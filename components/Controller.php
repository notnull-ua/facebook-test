<?php
/**
 * Created by PhpStorm.
 * User: Vladyslav
 * Date: 02.03.2017
 * Time: 15:42
 */

namespace components;


class Controller
{

    protected $view;

    function __construct()
    {
        $this->view = new View();

        /* get name folder for layouts */
        $nameClass = preg_split('/([[:upper:]][[:lower:]]+)/', get_called_class(), null, PREG_SPLIT_DELIM_CAPTURE | PREG_SPLIT_NO_EMPTY);
        $this->view->setFolderLayout(lcfirst($nameClass[1]));
    }


}