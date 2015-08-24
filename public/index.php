<?php

require_once __DIR__.'/../vendor/autoload.php';

$appDir = __DIR__ . '/../app';

$app = new Silex\Application();
$app['debug'] = true;
require $appDir . '/controllers.php';
$app->run();