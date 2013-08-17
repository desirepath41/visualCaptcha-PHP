# visualCaptcha for PHP

This is the PHP version of visualCaptcha.

## Current Version

Current version is 4.2.0.

## Requirements

For the script to work, PHP (5.3+ tested), jQuery (1.8-1.10 tested), and jQuery UI (1.9-1.10 tested) are required.

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

## Breaking visualCaptcha

In August 14th 2013, a user posted code that was breaking visualCaptcha at https://gist.github.com/ipeychev/6234050. We improved it at https://gist.github.com/BrunoBernardino/6244324 (so that multiple attempts could be made at the same time, and to get more information), having a successful breaking rate of < 5-7%.

The code's idea is that, because the hashes for the images are visible and don't change for 24h for the same ip, the hashes could be sniffed and multiple attempts made to eventually break visualCaptcha.

Since version 4.2.0, the hashes now vary every time you make a new request, and the successful breaking rate diminished to < 5% (the successful attempts would be for whenever the first option would be the correct one). However, to demonstrate how visualCaptcha's customization is also a powerful part of its security features, the demo now changes the captcha input name, bringing the **successful break rate to 0.00%**. This proves that a bot/script would have to be constantly updated and customized for each site, and still have a very low break rate.

## More information

If you want information about what visualCaptcha is, go to http://visualcaptcha.net.