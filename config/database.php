<?php

return [

    /*
    |--------------------------------------------------------------------------
    | PDO Fetch Style
    |--------------------------------------------------------------------------
    |
    | By default, database results will be returned as instances of the PHP
    | stdClass object; however, you may desire to retrieve records in an
    | array format for simplicity. Here you can tweak the fetch style.
    |
    */

    'fetch' => PDO::FETCH_CLASS,

    /*
    |--------------------------------------------------------------------------
    | Default Database Connection Name
    |--------------------------------------------------------------------------
    |
    | Here you may specify which of the database connections below you wish
    | to use as your default connection for all database work. Of course
    | you may use many connections at once using the Database library.
    |
    */

    'default' => env('DB_CONNECTION', 'cloud_core'),

    /*
    |--------------------------------------------------------------------------
    | Database Connections
    |--------------------------------------------------------------------------
    |
    | Here are each of the database connections setup for your application.
    | Of course, examples of configuring each database platform that is
    | supported by Laravel is shown below to make development simple.
    |
    |
    | All database work in Laravel is done through the PHP PDO facilities
    | so make sure you have the driver for your particular database of
    | choice installed on your machine before you begin development.
    |
    */

    'connections' => [

        'testing' => [
            'driver' => 'sqlite',
            'database' => ':memory:',
        ],

        'sqlite' => [
            'driver'   => 'sqlite',
            'database' => env('DB_DATABASE', base_path('database/database.sqlite')),
            'prefix'   => env('DB_PREFIX', ''),
        ],

        'cloud_user' => [
            'driver'    => 'mysql',
            'host'      => env('USER_DB_HOST', 'localhost'),
            'port'      => env('USER_DB_PORT', 3306),
            'database'  => env('USER_DB_DATABASE', 'cloud_user'),
            'username'  => env('USER_DB_USERNAME', 'root'),
            'password'  => env('USER_DB_PASSWORD', ''),
            'charset'   => env('USER_DB_CHARSET', 'utf8'),
            'collation' => env('USER_DB_COLLATION', 'utf8_unicode_ci'),
            'prefix'    => env('USER_DB_PREFIX', ''),
            'timezone'  => env('USER_DB_TIMEZONE', '+08:00'),
            'strict'    => env('USER_DB_STRICT_MODE', false),
            'unix_socket' => env('DB_SOCKET', ''),
        ],

        'cloud_core' => [
            'driver'    => 'mysql',
            'host'      => env('CORE_DB_HOST', 'localhost'),
            'port'      => env('CORE_DB_PORT', 3306),
            'database'  => env('CORE_DB_DATABASE', 'cloud_core'),
            'username'  => env('CORE_DB_USERNAME', 'root'),
            'password'  => env('CORE_DB_PASSWORD', ''),
            'charset'   => env('CORE_DB_CHARSET', 'utf8'),
            'collation' => env('CORE_DB_COLLATION', 'utf8_unicode_ci'),
            'prefix'    => env('CORE_DB_PREFIX', ''),
            'timezone'  => env('CORE_DB_TIMEZONE', '+08:00'),
            'strict'    => env('CORE_DB_STRICT_MODE', false),
            'unix_socket' => env('DB_SOCKET', ''),
        ],
        'cloud_post' => [
            'driver'    => 'mysql',
            'host'      => env('POST_DB_HOST', 'localhost'),
            'port'      => env('POST_DB_PORT', 3306),
            'database'  => env('POST_DB_DATABASE', 'cloud_post'),
            'username'  => env('POST_DB_USERNAME', 'root'),
            'password'  => env('POST_DB_PASSWORD', ''),
            'charset'   => env('POST_DB_CHARSET', 'utf8'),
            'collation' => env('POST_DB_COLLATION', 'utf8_unicode_ci'),
            'prefix'    => env('POST_DB_PREFIX', ''),
            'timezone'  => env('POST_DB_TIMEZONE', '+08:00'),
            'strict'    => env('POST_DB_STRICT_MODE', false),
            'unix_socket' => env('DB_SOCKET', ''),
        ],
        'cloud_order' => [
            'driver'    => 'mysql',
            'host'      => env('POST_DB_HOST', 'localhost'),
            'port'      => env('POST_DB_PORT', 3306),
            'database'  => env('POST_DB_DATABASE', 'cloud_order'),
            'username'  => env('POST_DB_USERNAME', 'root'),
            'password'  => env('POST_DB_PASSWORD', ''),
            'charset'   => env('POST_DB_CHARSET', 'utf8'),
            'collation' => env('POST_DB_COLLATION', 'utf8_unicode_ci'),
            'prefix'    => env('POST_DB_PREFIX', ''),
            'timezone'  => env('POST_DB_TIMEZONE', '+08:00'),
            'strict'    => env('POST_DB_STRICT_MODE', false),
            'unix_socket' => env('DB_SOCKET', ''),
        ],
        'cloud_statistics' => [
            'driver'    => 'mysql',
            'host'      => env('POST_DB_HOST', 'localhost'),
            'port'      => env('POST_DB_PORT', 3306),
            'database'  => env('POST_DB_DATABASE', 'cloud_statistics'),
            'username'  => env('POST_DB_USERNAME', 'root'),
            'password'  => env('POST_DB_PASSWORD', ''),
            'charset'   => env('POST_DB_CHARSET', 'utf8'),
            'collation' => env('POST_DB_COLLATION', 'utf8_unicode_ci'),
            'prefix'    => env('POST_DB_PREFIX', ''),
            'timezone'  => env('POST_DB_TIMEZONE', '+08:00'),
            'strict'    => env('POST_DB_STRICT_MODE', false),
            'unix_socket' => env('DB_SOCKET', ''),
        ],

    ],

    /*
    |--------------------------------------------------------------------------
    | Migration Repository Table
    |--------------------------------------------------------------------------
    |
    | This table keeps track of all the migrations that have already run for
    | your application. Using this information, we can determine which of
    | the migrations on disk haven't actually been run in the database.
    |
    */

    'migrations' => 'migrations',

    /*
    |--------------------------------------------------------------------------
    | Redis Databases
    |--------------------------------------------------------------------------
    |
    | Redis is an open source, fast, and advanced key-value store that also
    | provides a richer set of commands than a typical key-value systems
    | such as APC or Memcached. Laravel makes it easy to dig right in.
    |
    */

    'redis' => [

        'client' => 'predis',

        'cluster' => env('REDIS_CLUSTER', false),

        'default' => [
            'host'     => env('REDIS_HOST', '127.0.0.1'),
            'port'     => env('REDIS_PORT', 6379),
            'database' => env('REDIS_DATABASE', 0),
            'password' => env('REDIS_PASSWORD', null),
        ],

    ],

];
