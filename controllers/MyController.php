<?php
/**
 * Created by PhpStorm.
 * User: Vladyslav
 * Date: 05.03.2017
 * Time: 1:11
 */

namespace controllers;


use components\Controller;

class MyController extends Controller
{

    public function actionIndex()
    {
        session_start();
        if (!isset($_SESSION['user'])) {
            die("Access denied");
        }
        $this->view->render('index', ['user' => $_SESSION['user']]);
        return true;
    }

}