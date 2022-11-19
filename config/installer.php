<?php

// config for Hotash/Installer

use Hotash\Installer\Http\Controllers\DatabaseController;
use Hotash\Installer\Http\Controllers\InstallerController;

return [

    /*
    |--------------------------------------------------------------------------
    | Server Requirements
    |--------------------------------------------------------------------------
    |
    | This is the default Laravel server requirements, you can add as many
    | as your application require, we check if the extension is enabled
    | by looping through the array and run "extension_loaded" on it.
    |
    */
    'core' => [
        'minPhpVersion' => '8.0',
    ],

    'requirements' => [
        'openssl',
        'pdo',
        'mbstring',
        'tokenizer',
        'fileinfo',
        'curl',
    ],

    /*
    |--------------------------------------------------------------------------
    | Folders Permissions
    |--------------------------------------------------------------------------
    |
    | This is the default Laravel folders permissions, if your application
    | requires more permissions just add them to the array list bellow.
    |
    */
    'permissions' => [
        'storage/app/' => '755',
        'storage/framework/' => '755',
        'storage/logs/' => '755',
        'bootstrap/cache/' => '755',
    ],

    /*
    |--------------------------------------------------------------------------
    | Routes
    |--------------------------------------------------------------------------
    |
    | Laravel installer routes.
    |
    */
    'routes' => [
        'initial' => ['get', InstallerController::class],
        'requirements' => ['get', [InstallerController::class, 'requirements']],
        'permissions' => ['get', [InstallerController::class, 'permissions']],
        'config' => [['get', 'post'], DatabaseController::class],
        'finish' => ['get', [InstallerController::class, 'finish']],
    ],
];
