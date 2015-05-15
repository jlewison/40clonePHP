<?php

global $configuration;

$configuration['db']	= "database"; 		//	database name
$configuration['host']	= "localhost";	//	database host
$configuration['user']	= "databaseuser";		//	database user
$configuration['pass']	= "password";		//	database password
$configuration['port'] 	= '3306';		//	database port

$configuration['gid'] 	= 'pub-12345678912345612';		// Google Adsense ID
$configuration['url'] 	= 'YourSite.com';		// URL without www or http://
$configuration['title'] = 'Welcome to YourSite.com';		// Page Title
$configuration['description'] = 'Ask questions on any topic, get real answers from real people. Have a question? Ask it. Know an answer? Share it. Find and share information on Answerbag.com.'; // Meta Description
$configuration['keywords'] = 'answer, question, faq, information, knowledge, primer'; // Meta Keywords
$configuration['style'] = 'default.css';		// Stylesheet

//print_r($configuration);
if($HTTP_POST_VARS['language'] != '') {
	$_SESSION['languageid'] = $HTTP_POST_VARS['language'];
	$language_id = $_SESSION['languageid'];
}

?>