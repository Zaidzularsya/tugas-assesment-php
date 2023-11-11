<?php

use ZF\App\Route;

use ZF\Controllers\HomeController;
use ZF\Controllers\AuthController;
use ZF\Controllers\ApiController;

$route = new Route();


$route->get('/', [HomeController::class, 'index']);
$route->get('/home', [HomeController::class, 'home']);
$route->post('/auth', [AuthController::class, 'auth']);
$route->get('/logout', [AuthController::class, 'logout']);



$route->post('/update-task', [HomeController::class, 'updateTask']);
$route->post('/insert-task', [HomeController::class, 'insertTask']);
$route->post('/delete-task', [HomeController::class, 'deleteTask']);


$route->post('/upload-attachment', [HomeController::class, 'uploadAttachment']);


/**
 * Routing Api
 */

$route->get('/getTasks', [ApiController::class, 'getTasks']);
$route->post('/getTaskById', [ApiController::class, 'getTaskById']);
$route->post('/insertTask', [ApiController::class, 'insertTask']);
$route->post('/updateTask', [ApiController::class, 'updateTask']);
$route->post('/deleteTask', [ApiController::class, 'deleteTask']);