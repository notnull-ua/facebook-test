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

        if(isset($_GET['service'])){
            $auth = new SocialAuth($_GET['service']);
            $auth->authenticate();
            echo $auth->getSocialId();
            return true;
        }


        $config = include(ROOT."/config/serviceConfig.php");
        $facebook = new Facebook($config['facebook']);
        $this->view->render('login',['service' => $facebook]);
        return true;
    }
}