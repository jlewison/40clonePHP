<?PHP
	session_start();
	
	require_once("includes/configuration.php");
	require_once("includes/classes/class.database.php");
	require_once("includes/classes/class.question.php");
	require_once("includes/classes/class.category.php");
	require_once("includes/classes/class.user.php");
	require_once("includes/classes/class.country.php");
	require_once("includes/classes/class.langauge.php");
	
	$objQuestion = new question();
	$objCategory = new category();
	$objUser = new user();
	$objCountry = new country();
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
	
	$userid = $_GET['userid'];
	$rsUser = $objUser->GetList(array(array('userId','=',$userid)),'',true);
	$rsCountry = $objCountry->GetList(array(array('countryId','=',$rsUser[0]->countryid)),'',true);
	$rsQuestion = $objQuestion->GetList(array(array('questionid','!=',""),array('userid','=',$userid)),'date1',true,$limit);
?>
<?php include("includes/top.php");?>
<?php include("includes/search.php");?>

<DIV class=home id=y-body-green-knowledge-search>
  <DIV id=content>
    <?php include("includes/left.php");?>
    <DIV id=middle>
      <DIV id=ks-homepage-heading>Personal Information </DIV>
      <DIV class=silk_hp_open id=ks-homepage-questions>
        <table width="100%" cellpadding="3" cellspacing="0" border="0">
          <tr>
            <td height="13px"></td>
          </tr>
          <tr>
            <td><table width="100%" cellpadding="0" cellspacing="0" border="0">
                <tr>
                  <td width="15%"><img src="<?PHP if($rsUser[0]->photo != '') { echo "uploads/user/thumb/".$rsUser[0]->photo; } else {
											echo "images/man.gif"; }?>" border="0" /></td>
                  <td width="85%"><strong>First Name : </strong><?PHP echo $rsUser[0]->first_name?><br />
                    <strong>Last Name : </strong><?PHP echo $rsUser[0]->last_name?><br />
                    <strong>City : </strong><?PHP echo $rsUser[0]->city?><br />
                    <strong>State : </strong><?PHP echo $rsUser[0]->state?><br />
                    <strong>Country : </strong><?PHP echo $rsCountry[0]->countryname?><br />
                  </td>
                </tr>
              </table></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
          </tr>
          <tr>
          	<td><DIV id=ks-homepage-heading>Questions opened by user </DIV></td>
          </tr>
          <tr>
            <td><table width="100%" cellpadding="2" cellspacing="0" border="0">
                <?PHP
							for($i=0;$i<sizeof($rsQuestion);$i++) {
								$rsCategory = $objCategory->GetList(array(array('categoryid','=',$rsQuestion[$i]->categoryid)),'',true);
						?>
                <tr bgcolor="#EFEFEF">
                  <td width="20px" rowspan="2" align="center">&nbsp;</td>
                  <td colspan="3" class="questiontext"><a href="questiondetail.php?questionid=<?PHP echo $rsQuestion[$i]->questionId; ?>"><?PHP echo $rsQuestion[$i]->title; ?></a></td>
                </tr>
                <tr bgcolor="#EFEFEF">
                  <td width="10px" align="right">&nbsp;<?PHP echo $rsQuestion[$i]->rate ?>&nbsp;</td>
                  <td width="26px" align="left"><img src="images/star1.gif" border="0" /></td>
                  <td>&nbsp;In <a href="categorydetail.php?catid=<?PHP echo $rsCategory[0]->categoryId;?>"><?PHP echo $rsCategory[0]->category_name; ?></a></td>
                </tr>
                <tr>
                  <td>&nbsp;</td>
                </tr>
                <?PHP
						}
						?>
              </table></td>
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
