<?php

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../Custom/Routes.php';
require_once __DIR__ . '/../Custom/Error.php';
require_once __DIR__ . '/../Custom/utils.php';

require_once __DIR__ . '/../app/controllers/HomeController.php'; 
require_once __DIR__ . '/../app/controllers/TemplateController.php';
require_once __DIR__ . '/../app/controllers/Auth/UserController.php';
require_once __DIR__ . '/../app/controllers/CVController.php';


use App\Controllers\HomeController;
use App\Controllers\TemplateController;
use App\Controllers\Auth\UserController;
use App\Controllers\CVController;
use Custom\Routes;

Routes::get('/', [HomeController::class, 'index']);
Routes::get('/about', [HomeController::class, 'about']);
Routes::get('/contact', [HomeController::class, 'contact']);
Routes::get('/login', [HomeController::class, 'login']);
Routes::get('/register', [HomeController::class, 'register']);
Routes::get('/allcv', [HomeController::class, 'allcv'], true);
Routes::get('/template', [HomeController::class, 'template'], true);
Routes::get('/profile', [HomeController::class, 'profile'], true);
Routes::get('/cv', [HomeController::class, 'cv'], true);

//logout
Routes::get('/logout', [HomeController::class, 'logout']);


// Template 
Routes::get('/template1', [TemplateController::class, 'template1']);
Routes::get('/template2', [TemplateController::class, 'template2']);
//register
Routes::post('/register',[UserController::class, 'register']);
//login
Routes::post('/login', [UserController::class, 'login']);
//profile
Routes::post('/profile', [UserController::class, 'updateProfile']);
//create CV
Routes::post('/createcv', [CVController::class, 'createCV']);
//Update template cv
Routes::post('/updateTemplateCV', [CVController::class, 'updateTemplateCV']);
//Edit cv
Routes::get('/editcv/{id}', [CVController::class, 'editcv'], true);
Routes::post('/editcv/{id}', [CVController::class, 'editcv']);
//Delete cv
Routes::get('/deletecv/{id}', [CVController::class, 'deletecv']);
//review
Routes::get('/preview/{id}', [CVController::class, 'preview']);
//show cv by link
Routes::get('/{cv_link}', [CVController::class, 'showCVByLink']);




$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
Routes::route($uri);
