<?php
/**
 * Created by PhpStorm.
 * User: LONG
 * Date: 2019/3/6
 * Time: 0:39
 */
return [
    'defaults' => [
        'guard' => 'api',
        'passwords' => 'users',
    ],
    'guards' => [
        'api' => [
            'driver' => 'passport',
            'provider' => 'users',
        ],
    ],
    'providers' => [
        'users' => [
            'driver' => 'eloquent',
            'model' => Modules\User\Models\User::class
        ]
    ]
];