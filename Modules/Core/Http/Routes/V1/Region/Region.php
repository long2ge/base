<?php
/**
 * Created by PhpStorm.
 * User: long
 * Date: 2019/4/12
 * Time: 10:18 PM
 */

$api->post('region/{provinceId}/{cityId}', ['uses' => 'RegionController@index']);