<?PHP
	session_start();
	require_once "includes/configuration.php";
	require_once "includes/classes/class.database.php";
	require_once "includes/classes/class.user.php";
	require_once "includes/classes/mailer.class.php";
	require_once "includes/classes/class.langauge.php";

	$objMail= new mailer();
	$objLanguage=new language();
	
	$rsLanguage = $objLanguage->GetList(array(array('languageid','!=',"")),'language',true);

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
	
	if($HTTP_POST_VARS['txtEmail']!=''&& $HTTP_POST_VARS['cmdGo']){
		$objUser=new user();
		$adminEmail = $objUser->GetList(array(array('emailid','=',$HTTP_POST_VARS['txtEmail'])));
		if(count($adminEmail)>0){
			$username=	$adminEmail[0]->username;
			$password=	$adminEmail[0]->password;
			$to=$HTTP_POST_VARS['txtEmail'];
			$subject="Admin of You Ask it";
			$message = "<table>
			<tr><td colspan='2' align='center'>Forget Password Details</td></tr>
			<tr><td>User Name:</td><td>".$username."</td></tr>
			<tr><td>Password:</td><td>".$password."</td></tr>
			<table>";
			$flag=$objMail->send_mail("admin@you-ask-it.com",$HTTP_POST_VARS['txtEmail'],$subject,$message);
			//$flag=$objMail->Send();
				if($flag==false){
					$msg="This email do not exist.";
				}
				else{
					$msg="Your password have been sent to your email:".$HTTP_POST_VARS['txtEmail'];
				}
		}
		else{
			$msg="This email do not exist.";
		}
	}
?>
<?php include("includes/top.php");?>
		<?php include("includes/search.php");?>
		<DIV class=home id=y-body-green-knowledge-search>
			<DIV id=content>
				<?php include("includes/left.php");?>
			<DIV id=middle>
				<DIV id=ks-homepage-heading>Forget Password</DIV>
				<DIV class=silk_hp_open id=ks-homepage-questions>
					<table width="100%" cellpadding="2" cellspacing="2" border="0">
	<form name="frmForget" id="frmForget" method="post" action="forgetpassword.php" onsubmit="return frontforgetprodpwd();">
	  <tr>
	  	<td  colspan="2" align="left">&nbsp;&nbsp;</td>
	</tr>
	  <tr>
		<td align="left" colspan="2"><?php echo "Email Address";?></td>
	  </tr>
	  <tr>
		<td width="34%" align="left"><input type="text" value="" name="txtEmail" id="txtEmail" /></td>
		<td width="66%" align="left"><input type="submit" value="<?php echo go?>" name="cmdGo" id="cmdGo" onclick="return frontforgetprodpwd();" /></td>
	  </tr>
	  <tr>
		<td colspan="2" align="left"><strong><?php echo "you will receive your password on this email address";?></strong></td>
	  </tr>
	</form>
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
<script src="js/formvalidation.js"></script>
<script src="js/general.js"></script>

</head>
<script language=JavaScript>
var message="Function Disabled!";

///////////////////////////////////
function clickIE4(){
	if (event.button==2){
		return false;
	}
}
function clickNS4(e){
	if (document.layers||document.getElementById&&!document.all){
		if (e.which==2||e.which==3){
			return false;
		}
	}
}
if (document.layers){
	document.captureEvents(Event.MOUSEDOWN);
	document.onmousedown=clickNS4;
}
else if (
	document.all&&!document.getElementById){
	document.onmousedown=clickIE4;
}
document.oncontextmenu=new Function("return false")
// --> 
</script>