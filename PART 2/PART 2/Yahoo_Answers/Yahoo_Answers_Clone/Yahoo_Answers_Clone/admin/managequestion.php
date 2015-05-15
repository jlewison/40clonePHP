<?php
	session_start();
	include("includes/restricted.php");

	require_once("../includes/configuration.php");
	require_once("../includes/classes/class.database.php");
	require_once("../includes/classes/class.category.php");
	require_once("../includes/classes/class.question.php");
	require_once("../includes/classes/class.langauge.php");
	require_once("../includes/classes/class.answer.php");
	require_once "includes/functions.php";	
	
	$objCategory = new category();
	$objQuestion = new question();
	$objLanguage = new language();
	$objAnswer = new answer();

	if($_POST['cmdAdd']) {
		$objQuestion->questionId = '';
		$objQuestion->langid = $_POST['language'];
		$objQuestion->question_text = $_POST['question'];
		$objQuestion->userid = $_SESSION['userid'];
		$objQuestion->categoryid = $_POST['level'];
		$objQuestion->date1 = $_POST['date'];
		$objQuestion->status = $_POST['radActive'];
		$objQuestion->abuse = 'No';

		$id = $objQuestion->Save();
		$msg = "Record Added Successfully";
	}

	if($_POST['cmdUpdate'] == 'Update') {
		$objQuestion->questionId = $_POST['questionid'];
		$objQuestion->langid = $_POST['language'];
		$objQuestion->question_text = $_POST['question'];
		$objQuestion->userid = $_SESSION['userid'];
		$objQuestion->categoryid = $_POST['level'];
		$objQuestion->date1 = $_POST['date'];
		$objQuestion->status = $_POST['radActive'];
		$objQuestion->abuse = 'No';

		$objQuestion->Save();		
		$msg = "Record Updated Successfully";	
	}
	
	if($_POST['act'] == 'delete') {
		$objQuestion->questionId = $_POST['questionid'];
		$objQuestion->Delete();		
	}

	if($_POST['act'] == 'edit') {
		$rsEditQuestion = $objQuestion->GetList(array(array('questionId','=',$_POST['questionid'])),'',true);
	}
	
	if($_GET['id'] != '') {
		$rsQuestion = $objQuestion->GetList(array(array('questionid','!=',""),array('categoryid','=',$_GET['id'])),'',true);
	}
	else {
		$rsQuestion = $objQuestion->GetList(array(array('questionid','!=',"")),'',true);
	}
	$total_record = count($rsQuestion);
	$page_size = 10;//$setting['ADMIN_PAGE_SIZE'];
	if($total_record > $page_size) {
		if(isset($_POST['page']) && $_POST['page'] != '') {
			$page = $_POST['page'];
		} else {
			$page = 1;
		}
	$limit_start  = ($page - 1) * $page_size;
	$limit        = "$limit_start, ".$page_size;
		if($_GET['id'] != '') {
		$rsQuestion = $objQuestion->GetList(array(array('questionid','!=',""),array('categoryid','=',$_GET['id'])),'',true);
	}
	else {
		$rsQuestion = $objQuestion->GetList(array(array('questionid','!=',"")),'',true);
	}
}


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="css/style.css" rel="stylesheet" type="text/css">
<title>Admin Panel</title>
<script language="javascript">
	function questionaction(act,id) {
		res = 1;
		if(act == 'delete') {
			res = confirm("Are you sure you want to delete catategory");
		}
		if(res) {
			document.frmListQuestion.questionid.value = id;
			document.frmListQuestion.act.value = act;
			document.frmListQuestion.submit();
		}
		else {
			return false;
		}
	}
	function questiondet(val){
		document.frmListQuestion.questionid.value = val;
		document.frmListQuestion.action = "question-detail.php";
		document.frmListQuestion.submit();
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
                      <td class="HdText2" align="left">Manage Question </td>
                    </tr>
                    <tr>
                      <td align="center" class="redlink"></td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                    </tr>
                    <tr>
                      <td align="center"><strong><font color="#FF0000"><?PHP echo $msg ?></font></strong></td>
                    </tr>
                    <tr>
                      <td><table width="100%" cellpadding="0" cellspacing="0" border="0">
                          <form name="frmListQuestion" id="frmListQuestion" method="post" action="">
                            <input type="hidden" id="questionid" name="questionid" value="" />
                            <input name="page" id="page" value="" type="hidden" />
                            <input name="act" id="act" value="" type="hidden" />
                            <tr>
                              <td width="8%" align="center" class="HdText3">Sr no </td>
                              <td width="44%" align="center" class="HdText3">Question </td>
                              <td width="16%" align="center" class="HdText3">Category  </td>
                              <td width="12%" align="center" class="HdText3">Status </td>
                              <td width="20%" align="center" class="HdText3">Edit </td>
                            </tr>
                            <?PHP
								for($i=0;$i<sizeof($rsQuestion);$i++) {
									$rsEditCategory = $objCategory->GetList(array(array('categoryid','=',$rsQuestion[$i]->categoryid)),'',true);
							?>
								<tr>
								  <td class="tbltd" align="center"><?PHP echo $i+1;?></td>
								  <td class="tbltd" align="center"><a href="#" onclick="questiondet('<?PHP echo $rsQuestion[$i]->questionId; ?>');"><?PHP echo $rsQuestion[$i]->question_text; ?></a> </td>
								  <td class="tbltd" align="center"><?PHP echo $rsEditCategory[0]->category_name ?> </td>
								  <td class="tbltd" align="center"><?PHP echo $rsQuestion[$i]->status; ?></td>
								  <td class="tbltd" align="center"><a href="#" class="saffronlink" onclick="return questionaction('edit','<?PHP echo $rsQuestion[$i]->questionId; ?>');" >Edit</a>&nbsp;-&nbsp; <a href="#" class="redlink" onclick="return questionaction('delete','<?PHP echo $rsQuestion[$i]->questionId; ?>')" >Delete</a> </td>
								</tr>
							<?PHP
								}
								
								if(count($rsQuestion) == 0) {
							?>
								<tr>
									<td colspan="5">&nbsp;</td>
								</tr>
								<tr>
									<td align="center" colspan="5"><strong>No Question Found !</strong></td>
								</tr>								
							<?PHP
							}
							?>
                          </form>
                        </table></td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                    </tr><?php 
							if($total_record > $page_size) {?>
							<tr>
							<td colspan="5" align="left"><?php echo pagging_fun($page,$total_record,$page_size,"");?></td>
							</tr>
							<?PHP 
							}?>

                    <tr>
                      <td><table width="100%" cellpadding="2" cellspacing="2" border="0">
                          <tr>
                            <td class="HdText3" align="left" colspan="2">&nbsp;Add / Edit User</td>
                          </tr>
                          <tr>
                            <td colspan="2">&nbsp;</td>
                          </tr>
                          <form name="frmQuestion" id="frmQuestion" method="post" action="">
						  <input type="hidden" id="questionid" name="questionid" value="<?PHP echo $_POST['questionid']?>" />
							<?PHP
								$rsLanguage = $objLanguage->getList(array(array('languageId','!=','')),'',true);
								$rsCategory = $objCategory->GetList(array(array('categoryid','!=','')),'',true);
							?>
							<tr>
								<td align="right">Language :</td>
								<td align="left"><select name="language" id="language">
							  					<?PHP 
													for($i=0;$i<sizeof($rsLanguage);$i++) {
													?>
														<option value="<?PHP echo $rsLanguage[$i]->languageId; ?>" <?PHP if($rsEditQuestion[0]->langid ==$rsLanguage[$i]->languageId) {?> selected="selected" <?PHP } ?>><?PHP echo $rsLanguage[$i]->language_name; ?></option>
													 <?PHP 
													 }
													 ?>
							  					</select></td>
							</tr>
                            <tr>
                              <td align="right">Category Level  :</td>
                              <td align="left"><select name="level">
													<?PHP for($i=0;$i<sizeof($rsCategory);$i++) {
													?>
														<option value="<?PHP echo $rsCategory[$i]->categoryId; ?>" <?PHP if($rsEditQuestion[0]->categoryId == $rsCategory[$i]->categoryId) {?> selected="selected" <?PHP } ?>><?PHP echo $rsCategory[$i]->category_name; ?></option>
													 <?PHP 
													 }
													 ?>
												</select></td>
                            </tr>

                            <tr>
                              <td width="40%" align="right">Question :</td>
                              <td width="60%" align="left"><textarea cols="50" rows="5" name="question" id="question"><?PHP echo $rsEditQuestion[0]->question_text; ?></textarea></td>
                            </tr>
                            <tr>
                              <td align="right">Date :</td>
                              <td align="left"><input type="text" name="date" id="date" value="<?PHP echo $rsEditQuestion[0]->date1; ?>" /></td>
                            </tr>
                            <tr>
                              <td align="right">Stauts :</td>
                              <td align="left"><input type="radio" value="Active" name="radActive" <?PHP if($rsEditQuestion[0]->status == "Active") {?>  checked="checked" <?PHP } ?>   />
                                Active
                                <input type="radio" name="radActive" value="Inactive" <?PHP if($rsEditQuestion[0]->status == "Inactive") {?>  checked="checked" <?PHP } ?> />
                                Inactive </td>
                            </tr>
                            <tr>
                              <td colspan="2" align="center"><input type="submit" name="cmdAdd" id="cmdAdd" value="Add" <?PHP if($_POST['act'] == 'edit') {?>disabled="disabled"<?PHP } ?> />
                                &nbsp;
                                <input type="submit" name="cmdUpdate" id="cmdUpdate" value="Update" <?PHP if($_POST['act'] != 'edit') {?>disabled="disabled"<?PHP } ?>  />                              </td>
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
