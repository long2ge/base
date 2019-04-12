<?php

/*
|--------------------------------------------------------------------------
| Order 模块 API版本 v1 路由
|--------------------------------------------------------------------------
| 路由中间件可以加一下内容
|
| 'middleware' => ['']
| cors 允许跨域；serializer 格式化返回数据；serializer:array 数组格式化返回数据；api.throttle 接口访问频率控制
|--------------------------------------------------------------------------
*/
$api->version('v1', [
    'namespace' => 'Modules\User\Http\Controllers\V1',
    // 每分钟可以请求20次
    'middleware' => 'api.throttle', 'limit' => 20, 'expires' => 1
], function ($api) {
    /*
    |--------------------------------------------------------------------------
    | Order 模块 API版本 v1 路由 - 应用接口
    |--------------------------------------------------------------------------
    */

    $api->group(['prefix' => 'user'], function($api) {


        /*
        |--------------------------------------------------------------------------
        | 不受权限控制的路由
        |--------------------------------------------------------------------------
        */

        require __DIR__ . '/Test/Test.php';

        require __DIR__ . '/User/User.php';

        /*
        |--------------------------------------------------------------------------
        | 权限控制的路由
        |--------------------------------------------------------------------------
        | 在此路由组下的路由必须在头部传有效的令牌才能访问
        */
        $api->group(['middleware' => 'auth'], function ($api) {


        });
    });
});
