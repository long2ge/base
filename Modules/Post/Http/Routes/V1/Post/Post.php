<?php
/**
 * Created by PhpStorm.
 * User: LONG
 * Date: 2019/3/19
 * Time: 1:20
 */

$api->post('/post/store', ['uses' => 'PostController@store']);
$api->delete('/post/delete/{post_id}', [['uses' => 'PostController@destroy']]);
$api->post('/post//restore/{post_id}', ['uses' => 'PostController@restore']);
$api->post('/post/favor/{post_id}', ['uses' => 'PostController@favor']);
$api->post('/post/stick/{post_id}', ['uses' => 'PostController@stick']);
$api->get('/post/{post_id}', ['uses' => 'PostController@show']);
$api->get('/post', ['uses' => 'PostController@index']);

$api->post('/comment/store', ['uses' => 'CommentController@store']);
$api->delete('/comment/delete/{comment_id}', [['uses' => 'CommentController@destroy']]);
$api->post('/comment//restore/{comment_id}', ['uses' => 'CommentController@restore']);
$api->post('/comment/favor/{comment_id}', ['uses' => 'CommentController@favor']);
$api->get('/comment/{comment_id}', ['uses' => 'CommentController@show']);
$api->get('/comment', ['uses' => 'CommentController@index']);

$api->post('/response/store', ['uses' => 'ResponseController@store']);
$api->delete('/response/delete/{response_id}', [['uses' => 'ResponseController@destroy']]);
$api->post('/response//restore/{response_id}', ['uses' => 'ResponseController@restore']);
$api->post('/response/favor/{response_id}', ['uses' => 'ResponseController@favor']);
$api->get('/response/{response_id}', ['uses' => 'ResponseController@show']);
$api->get('/response', ['uses' => 'ResponseController@index']);