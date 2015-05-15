<?php
require('classes/php-captcha.inc.php');

// define fonts
$aFonts = array('fonts/VeraBd.ttf', 'fonts/VeraIt.ttf', 'fonts/Vera.ttf');

// create new image
$oPhpCaptcha = new PhpCaptcha($aFonts, 200, 50);
$oPhpCaptcha->UseColour(true);
$oPhpCaptcha->Create();

?>