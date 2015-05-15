<?php

	session_start();
	include("includes/restricted.php");

	require_once("../includes/configuration.php");
	require_once("../includes/classes/class.database.php");
	require_once("../includes/classes/class.question.php");
	require_once("../includes/classes/class.category.php");
	require_once "includes/functions.php";
	
	$objQuestion = new question();
	$objCategory = new category();
	
	if($HTTP_POST_VARS['act']=='delete'){
		$objQuestion->questionId=$HTTP_POST_VARS['questionid'];
		$objQuestion->Delete();
		
		$msg = "Record Deleted Successfully";
	}
	
	$rsQuestion = $objQuestion->GetList(array(array('questionid','!=',""),array('abuse','=','Yes')),'',true);
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
	$rsQuestion = $objQuestion->GetList(array(array('questionid','!=',""),array('abuse','=','Yes')),'',true);
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="css/style.css" rel="stylesheet" type="text/css">
<title>Admin Panel</title>
</head>
<script language="javascript">
   function next_prev_page(val) {
		document.frmListAbuse.page.value = val;
		document.frmListAbuse.submit();
	}
	function abuseaction(act,val) {
		result = true;
		document.frmListAbuse.act.value = act;
		document.frmListAbuse.questionid.value = val;
		if(act == 'delete') {
			result = confirm("Are you sure you want to delete abused question?");
		}
		if(!result) {
			return false;
		}	
		document.frmListAbuse.submit();
	}

</script>
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
        <tr height="300px" valign="top">
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
                      <td align="center" class="redlink">&nbsp;</td>
                    </tr>
					  <tr>
						<td colspan="2" align="center"><strong><font color="#FF0000"><?PHP echo $msg;?></font></strong></td>
					  </tr>
                    <tr>
                      <td>&nbsp;</td>
                    </tr>
                    <tr>
                      <td><table width="100%" cellpadding="0" cellspacing="0" border="0">
                          <form name="frmListAbuse" id="frmListAbuse" method="post" action="">
  	  					  <input name="page" id="page" value="" type="hidden" />
						  <input name="act" id="act" value="" type="hidden" />
                 	      <input type="hidden" id="questionid" name="questionid" value="<?php echo $HTTP_POST_VARS['questionid'];?>" />
                            <tr>
                              <td width="10%" align="center" class="HdText3">Sr no </td>
                              <td width="49%" align="center" class="HdText3">Question </td>
                              <td width="19%" align="center" class="HdText3">Category  </td>
                              <td width="10%" align="center" class="HdText3">Status </td>
                              <td width="12%" align="center" class="HdText3">Edit </td>
                            </tr>
                           <?PHP
	                            for($i=0;$i<sizeof($rsQuestion);$i++) {
							?>
						    <tr>
                              <td class="tbltd" align="center"><?PHP echo $i+1; ?></td>
                              <td class="tbltd" align="center"><a href="question-detail?questionid=<?PHP echo $rsQuestion[$i]->questionId;?>"><?PHP echo substr($rsQuestion[$i]->question_text,0,50).".."; ?></a> </td>
							  <?PHP
								$rsCategory = $objCategory->GetList(array(array('categoryid','=',$rsQuestion[$i]->categoryid)),'',true);
							  ?>
                              <td class="tbltd" align="center"><?PHP echo $rsCategory[0]->category_name ?></td>
                              <td class="tbltd" align="center"><?PHP echo $rsQuestion[$i]->status; ?></td>
                              <td class="tbltd" align="center"><a href="#" class="redlink" onclick="return abuseaction('delete','<?PHP echo $rsQuestion[$i]->questionId; ?>')" >Delete</a> </td>
                            </tr>
							<?PHP
							}
							?>
                          </form>
						  <?PHP
						  	if(count($rsQuestion) == 0) {
						  ?>
						  <tr>
						  	<td colspan="5">&nbsp;</td>
						  </tr>
						  <tr>
						  	<td colspan="5" align="center"><strong>No Abused Question Found !!</strong></td>
						  </tr>
						  <?PHP
							  }
							?>
                            
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
                      <td>&nbsp;</td>
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
