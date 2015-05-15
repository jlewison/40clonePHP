<?php
	session_start();
	include("includes/restricted.php");
	

	require_once("../includes/configuration.php");
	require_once("../includes/classes/class.database.php");
	require_once("../includes/classes/class.filter.php");
	require_once "includes/functions.php";
	$objFilter=new filter();

	if($HTTP_POST_VARS['cmdAdd']=='Add'){
		$objFilter->word=$HTTP_POST_VARS['txtfname'];
		$objFilter->Save();
	}
	if($HTTP_POST_VARS['cmdUpdate']=='Update'){
		$objFilter->filterId=$HTTP_POST_VARS['filterid'];
		$objFilter->word=$HTTP_POST_VARS['txtfname'];
		$objFilter->Save();
	}
	if($HTTP_POST_VARS['act']=='edit'){
		$rsEditFilter = $objFilter->GetList(array(array('filterid','=',$HTTP_POST_VARS['filterid'])),'',true);
	}
	if($HTTP_POST_VARS['act']=='delete'){
		$objFilter->filterId=$HTTP_POST_VARS['filterid'];
		$objFilter->word=$HTTP_POST_VARS['txtfname'];
		$objFilter->Delete();
		$rsEditFilter = $objFilter->GetList(array(array('filterid','=',$HTTP_POST_VARS['filterid'])),'',true);
	}
	$rsFilter = $objFilter->GetList(array(array('filterid','!=',"")),'',true);
	$total_record = count($rsSettings);
	$page_size = 10;//$setting['ADMIN_PAGE_SIZE'];
	if($total_record > $page_size) {
		if(isset($_POST['page']) && $_POST['page'] != '') {
			$page = $_POST['page'];
		} else {
			$page = 1;
		}
	$limit_start  = ($page - 1) * $page_size;
	$limit        = "$limit_start, ".$page_size;
	$rsFilter = $objFilter->GetList(array(array('filterid','!=',"")),'',true,$limit);
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
		document.frmListMember.page.value = val;
		document.frmListMember.submit();
	}
	function filteraction(act,val) {
		result = true;
		document.frmListMember.act.value = act;
		document.frmListMember.filterid.value = val;
		if(act == 'delete') {
			result = confirm("Are you sure you want to delete Filter Word?");
		}
		if(!result) {
			return false;
		}	
		document.frmListMember.submit();
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
        <tr height="300px" valign="top">
          <td bgcolor="#FFFFFF"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td align="center" bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr height="2px">
                      <td></td>
                    </tr>
                    <tr>
                      <td class="HdText2" align="left">Filter Bad Word </td>
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
                          <form name="frmListMember" id="frmListMember" method="post" action="filterbadwords.php">
	  					  <input name="page" id="page" value="" type="hidden" />
						  <input name="act" id="act" value="" type="hidden" />
                 	      <input type="hidden" id="filterid" name="filterid" value="<?php echo $HTTP_POST_VARS['filterid'];?>" />
                            <tr>
                              <td width="15%" align="center" class="HdText3">Sr no </td>
                              <td width="66%" align="center" class="HdText3">Filter Word  </td>
                              <td width="19%" align="center" class="HdText3">Edit </td>
                            </tr>
							<?php for($i=0;$i<count($rsFilter);$i++){?>
                            <tr>
                              <td class="tbltd" align="center"><?php echo $i+1;?> </td>
                              <td class="tbltd" align="center"><?php echo $rsFilter[$i]->word;?>
							   </td>
                              <td class="tbltd" align="center"><a href="#" class="saffronlink" onclick="return filteraction('edit','<?php echo $rsFilter[$i]->filterId;?>');" >Edit</a>&nbsp;-&nbsp; <a href="#" class="redlink" onclick="return filteraction('delete','<?php echo $rsFilter[$i]->filterId;?>')" >Delete</a> </td>							  
                            </tr>
							<?php }?>

                          </form>
                        </table></td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                    </tr>
                    <?php 
							if($total_record > $page_size) {?>
							<tr>
							<td colspan="5" align="left"><?php echo pagging_fun($page,$total_record,$page_size,"");?></td>
							</tr>
							<?PHP 
							}?>
                    <tr>
                      <td><table width="100%" cellpadding="2" cellspacing="2" border="0">
                          <tr>
                            <td class="HdText3" align="left" colspan="2">&nbsp;Add / Edit Word</td>
                          </tr>
                          <tr>
                            <td colspan="2">&nbsp;</td>
                          </tr>
                          <form name="frmFilter" id="frmFilter" method="post" action="filterbadwords.php" onsubmit="return manageuser_validation();">
                            <input type="hidden" id="filterid" name="filterid" value="<?php echo $HTTP_POST_VARS['filterid'];?>" />
                            <tr>
                              <td align="right">Bad Word  :</td>
                              <td align="left"><input type="text" name="txtfname" id="txtfname" value="<?php echo $rsEditFilter[0]->word;?>" />                              </td>
                            </tr>
                            <tr>
                              <td colspan="2" align="center"><input type="submit" name="cmdAdd" id="cmdAdd" value="Add" <?php if($HTTP_POST_VARS['act']=='edit'){?>  disabled="disabled"<?php } ?> onclick="return manageuser_validation();" />
                                &nbsp;
                                <input type="submit" name="cmdUpdate" <?php if($HTTP_POST_VARS['act']!='edit'){?>  disabled="disabled "<?php } ?> id="cmdUpdate" value="Update"   onclick="return manageuser_validation();" />                              </td>
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
