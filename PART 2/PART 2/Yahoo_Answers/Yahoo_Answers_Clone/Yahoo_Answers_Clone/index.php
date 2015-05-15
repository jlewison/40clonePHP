<?PHP
	session_start();

	require_once("includes/configuration.php");
	require_once("includes/classes/class.database.php");
	require_once("includes/classes/class.question.php");
	require_once("includes/classes/class.category.php");
	require_once("includes/classes/class.langauge.php");
	require_once("includes/classes/class.user.php");

	$objQuestion = new question();
	$objCategory = new category();
	$objUser = new user();
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

	if($HTTP_POST_VARS['cmdSend']){
	$login = 	$objUser->GetList(array(array('username','=',$HTTP_POST_VARS['txtUsername']),array('password','=',$HTTP_POST_VARS['txtPassword'])),'',true);

		if(count($login)>0){
			$_SESSION['Username']=$HTTP_POST_VARS['txtUsername'];
			$_SESSION['Password']=$HTTP_POST_VARS['txtPassword'];
			$_SESSION['userid']=$login[0]->userId;
			$_SESSION['languageid']=$login[0]->langid;
			if($_SESSION['requestedurl'] != '') {
				$requestedurl = explode("/",$_SESSION['requestedurl']);
//					$rsCart=$objCart->GetList(array(array('cart_masterid','=',$_SESSION['cartId'])),'',true);
//					$objCart->cart_masterId=$_SESSION['cartId'];
//					$objCart->userid=$_SESSION['userid'];
//					$objCart->Save();
				header("location:".$requestedurl[count($requestedurl)-1]);
				exit;
			}
		}
		else{
			$msg="Invalid Username or Password";
		}
	}

	$limit        = "0,10 ";
	$rsQuestion = $objQuestion->GetList(array(array('questionid','!=',""),array('langid','=',$language_id)),'',true,$limit);
?>
<?php include("includes/top.php");?>
		<?php include("includes/search.php");?>
		<div class=home id=y-body-green-knowledge-search>
			<div id=content>
				<?php include("includes/left.php");?>
			<div id=middle>
				<div id=ks-homepage-heading>Answer Questions </div>

				<?php include('includes/google_468x60.php'); ?>

				<div class=silk_hp_open id=ks-homepage-questions>
					<TABLE class=question-results cellSpacing=0 cellPadding=0 width="100%" border=0>
						<TBODY>
							<?PHP
	for($i=0;$i<sizeof($rsQuestion);$i++) {
		$rsUser = $objUser->GetList(array(array('userid','=',$rsQuestion[$i]->userid)),'',true);
			if($i%2 == 0) {
				$class = "question  qrownorm";
			}
			else {
				$class = "question  qrowalt";
			}
?>
							<TR class="<?=$class ?>" id=q_row_20071016212549AApTbGr>
								<TD class=image><div><img src="<?PHP if($rsUser[0]->photo != '') { echo "uploads/user/thumb/".$rsUser[0]->photo; } else {
							echo "images/man.gif"; }?>" border="0" /></div></TD>
								<TD class=info><a href="questiondetail.php?questionid=<?PHP echo $rsQuestion[$i]->questionId; ?>"><?PHP echo $rsQuestion[$i]->title; ?></a><BR>
									<SPAN id=starflag_area-20071016212549AApTbGr>
									<div class="qsfl qstar" id=qstar-20071016212549AApTbGr title="Star this question if you think it is interesting and would like to share it with others.">&nbsp;<?PHP echo $rsQuestion[$i]->rate; ?>&nbsp;<img src="images/star1.gif" border="0" /></div>
									</SPAN>
									<?PHP
			$rsCategory = $objCategory->GetList(array(array('categoryid','=',$rsQuestion[$i]->categoryid),array('langid','=',$language_id)),'',true);
		?>
									<div class=metainfo_qtext><SPAN>In <a class="more-subtle" title="See more details on <?PHP echo $rsCategory[0]->category_name; ?>"  href="categorydetail.php?catid=<?PHP echo $rsCategory[0]->categoryId;?>"><?PHP echo $rsCategory[0]->category_name; ?></a></A> - Asked by <A class=" more-subtle" href="userdetail.php?userid=<?PHP echo $rsUser[0]->userId;?>"><?PHP echo $rsUser[0]->username; ?></A></SPAN></div></TD>
							</TR>
							<?PHP
}
?>
						</TBODY>
					</TABLE>
				</div>
				<div class=dotted-line></div>
				      <P class=more-link id=ks-more-link>
	        <FORM action="allquestions.php"><INPUT class=button type=submit value="More Open Questions >"></FORM>
        </P>
			</div>
		</div>
	</div>
	<?php include("includes/bottom.php");?>
