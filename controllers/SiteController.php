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
use components\View;

class SiteController extends Controller
{

    public function actionIndex(){
        $this->view->render('index',['model' => 1]);
        return true;

    }
}