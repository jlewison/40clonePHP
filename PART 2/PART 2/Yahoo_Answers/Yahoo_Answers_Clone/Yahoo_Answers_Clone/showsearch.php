<?PHP
	session_start();

	require_once("includes/configuration.php");
	require_once("includes/classes/class.database.php");
	require_once("includes/classes/class.question.php");
	require_once("includes/classes/class.category.php");
	require_once("includes/classes/class.user.php");
	require_once("includes/classes/class.langauge.php");	
	
	$objQuestion = new question();
	$objCategory = new category();
	$objUser = new user();
	$objLanguage = new language();
	
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
	
	$limit        = "0,5 ";
	$rsQuestion = $objQuestion->GetList(array(array('question_text','LIKE','%'.$HTTP_POST_VARS['txtSearch'].'%'),array('langid','=',$language_id)),'',true);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="css/style.css" rel="stylesheet" type="text/css">
<title>Welcome</title>
</head>
<body leftmargin="0" topmargin="0">
<table border="0" width="900px" cellpadding="0" cellspacing="0" height="100%" align="center"> 
  <tr> 
    <td colspan="2"><?php include("includes/top.php");?></td> 
  </tr>
  <tr>
  	<td colspan="2" bgcolor="#A6C8E1"><?php include("includes/search.php");?></td>
  </tr> 
  <tr>
  	<td width="250" valign="top"><?php include("includes/left.php");?></td>
	<td width="650" valign="top">
		<table width="100%" cellpadding="3" cellspacing="0" border="0">
			<tr>
				<td height="13px"></td>
			</tr>
			<tr>
				<td align="left" bgcolor="#666666"><font color="#FFFFFF"><strong>Search Result</strong></font></td>
			</tr>
			<tr>
				<td>
					<table width="100%" cellpadding="2" cellspacing="0" border="0">
						<?PHP
							for($i=0;$i<sizeof($rsQuestion);$i++) {
							$rsUser = $objUser->GetList(array(array('userid','=',$rsQuestion[$i]->userid)),'',true);
						?>
						<tr bgcolor="#EFEFEF">
							<td><img src="<?PHP if($rsUser[0]->photo != '') { echo "uploads/user/thumb/".$rsUser[0]->photo; } else {
											echo "images/man.gif"; }?>" border="0" /></td>
							<td colspan="3" class="questiontext"><a href="questiondetail.php?questionid=<?PHP echo $rsQuestion[$i]->questionId; ?>"><?PHP echo $rsQuestion[$i]->title; ?></a></td>
						</tr>
						<tr bgcolor="#EFEFEF">
							<td>&nbsp;</td>
							<td width="10px">&nbsp;<?PHP echo $rsQuestion[$i]->rate; ?>&nbsp;</td>
							<td width="26px"><img src="images/star1.gif" border="0" /></td>
							<?PHP 
								$rsCategory = $objCategory->GetList(array(array('categoryid','=',$rsQuestion[$i]->categoryid),array('langid','=',$language_id)),'',true);
								
							?>
							<td>&nbsp;In <a href="categorydetail.php?catid=<?PHP echo $rsCategory[0]->categoryId;?>"><?PHP echo $rsCategory[0]->category_name; ?></a> - Asked by <a href="userdetail.php?userid=<?PHP echo $rsUser[0]->userId;?>"><?PHP echo $rsUser[0]->username; ?></a></td>
						</tr>
						<tr>
							<td>&nbsp;</td>
						</tr>
						<?PHP 
						}
						
						if(count($rsQuestion) == 0) {
						?>
						<tr>
							<td align="center" colspan="4"><strong>No Record Related To Your Search Found !!</strong></td>
						</tr>
						<?PHP
						}
						?>
					</table>
				</td>
			</tr>
		</table>
	</td>
  </tr> 
  <tr> 
    <td height="15" colspan="2" bgcolor="#A6C8E1"><?php include("includes/bottom.php");?></td>
  </tr> 
</table>
</body>
</html>