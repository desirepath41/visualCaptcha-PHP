<?php
/**
 * visualCaptchaHTML class by emotionLoop - 2013.03.28
 *
 * This class handles the HTML for the main visualCaptcha class.
 *
 * This license applies to this file and others without reference to any other license.
 *
 * @author emotionLoop | http://emotionloop.com
 * @link http://visualcaptcha.net
 * @package visualCaptcha
 * @license GNU GPL v3
 * @version 4.0.3
 */
namespace visualCaptcha;

class html {
	
	public function __construct() {
	}
	
	public static function get( $type, $fieldName, $accessibilityFieldName, $formId, $captchaText, $options, $optionsProperties, $jsFile, $cssFile ) {
		$html = '';
		
		$limit = count($options);
		
		ob_start();
?>
<script>
window.vCVals = {
	'f': '<?php echo $formId; ?>',
	'n': '<?php echo $fieldName; ?>',
	'a': '<?php echo $accessibilityFieldName; ?>'
};
</script>
<link rel="stylesheet" href="<?php echo $cssFile; ?>">
<div class="eL-captcha type-<?php echo $type; ?> clearfix">
	<p class="eL-explanation type-<?php echo $type; ?>"><?php echo 'Drag the'; ?> <strong><?php echo $captchaText; ?></strong> <?php echo 'to the circle on the side'; ?>.</p>
	<div class="eL-possibilities type-<?php echo $type; ?> clearfix">
<?php
		for ($i=0;$i<$limit;$i++) {
			$name = $options[$i];
			$image = $optionsProperties[$name][0];
			$text = $optionsProperties[$name][1];
?>
		<img src="<?php echo $image; ?>" class="vc-<?php echo $name; ?>" data-value="<?php echo $name; ?>" alt="" title="">
<?php
		}
?>
	</div>
	<div class="eL-where2go type-<?php echo $type; ?> clearfix">
	</div>
	<p class="eL-accessibility type-<?php echo $type; ?>"><a href="javascript:void(0);" title="<?php echo 'Accessibility option: listen to a question and answer it!'; ?>"><img src="<?php echo \visualCaptcha\captcha::$imagesPath; ?>accessibility.png" alt="<?php echo 'Accessibility option: listen to a question and answer it!'; ?>"></a></p>
	<div class="eL-accessibility type-<?php echo $type; ?>">
		<p><?php echo 'Type below the'; ?> <strong><?php echo 'answer'; ?></strong> <?php echo 'to what you hear. Numbers or words, lowercase:'; ?></p>
		<audio preload="preload">
			<source src="<?php echo \visualCaptcha\captcha::$audioFile; ?>?t=ogg&amp;r=<?php echo time(); ?>" type="audio/ogg">
			<source src="<?php echo \visualCaptcha\captcha::$audioFile; ?>?t=mp3&amp;r=<?php echo time(); ?>" type="audio/mpeg">
			<?php echo 'Your browser does not support the audio element.'; ?>
		</audio>
	</div>
</div>
<script src="<?php echo $jsFile; ?>"></script>
<?php
		$html = ob_get_clean();
		return $html;
	}
}
?>