<?php
/**
 * Created by PhpStorm.
 * User: Vladyslav
 * Date: 01.03.2017
 * Time: 15:18
 */

return [
    'test/([1-9]+)' => 'test/view/$1',
    'test' => 'test/index',

    /*site*/
    'site/login' => 'site/login',
    'site' => 'site/index',
    '(w+)' => 'site/$1'
];