<?php
	session_start();
//	include("includes/restricted.php");

	require_once("includes/configuration.php");
	require_once("includes/classes/class.database.php");
	require_once("includes/classes/class.category.php");
	require_once("includes/classes/class.question.php");
	require_once("includes/classes/class.langauge.php");
	require_once("includes/classes/class.answer.php");
	require_once("includes/classes/class.user.php");

	$objCategory = new category();
	$objQuestion = new question();
	$objLanguage = new language();
	$objAnswer = new answer();
	$objUser = new user();

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


	if($HTTP_POST_VARS['btnAbuse'] == 1){
		$objQuestion->questionId=$HTTP_POST_VARS['questionid'];
		$objQuestion->abuse='Yes';
		$objQuestion->Save();
	}

	if(!$HTTP_POST_VARS['questionid']) {
		$questionid1 = $_GET['questionid'];
	}
	else {
		$questionid1 = $HTTP_POST_VARS['questionid'];
	}

	$rsQuestion = $objQuestion->GetList(array(array('questionid','=',$questionid1),array('langid','=',$language_id)),'',true);
	$rsAnswer = $objAnswer->GetList(array(array('questionid','=',$questionid1),array('langid','=',$language_id)),'',true);
	$rsUser = $objUser->GetList(array(array('userid','=',$rsQuestion[0]->userid)),'',true);

?>
<?php include("includes/top.php");?>
<?php include("includes/search.php");?>

<DIV class=home id=y-body-green-knowledge-search>
  <DIV id=content>
    <?php include("includes/left.php");?>
    <DIV id=middle>
      <DIV id=ks-homepage-heading>Question Details </DIV>
      <DIV class=silk_hp_open id=ks-homepage-questions>
        <table width="100%" cellpadding="3" cellspacing="0" border="0">
          <tr>
            <td height="13px"></td>
          </tr>
          <form name="frmQuestdetail" id="frmQuestdetail" method="post" action="questiondetail.php">
            <tr>
              <td><input type="hidden" name="questionid" id="questionid" value="<?php echo $questionid1;?>"  />
                <table width="100%" cellpadding="2" cellspacing="0" border="0">
                  <tr>
                    <td><img src="<?PHP if($rsUser[0]->photo != '') { echo "uploads/user/thumb/".$rsUser[0]->photo; } else {
									echo "images/man.gif"; }?>" border="0" /></td>
                    <td colspan="3" class="questiontext"><?php echo $rsQuestion[0]->title;?></td>
                  </tr>
                  <?PHP
				  	$rsCategory = $objCategory->GetList(array(array('categoryid','=',$rsQuestion[0]->categoryid),array('langid','=',$language_id)),'',true);
				  ?>
				  <tr>
                  	<td colspan="4" class="questiontext"><strong>Details : </strong><?php echo $rsQuestion[0]->question_text;?></td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td width="10">&nbsp;<?php echo $rsQuestion[0]->rate;?>&nbsp;</td>
                    <td width="26"><img src="images/star1.gif" border="0" /></td>
                    <td>&nbsp;In <a href="categorydetail.php?catid=<?PHP echo $rsCategory[0]->categoryId;?>"><?php echo $rsCategory[0]->category_name;?></a> - Asked by <a href="userdetail.php?userid=<?PHP echo $rsUser[0]->userId;?>"><?php echo $rsUser[0]->username;?></a></td>
                  </tr>
                </table></td>
            </tr>
            <tr>
              <td><?PHP if($_SESSION['userid'] !=  $rsQuestion[0]->userid) {?><input type="submit" name="btnAnswer" value="Answer This Question" onclick="return answerques();" /> <?PHP } ?>
                &nbsp;
                <input type="submit" name="btnAbuse" value="Report Abuse" />
                &nbsp;
                <input type="submit" name="btnEMail" value="E Mail To Friend" onclick="return emailfriend();" />
                &nbsp;<br /><Br />Rate This Question
                <?php
				  	for($i=1;$i<6;$i++) {
				  ?>
                <?php if($i <= $rsQuestion[0]->rate) { ?>
                <a href="#"><img id='img<?php echo $i;?>' src="images/starbig_r.gif" border="0" onmouseover=OnEnter('img<?php echo $i;?>') onmouseout="OnOut(<?php echo $rsQuestion[0]->rate;?>);" runat='server' onClick="return rate('<?php echo $i;?>','<?php echo $rsQuestion[0]->questionId;?>');" /></a>
                <?php
					 }
					 else {
					 ?>
                <a href="#"><img id='img<?php echo $i;?>' src="images/starbig_nr.gif" border="0" onmouseover=OnEnter('img<?php echo $i;?>') onmouseout="OnOut(<?php echo $rsQuestion[0]->rate;?>);" runat='server' onClick="return rate('<?php echo $i;?>','<?php echo $rsQuestion[0]->questionId;?>');" /></a>
                <?php
					 }
					 ?>
                <?php
					}
					?>
              </td>
            </tr>
			<?php include('includes/google_468x60.php'); ?>
          </form>
          <tr>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td><table width="100%" cellpadding="5" cellspacing="0" border="0">
                <?php
					  if(count($rsAnswer)>0){
					  for($i=0;$i<count($rsAnswer);$i++){
						$rsUser = $objUser->GetList(array(array('userid','=',$rsAnswer[$i]->userid)),'',true);

					  ?>
                <tr bgcolor="#EFEFEF">
                  <td><img src="<?PHP if($rsUser[0]->photo != '') { echo "uploads/user/thumb/".$rsUser[0]->photo; } else {
											echo "images/man.gif"; }?>" border="0" /></td>
                  <td valign="top"><?php echo $rsAnswer[$i]->answer_text;?></td>
                </tr>
                <tr height="5px">
                	<td></td>
                </tr>
                <?php }
						}else{
						?>
                <tr>
                  <td width="100%" align="center" class="tbltd">No Answer Found</td>
                </tr>


              <?php }?>
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
<script src="js/ajax.js"></script>
<script language="javascript">

function OnEnter(cid){

	if (cid == 'img1'){

		document.getElementById('img1').src = 'images/star1.gif';
		document.getElementById('img2').src = 'images/star2.gif';
		document.getElementById('img3').src = 'images/star2.gif';
		document.getElementById('img4').src = 'images/star2.gif';
		document.getElementById('img5').src = 'images/star2.gif';


	}else if (cid == 'img2'){

		document.getElementById('img1').src = 'images/star1.gif';
		document.getElementById('img2').src = 'images/star1.gif';
		document.getElementById('img3').src = 'images/star2.gif';
		document.getElementById('img4').src = 'images/star2.gif';
		document.getElementById('img5').src = 'images/star2.gif';


	}else if (cid == 'img3'){

		document.getElementById('img1').src = 'images/star1.gif';
		document.getElementById('img2').src = 'images/star1.gif';
		document.getElementById('img3').src = 'images/star1.gif';
		document.getElementById('img4').src = 'images/star2.gif';
		document.getElementById('img5').src = 'images/star2.gif';


	}else if (cid == 'img4'){

		document.getElementById('img1').src = 'images/star1.gif';
		document.getElementById('img2').src = 'images/star1.gif';
		document.getElementById('img3').src = 'images/star1.gif';
		document.getElementById('img4').src = 'images/star1.gif';
		document.getElementById('img5').src = 'images/star2.gif';


	}else if (cid == 'img5'){

		document.getElementById('img1').src = 'images/star1.gif';
		document.getElementById('img2').src = 'images/star1.gif';
		document.getElementById('img3').src = 'images/star1.gif';
		document.getElementById('img4').src = 'images/star1.gif';
		document.getElementById('img5').src = 'images/star1.gif';

	}

}

var flag = 0;
function OnClick(cid){
	if (cid == 'img1'){
		document.getElementById('txtValue').value = '1';
		flag = 1;
	}else if (cid == 'img2'){
		document.getElementById('txtValue').value = '2';
		flag = 2;
	}else if (cid == 'img3'){
		document.getElementById('txtValue').value = '3';
		flag = 3;
	}else if (cid == 'img4'){
		document.getElementById('txtValue').value = '4';
		flag = 4;
	}else if (cid == 'img5'){
		document.getElementById('txtValue').value = '5';
		flag = 5;
	}
}

function OnOut(selected){
if (flag == 1){
			document.getElementById('img1').src = 'images/star1.gif';
			document.getElementById('img2').src = 'images/star2.gif';
			document.getElementById('img3').src = 'images/star2.gif';
			document.getElementById('img4').src = 'images/star2.gif';
			document.getElementById('img5').src = 'images/star2.gif';
}else if (flag == 2){
			document.getElementById('img1').src = 'images/star1.gif';
			document.getElementById('img2').src = 'images/star1.gif';
			document.getElementById('img3').src = 'images/star2.gif';
			document.getElementById('img4').src = 'images/star2.gif';
			document.getElementById('img5').src = 'images/star2.gif';
 }else if (flag == 3){
 			document.getElementById('img1').src = 'images/star1.gif';
			document.getElementById('img2').src = 'images/star1.gif';
			document.getElementById('img3').src = 'images/star1.gif';
			document.getElementById('img4').src = 'images/star2.gif';
			document.getElementById('img5').src = 'images/star2.gif';
  }else if (flag == 4){
  			document.getElementById('img1').src = 'images/star1.gif';
			document.getElementById('img2').src = 'images/star1.gif';
			document.getElementById('img3').src = 'images/star1.gif';
			document.getElementById('img4').src = 'images/star1.gif';
			document.getElementById('img5').src = 'images/star2.gif';
	}else if (flag == 5){
			document.getElementById('img1').src = 'images/star1.gif';
			document.getElementById('img2').src = 'images/star1.gif';
			document.getElementById('img3').src = 'images/star1.gif';
			document.getElementById('img4').src = 'images/star1.gif';
			document.getElementById('img5').src = 'images/star1.gif';
	}else if (flag == 0){
			document.getElementById('img1').src = 'images/star2.gif';
			document.getElementById('img2').src = 'images/star2.gif';
			document.getElementById('img3').src = 'images/star2.gif';
			document.getElementById('img4').src = 'images/star2.gif';
			document.getElementById('img5').src = 'images/star2.gif';

	}
	for(i=1;i<6;i++) {
		if(i<=selected) {
			document.getElementById('img'+i).src = 'images/star1.gif';
		}
	}
}

function rate(val,imageid)
{
	InsertCustomer('eval.php?rate_val='+val+'&imageid='+imageid);
}
	function rateaction(act,val) {
		result = true;
		document.frm.act.value = act;
		document.frm.albumid.value = val;
		if(act == 'searchchar') {
			document.frm.matchchar.value = val;
		}
		if(act == 'delete') {
			result = confirm("Are you sure you want to delete genre?");
		}
		if(!result) {
			return false;
		}
		document.frm.submit();
	}
</script>
<script language="javascript">
function answerques(){
	document.frmQuestdetail.action='answerthisquestion.php';
	document.frmQuestdetail.submit();
}
function emailfriend(){
	document.frmQuestdetail.action='emailtofriend.php';
	document.frmQuestdetail.submit();
}
function reportabuse() {
	document.frmQuestdetail.btnAbuse.value = 1;
	document.frmQuestdetail.submit();
}
</script>
