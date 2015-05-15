<?PHP
	session_start();
	include("includes/restricted.php");
	require_once "../includes/configuration.php";
	require_once "../includes/classes/class.database.php";
	require_once "../includes/classes/class.country.php";
	require_once "includes/fileoperation.php";
	require_once "includes/functions.php";

	$objCountry=new country();
	
	if($HTTP_POST_VARS['cmdAdd']=='Add'){
		$objCountry->countryname=($HTTP_POST_VARS['txtCountryName']);
		$objCountry->countrycode=($HTTP_POST_VARS['txtCountryCode']);

		$HTTP_POST_VARS['cmdAdd']='';
		$id=$objCountry->Save();
		$msg="Record added successfully.";
	}

	if($HTTP_POST_VARS['cmdUpdate']=='Update'){
		$objCountry->countryId=($HTTP_POST_VARS['countryid']);
		$objCountry->countryname=($HTTP_POST_VARS['txtCountryName']);
		$objCountry->countrycode=($HTTP_POST_VARS['txtCountryCode']);

		$HTTP_POST_VARS['cmdAdd']='';
		$id=$objCountry->Save();
		$msg="Record added successfully.";
	}

	if($_POST['act'] == 'edit') {
		$rsEditCountry = $objCountry->GetList(array(array('countryId','=',$HTTP_POST_VARS['countryid'])),'countryname',false);
		$_POST['act'] = '';
	}

	if($_POST['act'] == 'delete') {
		$objCountry->countryId = $HTTP_POST_VARS['countryid'];
		$objCountry->Delete();
		$_POST['act'] = '';
		$msg = "Record deleted successfully";
	}

	$page_size = 10;
	$rsCountry = $objCountry->GetList(array(array('countryId','!=',"")),'',true);
	$total_record = count($rsCountry);
	if($total_record > $page_size) {
		if(isset($_POST['page']) && $_POST['page'] != '') {
			$page = $_POST['page'];
		} else {
			$page = 1;
		}
		$limit_start  = ($page - 1) * $page_size;
		$limit        = "$limit_start, ".$page_size;
		$rsCountry = $objCountry->GetList(array(array('countryId','!=',"")),'', true,$limit);
	}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="css/style.css" rel="stylesheet" type="text/css">
<title>Admin Panel</title>
<script language="javascript">
   function next_prev_page(val) {
		document.frmListCountry.page.value = val;
		document.frmListCountry.submit();
	}
	function Memberaction(act,val) {
		result = true;
		document.frmAddCountry.act.value = act;
		document.frmAddCountry.countryid.value = val;
		if(act == 'delete') {
			result = confirm("Do you want to delete ?");
		}
		if(!result) {
			return false;
		}	
		document.frmAddCountry.submit();
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
                      <td class="HdText2" align="left">Country Settings / Manage Country</td>
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
                          <form name="frmListCountry" id="frmListCountry" method="post" action="managecountry.php">
	 			  		  <input name="page" id="page" value="" type="hidden" />

                            <tr>
                              <td class="HdText3" align="center">Sr no </td>
                              <td class="HdText3" align="center">Country Name </td>
                              <td class="HdText3" align="center">Country Code </td>
                              <td class="HdText3" align="center">Edit </td>
                            </tr>
				 			<?PHP 
							if(count($rsCountry)>0){
								for($i=0;$i<count($rsCountry);$i++){?>
								<tr>
								<td class="tbltd" align="center"><?PHP echo $i+1; ?> </td>
								<td class="tbltd" align="center"><?PHP echo ($rsCountry[$i]->countryname); ?> </td>
								<td class="tbltd" align="center"><?PHP echo $rsCountry[$i]->countrycode; ?></td>
								<td class="tbltd" align="center"><a href="#" onclick="return Memberaction('edit','<?php echo $rsCountry[$i]->countryId;?>');" >Edit</a>&nbsp;-&nbsp; <a href="#"  onclick="return Memberaction('delete','<?php echo $rsCountry[$i]->countryId;?>')" >Delete</a> </td>
								</tr>
							<?PHP
							}
							}else{?>
								<tr>
								<td colspan="5" class="redlink" align="center">No Record Found</td>
								</tr>
							<?PHP 
							}?>
							                            </form>
<?php 
							if($total_record > $page_size) {?>
							<tr>
							<td colspan="5" align="left"><?php echo pagging_fun($page,$total_record,$page_size,"");?></td>
							</tr>
							<?PHP 
							}?>
                                                        
                        </table></td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                    </tr>
                    <tr>
                      <td><table width="100%" cellpadding="2" cellspacing="2" border="0">
                          <tr>
                            <td class="HdText3" align="left" colspan="2">&nbsp;Add / Edit Country</td>
                          </tr>
                          <tr>
                            <td colspan="2">&nbsp;</td>
                          </tr>
                          <form name="frmAddCountry" enctype="multipart/form-data" id="frmAddCountry" method="post" action="managecountry.php" onsubmit="return manageuser_validation();">
                            <input type="hidden" id="countryid" name="countryid" value="<?PHP echo  $HTTP_POST_VARS['countryid'];?>" />
                            <input name="page" id="page" value="" type="hidden" />
                            <input name="act" id="act" value="" type="hidden" />
                            <tr>
                              <td align="right">Country Name :</td>
                              <td align="left"><input type="text" name="txtCountryName" id="txtCountryName" value="<?PHP echo $rsEditCountry[0]->countryname;?>" />
                              </td>
                            </tr>
                            <tr>
                              <td align="right">Country Code :</td>
                              <td align="left"><input type="text" name="txtCountryCode" id="txtCountryCode" value="<?PHP echo $rsEditCountry[0]->countrycode;?>" />
                              </td>
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
