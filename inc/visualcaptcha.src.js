/**
 * visualCaptcha JS file by emotionLoop - 2013.08.17
 *
 * This file handles the JS for the visualCaptcha plugin.
 *
 * This license applies to this file and others without reference to any other license.
 *
 * @author emotionLoop | http://emotionloop.com
 * @link http://visualcaptcha.net
 * @package visualCaptcha
 * @license GNU GPL v3
 * @version 4.2.0
 */
(function( $ ) {
	"use strict";

	// "Global" variables for feature detection
	var isMobile = false;
	var isRetina = false;
	var isOld = false;
	var supportsAudio = false;

	var userAgent = navigator.userAgent || 'Unknown';

	// Known Mobile User Agents
	var mobileRegExp = new RegExp( 'iPhone|iPad|iPod|Android|Windows (Phone|CE)|Bada|Meego|webOS|Palm|BlackBerry|Nokia|Symbian|PocketPC|Smartphone|Mobile', 'i' );

	// User Agents that don't support background gradient + shadow + text-shadow + rounded corners
	var oldRegExp = new RegExp( 'MSIE (6|7|8|9)', 'i' );

	// Check if the user agent is a mobile one
	if ( mobileRegExp.test(userAgent) ) {
		isMobile = true;
	}

	// Check if the user agent is an old one
	if ( oldRegExp.test(userAgent) ) {
		isOld = true;
	}

	// Check if the device is retina-like
	if ( window.devicePixelRatio !== undefined && window.devicePixelRatio > 1 ) {
		isRetina = true;
	}

	// Check if the device supports audio, for accessibility
	try {
		var audioElement = document.createElement('audio');
		if ( audioElement.canPlayType ) {
			supportsAudio = true;
		}
	} catch( e ) {}

	// If the device is old, add the img class to the dropzone so a background image is used instead
	if ( isOld ) {
		$('div.eL-captcha > div.eL-where2go').addClass( 'img' );

		// Remove the paragraph
		$('div.eL-captcha > div.eL-where2go > p').remove();
	}

	// If the device is retina-like, update the img src's and the dropzone class
	if ( isRetina ) {
		$('div.eL-captcha img').each( function( index, element ) {
			if ( ! $(element).attr('src') ) {
				return false;
			}

			var newImageSRC = $(element).attr( 'src' );

			// If the images are the choices, add a &retina=1 to ask for the retina images
			if ( newImageSRC.indexOf('.php') !== -1 ) {
				newImageSRC = newImageSRC + '&retina=1';
			} else {
				// Otherwise add @2x to the path
				newImageSRC = newImageSRC.replace( /(.+)(\.\w{3,4})$/, "$1@2x$2" );
			}

			$.ajax({
				url: newImageSRC,
				type: "HEAD",
				success: function() {
					$(element).attr( 'src', newImageSRC );
				}
			});
		});

		$('div.eL-captcha > div.eL-where2go').addClass( 'retina' );
	}

	// Check if the browser supports audio HTML5 tag for accessibility
	if ( ! supportsAudio ) {
		$('div.eL-captcha > .eL-accessibility').hide();
	} else {
		$('div.eL-captcha > p.eL-accessibility a').on( 'click.visualCaptcha touchstart.visualCaptcha', function( event ) {
			event.preventDefault();

			if ( ! $('div.eL-captcha > div.eL-accessibility').is(':visible') ) {
				// Automatically load and play the audio file
				$('div.eL-captcha > div.eL-accessibility > audio').each(function() {
					this.load();
					this.play();
				});

				// Generate the input for the accessibility answer
				if ( ! $('#' + window.vCVals.a).length ) {
					var validAccessibleElement = '<input type="text" name="' + window.vCVals.a + '" id="' + window.vCVals.a + '" value="" autocomplete="off">';
					$('div.eL-captcha > div.eL-accessibility > p').after( validAccessibleElement );
				}
			}

			$('div.eL-captcha > p.eL-explanation').stop().slideToggle('fast');
			$('div.eL-captcha > div.eL-possibilities').stop().slideToggle('fast');
			$('div.eL-captcha > div.eL-where2go').stop().slideToggle('fast');
			$('div.eL-captcha > div.eL-accessibility').stop().slideToggle('fast');
		});
	}

	// If it's not mobile, load normal drag/drop behavior
	if ( ! isMobile ) {
		// Enable dragging on images
		$('div.eL-captcha > div.eL-possibilities > img').draggable({ opacity: 0.6, revert: 'invalid' });

		// Enable the images to be dropped their initial place, so users can switch images
		$('div.eL-captcha > div.eL-possibilities').droppable({
			drop: function( event, ui ) {
				// If there still isn't any image in the drop area, don't allow rearranging them. No playing! :P
				if ( ! $('#' + window.vCVals.n).length ) {
					return false;
				}

				// If the image is being dropped back and was in the drop area, we need to remove the input with its answer
				if ( $('#' + window.vCVals.n).val() === $(ui.draggable).data('value') ) {
					$('#' + window.vCVals.n).remove();
				}

				// Re-enable dropping to the drop area
				$('div.eL-captcha > div.eL-where2go').droppable( 'enable' );
			},
			accept: 'div.eL-captcha > div.eL-possibilities > img'
		});

		// Enable the images to be dropped in the drop area
		$('div.eL-captcha > div.eL-where2go').droppable({
			drop: function( event, ui ) {
				// Don't allow the image to be dropped if there's one there already
				if ( $('#' + window.vCVals.n).length ) {
					return false;
				}

				// Generate the input with the answer
				var validElement = '<input type="hidden" name="' + window.vCVals.n + '" id="' + window.vCVals.n + '" value="' + $(ui.draggable).data('value') + '" readonly>';
				$('#' + window.vCVals.f).append( validElement );

				// Disable dropping
				$(this).droppable( 'disable' );
			},
			accept: 'div.eL-captcha > div.eL-possibilities > img'
		});
	} else {
		// If it's mobile, we're going to make it possible to just tap an image and move it to the drop area automagically
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

				// If the image is being dropped back and was in the drop area, we need to remove the input with its answer
				if ( $('#' + window.vCVals.n).val() === $(clickedImageSelector).data('value') ) {
					$('#' + window.vCVals.n).remove();
				}

				$(clickedImageSelector).css({
					'position': 'relative',
					'left': 'auto',
					'top': 'auto'
				});
			} else {
				// Don't allow the image to be dropped if there's one there already
				if ( $('#' + window.vCVals.n).length ) {
					return false;
				}

				// Generate the input with the answer
				var validElement = '<input type="hidden" name="' + window.vCVals.n + '" id="' + window.vCVals.n + '" value="' + $(clickedImageSelector).data('value') + '" readonly>';
				$('#' + window.vCVals.f).append(validElement);

				// Calculate the middle of the dropzone
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