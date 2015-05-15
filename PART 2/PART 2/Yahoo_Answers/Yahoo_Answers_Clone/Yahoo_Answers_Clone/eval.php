<?php
	require_once "includes/configuration.php";
	require_once "includes/classes/class.database.php";
	require_once "includes/classes/class.rating.php";
	require_once "includes/classes/class.question.php";

	$objQuestion = new question();
	$objRating = new rating();
	
	$objRating->ratingId = '';
	$objRating->albumid = $_GET['imageid'];
	$objRating->ratingdate = date("d/m/Y",time());
	$objRating->ipaddress = $_SERVER['REMOTE_ADDR'];
	$objRating->rate = $_GET['rate_val'];	
	
	$objRating->Save();

	$rstemp = $objQuestion->GetList(array(array('questionId','=',$_GET['imageid'])),'',false);

	$rsRating = $objRating->GetList(array(array('albumid','=',$_GET['imageid'])),'',false);
	
	for($i=0;$i<count($rsRating);$i++) {
		$total += $rsRating[$i]->rate;
	}
	
	if(count($rsRating) > 0) {
		$finalrate = $total/count($rsRating);
	}
	else {
		$finalrate = $total;
	}
	
	$objQuestion->questionId = $_GET['imageid'];
	
	$objQuestion->questionId = $rstemp[0]->questionId;
	$objQuestion->langid =  $rstemp[0]->langid;
	$objQuestion->question_text = $rstemp[0]->question_text;
	$objQuestion->title = $rstemp[0]->title;
	$objQuestion->userid = $rstemp[0]->userid;
	$objQuestion->categoryid = $rstemp[0]->categoryid;
	$objQuestion->date1 = $rstemp[0]->date1;
	$objQuestion->status = $rstemp[0]->status;
	$objQuestion->abuse = $rstemp[0]->abuse;
	$objQuestion->rate = round($finalrate);
	$objQuestion->Save();

?>