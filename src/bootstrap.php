<?php


$app = new \Pageup\Base\App;
// Routes

// $app->router->map('GET', '/', 'HomeController@index', 'index');
$app->get('/', 'HomeController@index', 'index');
$app->get('/a', 'HomeController@index', 'a');
$app->get('/user/[i:id]', 'HomeController@user', 'user');
$app->run();