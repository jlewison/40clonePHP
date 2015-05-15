<?php
	session_start();
	require_once("../includes/configuration.php");
	require_once("../includes/classes/class.database.php");
	require_once("../includes/classes/class.user.php");

	$objUser=new user();

	if($HTTP_POST_VARS['txtUsername'] == 'admin' && $HTTP_POST_VARS['txtPassword'] == 'admin'){
		$_SESSION['username']=$HTTP_POST_VARS['txtUsername'];
		$_SESSION['password']=$HTTP_POST_VARS['txtPassword'];
		header("location:welcome.php");
		exit;
	}
	else{
		$msg= "Entered Username or password is invalid";
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="css/style.css" rel="stylesheet" type="text/css">
<title>Admin Panel</title>
</head>
<body leftmargin="0" topmargin="0">

<table border="0" width="900px" cellpadding="0" cellspacing="0" height="100%" align="center">
  <tr>
    <td colspan="2"><?php include("includes/top.php");?></td>
  </tr>
  <tr bgcolor="#316CA8">
    <td  height="6" colspan="2"><img src="images/transparent.gif" width="10" height="5"></td>
  </tr>
  <tr bgcolor="#C7B9E2">
    <td  colspan="2" bgcolor="#A6C8E1"> <font color="#003366" size="3">&nbsp;&nbsp;<strong>Welcome To Admin Panel</strong></font></td>
  </tr>
  <tr  valign=top>
    <td height="16" colspan="2"><table width="100%" height="24"  border="0" cellpadding="0" cellspacing="0">
        <tr bgcolor="D3EDF6">
          <td height="8" colspan="5" valign="top"><img src="images/transparent.gif" width="10" height="8"></td>
        </tr>
      </table></td>
  </tr>
  <tr  valign=top>
     <td width="780" height="0" bgcolor="#D3EDF6"><table width="100%"  border="0" cellpadding="0" cellspacing="0">
      <tr bgcolor="#D3EDF6">
        <td colspan="2" valign="top">
			<form name="frmLogin" action="index.php" method="post">
				<table width="50%" align="center" cellpadding="2" cellspacing="0" border="0">
					<tr>
						<td colspan="3" align="left">Restricted Area</td>
					</tr>
					<tr>
					<td colspan="3" align="center"><?php echo $msg;?></td>
					</tr>
					<tr>
						<td colspan="3">&nbsp;</td>
					</tr>
					<tr>
						<td align="right"><strong>Username</strong></td>
						<td align="center" width="5%"><strong>:</strong></td>
						<td align="left"><input type="text" name="txtUsername" value="" /></td>
					</tr>
					<tr>
						<td align="right"><strong>Password</strong></td>
						<td align="center" width="5%"><strong>:</strong></td>
						<td align="left"><input type="password" name="txtPassword" value="" /></td>
					</tr>
					<tr>
						<td align="center" colspan="3"><input type="submit" name="btnSubmit" value="Login" /></td>
					</tr>
					<tr>
						<td colspan="3">&nbsp;</td>
					</tr>
				</table>
			</form>
		</td>
      </tr>
    </table></td>
  </tr>
  <tr  valign=top bgcolor="D3EDF6">
    <td height="17" colspan="2">&nbsp;</td>
  </tr>
  <tr bgcolor="B19FD2">
    <td height="15" colspan="2" bgcolor="#A6C8E1"><?php include("includes/bottom.php");?></td></tr>
</table>
</body>
</html>