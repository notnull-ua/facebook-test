<?php
/**
 * Created by PhpStorm.
 * User: Vladyslav
 * Date: 02.03.2017
 * Time: 15:43
 */

namespace controllers;

/**@var $view View */

use components\Controller;
use components\DB;
use components\Facebook;
use components\SocialAuth;
use components\View;
use models\User;

class SiteController extends Controller
{

    public function actionIndex()
    {

        $this->view->render('index', ['model' => 1]);
        return true;
    }

    public function actionLogin()
    {

        if (isset($_SESSION['user'])) {
            die("Access denied");
        }


        $config = include(ROOT . "/config/serviceConfig.php");

        if (isset($_GET['service'])) {
            $service = 'components\\' . ucfirst($_GET['service']);
            $serviceObj = new $service($config[$_GET['service']]);
            $auth = new SocialAuth($serviceObj);

            if ($auth->authenticate()) {
                $socialauth = \models\SocialAuth::getModelBySocialId($auth->getSocialId());
                if (count($socialauth) == 0) {
                    $user = new User();
                    $namearr = $auth->getExplodedName();
                    $user->firstname = $namearr['firstname'];
                    $user->lastname = $namearr['lastname'];
                    $user->email = $auth->getEmail();
                    if ($user->save()) {
                        $socialauth = new \models\SocialAuth();
                        $socialauth->service_name = $auth->getProvider();
                        $socialauth->social_id = $auth->getSocialId();
                        $socialauth->user_id = $user->id;
                        if (!$socialauth->save()) {
                            throw  new \ErrorException("Save error of social_auth");
                        }
                    } else {
                        throw  new \ErrorException("Save error user");
                    }
                }


            }
            $_SESSION['user'] += $auth->getUserInfo();
            header('Location: /my');
            return true;
        }


        $facebook = new Facebook($config['facebook']);
        $this->view->render('login', ['service' => $facebook]);
        return true;
    }

    public function actionLogout()
    {
        if (!isset($_SESSION['user'])) {
            exit("Access denied");
        } else {
            unset($_SESSION['user']);
        }
        header('Location: /');
        return true;
    }
}