<?php
/**
 * Created by PhpStorm.
 * User: LONG
 * Date: 2019/3/19
 * Time: 1:20
 */

$api->group(['prefix' => 'post'], function ($api) {
    $api->post('/store', ['uses' => 'PostController@store']);
    $api->delete('/delete/{post_id}', [['uses' => 'PostController@destroy']]);
    $api->post('/restore/{post_id}', ['uses' => 'PostController@restore']);
    $api->post('/favor/{post_id}', ['uses' => 'PostController@favor']);
    $api->post('/stick/{post_id}', ['uses' => 'PostController@stick']);
    $api->get('/{post_id}', ['uses' => 'PostController@show']);
    $api->get('/', ['uses' => 'PostController@index']);
});

$api->group(['prefix' => 'comment'], function ($api) {
    $api->post('/store/{post_id}', ['uses' => 'CommentController@store']);
    $api->delete('/delete/{post_id}/{comment_id}', [['uses' => 'CommentController@destroy']]);
    $api->post('/restore/{post_id}/{comment_id}', ['uses' => 'CommentController@restore']);
    $api->post('/favor/{post_id}/{comment_id}', ['uses' => 'CommentController@favor']);
    $api->get('/{post_id}/{comment_id}', ['uses' => 'CommentController@show']);
    $api->get('/{post_id}', ['uses' => 'CommentController@index']);
});

$api->group(['prefix' => 'response'], function ($api) {
    $api->post('/store/{post_id}/{comment_id}', ['uses' => 'ResponseController@store']);
    $api->delete('/delete/{post_id}/{comment_id}/{response_id}', [['uses' => 'ResponseController@destroy']]);
    $api->post('/restore/{post_id}/{comment_id}/{response_id}', ['uses' => 'ResponseController@restore']);
    $api->post('/favor/{post_id}/{comment_id}/{response_id}', ['uses' => 'ResponseController@favor']);
    $api->get('/{post_id}/{comment_id}', ['uses' => 'ResponseController@index']);
});