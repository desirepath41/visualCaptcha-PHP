visualCaptcha-php [![Build Status](https://travis-ci.org/emotionLoop/visualCaptcha-PHP.png?branch=master)](https://travis-ci.org/emotionLoop/visualCaptcha-PHP)
==================

PHP sample for visualCaptcha.


## Installation 

You need PHP 5.3+ installed with [composer](https://getcomposer.org/doc/00-intro.md#downloading-the-composer-executable). Use next command for locally installed composer:
```
php composer.phar install
```
Or next one for globally installed composer:
```
composer install
```


## Run server

Run next command to start PHP server on port 8282:
```
php -S localhost:8282 -t public
```


## Run tests

Run next command to start unit tests:
```
vendor/bin/phpunit
```


## API

### GET `/start/:howmany`

This route is for generation common data (image field name, image name, image values and audio field name) for visual captcha front-end.

Parameters:

- `howmany` is required, the number of images to generate.

### GET `/image/:index`

This route is for getting generated image file by index. 

Parameters:

- `index` is required, the index of the image you wish to get.

### GET `/audio(/:type)`

This route is for getting generated audio file.

Parameters:

- `type` is optional, the audio file format and defaults to `mp3`, but can also be `ogg`.

### POST `/try` 

It is a demo example of validating the visual captcha.


## License

The MIT License (MIT)

Copyright (c) 2014 emotionLoop

Permission is hereby granted, free of charge, to any person obtaining a copy of
this software and associated documentation files (the "Software"), to deal in
the Software without restriction, including without limitation the rights to
use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of
the Software, and to permit persons to whom the Software is furnished to do so,
subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS
FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR
COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER
IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN
CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
