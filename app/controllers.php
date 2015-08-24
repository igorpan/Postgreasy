<?php

use Silex\Application;
/** @var $app \Silex\Application */

$app->get('', function (Application $app) {
    $manager = new \Postgreasy\Postgres\Manager('127.0.0.1', 'rounded_dev', 'rounded_dev');
    ob_start();
    require __DIR__ . '/view.php';
    return ob_get_clean();
});