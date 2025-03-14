<?php

namespace Custom;

class ErrorController
{
    /**
     * Hiển thị lỗi 404 - Không tìm thấy.
     */
    public static function notFound()
    {
        http_response_code(404);
        echo "404 Not Found. The page you are looking for does not exist.";
    }

    /**
     * Hiển thị lỗi 401 - Không được phép truy cập.
     */
    public static function unauthorized()
    {
        http_response_code(401);
        echo "401 Unauthorized. You do not have permission to access this resource.";
    }
}
