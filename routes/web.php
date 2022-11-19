<?php

use Hotash\Installer\Http\Middleware\InstallerMiddleware;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'install', 'as' => 'installer.', 'middleware' => ['web', InstallerMiddleware::class]], function () {
    $routes = config('installer.routes', []);

    if ($name = array_key_first($routes)) {
        Route::redirect('/', "/install/$name");
    }

    foreach ($routes as $name => [$match, $action]) {
        Route::match($match, $name, $action)->name($name);
    }
});
