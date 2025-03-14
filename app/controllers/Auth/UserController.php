<?php
namespace App\Controllers\Auth;
use App\services\Auth\UserService;
use App\services\JwtService;


class UserController
{

    private $jwtService;

    private $userService;
    public function __construct()
    {
        $this->userService = new UserService();
        $this->jwtService = new JwtService();

        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }

    public function login()
    {
        $userId = $this->jwtService->getUserId();
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $result = $this->userService->login($_POST);

            if (!$result['success']) {
                $errors = $result['errors'];
                $oldData = $_POST;

                render('index', [
                    'template' => '/auth/login',
                    with('error', 'Đăng nhập thất bại!'),
                    'errors' => $errors,
                    'oldData' => $oldData
                ]);
                exit;
            }

            $_SESSION['token'] = $result['token'];
            $userData = $this->userService->getUserProfile($userId);
            render('index', [
                'template' => '/MyCV/profile',
                'profile' => $userData['profile'],
                'socialLinks' => $userData['socialLinks']
            ], 'profile');
            exit;
        }

        render('index', ['template' => '/auth/login']);
        exit;
    }

    public function register()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $result = $this->userService->register($_POST);

            if (!$result['success']) {
                $errors = $result['errors'];
                $oldData = $_POST;
                with('error', 'Đăng ký thất bại!');
                render('index', [
                    'template' => '/auth/register',
                    'errors' => $errors,
                    'oldData' => $oldData
                ]);
                
                exit;
            }
            with('success', 'Đăng ký thành công!');

            render('index', ['template' => '/auth/login']);
            exit;
        }
    }

    public function updateProfile()
    {
        $token = $this->jwtService->getTokenFromRequest();
        $userId = $this->jwtService->getUserIdFromToken($token);

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $result = $this->userService->updateProfile($_POST);

            if (!$result['success']) {
                $errors = $result['errors'];
                $oldData = $_POST;
                with('error', 'Cập nhật profile thất bại!');
                $userData = $this->userService->getUserProfile($userId);
                render('index', [
                    'template' => '/mycv/profile',                  
                    'errors' => $errors,
                    'oldData' => $oldData,
                    'profile' => $userData['profile'],
                    'socialLinks' => $userData['socialLinks'],
                ]);
                exit;
            }
            with('success', 'Cập nhật profile thành công!');
            $userData = $this->userService->getUserProfile($userId);
            render('index', [
                'template' => '/MyCV/profile',
                'profile' => $userData['profile'],
                'socialLinks' => $userData['socialLinks']
            ]);
            exit;
        }
        render('index', ['template' => '/mycv/profile']);
    }



}