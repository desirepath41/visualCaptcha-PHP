<?php
/**
 * visualCaptchaHTML class by emotionLoop - 2013.03.28
 *
 * This class handles a visual image captcha system.
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

class captcha {
	private $formId = 'frm_captcha';
	private $type = 0;
	private $fieldName = 'captcha-value';
	private $accessibilityFieldName = 'captcha-accessibility-value';
	private $js = '';
	private $css = '';
	private $html = '';
	private $hash = '';
	private $hashSalt = '';
	private $answers = array();
	private $options = array();
	private $optionsProperties = array();
	private $accessibilityOptions = array();
	private $accessibilityFile = '';
	private $accessibilityAnswer = '';
	private $value = '';
	private $valueProperties = array();
	private $jsFile = 'inc/visualcaptcha.js';
	private $cssFile = 'inc/visualcaptcha.css';
	private $htmlClass = 'inc/visualcaptcha.class.html.php';
	public static $imagesPath = 'images/visualcaptcha/';
	public static $audiosPath = 'audio/visualcaptcha/';
	public static $audioFile = 'audio.php';

	public function __construct( $formId = NULL, $type = NULL, $fieldName = NULL, $accessibilityFieldName = NULL ) {
		$this->hashSalt = 'emotionLoop::' . $_SERVER['REMOTE_ADDR'] . '::visualCaptcha::';
		$this->hash = sha1( $this->hashSalt . $this->nonceTick(1800) . '::tick' );
		
		if ( ! is_null($formId) ) {
			$this->formId = $formId;
		}
		
		if ( ! is_null($type) ) {
			$this->type = (int) $type;
		} else {
			$this->type = 0;
		}

		if ( ! is_null($fieldName) ) {
			$this->fieldName = $fieldName;
		}

		if ( ! is_null($accessibilityFieldName) ) {
			$this->accessibilityFieldName = $accessibilityFieldName;
		}

		// Setup Image Names here: stringID, array(ImagePath, ImageName/Text to show)
		$this->answers = array(
			'airplane' => array(self::$imagesPath . 'airplane.png', 'Airplane'),
			'balloons' => array(self::$imagesPath . 'balloons.png', 'Balloons'),
			'camera'   => array(self::$imagesPath . 'camera.png',   'Camera'),
			'car'	  => array(self::$imagesPath . 'car.png',	  'Car'),
			'cat'	  => array(self::$imagesPath . 'cat.png',	  'Cat'),
			'chair'	=> array(self::$imagesPath . 'chair.png',	'Chair'),
			'clip'	 => array(self::$imagesPath . 'clip.png',	 'Clip'),
			'clock'	=> array(self::$imagesPath . 'clock.png',	'Clock'),
			'cloud'	=> array(self::$imagesPath . 'cloud.png',	'Cloud'),
			'computer' => array(self::$imagesPath . 'computer.png', 'Computer'),
			'envelope' => array(self::$imagesPath . 'envelope.png', 'Envelope'),
			'eye'	  => array(self::$imagesPath . 'eye.png',	  'Eye'),
			'flag'	 => array(self::$imagesPath . 'flag.png',	 'Flag'),
			'folder'   => array(self::$imagesPath . 'folder.png',   'Folder'),
			'foot'	 => array(self::$imagesPath . 'foot.png',	 'Foot'),
			'graph'	=> array(self::$imagesPath . 'graph.png',	'Graph'),
			'house'	=> array(self::$imagesPath . 'house.png',	'House'),
			'key'	  => array(self::$imagesPath . 'key.png',	  'Key'),
			'lamp'	 => array(self::$imagesPath . 'lamp.png',	 'Lamp'),
			'leaf'	 => array(self::$imagesPath . 'leaf.png',	 'Leaf'),
			'lock'	 => array(self::$imagesPath . 'lock.png',	 'Lock'),
			'magnifying-glass' => array(self::$imagesPath . 'magnifying-glass.png', 'Magnifying Glass'),
			'man'	  => array(self::$imagesPath . 'man.png',	  'Man'),
			'music-note' => array(self::$imagesPath . 'music-note.png', 'Music Note'),
			'pants'	=> array(self::$imagesPath . 'pants.png',	'Pants'),
			'pencil'   => array(self::$imagesPath . 'pencil.png',   'Pencil'),
			'printer'  => array(self::$imagesPath . 'printer.png',  'Printer'),
			'robot'	=> array(self::$imagesPath . 'robot.png',	'Robot'),
			'scissors' => array(self::$imagesPath . 'scissors.png', 'Scissors'),
			'sunglasses' => array(self::$imagesPath . 'sunglasses.png', 'Sunglasses'),
			'tag'	  => array(self::$imagesPath . 'tag.png',	  'Tag'),
			'tree'	 => array(self::$imagesPath . 'tree.png',	 'Tree'),
			'truck'	=> array(self::$imagesPath . 'truck.png',	'Truck'),
			'tshirt'   => array(self::$imagesPath . 'tshirt.png',   'T-Shirt'),
			'umbrella' => array(self::$imagesPath . 'umbrella.png', 'Umbrella'),
			'woman'	=> array(self::$imagesPath . 'woman.png',	'Woman'),
			'world'	=> array(self::$imagesPath . 'world.png',	'World'),
		);

		// Setup Accessibility Questions here: array(Answer, MP3 Audio file). You can repeat answers, but it's safer if you don't.
		// You can generate MP3 & Ogg audio files easily using http://stuffthatspins.com/stuff/php-TTS/index.php
		$this->accessibilityOptions = array(
			array('10', self::$audiosPath . '5times2.mp3'),
			array('20', self::$audiosPath . '2times10.mp3'),
			array('6', self::$audiosPath . '5plus1.mp3'),
			array('7', self::$audiosPath . '4plus3.mp3'),
			array('4', self::$audiosPath . 'add3to1.mp3'),
			array('green', self::$audiosPath . 'addblueandyellow.mp3'),
			array('white', self::$audiosPath . 'milkcolor.mp3'),
			array('2', self::$audiosPath . 'divide4by2.mp3'),
			array('yes', self::$audiosPath . 'sunastar.mp3'),
			array('no', self::$audiosPath . 'yourobot.mp3'),
			array('12', self::$audiosPath . '6plus6.mp3'),
			array('100', self::$audiosPath . '99plus1.mp3'),
			array('blue', self::$audiosPath . 'skycolor.mp3'),
			array('3', self::$audiosPath . 'after2.mp3'),
			array('24', self::$audiosPath . '12times2.mp3'),
			array('5', self::$audiosPath . '4plus1.mp3'),
		);
	}
	
	public function show() {
		$this->setNewValue();
		
		shuffle($this->options);
		
		// Include visualCaptchaHTML class
		require_once( $this->htmlClass );

		$this->html = \visualCaptcha\html::get( $this->type, $this->fieldName, $this->accessibilityFieldName, $this->formId, $this->getText(), $this->options, $this->optionsProperties, $this->jsFile, $this->cssFile );

		echo $this->html;
	}
	
	public function isValid() {
		if ( isset($_POST[$this->fieldName]) && isset($_SESSION[$this->hash]) && ($_POST[$this->fieldName] == $_SESSION[$this->hash]) ) {
			return true;
		}
		// Accessibility option
		if ( isset($_POST[$this->accessibilityFieldName]) && isset($_SESSION[$this->hash.'::accessibility']) && ($this->encrypt( mb_strtolower($_POST[$this->accessibilityFieldName]) ) == $_SESSION[$this->hash.'::accessibility']) ) {
			return true;
		}
		return false;
	}
	
	private function setNewValue() {
		$this->answers = $this->shuffle( $this->answers );

		$i = 0;
		switch ($this->type) {
			case 0:// Horizontal
				$limit = 5;
			break;
			case 1:// Vertical
				$limit = 4;
			break;
		}
		
		$rnd = rand(0, $limit-1);
		
		foreach ( $this->answers as $answer => $answerProps ) {
			if ( $i >= $limit ) {
				continue;
			}

			$encryptedAnswer = $this->encrypt( $answer );

			$this->options[] = $encryptedAnswer;
			$this->optionsProperties[$encryptedAnswer] = $answerProps;
			if ( $i == $rnd ) {
				$_SESSION[$this->hash] = $encryptedAnswer;
				$this->value = $encryptedAnswer;
				$this->valueProperties = $answerProps;
				
			}
			++$i;
		}

		// Accessibility option. Set question file and answer, encrypted
		$this->accessibilityOptions = $this->shuffle( $this->accessibilityOptions );

		$limit = count( $this->accessibilityOptions );

		$rnd = rand(0, $limit-1);

		$this->accessibilityAnswer = $this->encrypt( $this->accessibilityOptions[$rnd][0] );
		$this->accessibilityFile = $this->accessibilityOptions[$rnd][1];

		$_SESSION[$this->hash.'::accessibility'] = $this->accessibilityAnswer;
		$_SESSION[$this->hash.'::accessibilityFile'] = $this->accessibilityFile;
	}
	
	private function getValue() {
		return $this->value;
	}
	
	private function getImage() {
		return $this->valueProperties[0];
	}
	
	private function getText() {
		return $this->valueProperties[1];
	}
	
	/**
	 * Get the time-dependent variable for nonce creation.
	 * This function is based on Wordpress' wp_nonce_tick().
	 *
	 * @since 1.1
	 * @param $life Integer number of seconds for the tick to be valid. Defaults to 86400 (24 hours)
	 * @return int
	 */
	private function nonceTick( $life = 86400 ) {
		return ceil( time() / $life );
	}
	
	/**
	 * Private shuffle() method. Shuffles an associative array. If $list is not an array, it returns $list without any modification.
	 *
	 * @since 1.1
	 * @param $list Array to shuffle.
	 * @return $random Array shuffled array.
	 */
	private function shuffle( $list ) {
		if ( ! is_array($list) ) {
			return $list;
		}
		$keys = array_keys( $list );
		shuffle( $keys );
		$random = array();
		
		foreach ($keys as $key) {
			$random[$key] = $list[$key];
		}
		
		return $random;
	}

	/**
	 * Private encrypt method. Encrypts a string using sha1()
	 *
	 * @since 4.0
	 * @param $string String to encrypt
	 * @return $encryptedString String encrypted
	 */
	private function encrypt( $string ) {
		$encryptedString = sha1( $this->hashSalt . $this->nonceTick(1800) . '::encrypt::' . $string );
		return $encryptedString;
	}

	/**
	 * Public getAudioFilePath method. Returns the current audio file path in the session, if set
	 */
	public function getAudioFilePath() {
		return $_SESSION[$this->hash.'::accessibilityFile'];
	}
}
?>