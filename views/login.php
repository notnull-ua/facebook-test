<?php
/**
 * Created by PhpStorm.
 * User: Vladyslav
 * Date: 03.03.2017
 * Time: 15:52
 */
/* @var $service \components\Facebook */

if (!isset($_GET['code'])) {
        echo '<p><a href="' . $service->getAuthUrl() . '">Authenticate using Facebook '.'</a></p>';
}
