<?PHP
	session_start();
	
	require_once("includes/configuration.php");
	require_once("includes/classes/class.database.php");
	require_once("includes/classes/class.question.php");
	require_once("includes/classes/class.category.php");
	require_once("includes/classes/class.user.php");
	require_once("includes/classes/class.langauge.php");
	require_once("includes/classes/class.watchlist.php");
	
	$objQuestion = new question();
	$objCategory = new category();
	$objUser = new user();
	$objWatchlist=new watchlist();
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
	
	if(!$HTTP_POST_VARS['userid']) {
		$userid1 = $_GET['userid'];
	}
	else {
		$userid1 = $HTTP_POST_VARS['userid'];
	}


	$limit        = "0,5 ";

	$rsWatchlist = $objWatchlist->GetList(array(array('userid','=',$userid1)),'date1',true,$limit);
?>
<?php include("includes/top.php");?>
<?php include("includes/search.php");?>

<DIV class=home id=y-body-green-knowledge-search>
  <DIV id=content>
    <?php include("includes/left.php");?>
    <DIV id=middle>
      <DIV id=ks-homepage-heading>My Questions</DIV>
      <DIV class=silk_hp_open id=ks-homepage-questions>
        <table width="100%" cellpadding="3" cellspacing="0" border="0">
          <tr>
            <td height="13px"></td>
          </tr>
          <tr>
            <td><form name="frmWatchlist" id="frmWatchlist" method="post" action="questionlist.php">
                <input type="hidden" name="userid" id="userid" value="<?php echo $userid1;?>" />
                <table width="100%" cellpadding="2" cellspacing="0" border="0">
                  <?PHP
							for($i=0;$i<sizeof($rsWatchlist);$i++) {
							$rsQuestion = $objQuestion->GetList(array(array('questionid','=',$rsWatchlist[$i]->questionid),array('userid','=',$rsWatchlist[$i]->userid)),'',true);
							$rsUser = $objUser->GetList(array(array('userid','=',$rsQuestion[$i]->userid)),'',true);

						?>
                  <input type="hidden" name="questionid" id="questionid" value="<?php echo $rsQuestion[$i]->questionId;?>"  />
                  <tr bgcolor="#EFEFEF">
                    <td><img src="<?PHP if($rsUser[0]->photo != '') { echo "uploads/user/thumb/".$rsUser[0]->photo; } else {
											echo "images/man.gif"; }?>" border="0" /></td>
                    <td colspan="3" class="questiontext"><a href="questiondetail.php?questionid=<?PHP echo $rsQuestion[0]->questionId; ?>"><?PHP echo $rsQuestion[0]->question_text; ?></a></td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                  </tr>
                  <?PHP 
						}
						?>
                  <tr>
                    <td>&nbsp;</td>
                  </tr>
                </table>
              </form></td>
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
