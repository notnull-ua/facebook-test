<?php
/**
 * Created by PhpStorm.
 * User: Vladyslav
 * Date: 05.03.2017
 * Time: 1:11
 */

namespace controllers;


use components\Controller;
use models\User;

class MyController extends Controller
{

    public function actionIndex()
    {
        if (!isset($_SESSION['user'])) {
            die("Access denied");
        }
        $user = User::getUser();
        $this->view->render('index', ['user' => $_SESSION['user']]);
        return true;
    }

}