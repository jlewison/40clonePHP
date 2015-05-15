<?PHP
	session_start();
	
	require_once("includes/configuration.php");
	require_once("includes/classes/class.database.php");
	require_once("includes/classes/class.question.php");
	require_once("includes/classes/class.user.php");
	require_once("includes/classes/class.country.php");
	require_once "includes/fileoperation.php";

	$objMember = new user();
	$objCountry = new country();

	if($_SESSION['languageid'] == '' || $_SESSION['languageid'] == 0) {
		for($i=0;$i<count($rsLanguage);$i++) {
			if($rsLanguage[$i]->language_name == "English") {
				$language_id = $rsLanguage[$i]->languageId;
			}
		}
	}
	else {
		$language_id = $_SESSION['languageid'];
	}

	if(!$HTTP_POST_VARS['userid']) {
		$userid1 = $_GET['userid'];
	}
	else {
		$userid1 = $HTTP_POST_VARS['userid'];
	}

	if($HTTP_POST_VARS['cmdUpdate']=='Update'){
		$objMember->userId=($userid1);
		$objMember->first_name=$HTTP_POST_VARS['txtfname'];
		$objMember->last_name=$HTTP_POST_VARS['txtlname'];
		$objMember->emailid=$HTTP_POST_VARS['txtmail'];
		$objMember->address=$HTTP_POST_VARS['txtAddress'];
		$objMember->city=$HTTP_POST_VARS['txtcity'];
		$objMember->state=$HTTP_POST_VARS['txtstate'];
		$objMember->zipcode=$HTTP_POST_VARS['txtzip'];
		$objMember->countryid=$HTTP_POST_VARS['cmbCountry'];
		$objMember->languageid=$HTTP_POST_VARS['cmbLanguage'];
		$objMember->username=$HTTP_POST_VARS['txtusername'];
		$objMember->password=$HTTP_POST_VARS['txtpassword'];

		if($_FILES['txtphoto']['name'] != '') {
			$type = explode("/",$_FILES['txtphoto']['type']);
			if($type[0] == 'image') {
				resizeimage($_FILES['txtphoto'],"uploads/user");
				$objMember->photo=$_FILES['txtphoto']['name'];
			}
		}
		else {
			$objMember->photo = $_POST['txtOldImage'];
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
			$msg="Record updated successfully.";
			
		}
		else{
			$msg="Retype Password and Password both must be same.";
		}
	}
	$rsEditMember = $objMember->GetList(array(array('userid','=',$userid1)),'name',false);

	$rsCountry = $objCountry->GetList(array(array('countryId','!=','')),'',true);
?>
<?php include("includes/top.php");?>
		<?php include("includes/search.php");?>
		<DIV class=home id=y-body-green-knowledge-search>
			<DIV id=content>
				<?php include("includes/left.php");?>
			<DIV id=middle>
				<DIV id=ks-homepage-heading>My Account</DIV>
				<DIV class=silk_hp_open id=ks-homepage-questions>
					<table width="100%" cellpadding="3" cellspacing="0" border="0">
			<tr>
				<td height="13px"><?=$msg?></td>
			</tr>
			<tr>
				<td>
					<table width="100%" cellpadding="2" cellspacing="2" border="0">
				<form name="frmCrRegister" id="frmCrRegister" method="post" enctype="multipart/form-data" action="myaccount.php" onSubmit="return frontcreateaccount();">
				<input type="hidden" name="userid" id="userid" value="<?php echo $userid1;?>" />
				<input type="hidden" name="txtOldImage" id="txtOldImage" value="<?php echo $rsEditMember[0]->photo;?>" />
                <input type="hidden" name="cmbLanguage" id="cmbLanguage" value="1">
                    <tr>
                      <td align="right">First Name </td>
                      <td align="center">:</td>
                      <td align="left"><input type="text" name="txtfname" id="txtfname" value="<?PHP echo $rsEditMember[0]->first_name;?>" />&nbsp;<span class="star"></span></td>
                    </tr>
                    <tr>
                      <td align="right">Last Name </td>
                      <td align="center">:</td>
                      <td align="left"><input type="text" name="txtlname" id="txtlname" value="<?PHP echo $rsEditMember[0]->last_name;?>" />&nbsp;<span class="star"></span></td>
                    </tr>
                    <tr>
                      <td align="right">E-Mail</td>
                      <td align="center">:</td>
                      <td align="left"><input type="text" name="txtmail" id="txtmail" value="<?PHP echo $rsEditMember[0]->emailid;?>" />&nbsp;<span class="star"></span></td>
                    </tr>
                    <tr>
                      <td align="right">Address</td>
                      <td align="center">:</td>
                      <td align="left"><textarea name="txtAddress" id="txtAddress"><?PHP echo $rsEditMember[0]->address;?></textarea></td>
                    </tr>
                    <tr>
                      <td align="right">City</td>
                      <td align="center">:</td>
                      <td align="left"><input type="text" name="txtcity" id="txtcity" value="<?PHP echo $rsEditMember[0]->city;?>" /></td>
                    </tr>		
                    <tr>
                      <td align="right">State</td>
                      <td align="center">:</td>
                      <td align="left"><input type="text" name="txtstate" id="txtstate" value="<?PHP echo $rsEditMember[0]->state;?>" /></td>
                    </tr>
                    <tr>
                     
                    </tr>
                    <tr>
                      <td align="right">Country</td>
                      <td align="center">:</td>
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
                                </select>					</td>
                    </tr>
                    <tr>
                      <td align="right">Display Image</td>
                      <td align="center">:</td>
                      <td align="left"><input type="file" name="txtphoto" id="txtphoto" value="<?PHP echo $rsEditMember[0]->photo;?>" /></td>
                    </tr>
                    <tr>
                      <td align="right">Username</td>
                      <td align="center">:</td>
                      <td align="left"><input type="hidden" name="txtusername" value="<?PHP echo $rsEditMember[0]->username;?>"><label><?PHP echo $rsEditMember[0]->username;?></label></td>
                    </tr>
                    <tr>
                      <td align="right">Password</td>
                      <td align="center">:</td>
                      <td align="left"><input type="password" name="txtpassword" id="txtpassword" value="<?PHP echo $rsEditMember[0]->password;?>" />&nbsp;<span class="star"></span></td>
                    </tr>
                    <tr>
                      <td align="right">Re-Type Password </td>
                      <td align="center">:</td>
                      <td align="left"><input type="password" name="txtRpassword" id="txtRpassword" value="<?PHP echo $rsEditMember[0]->password;?>" />&nbsp;<span class="star"></span></td>
                    </tr>
                    <tr>
					<td colspan="3" align="center">&nbsp;</td>
          			</tr>
					<tr>
					<td align="center" colspan="3">
					<input type="submit" name="cmdUpdate" id="cmdUpdate" value="Update"/>					</td>
					</tr>
					</form>
                  </table>				</td>
			</tr>
		</table>
				</DIV>
				<DIV class=dotted-line></DIV>
				<!--        <P class=more-link id=ks-more-link>
        <FORM action=#><INPUT class=button type=submit value="More Open Questions >"></FORM>
        </P> -->
			</DIV>
		</DIV>
	</DIV>
	<?php include("includes/bottom.php");?>