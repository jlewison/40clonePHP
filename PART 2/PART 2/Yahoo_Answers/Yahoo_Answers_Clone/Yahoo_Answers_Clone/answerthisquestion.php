<?php
	session_start();
//	include("includes/restricted.php");
	if($_SESSION['Username'] == '' && !isset($_SESSION['Username'])) {
		header("location:login.php");
	}
	require_once("includes/configuration.php");
	require_once("includes/classes/class.database.php");
	require_once("includes/classes/class.category.php");
	require_once("includes/classes/class.question.php");
	require_once("includes/classes/class.langauge.php");
	require_once("includes/classes/class.answer.php");
	require_once("includes/classes/class.user.php");
	require_once "includes/classes/mailer.class.php";

	$objCategory = new category();
	$objQuestion = new question();
	$objAnswer = new answer();
	$objUser = new user();
	$objLangauge = new language();

	$rsLanguage = $objLangauge->GetList(array(array('languageid','!=',"")),'language',true);

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

	$rsQuestion = $objQuestion->GetList(array(array('questionid','=',$HTTP_POST_VARS['questionid'])),'',true);

	if($HTTP_POST_VARS['cmdAddAns']){
		$rsQuestion = $objQuestion->GetList(array(array('questionid','=',$HTTP_POST_VARS['questionid'])),'',true);
		$objAnswer->langid=$rsQuestion[0]->langid;
		$objAnswer->answer_text=$HTTP_POST_VARS['txtans'];
		$objAnswer->questionid =$rsQuestion[0]->questionId;
		$objAnswer->userid=$_SESSION['userid'];
		$objAnswer->date1=time();
		$objAnswer->rate=2;
		$objAnswer->bestans='No';
		$objAnswer->Save();

		$rsUser = $objUser->GetList(array(array('userid','=',$rsQuestion[0]->userid)),'',true);

		$objMail= new mailer();
		$subject = "New Answer has been added to your question.";
		$Message = "Hello ".$rsUser[0]->first_name." ".$rsUser[0]->last_name.",<br><br>".$_SESSION['Username']." has added answer to your question.<br><br>Question : ".$rsQuestion[0]->title."<br><br>Answer : ".$HTTP_POST_VARS['txtans']."<br><br>Sincerely,<br><br><a href=http://you-ask-it.com>http://you-ask-it.com";
		$flag=$objMail->send_mail("admin@you-ask-it.com",$rsUser[0]->emailid,$subject,$Message);
	}

?>
<?php include("includes/top.php");?>
<?php include("includes/search.php");?>
<script language="javascript" type="text/javascript" src="tiny_mce/tiny_mce.js"></script>
<script language="javascript" type="text/javascript">
	tinyMCE.init({
		theme : "advanced",
		mode : "exact",
		elements : "txtans",
		content_css : "css/example_advanced.css",
		extended_valid_elements : "a[href|target|name]",
/*		theme_advanced_buttons1_add : "fontselect,fontsizeselect,cut,copy,paste,separator",
		theme_advanced_buttons2_add : "separator,insertdate,inserttime,separator,forecolor,backcolor,separator", */

		theme_advanced_toolbar_location : "top",
		theme_advanced_toolbar_align : "left",
		theme_advanced_path_location : "bottom",
		plugin_insertdate_dateFormat : "%Y-%m-%d",
		plugin_insertdate_timeFormat : "%H:%M:%S",
		//invalid_elements : "a",
		theme_advanced_styles : "Header 1=header1;Header 2=header2;Header 3=header3;Table Row=tableRow1", // Theme specific setting CSS classes
		//execcommand_callback : "myCustomExecCommandHandler",
		debug : false
	});
</script>
<DIV class=home id=y-body-green-knowledge-search>
  <DIV id=content>
    <?php include("includes/left.php");?>
    <DIV id=middle>
      <DIV id=ks-homepage-heading>Answer this questions </DIV>
      <DIV class=silk_hp_open id=ks-homepage-questions>
        <table width="100%" cellpadding="3" cellspacing="0" border="0">
          <tr>
            <td height="13px"></td>
          </tr>
          <form name="frmaddans" id="frmaddans" method="post" action="answerthisquestion.php">
            <input type="hidden" name="questionid" id="questionid" value="<?php echo $HTTP_POST_VARS['questionid'];?>"  />
            <tr>
              <td>
              <?PHP if($_SESSION['userid'] != $rsQuestion[0]->userid) { ?>
              <table width="100%" cellpadding="2" cellspacing="0" border="0">
                  <tr bgcolor="#EFEFEF">
                  <tr>

					<?php include('includes/google_468x60.php'); ?>

		            <td>Question:</td>
                  </tr>
                  <tr>
                    <td><?=$rsQuestion[0]->question_text;?></td>
                  </tr>
                  <tr>
                  	<td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td> Enter your Answer:</td>
                  </tr>
                  <tr>
                    <td><textarea rows="15" cols="65" name="txtans" id="txtans"></textarea></td>
                  </tr>
                  <tr>
                  <td><input type="submit" name="cmdAddAns" id="cmdAddAns" value="Add" />                  </tr>
                </table>
                <?PHP } else { ?>
              <table width="100%" cellpadding="2" cellspacing="0" border="0">
                  <tr>
                    <td>You can not answer your own question !!</td>
                  </tr>
				</table>
                <?PHP } ?>
                </td>
            </tr>
          </form>
          <tr>
            <td>&nbsp;</td>
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
