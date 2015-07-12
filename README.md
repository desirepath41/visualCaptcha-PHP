[![Build Status](https://travis-ci.org/emotionLoop/visualCaptcha-PHP.svg?branch=master)](https://travis-ci.org/emotionLoop/visualCaptcha-PHP)
[![Codacy](https://www.codacy.com/project/badge/07b7a5b48c2044a0984d458c7b82b35a)](https://www.codacy.com/app/bruno-bernardino/visualCaptcha-PHP)
[![Code Climate](https://codeclimate.com/github/emotionLoop/visualCaptcha-ruby/badges/gpa.svg)](https://codeclimate.com/github/emotionLoop/visualCaptcha-ruby)

# visualCaptcha-PHP

PHP sample for visualCaptcha. [You can also see it live](http://demo.visualcaptcha.net).

This is a demo/sample PHP app that uses the [visualCaptcha PHP composer/packagist package](https://github.com/emotionLoop/visualCaptcha-packagist) and the [visualCaptcha jQuery plugin bower package](https://github.com/emotionLoop/visualCaptcha-frontend-jquery), as a proof-of-concept for how to integrate it with your PHP project.

## NOTES FOR BEGINNERS

If you're used to the simpler, older version of visualCaptcha, you can still get [version 4.2.0](https://github.com/emotionLoop/visualCaptcha-PHP/tree/v4.2.0), but note it's harder to update and it has a potential flaw that could make bots override it, though it isn't a big concern if you understand how it's done.

If you're not familiar with building APIs, custom routes, composer, or bower, you should also consider using that simpler version.

This won't look like the current demo, because all demos use version 5.0+.


## Installation 

You need PHP 5.3+ installed with [composer](https://getcomposer.org/doc/00-intro.md#downloading-the-composer-executable). Use the following command if you've got composer locally installed:
```
php composer.phar install
```
If you've got composer installed globally, use the following command
```
composer install
```

This will install the visualCaptcha package, PHPUnit, and Slim (for the API demo).


## Run server

If you don't have a server running, you can use PHP's new built-in server to run it, for example on port 8282, by typing the following command:
```
php -S localhost:8282 -t public
```

If you already have apache or nginx running with PHP, you just need to point the root to `public/index.php`


## Run tests

If you need to run Unit tests, just use the following command:
```
vendor/bin/phpunit
```


## API

visualCaptcha, since 5.0, uses an API for increased security and to become back-end-agnostic (that's why you can easily plug-in a Vanilla JS, AngularJS, or jQuery front-end without changing anything).

It expects the following routes to exist, which we've put in this sample, using Slim (just to make it easier).

You are expected to have these routes in your implementation, but you can change them in visualCaptcha's front-end config.

### GET `/start/:howmany`

This route will be the first route called by the front-end, which will generate and store session data.

Parameters:

- `howmany` is required, the number of images to generate.

### GET `/image/:index`

This route will be called for each image, to get it and show it, by index.

Parameters:

- `index` is required, the index of the image you want to get.

### GET `/audio(/:type)`

This route will be called for the audio file, to get it and play it, either the mp3 or ogg file.

Parameters:

- `type` is optional, the audio file format defaults to `mp3`, but can also be `ogg`.

### POST `/try` 

This is just a sample route, where we post the form to, and where the visualCaptcha validation takes place.


## License

MIT. Check the [LICENSE](LICENSE) file.
