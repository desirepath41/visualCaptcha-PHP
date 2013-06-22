<?php
/**
 * visualCaptcha Image file by emotionLoop - 2013.06.22
 *
 * This file will get the proper session image file and return it, so that it's not possible to know through the front-end code the image file name or even which image file it is.
 *
 * This license applies to this file and others without reference to any other license.
 *
 * @author emotionLoop | http://emotionloop.com
 * @link http://visualcaptcha.net
 * @package visualCaptcha
 * @license GNU GPL v3
 * @version 4.1.0
 */
namespace visualCaptcha;

session_start();

include( 'inc/visualcaptcha.class.php' );

$visualCaptcha = new Captcha();

if ( ! isset($_GET['i']) ) {
	$_GET['i'] = 0;
} else {
	$_GET['i'] = (int) $_GET['i'];
	--$_GET['i'];
}

if ( isset($_GET['retina']) && ! empty($_GET['retina']) ) {
	$getRetina = true;
} else {
	$getRetina = false;
}

$image = $visualCaptcha->getImageFilePath( $_GET['i'], $getRetina );

header( 'Pragma: public' );
header( 'Expires: 0' );
header( 'Cache-Control: must-revalidate, post-check=0, pre-check=0' );
header( 'Cache-Control: private', false );
header( 'Content-Type: image/png' );
header( 'Content-Transfer-Encoding: binary' );
header( 'Content-Length: ' . filesize($image) );
readfile( $image );
exit();
?>