<?php
require_once __DIR__ . '/../services/JwtService.php';

function authenticate()
{
    $headers = getallheaders();

    if (!isset($headers['Authorization'])) {
        http_response_code(401);
        echo json_encode(['message' => 'Unauthorized']);
        exit;
    }

    $token = str_replace('Bearer ', '', $headers['Authorization']);
    $jwtService = new JwtService();
    $decoded = $jwtService->verifyToken($token);

    if (!$decoded) {
        http_response_code(401);
        echo json_encode(['message' => 'Invalid token']);
        exit;
    }

    return $decoded['data'];
}
