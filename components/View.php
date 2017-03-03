<?php
/**
 * Created by PhpStorm.
 * User: Vladyslav
 * Date: 02.03.2017
 * Time: 15:45
 */

namespace components;


// Путь до папки с шаблонами
define('VIEWS_BASEDIR', ROOT.'/views/');

class View {
    // get rendered layout with $params
    function fetchPartial($template, $params = array()){
        extract($params);
        ob_start();
        include VIEWS_BASEDIR.$template.'.php';
        return ob_get_clean();
    }

    // print rendered layout with $params
    function renderPartial($template, $params = array()){
        echo $this->fetchPartial($template, $params);
    }

    // render layout with $params to $content
    // get rendered layout with $content
    function fetch($template, $params = array()){
        $content = $this->fetchPartial($template, $params);
        return $this->fetchPartial('layout', array('content' => $content));
    }

    // print fetched layout with params
    function render($template, $params = array()){
        echo $this->fetch($template, $params);
    }
}