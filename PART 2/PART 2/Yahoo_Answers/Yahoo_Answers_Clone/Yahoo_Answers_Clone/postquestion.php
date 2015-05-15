<?php
	session_start();
	if($_SESSION['Username'] == '' && !isset($_SESSION['Username'])) {
		header("location:login.php");
	}

	require_once("includes/configuration.php");
	require_once("includes/classes/class.database.php");
	require_once("includes/classes/class.category.php");
	require_once("includes/classes/class.question.php");
	require_once("includes/classes/class.langauge.php");
	require_once("includes/classes/class.answer.php");

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
		$objQuestion->date1 = date("d/m/Y",time());
		$objQuestion->status ='Active';
		$objQuestion->abuse = 'No';
		$objQuestion->title = $_POST['title'];

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
		$objQuestion->title = $_POST['title'];

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
<script language="javascript" type="text/javascript" src="tiny_mce/tiny_mce.js"></script>
<script language="javascript" type="text/javascript">
	tinyMCE.init({
		theme : "advanced",
		mode : "exact",
		elements : "question",
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
<?php include("includes/top.php");?>
		<?php include("includes/search.php");?>
		<DIV class=home id=y-body-green-knowledge-search>
			<DIV id=content>
				<?php include("includes/left.php");?>
			<DIV id=middle>
				<DIV id=ks-homepage-heading>Add Questions </DIV>
				<DIV class=silk_hp_open id=ks-homepage-questions>
					<table width="100%" cellpadding="3" cellspacing="0" border="0">
			<tr>
				<td height="13px"></td>
			</tr>
			<tr>
				<td>
					<table width="100%" cellpadding="2" cellspacing="2" border="0">
                          <form name="frmQuestion" id="frmQuestion" method="post" action="">
						  <input type="hidden" id="questionid" name="questionid" value="<?PHP echo $_POST['questionid']?>" />
						  <input type="hidden" id="language" name="language" value="1" />
	                          <tr>
								<?php include('includes/google_468x60.php'); ?>
                            	<td align="right">Title : </td>
                                <td align="left"><input type="text" size='40' maxlength="80" value="Title" name="title" value=""></td>
                            </tr>
                            <tr>
                              <td align="right">Category :</td>
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
                              <td width="17%" align="right">Question :</td>
                              <td width="83%" align="left">&nbsp;</td>
                            </tr>
                            <tr>
                            <td colspan="2" align="left"><textarea cols="55" rows="10" name="question" id="question"><?PHP echo $rsEditQuestion[0]->question_text; ?></textarea></td>
                            </tr>
                            <tr>
                              <td colspan="2" align="center"><input type="submit" name="cmdAdd" id="cmdAdd" value="Add" <?PHP if($_POST['act'] == 'edit') {?>disabled="disabled"<?PHP } ?> />
                                &nbsp;</td>
                            </tr>
                          </form>
                  </table>
				</td>
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
