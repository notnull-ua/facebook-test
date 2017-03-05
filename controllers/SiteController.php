<?php
/**
 * Created by PhpStorm.
 * User: Vladyslav
 * Date: 02.03.2017
 * Time: 15:43
 */

namespace controllers;

/**@var $view View*/

use components\Controller;
use components\DB;
use components\Facebook;
use components\SocialAuth;
use components\View;

class SiteController extends Controller
{

    public function actionIndex(){

        $this->view->render('index',['model' => 1]);
        return true;
    }

    public  function  actionLogin(){

        if (isset($_SESSION['login'])) {
            die("Access denied");
        }


        $config = include(ROOT . "/config/serviceConfig.php");

        if(isset($_GET['service'])){
            $service = ucfirst($_GET['service']);
            $serviceObj = new Facebook($config['facebook']);
            $auth = new SocialAuth($serviceObj);
            if ($auth->authenticate()) {

            }
            session_start();
            $_SESSION['user'] = $auth->getUserInfo();
            header('Location: /my');
            return true;
        }


        $facebook = new Facebook($config['facebook']);
        $this->view->render('login',['service' => $facebook]);
        return true;
    }

    public function actionLogout()
    {
        session_start();
        if (!isset($_SESSION['user'])) {
            exit("Access denied");
        } else {
            unset($_SESSION['user']);
        }
        header('Location: /');
        return true;
    }
}