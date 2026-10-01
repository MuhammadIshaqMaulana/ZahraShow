<?php

use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

// 1. Prepare writable directories in /tmp for Vercel Serverless environment
$tmpStorage = '/tmp/storage';
$subDirs = [
    $tmpStorage . '/framework/views',
    $tmpStorage . '/framework/cache',
    $tmpStorage . '/framework/cache/data',
    $tmpStorage . '/framework/sessions',
    $tmpStorage . '/bootstrap/cache',
    $tmpStorage . '/logs',
    $tmpStorage . '/app/public',
];

foreach ($subDirs as $dir) {
    if (!is_dir($dir)) {
        mkdir($dir, 0755, true);
    }
}

// 2. Set dynamic cache & view paths to writable /tmp
putenv("VIEW_COMPILED_PATH={$tmpStorage}/framework/views");
putenv("APP_CONFIG_CACHE={$tmpStorage}/bootstrap/cache/config.php");
putenv("APP_SERVICES_CACHE={$tmpStorage}/bootstrap/cache/services.php");
putenv("APP_PACKAGES_CACHE={$tmpStorage}/bootstrap/cache/packages.php");
putenv("APP_ROUTES_CACHE={$tmpStorage}/bootstrap/cache/routes.php");
putenv("APP_EVENTS_CACHE={$tmpStorage}/bootstrap/cache/events.php");

// 3. Fix script name for Vercel routing
$_SERVER['SCRIPT_NAME'] = '/index.php';
$_SERVER['SCRIPT_FILENAME'] = __DIR__ . '/../public/index.php';

// 4. Register Composer autoloader
require __DIR__ . '/../vendor/autoload.php';

// 5. Bootstrap Laravel Application and configure storage path
$app = require_once __DIR__ . '/../bootstrap/app.php';
$app->useStoragePath($tmpStorage);

// 6. Handle incoming HTTP Request
$app->handleRequest(Request::capture());
