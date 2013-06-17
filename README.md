# visualCaptcha for PHP

This is the PHP version of visualCaptcha.

## Current Version

Current version is 4.0.4.

## Requirements

For the script to work, PHP (5.3+ tested), jQuery (1.8+ tested), and jQuery UI (1.9+ tested) are required.

**Note:** PHP < 5.3 is not supported (you can remove the namespaces and it should still work, but we're not supporting that).

## Usage

We have it prepared to be setup in an Horizontal or Vertical way (css changes and the number of images showing as well). Type `0` is Horizontal and `1` is Vertical. By default, Horizontal is applied, so if you want to show it vertically, you can use:

```php
printCaptcha( 'frm_sample', 1 );
```

**Note:** `printCaptcha()` is a function we've created in index.php for example purposes, but it's not required. The methods you'll need to use (besides the constructor) will be `show()` and `isValid()`.

The sample is in English (for distribution reasons), but the strings, images, and audio files are easily changed, so you can change it to your own language, or implement multi-language without hassle.

## Demo

You can view visualCaptcha's demo at http://demo.visualcaptcha.net

## More information

If you want information about what visualCaptcha is, go to http://visualcaptcha.net.