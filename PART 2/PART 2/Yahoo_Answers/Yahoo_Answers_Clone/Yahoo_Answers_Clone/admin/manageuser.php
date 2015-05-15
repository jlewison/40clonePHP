<?PHP
	session_start();
	include("includes/restricted.php");
	require_once "../includes/configuration.php";
	require_once "../includes/classes/class.database.php";
	require_once "../includes/classes/class.user.php";
	require_once "../includes/classes/class.country.php";
	require_once "../includes/classes/class.langauge.php";
	require_once "includes/fileoperation.php";
	require_once "includes/functions.php";

	$objMember=new user();
	$objCountry=new country();
	$objLanguage=new language();
	
	$rsLanguage = $objLanguage->GetList(array(array('languageid','!=',"")),'language',true);

	if($_SESSION['languageid'] == '' || $_SESSION['languageid'] == 0) {
		for($i=0;$i<count($rsLanguage);$i++) {
			if($rsLanguage[$i]->language == "English") {
				$language_id = $rsLanguage[$i]->language_masterId;
			}
		}
	}
	else {
		$language_id = $_SESSION['languageid'];
	}
	if($HTTP_POST_VARS['cmdAdd']=='Add'){
		$objMember->first_name=($HTTP_POST_VARS['txtfname']);
		$objMember->last_name=($HTTP_POST_VARS['txtlname']);
		$objMember->emailid=$HTTP_POST_VARS['txtmail'];
		$objMember->address=($HTTP_POST_VARS['txtAddress']);
		$objMember->city=$HTTP_POST_VARS['txtcity'];
		$objMember->state=$HTTP_POST_VARS['txtstate'];
		$objMember->zipcode=$HTTP_POST_VARS['txtzip'];
		$objMember->countryid=$HTTP_POST_VARS['cmbCountry'];
		$objMember->languageid=$HTTP_POST_VARS['cmbLanguage'];
		$objMember->username=($HTTP_POST_VARS['txtuname']);
		if($_FILES['txtphoto']['name'] != '') {
			$type = explode("/",$_FILES['txtphoto']['type']);
			if($type[0] == 'image') {
				resizeimage($_FILES['txtphoto'],"../uploads/user");
				$objMember->photo=$_FILES['txtphoto']['name'];
			}
		}
		if($HTTP_POST_VARS['radActive']=='Active'){
			$objMember->status='Active';
		}else{
			$objMember->status='Inactive';
		}
		if($HTTP_POST_VARS['txtpassword']==$HTTP_POST_VARS['txtRpassword']){
			$objMember->password=$HTTP_POST_VARS['txtpassword'];
			$HTTP_POST_VARS['cmdAdd']='';
			$id=$objMember->Save();
			$msg="Record added successfully.";
		}
		else{
			$msg="Retype Password and Password both are same.";
		}
	}
		if($HTTP_POST_VARS['cmdUpdate']=='Update'){
		$objMember->userId=($HTTP_POST_VARS['memberid']);
		$objMember->first_name=($HTTP_POST_VARS['txtfname']);
		$objMember->last_name=($HTTP_POST_VARS['txtlname']);
		$objMember->emailid=$HTTP_POST_VARS['txtmail'];
		$objMember->address=($HTTP_POST_VARS['txtAddress']);
		$objMember->city=$HTTP_POST_VARS['txtcity'];
		$objMember->state=$HTTP_POST_VARS['txtstate'];
		$objMember->zipcode=$HTTP_POST_VARS['txtzip'];
		$objMember->countryid=$HTTP_POST_VARS['cmbCountry'];
		$objMember->languageid=$HTTP_POST_VARS['cmbLanguage'];
		$objMember->username=($HTTP_POST_VARS['txtuname']);
		if($_FILES['txtphoto']['name'] != '') {
			$type = explode("/",$_FILES['txtphoto']['type']);
			if($type[0] == 'image') {
				resizeimage($_FILES['txtphoto'],"../uploads/user");
				$objMember->photo=$_FILES['txtphoto']['name'];
			}
		}
		if($HTTP_POST_VARS['radActive']=='Active'){
			$objMember->status='Active';
		}else{
			$objMember->status='Inactive';
		}
		if($HTTP_POST_VARS['txtpassword']==$HTTP_POST_VARS['txtRpassword']){
			$objMember->password=$HTTP_POST_VARS['txtpassword'];
			$HTTP_POST_VARS['cmdAdd']='';
			$id=$objMember->Save();
			$msg="Record added successfully.";
		}
		else{
			$msg="Retype Password and Password both are same.";
		}
	}
	if($_POST['act'] == 'edit') {
		$rsEditMember = $objMember->GetList(array(array('userid','=',$HTTP_POST_VARS['memberid'])),'name',false);
		$_POST['act'] = '';
	}

	if($_POST['act'] == 'delete') {
		$objMember->userId = $HTTP_POST_VARS['memberid'];
		$objMember->Delete();
		
		$sSQL = "DELETE FROM answers WHERE userid = '".$HTTP_POST_VARS['memberid']."'";
		mysql_query($sSQL);
		
		$sSQL = "DELETE FROM question WHERE userid = '".$HTTP_POST_VARS['memberid']."'";
		mysql_query($sSQL);
		
		$sSQL = "DELETE FROM watchlist WHERE userid = '".$HTTP_POST_VARS['memberid']."'";
		mysql_query($sSQL);
		
		$_POST['act'] = '';
		$msg = "Record deleted successfully";
	}

	$page_size = 10;
	$rsMember =	$objMember->GetList(array(array('userid','!=',"")),'',true);
	$total_record = count($rsMember);
	if($total_record > $page_size) {
		if(isset($_POST['page']) && $_POST['page'] != '') {
			$page = $_POST['page'];
		} else {
			$page = 1;
		}
		$limit_start  = ($page - 1) * $page_size;
		$limit        = "$limit_start, ".$page_size;
		$rsMember = $objMember->GetList(array(array('userid','!=',"")),'', true,$limit);
	}
	$rsLanguage =$objLanguage->GetList(array(array('languageid','!=',"")),'',true);
	$rsCountry = $objCountry->GetList(array(array('countryid','!=',"")),'',true);

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="css/style.css" rel="stylesheet" type="text/css">
<title>Admin Panel</title>
<script language="javascript">
   function next_prev_page(val) {
		document.frmListMember.page.value = val;
		document.frmListMember.submit();
	}
	function Memberaction(act,val) {
		result = true;
		document.frmAddMember.act.value = act;
		document.frmAddMember.memberid.value = val;
		if(act == 'delete') {
			result = confirm("Do you want to delete ?");
		}
		if(!result) {
			return false;
		}	
		document.frmAddMember.submit();
	}
</script>

</head>
<body leftmargin="0" topmargin="0">
<table border="0" width="900px" cellpadding="0" cellspacing="0" align="center">
  <tr>
    <td colspan="2"><?php include("includes/top.php");?></td>
  </tr>
  <tr bgcolor="#316CA8">
    <td  height="6" colspan="2"><img src="images/transparent.gif" width="10" height="5"></td>
  </tr>
  <tr bgcolor="#C7B9E2">
    <td  height="25" colspan="2" bgcolor="#A6C8E1"><font color="#003366" size="3">&nbsp;&nbsp;<strong>Welcome To Admin Panel</strong></font></td>
  </tr>
  <tr  valign=top>
    <td height="16" colspan="2"><table width="100%" height="24"  border="0" cellpadding="0" cellspacing="0">
        <tr bgcolor="D3EDF6">
          <td height="8" colspan="5" valign="top"><img src="images/transparent.gif" width="10" height="8"></td>
        </tr>
        <tr>
          <td width="14" height="16" valign="top"><img src="images/leftcurve.gif" width="14" height="16"></td>
          <td width="167" height="16" valign="bottom" background="images/middleline.gif"><div align="left"><img src="images/transparent.gif" width="169" height="1"></div></td>
          <td width="35" height="16" valign="top"><div align="left"><img src="images/middlecurve.gif" width="35" height="16"></div></td>
          <td height="16" background="images/middleline.gif"><div align="right"><img src="images/transparent.gif" width="10" height="16"></div></td>
          <td width="17" height="16" valign="top"><img src="images/rightcurve.gif" width="17" height="16"></td>
        </tr>
      </table></td>
  </tr>
  <tr  valign=top>
    <td width=205 bgcolor="D3EDF6"><table width="100%"  border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td width="15" height="289" background="images/leftline.gif">&nbsp;</td>
          <td width="179" height="250" valign="top" bgcolor="#FFFFFF"><img src="images/transparent.gif" width="167" height="1">
            <?php include("includes/left.php");?></td>
          <td width="23" background="images/column.gif">&nbsp;</td>
        </tr>
        <tr>
          <td valign="top"><img src="images/botleft.gif" width="15" height="17"></td>
          <td height="17" background="images/botlinr.gif" style="background-repeat:repeat-x;">&nbsp;</td>
          <td valign="top"><img src="images/botright.gif" width="23" height="17"></td>
        </tr>
        <tr>
          <td height="19">&nbsp;</td>
          <td>&nbsp;</td>
          <td background="images/tryliner.gif" bgcolor="#FFFFFF">&nbsp;</td>
        </tr>
        <tr>
          <td height="19">&nbsp;</td>
          <td>&nbsp;</td>
          <td valign="top" bgcolor="D3EDF6"><div align="right"></div></td>
        </tr>
      </table></td>
    <td height="0" bgcolor="#D3EDF6"><table width="100%"  border="0" cellpadding="0" cellspacing="0">
        <tr height="300px">
          <td bgcolor="#FFFFFF"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td align="center" bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr height="2px">
                      <td></td>
                    </tr>
                    <tr>
                      <td class="HdText2" align="left">User Settings / Manage Users</td>
                    </tr>
                    <tr>
                      <td align="center" class="redlink"></td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                    </tr>
                    <tr>
                      <td><table width="100%" cellpadding="0" cellspacing="0" border="0">
                          <form name="frmListMember" id="frmListMember" method="post" action="manageuser.php">
	 			  		  <input name="page" id="page" value="" type="hidden" />

                            <tr>
                              <td class="HdText3" align="center">Sr no </td>
                              <td class="HdText3" align="center">First Name </td>
                              <td class="HdText3" align="center">Email </td>
                              <td class="HdText3" align="center">User Name </td>
                              <td class="HdText3" align="center">Edit </td>
                            </tr>
				 			<?PHP 
							if(count($rsMember)>0){
								for($i=0;$i<count($rsMember);$i++){?>
								<tr>
								<td class="tbltd" align="center"><?PHP echo $i+1; ?> </td>
								<td class="tbltd" align="center"><?PHP echo ($rsMember[$i]->first_name); ?> </td>
								<td class="tbltd" align="center"><?PHP echo $rsMember[$i]->emailid; ?></td>
								<td class="tbltd" align="center"><?PHP echo ($rsMember[$i]->username); ?></td>
								<td class="tbltd" align="center"><a href="#" onclick="return Memberaction('edit','<?php echo $rsMember[$i]->userId;?>');" >Edit</a>&nbsp;-&nbsp; <a href="#"  onclick="return Memberaction('delete','<?php echo $rsMember[$i]->userId;?>')" >Delete</a> </td>
								</tr>
							<?PHP
							}
							}else{?>
								<tr>
								<td colspan="5" class="redlink" align="center">No Record Found</td>
								</tr>
							<?PHP 
							}?>
							<?php 
							if($total_record > $page_size) {?>
							<tr>
							<td colspan="5" align="left"><?php echo pagging_fun($page,$total_record,$page_size,"");?></td>
							</tr>
							<?PHP 
							}?>
                            </form>
                        </table></td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                    </tr>
                    <tr>
                      <td><table width="100%" cellpadding="2" cellspacing="2" border="0">
                          <tr>
                            <td class="HdText3" align="left" colspan="2">&nbsp;Add / Edit User</td>
                          </tr>
                          <tr>
                            <td colspan="2">&nbsp;</td>
                          </tr>
                          <form name="frmAddMember" enctype="multipart/form-data" id="frmAddMember" method="post" action="manageuser.php" onsubmit="return manageuser_validation();">
                            <input type="hidden" id="memberid" name="memberid" value="<?PHP echo  $HTTP_POST_VARS['memberid'];?>" />
                            <input name="page" id="page" value="" type="hidden" />
                            <input name="act" id="act" value="" type="hidden" />
                            <tr>
                              <td align="right">First Name :</td>
                              <td align="left"><input type="text" name="txtfname" id="txtfname" value="<?PHP echo $rsEditMember[0]->first_name;?>" />
                              </td>
                            </tr>
                            <tr>
                              <td align="right">Last Name :</td>
                              <td align="left"><input type="text" name="txtlname" id="txtlname" value="<?PHP echo $rsEditMember[0]->last_name;?>" />
                              </td>
                            </tr>
                            <tr>
                              <td align="right">Email :</td>
                              <td align="left"><input type="text" name="txtmail" id="txtmail" value="<?PHP echo $rsEditMember[0]->emailid;?>" />
                              </td>
                            </tr>
                            <tr>
                              <td align="right">Address :</td>
                              <td align="left"><textarea name="txtAddress" id="txtAddress"><?PHP echo $rsEditMember[0]->address;?></textarea>
                              </td>
                            </tr>
                            <tr>
                              <td align="right">City :</td>
                              <td align="left"><input type="text" name="txtcity" id="txtcity" value="<?PHP echo $rsEditMember[0]->city;?>" />
                              </td>
                            </tr>
                            <tr>
                              <td align="right">State :</td>
                              <td align="left"><input type="text" name="txtstate" id="txtstate" value="<?PHP echo $rsEditMember[0]->state;?>" />
                              </td>
                            </tr>
                            <tr>
                              <td align="right">Zip Code :</td>
                              <td align="left"><input type="text" name="txtzip" id="txtzip" value="<?PHP echo $rsEditMember[0]->zipcode;?>" />
                              </td>
                            </tr>
                            <tr>
                              <td align="right">Country :</td>
                              <td align="left"><select name="cmbCountry">
                   			  <?PHP 
								for($i=0;$i<count($rsCountry);$i++){
									if($rsCountry[$i]->countryId==$rsEditMember[0]->countryid){
								?>
									<option value="<?PHP echo $rsCountry[$i]->countryId;?>" selected="selected"><?PHP echo $rsCountry[$i]->countryname;?></option>
								<?PHP 
									}else{?>
									<option value="<?PHP echo $rsCountry[$i]->countryId;?>"><?PHP echo $rsCountry[$i]->countryname;?></option>
									<?PHP 
									}					  
								} ?>
                                </select>
                              </td>
                            </tr>
                            <tr>
                              <td align="right">Language :</td>
                              <td align="left"><select name="cmbLanguage">
							 <?PHP 
								for($i=0;$i<count($rsLanguage);$i++){
									if($rsLanguage[$i]->languageId==$rsEditMember[0]->langid){
								?>
									<option value="<?PHP echo $rsLanguage[$i]->languageId;?>" selected="selected"><?PHP echo $rsLanguage[$i]->language_name;?></option>
								<?PHP 
									}else{?>
									<option value="<?PHP echo $rsLanguage[$i]->languageId;?>"><?PHP echo $rsLanguage[$i]->language_name;?></option>
								<?PHP 
									}
								}?>
			                    </select>					
                              </td>
	                          </tr>
	`                         <tr>
                              <td align="right">Photo :</td>
                              <td align="left"><input type="file" name="txtphoto" id="txtphoto" value="<?PHP echo $rsEditMember[0]->photo;?>" />
                              </td>
                            </tr>

                            <tr>
                              <td align="right">User name :</td>
                              <td align="left"><input type="text" name="txtuname" id="txtuname" value="<?PHP echo $rsEditMember[0]->username;?>" />
                              </td>
                            </tr>
                            <tr>
                              <td align="right">Password :</td>
                              <td align="left"><input type="password" name="txtpassword" id="txtpassword" value="<?PHP echo $rsEditMember[0]->password;?>" />
                              </td>
                            </tr>
                            <tr>
                              <td align="right">Retype Password :</td>
                              <td align="left"><input type="password" name="txtRpassword" id="txtRpassword" value="<?PHP echo $rsEditMember[0]->password;?>" />
                              </td>
                            </tr>
                            <tr>
                              <td align="right">Active :</td>
                              <td align="left"><input type="radio" value="Active" <?PHP if( $rsEditMember[0]->status=='Active'){?> checked="checked"<?php }?> name="radActive"   />
                                On<br />
                                <input type="radio" name="radActive" <?PHP if( $rsEditMember[0]->status=='Inactive'){?> checked="checked"<?php }?> value="Inactive"  />
                                Off </td>
                            </tr>
                            <tr>
                              <td colspan="2" align="center"><input type="submit" name="cmdAdd" id="cmdAdd" value="Add"  onclick="return manageuser_validation();" />
                                &nbsp;
                                <input type="submit" name="cmdUpdate" id="cmdUpdate" value="Update"   onclick="return manageuser_validation();" />
                              </td>
                            </tr>
                          </form>
                        </table></td>
                    </tr>
                  </table></td>
              </tr>
            </table></td>
          <td width="6" bgcolor="#D3EDF6"><img src="images/transparent.gif" width="6" height="8"></td>
        </tr>
        <tr bgcolor="#D3EDF6">
          <td colspan="2" valign="top"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="99%" background="images/botline.gif"><img src="images/botcurve.gif" width="13" height="17"></td>
                <td width="1%" height="18" valign="top"><img src="images/botrighcurve.gif" width="19" height="18"></td>
              </tr>
            </table></td>
        </tr>
      </table></td>
  </tr>
  <tr  valign=middle bgcolor="B19FD2">
    <td height="30" colspan="2" bgcolor="#A6C8E1"><?php include("includes/bottom.php");?></td>
    </td>
  </tr>
</table>
</body>
</html>
