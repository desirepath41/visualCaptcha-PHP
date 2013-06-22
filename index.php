<?php
session_start();

$_GLOBAL_MSG = '';

if ( isset($_POST['form_submit']) && $_POST['form_submit'] === '1' ) {
	if ( ! validCaptcha('frm_sample') ) {
		$_GLOBAL_MSG = 'Captcha error!';
	} else {
		$_GLOBAL_MSG = 'Captcha valid!';
	}
}

if ( isset($_REQUEST['css_type']) && $_REQUEST['css_type'] === '1' ) {
	$_FORM_TYPE = 1;// Vertical
} else {
	$_FORM_TYPE = 0;// Horizontal
}

?><!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

	<title>visualCaptcha - A cool visual drag-and-drop captcha jQuery plugin by emotionLoop - Demo</title>

	<meta name="keywords" content="visualcaptcha, visual, jquery captcha, captcha, mobile-friendly, better captcha, fancy captcha, captcha alternative, jquery, jquery ui, drag, draggable, demo, retina, accessibility">
	<meta name="description" content="A cool visual drag-and-drop captcha jQuery plugin. Mobile-friendly. Retina-ready. Accessible.">
	<meta name="author" content="emotionLoop">

	<meta name="viewport" content="width=device-width,initial-scale=1">

	<!-- Required CSS -->
	<link rel="stylesheet" href="inc/visualcaptcha.css" media="all" />
	
	<link rel="stylesheet" href="sample.css" media="all" />
</head>
<body>
	<div id="logo">
		<a href="http://visualcaptcha.net" target="_blank"><img src="http://visualcaptcha.net/img/logo-white.png" alt="visualCaptcha"></a>
	</div>
	<div id="wrapper" class="type-<?php echo $_FORM_TYPE; ?>">
		<div id="content">
<?php
			if ( ! empty($_GLOBAL_MSG) ) {
?>
			<h3><?php echo $_GLOBAL_MSG; ?></h3>
<?php
			}
?>
			<p>Fill in the form and submit it.</p>
			<form name="frm_sample" id="frm_sample" action="index.php" method="post">
				<input type="hidden" name="form_submit" value="1" readonly="readonly" />
				<input type="hidden" name="css_type" value="<?php echo $_FORM_TYPE; ?>" readonly="readonly" />
				<p><label for="name">Name:</label> <input type="text" name="name" id="name" value="" size="30" /></p>
				<?php printCaptcha( 'frm_sample', $_FORM_TYPE ); ?>
				<p class="submit"><button type="submit" name="submit-bt">Submit form</button></p>
				<p><small>CSS types: <a href="?css_type=0">Horizontal (default)</a> | <a href="?css_type=1">Vertical</a></small></p>
			</form>
		</div>
		<div id="footer">
			<p><a href="http://visualcaptcha.net/" target="_blank">visualCaptcha</a> by <a href="http://emotionloop.com/" target="_blank">emotionLoop</a><br />You can get it at <a href="https://github.com/emotionLoop/visualCaptcha" target="_blank">GitHub</a></p>
		</div>
	</div>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
<script src="inc/visualcaptcha.js"></script>
</body>
</html>
<?php

// These functions aren't needed, but we recommend you to use them (or similar), so you can start/get multiple captcha instances with two simple functions.

function printCaptcha( $formId = NULL, $type = NULL, $fieldName = NULL, $accessibilityFieldName = NULL ) {
	require_once( 'inc/visualcaptcha.class.php' );
	
	$visualCaptcha = new \visualCaptcha\Captcha( $formId, $type, $fieldName, $accessibilityFieldName );
	$visualCaptcha->show();
}

function validCaptcha( $formId = NULL, $type = NULL, $fieldName = NULL, $accessibilityFieldName = NULL ) {
	require_once( 'inc/visualcaptcha.class.php' );
	
	$visualCaptcha = new \visualCaptcha\Captcha( $formId, $type, $fieldName, $accessibilityFieldName );
	return $visualCaptcha->isValid();
}

?>