<?php

namespace App\Controllers;
use App\Models\Connect;
use App\Services\Auth\UserService;
use App\services\JwtService;
use App\Models\TemplateModel;
use App\Models\CVModel;

class HomeController {


    private $jwtService;

    private $userService;
    public function __construct()
    {
        $this->userService = new UserService();
        $this->jwtService = new JwtService();
        
    }
    public function index() {
        $data = [
            'template' => '/auth/login',
        ];
      
        render('index', $data);
    }

    public function about()
    {
        render('aboutus');
    }
    public function login(){

        $data = [
            'template' => '/auth/login',
        ];
        render('index', $data);
    }

    public function register()
    {
        $data = [
            'template' => '/auth/register',
        ];
        render('index', $data);
    }

    public function allcv()
    {
        $this->jwtService->checkAndRefreshToken();
        $userId = $this->jwtService->getUserId();
        if (!$userId) {
            $data = [
                'template' => '/auth/login',
            ];
            render('index', $data);
            exit;
        }
        $CVModel = new CVModel();
        $userId = $this->jwtService->getUserId();
        $data = [
            'template' => '/MyCV/allcv',
            'cv' => $CVModel->getAllCVById($userId),
        ];
        render('index', $data);
    }
    public function template(){
        $this->jwtService->checkAndRefreshToken();
        $userId = $this->jwtService->getUserId();
        if (!$userId) {
            $data = [
                'template' => '/auth/login',
            ];
            render('index', $data);
            exit;
        }
        $TemplateModel = new TemplateModel();
        $CVModel = new CVModel();
        $userId = $this->jwtService->getUserId();
        $data = [
            'template' => '/MyCV/template',
            'templates' => $TemplateModel->getAll(),
            'namecv' => $CVModel->getCVById($userId),
        ];
        render('index', $data);
    }
    public function profile()
    {
        $this->jwtService->checkAndRefreshToken();
        $userId = $this->jwtService->getUserId();
        if (!$userId) {
            $data = [
                'template' => '/auth/login',
            ];
            render('index', $data);
            exit;
        }
        $userData = $this->userService->getUserProfile($userId);

        render('index', [
            'template' => '/MyCV/profile',
            'profile' => $userData['profile'],
            'socialLinks' => $userData['socialLinks']
        ]);
    }
    public function cv(){
        $this->jwtService->checkAndRefreshToken();
        $userId = $this->jwtService->getUserId();
        if (!$userId) {
            $data = [
                'template' => '/auth/login',
            ];
            render('index', $data);
            exit;
        }
        $data = [
            'template' => '/MyCV/cv',
        ];
        render('index', $data);
    }

    public function logout(){
        $this->jwtService->checkAndRefreshToken();
        $result = $this->jwtService->logout();
        if($result['success']){
            render('index', [
                'template' => '/auth/login',
            ]);
            exit;
        }
    }
}


