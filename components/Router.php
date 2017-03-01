<?php

/**
 * Created by PhpStorm.
 * User: Vladyslav
 * Date: 01.03.2017
 * Time: 15:03
 */
namespace components;
//use controllers\TestController;


class Router
{
    private $routes;

    public function __construct()
    {
        $routesPath = ROOT . '/config/routes.php';
        $this->routes = include($routesPath);
    }

    /* @return string Getting request
     * */
    private  function getURI(){
        if(!empty($_SERVER['REQUEST_URI'])){
            return trim($_SERVER['REQUEST_URI'], "/");
        }
    }

    public function run()
    {

        //get request
        $uri =  $this->getURI();

        // check pattern in URI
        foreach ($this->routes as $uriPattern => $path) {
            if(preg_match("~$uriPattern~",$uri)){
                $segments = explode('/', $path);

                //parse name Controller
                $controllerName = ucfirst(array_shift($segments)."Controller");

                //parse name Action
                $actionName = 'action'.ucfirst(array_shift($segments));
                $controllerFile = ROOT.'/controllers/'.$controllerName.'.php';

                if(file_exists($controllerFile)){
                    include_once ($controllerFile);

                }

                $controllerObject = new $controllerName;
                $result = $controllerObject->$actionName();
                if($result != null) {
                    break;
                }




            }
        }

    }
}