<?php

/**
 * Created by PhpStorm.
 * User: Vladyslav
 * Date: 01.03.2017
 * Time: 15:03
 */
namespace components;

class Router
{
    /**
     * Array with routes
     * @var  $routes array
     */
    private $routes;


    public function __construct()
    {
        $routesPath = ROOT . '/config/routes.php';
        $this->routes = include($routesPath);
    }

    /* @return string Getting request
     * */
    private function getURI()
    {
        if (!empty($_SERVER['REQUEST_URI'])) {
            return trim($_SERVER['REQUEST_URI'], "/");
        }
    }

    public function run()
    {

        //get request
        $uri = $this->getURI();

        /* delete GET parameters in request*/
        if ($pos = strpos($uri, '?')) {
            $uri = substr($uri, 0, $pos);
        }
        // check pattern in URI
        foreach ($this->routes as $uriPattern => $path) {

            if (preg_match("~$uriPattern~", $uri)) {


                $internalRoute = preg_replace("~$uriPattern~", $path, $uri);
                $segments = explode('/', $internalRoute);


                //parse name Controller
                $controllerName = '\controllers\\' . ucfirst(array_shift($segments) . "Controller");

                //parse name Action
                $actionName = 'action' . ucfirst(array_shift($segments));

                $parameters = $segments;

                $controllerObject = new $controllerName;
                $result = call_user_func_array([$controllerObject, $actionName], $parameters);
                if ($result != null) {
                    break;
                }

            }
        }

    }
}