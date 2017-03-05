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

    /* todo: зробити зберігання до бази даних якщо немає користувача та оновлення даних якщо є.
    todo: зберігати в дві таблиці.

    todo: БД: створити таблицю imported_friends з полями: id, user_id, social_user_id, firstname,lastname
    todo: та звязати її з таблицею юзерів.
    */
}