<?php
/**
 * Created by PhpStorm.
 * User: Vladyslav
 * Date: 01.03.2017
 * Time: 14:55
 */

ini_set('display_errors', 1);
error_reporting(E_ALL);

define('ROOT', __DIR__);

$loader = require_once(ROOT . '/vendor/autoload.php');
$loader->addPsr4('controllers\\', ROOT . '/controllers/');
$loader->addPsr4('components\\', ROOT . '/components/');
$loader->addPsr4('models\\', ROOT . '/models/');

$router = new \components\Router();
$router->run();