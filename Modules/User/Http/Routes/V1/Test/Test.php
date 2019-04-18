<?php
/**
 * Created by PhpStorm.
 * User: LONG
 * Date: 2019/3/19
 * Time: 1:20
 */

$api->get('test', ['uses' => 'TestController@test']);
$api->get('fans', ['uses' => 'TestController@fans']);
$api->get('concerns', ['uses' => 'TestController@concerns']);
$api->get('info', ['uses' => 'TestController@info']);