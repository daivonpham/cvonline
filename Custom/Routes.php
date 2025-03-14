<?php


namespace Custom;

use Custom\ErrorController;

class Routes
{
    protected static $routes = [];

    /**
     * Đăng ký một route mới.
     */
    private static function registerRoute($method, $uri, $action, $authRequired = false)
    {
        if (!is_array($action) || count($action) !== 2 || !is_string($action[0]) || !is_string($action[1])) {
            throw new \InvalidArgumentException("Action phải là mảng dạng [Controller::class, 'method'].");
        }

        self::$routes[] = [
            'method' => strtoupper($method),
            'uri' => $uri,
            'controller' => $action[0],
            'controllerMethod' => $action[1],
            'authRequired' => $authRequired,
        ];
    }

    /**
     * Định nghĩa phương thức GET.
     */
    public static function get($uri, $action, $authRequired = false)
    {
        self::registerRoute('GET', $uri, $action, $authRequired);
    }

    /**
     * Định nghĩa phương thức POST.
     */
    public static function post($uri, $action, $authRequired = false)
    {
        self::registerRoute('POST', $uri, $action, $authRequired);
    }

    /**
     * Định nghĩa phương thức PUT.
     */
    public static function put($uri, $action, $authRequired = false)
    {
        self::registerRoute('PUT', $uri, $action, $authRequired);
    }

    /**
     * Định nghĩa phương thức DELETE.
     */
    public static function delete($uri, $action, $authRequired = false)
    {
        self::registerRoute('DELETE', $uri, $action, $authRequired);
    }

    /**
     * Xử lý routing.
     */
    public static function route($uri)
    {
        $requestMethod = $_SERVER['REQUEST_METHOD'];
        if ($requestMethod === 'POST' && isset($_POST['_method'])) {
            $requestMethod = strtoupper($_POST['_method']);
        }

        foreach (self::$routes as $route) {
            $uriSegments = explode('/', trim($uri, '/'));
            $routeSegments = explode('/', trim($route['uri'], '/'));

            if (self::matchRoute($routeSegments, $uriSegments, $route['method'], $requestMethod)) {
                $params = self::extractParams($routeSegments, $uriSegments);

                // Kiểm tra yêu cầu quyền truy cập
                if ($route['authRequired'] && !self::checkAuthorization()) {
                    with('error', 'Vui lòng đăng nhập!');
                    render('index', [
                        'template' => '/auth/login',
                    ]);
                    return;
                }

                // Gọi Controller
                $controller = $route['controller'];
                $controllerMethod = $route['controllerMethod'];
                (new $controller())->$controllerMethod($params);

                return;
            }
        }

        ErrorController::notFound();
    }

    /**
     * So khớp route và URI hiện tại.
     */
    private static function matchRoute($routeSegments, $uriSegments, $routeMethod, $requestMethod)
    {
        if (count($uriSegments) !== count($routeSegments) || strtoupper($routeMethod) !== strtoupper($requestMethod)) {
            return false;
        }

        foreach ($routeSegments as $index => $segment) {
            if ($segment !== $uriSegments[$index] && !preg_match('/\{.+?\}/', $segment)) {
                return false;
            }
        }

        return true;
    }

    /**
     * Trích xuất tham số từ URI.
     */
    private static function extractParams($routeSegments, $uriSegments)
    {
        $params = [];
        foreach ($routeSegments as $index => $segment) {
            if (preg_match('/\{(.+?)\}/', $segment, $matches)) {
                $params[$matches[1]] = $uriSegments[$index];
            }
        }

        return $params;
    }

    /**
     * Kiểm tra quyền truy cập.
     */
    private static function checkAuthorization()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        if (isset($_SESSION['token']) && !empty($_SESSION['token'])) {
            return true;
        }
        return false;
    }
}
