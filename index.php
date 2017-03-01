<?php
/**
 * Created by PhpStorm.
 * User: Vladyslav
 * Date: 01.03.2017
 * Time: 14:55
 */

ini_set('display_errors',1);
error_reporting(E_ALL);

define('ROOT', dirname(__FILE__));
use components\Router;
require_once (ROOT.'/components/Router.php');


$router = new Router();
$router->run();