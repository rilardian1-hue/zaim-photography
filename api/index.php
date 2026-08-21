<?php

try {
    // Vercel Serverless environment makes /var/task read-only.
    $storagePath = '/tmp/storage';
    if (!is_dir($storagePath)) {
        mkdir($storagePath, 0777, true);
        mkdir($storagePath.'/app/public', 0777, true);
        mkdir($storagePath.'/framework/cache/data', 0777, true);
        mkdir($storagePath.'/framework/sessions', 0777, true);
        mkdir($storagePath.'/framework/views', 0777, true);
        mkdir($storagePath.'/logs', 0777, true);
        mkdir($storagePath.'/bootstrap/cache', 0777, true);
    }
    
    putenv('LOG_CHANNEL=stderr');
    $_ENV['LOG_CHANNEL'] = 'stderr';
    $_ENV['APP_PACKAGES_CACHE'] = '/tmp/storage/bootstrap/cache/packages.php';
    $_ENV['APP_SERVICES_CACHE'] = '/tmp/storage/bootstrap/cache/services.php';
    
    define('LARAVEL_START', microtime(true));
    
    if (file_exists($maintenance = __DIR__.'/../storage/framework/maintenance.php')) {
        require $maintenance;
    }
    
    require __DIR__.'/../vendor/autoload.php';
    
    $app = require_once __DIR__.'/../bootstrap/app.php';
    
    $app->useStoragePath($storagePath);
    
    $app->handleRequest(Illuminate\Http\Request::capture());
} catch (\Throwable $e) {
    http_response_code(500);
    echo "Internal Server Error";
}
