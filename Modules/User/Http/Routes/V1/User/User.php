<?php
/**
 * Created by PhpStorm.
 * User: LONG
 * Date: 2019/4/11
 * Time: 0:50
 */


    $api->get('/info/show', ['uses' => 'UserController@show']);

    $api->get('/info/fans-count', ['uses' => 'UserController@fansCount']);

    $api->get('/info/concerns-count', ['uses' => 'UserController@concernsCount']);
