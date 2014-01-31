<?php

require_once '../vendor/autoload.php';

// Initialize Session
session_cache_limiter( false );
session_start();

// Initialize Slim
$composer = json_decode( file_get_contents( __DIR__ . '/../composer.json' ) );

$app = new \Slim\Slim(
    array(
      'version' => $composer->version,
      'debug' => false,
      'mode' => 'production'
    )
);

require_once __DIR__ . '/../app/app.php';

$app->run();

?>