<?php
session_start();
require_once "../includes/configuration.php";
require_once "../includes/classes/class.database.php";

	if($_SESSION['username'] == "") {
		$_SESSION['requestedurl'] = $_SERVER['REQUEST_URI'];
		header("Location: index.php");
		exit;
	?>
	<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
	<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<title>Tahiti Zik - Polynesian Music (Restricted Area)</title>
	<link href="../style.css" rel="stylesheet" type="text/css" />
	<!--[if lt IE 7]>
	<script defer type="text/javascript" src="pngfix.js"></script>
	<![endif]-->
	</head>
	<body>
	<table width="100%" border="0" cellpadding="0" cellspacing="0" class="MainTable">
	  <tr >
		<td>
		  <div class="Header">
				<table width="100%" border="0" cellspacing="0" cellpadding="0">
					<tr>
						<td class="Header"><img src="images/tahitizik.png" width="185" height="65" /></td>
					</tr>
				</table>
			</div>
		</td>
	  </tr>
	  <tr height="370px">
		<td>
			<table width="100%" cellpadding="0" cellspacing="0" border="0">
				<tr>
					<td align="center"><img src="images/STOP.gif" /></td>
				</tr>
				<tr>
					<td>&nbsp;</td>
				</tr>
				<tr>
					<td align="center"><strong>You are in a restricted area of Tahiti Zik - Polynesian Music. Please <a href="index.php"><font color="#FF0000">click here</font></a> to login</strong></td>
				</tr>
			</table>
		</td>
	  </tr>
	  <tr>
		<td class="Footer"><?php include("footer.php")?></td>
	  </tr>
	</table>
	</body>
	</html>
<?PHP
	exit;
}
?>