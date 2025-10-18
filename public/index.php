<?php

use Illuminate\Contracts\Http\Kernel;
use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

// Check if the application is in maintenance mode
if (file_exists($maintenance = __DIR__.'/../storage/framework/maintenance.php')) {
    require $maintenance;
}

// Autoload Composer dependencies
require __DIR__.'/../vendor/autoload.php';

// Bootstrap the application
$app = require_once __DIR__.'/../bootstrap/app.php';

// Get the HTTP kernel
$kernel = $app->make(Kernel::class);

// Capture the incoming request and handle it
$request = Request::capture();
$response = $kernel->handle($request);

// Send the response back to the client
$response->send();

// Terminate the request lifecycle
$kernel->terminate($request, $response);
