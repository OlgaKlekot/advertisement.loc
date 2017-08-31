<?php
// Includes
include '../core/sessions.php';
include '../core/security.php';
include '../core/routing.php';
include '../core/templating.php';
include '../core/files.php';
include '../core/flash_messages.php';
include '../exceptions/HttpNotFoundException.php';
include '../exceptions/RuntimeException.php';
include '../vendor/autoload.php';

// Configuring
$app = [
    'kernel.root_dir' => dirname(dirname(__FILE__))
];
$app = array_merge($app, [
    'kernel.view_dir' => $app['kernel.root_dir'] . DIRECTORY_SEPARATOR . 'resources' . DIRECTORY_SEPARATOR . 'views',
    'kernel.src_dir' => $app['kernel.root_dir'] . DIRECTORY_SEPARATOR . 'src',
    'kernel.app_dir' => $app['kernel.root_dir'] . DIRECTORY_SEPARATOR . 'app',
    'kernel.services_dir' => $app['kernel.root_dir'] . DIRECTORY_SEPARATOR . 'services'
]);

$app['config']  = require $app['kernel.app_dir'] . DIRECTORY_SEPARATOR . 'config.php';
$app['routes']  = require $app['kernel.app_dir'] . DIRECTORY_SEPARATOR . 'routes.php';
$app['user']    = require $app['kernel.app_dir'] . DIRECTORY_SEPARATOR . 'user.php';

$app['db'] = new PDO($app['config']['dsn'], $app['config']['username'], $app['config']['password']);
$app['db']->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

use Illuminate\Database\Capsule\Manager as Capsule;

$app['capsule'] = new Capsule;
$app['capsule']->addConnection(['driver' => $app['config']['driver'], 'host' => $app['config']['host'], 'database' => $app['config']['database'], 'username' => $app['config']['username'], 'password' => $app['config']['password'], 'charset' => $app['config']['charset'], 'collation' => $app['config']['collation'], 'prefix' => $app['config']['prefix']]);
$app['capsule']->setAsGlobal();
$app['capsule']->bootEloquent();
