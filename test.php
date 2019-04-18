<?php
/**
 * Created by PhpStorm.
 * User: LONG
 * Date: 2019/4/9
 * Time: 21:51
 */

use Modules\User\Models\User;

require './bootstrap/app.php';


    $user = app(User::class)->find(1);

    dd($user);