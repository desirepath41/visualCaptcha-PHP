/**
 * visualCaptchaJS file by emotionLoop - 2013.06.17
 *
 * This file handles the JS for the visualCaptcha plugin.
 *
 * This license applies to this file and others without reference to any other license.
 *
 * @author emotionLoop | http://emotionloop.com
 * @link http://visualcaptcha.net
 * @package visualCaptcha
 * @license GNU GPL v3
 * @version 4.0.4
 */
(function( $ ) {
	var isMobile = false;
	var isRetina = false;
	var supportsAudio = false;

	var uAgent = navigator.userAgent.toLowerCase();

	// Check if the user agent is a mobile one
	if ( uAgent.indexOf('iphone') !== -1 || uAgent.indexOf('ipad') !== -1 || uAgent.indexOf('ipod') !== -1 ||
	uAgent.indexOf('android') !== -1 ||
	uAgent.indexOf('windows phone') !== -1 || uAgent.indexOf('windows ce') !== -1 ||
	uAgent.indexOf('bada') !== -1 ||
	uAgent.indexOf('meego') !== -1 ||
	uAgent.indexOf('palm') !== -1 ||
	uAgent.indexOf('blackberry') !== -1 ||
	uAgent.indexOf('nokia') !== -1 || uAgent.indexOf('symbian') !== -1 ||
	uAgent.indexOf('pocketpc') !== -1 ||
	uAgent.indexOf('smartphone') !== -1 ||
	uAgent.indexOf('mobile') !== -1 ) {
		isMobile = true;
	}

	// Check if the device is retina-like
	if ( window.devicePixelRatio && window.devicePixelRatio > 1 ) {
		isRetina = true;
	}

	// Check if the device supports audio, for accessibility
	try {
		var audioElement = document.createElement('audio');
		if ( audioElement.canPlayType ) {
			supportsAudio = true;
		}
	} catch(e) {}

	// If the device is retina-like, update the img src's and the dropzone class
	if ( isRetina ) {
		$('div.eL-captcha img').each(function(index, element) {
			if ( ! $(element).attr('src') ) return;

			var newImageSRC = $(element).attr('src').replace(/(.+)(\.\w{3,4})$/, "$1@2x$2");
			$.ajax({
				url: newImageSRC,
				type: "HEAD",
				success: function() {
					$(element).attr('src', newImageSRC);
				}
			});
		});

		$('div.eL-captcha > div.eL-where2go').addClass('retina');
	}

	if ( ! supportsAudio ) {
		$('div.eL-captcha > .eL-accessibility').hide();
	} else {
		$('div.eL-captcha > p.eL-accessibility a').on('click touchstart', function( event ) {
			event.preventDefault();

			if ( ! $('div.eL-captcha > div.eL-accessibility').is(':visible') ) {
				$('div.eL-captcha > div.eL-accessibility > audio').each(function() {
					this.load();
					this.play();
				});

				if ( ! $('#' + window.vCVals.a).length ) {
					var validAccessibleElement = '<input type="text" name="' + window.vCVals.a + '" id="' + window.vCVals.a + '" value="" autocomplete="off">';
					$('div.eL-captcha > div.eL-accessibility > p').after(validAccessibleElement);
				}
			}

			$('div.eL-captcha > p.eL-explanation').stop().slideToggle('fast');
			$('div.eL-captcha > div.eL-possibilities').stop().slideToggle('fast');
			$('div.eL-captcha > div.eL-where2go').stop().slideToggle('fast');
			$('div.eL-captcha > div.eL-accessibility').stop().slideToggle('fast');
		});
	}

	if ( ! isMobile ) {// If it's not mobile, load normal drag/drop behavior
		$('div.eL-captcha > div.eL-possibilities > img').draggable({ opacity: 0.6, revert: 'invalid' });
		$('div.eL-captcha > div.eL-possibilities').droppable({
			drop: function(event, ui) {
				if ( ! $('#' + window.vCVals.n).length ) {
					return false;
				}
				if ( $('#' + window.vCVals.n).val() == $(ui.draggable).data('value') ) {
					$('#' + window.vCVals.n).remove();
				}
				$('div.eL-captcha > div.eL-where2go').droppable('enable');
			},
			accept: 'div.eL-captcha > div.eL-possibilities > img'
		});

		$('div.eL-captcha > div.eL-where2go').droppable({
			drop: function(event, ui) {
				if ( $('#' + window.vCVals.n).length ) {
					return false;
				}
				var validElement = '<input type="hidden" name="' + window.vCVals.n + '" id="' + window.vCVals.n + '" readonly="readonly" value="' + $(ui.draggable).data('value') + '">';
				$('#' + window.vCVals.f).append(validElement);
				$(this).droppable('disable');
			},
			accept: 'div.eL-captcha > div.eL-possibilities > img'
		});
	} else {// If it's mobile, we're going to make it possible to just tap an image and move it to the drop area automagically
		$('div.eL-captcha > p.eL-explanation > span.desktopText').hide();// Hide desktop text
		$('div.eL-captcha > p.eL-explanation > span.mobileText').show();// Show mobile text
		$('div.eL-captcha > div.eL-possibilities > img').on('click touchstart', function( event ) {// Add tap behavior, but keep click in case that also works. There is no "duplication" problem since this code won't run twice
			event.preventDefault();

			var dropzoneSelector = 'div.eL-captcha > div.eL-where2go';
			var clickedImageSelector = this;
			var xPos = $(dropzoneSelector).position().left + parseInt( $(dropzoneSelector).css('margin-left'), 10 ) + parseInt( $(dropzoneSelector).css('padding-left'), 10 ) - parseInt( $(clickedImageSelector).css('margin-left'), 10 ) - parseInt( $(clickedImageSelector).css('padding-left'), 10 );
			var yPos = $(dropzoneSelector).position().top + parseInt( $(dropzoneSelector).css('margin-top'), 10 ) + parseInt( $(dropzoneSelector).css('padding-top'), 10 ) - parseInt( $(clickedImageSelector).css('margin-top'), 10 ) - parseInt( $(clickedImageSelector).css('padding-top'), 10 );
			var wDim = $(dropzoneSelector).width();
			var hDim = $(dropzoneSelector).height();
			var iwDim = $(clickedImageSelector).width();
			var ihDim = $(clickedImageSelector).height();

			// If it was dragged already to the droppable zone, move it back to the beginning
			if ( $(clickedImageSelector).css('position') === 'absolute' ) {
				if ( ! $('#' + window.vCVals.n).length ) {
					return false;
				}
				if ( $('#' + window.vCVals.n).val() == $(clickedImageSelector).data('value') ) {
					$('#' + window.vCVals.n).remove();
				}

				$(clickedImageSelector).css({
					'position': 'relative',
					'left': 'auto',
					'top': 'auto'
				});
			} else {
				if ( $('#' + window.vCVals.n).length ) {
					return false;
				}
				var validElement = '<input type="hidden" name="' + window.vCVals.n + '" id="' + window.vCVals.n + '" value="' + $(clickedImageSelector).data('value') + '" readonly>';
				$('#' + window.vCVals.f).append(validElement);

				// Calculate the middle of hte
				var xPos2Go = Math.round(xPos + (wDim/2) - (iwDim/2));
				var yPos2Go = Math.round(yPos + (hDim/2) - (ihDim/2));

				$(clickedImageSelector).css({
					'position': 'absolute',
					'left': xPos2Go,
					'top': yPos2Go
				});
			}
		});
	}
})( jQuery );