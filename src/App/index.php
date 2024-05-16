<?php

// white list routes
use System\Application;

$app = Application::getInstance();

// APIS Articles Routes
$app->route->add('/api/articles', 'User/Articles');
$app->route->add('/api/articles/store', 'User/Articles@store', 'POST');
$app->route->add('/api/articles/show/:id', 'User/Articles@show', 'POST');
$app->route->add('/api/articles/update/:id', 'User/Articles@update', 'POST');
$app->route->add('/api/articles/delete/:id', 'User/Articles@delete', 'POST');


// APIS  Routes
$app->route->add('/api/auth/login', 'User/User@login', 'POST');


// Not Found Routes
$app->route->add('/404', 'NotFound');
$app->route->notFound('/404');
