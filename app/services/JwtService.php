<?php
namespace App\Services;

require_once __DIR__ . '/../../vendor/autoload.php';

use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Exception;

class JwtService
{
    private $secret;
    private $algorithm;
    private $expiration;

    public function __construct()
    {
        $config = include __DIR__ . '/../../config/config.php';
        $this->secret = $config['jwt_secret'];
        $this->algorithm = $config['jwt_algorithm'];
        $this->expiration = $config['jwt_expiration'];
    }

    public function generateToken($userData)
    {
        $payload = [
            'iss' => "dtsnova.online",
            'iat' => time(),
            'exp' => time() + $this->expiration,
            'data' => [
                'id' => $userData['user_id'],
                'email' => $userData['email'],

            ]
        ];

        return JWT::encode($payload, $this->secret, $this->algorithm);
    }

    public function verifyToken($token)
    {
        try {
            $decoded = JWT::decode($token, new Key($this->secret, $this->algorithm));
            return ["success" => true, "data" => $decoded];
        } catch (Exception $e) {
            return ["success" => false, "errors" => "Token không hợp lệ"];
        }
    }

    public function getUserIdFromToken($token)
    {
        if (!$token || !is_string(value: $token)) {
            return null; // Trả về null nếu token không hợp lệ
        }
        try {
            $decoded = JWT::decode($token, new Key($this->secret, $this->algorithm));
            return $decoded->data->id ?? null;
        } catch (\Throwable $e) {
            return null;
        }
    }

    public function getTokenFromRequest()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        if (isset($_SESSION['token']) && !empty($_SESSION['token'])) {
            return $_SESSION['token'];
        }
        return null;
    }
    public function getUserId()
    {
        $token = $this->getTokenFromRequest();
        return $token ? $this->getUserIdFromToken($token) : null;
    }

    public function isTokenExpired($token)
    {
        if (!$token || !is_string($token)) {
            return true;
        }
        try {
            $decoded = JWT::decode($token, new Key($this->secret, $this->algorithm));
            $expiration = $decoded->exp;
            $timeLeft = $expiration - time();
            return $timeLeft <= 300;
        } catch (Exception $e) {
            return true;
        }
    }
    public function refreshToken($token)
    {
        if (!$token || !is_string($token)) {
            return ["success" => false, "errors" => "Token không hợp lệ"];
        }

        try {
            $decoded = JWT::decode($token, new Key($this->secret, $this->algorithm));
            $userData = [
                'user_id' => $decoded->data->id ?? null,
                'email' => $decoded->data->email ?? null
            ];
            return ["success" => true, "token" => $this->generateToken($userData)];
        } catch (Exception $e) {
            return ["success" => false, "errors" => "Không thể làm mới token: " . $e->getMessage()];
        }
    }

    public function checkAndRefreshToken()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        $token = $this->getTokenFromRequest();
        if ($this->isTokenExpired($token)) {
            $refreshResult = $this->refreshToken($token);
            if ($refreshResult['success']) {
                $_SESSION['token'] = $refreshResult['token'];
                return ["success" => true, "token" => $refreshResult['token']];
            }
            return $refreshResult;
        }
        return ["success" => true, "message" => "Token vẫn hợp lệ"];
    }

    public function logout()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        if (isset($_SESSION['token'])) {
            unset($_SESSION['token']);
        }
        session_destroy();

        return ["success" => true, "message" => "Đăng xuất thành công"];
    }


}
