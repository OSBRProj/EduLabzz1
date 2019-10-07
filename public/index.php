<?php

define('LARAVEL_START', microtime(true));

//require __DIR__.'/../../laravel/jpiaget/vendor/autoload.php';
require __DIR__.'/../vendor/autoload.php';

//$app = require_once __DIR__.'/../../laravel/jpiaget/bootstrap/app.php';
$app = require_once __DIR__.'/../bootstrap/app.php';

$app->bind('path.public', function () {
    return __DIR__;
});

$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

$response = $kernel->handle(
    $request = Illuminate\Http\Request::capture()
);

$response->send();

$kernel->terminate($request, $response);
