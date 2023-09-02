<?php
//ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);
use Pecee\SimpleRouter\SimpleRouter as Router;

require_once __DIR__ . '/../vendor/autoload.php';
//require_once __DIR__ . '/../vendor/autoload.php';
require_once (__DIR__ . '/../config/routes.php');

/*
try {
    Router::start();
} catch (Throwable $e) {
    var_dump($e);
}
*/
Router::start();