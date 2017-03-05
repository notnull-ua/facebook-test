<?php
/**
 * Created by PhpStorm.
 * User: Vladyslav
 * Date: 05.03.2017
 * Time: 21:19
 */

namespace models;


class User
{

    /**
     * Return user array with id and other data
     * or redirect if user is not auth
     * @return array User
     */
    public static function checkLogged()
    {
        // Если сессия есть, вернем идентификатор пользователя
        if (isset($_SESSION['user'])) {
            return $_SESSION['user'];
        }
        header("Location: /site/login");
    }

    /**
     * Check if User is Guest
     * @return boolean Result
     */
    public static function isGuest()
    {
        if (isset($_SESSION['user'])) {
            return false;
        }
        return true;
    }

}