<?php

namespace Custom;

use Custom\ErrorController;

class Routes
{
    protected $routes = [];

    /**
     * Đăng ký một route mới.
     */
    public function registerRoute($method, $uri, $action, $authRequired = false)
    {
        if (!is_array($action) || count($action) !== 2 || !is_string($action[0]) || !is_string($action[1])) {
            throw new \InvalidArgumentException("Action phải là mảng dạng [Controller::class, 'method'].");
        }

        $this->routes[] = [
            'method' => strtoupper($method),
            'uri' => $uri,
            'controller' => $action[0],
            'controllerMethod' => $action[1],
            'authRequired' => $authRequired,
        ];
    }

    // Định nghĩa các phương thức cụ thể cho GET, POST, PUT, DELETE
    public function get($uri, $action, $authRequired = false)
    {
        $this->registerRoute('GET', $uri, $action, $authRequired);
    }
 
    public function post($uri, $action, $authRequired = false)
    {
        $this->registerRoute('POST', $uri, $action, $authRequired);
    }

    public function put($uri, $action, $authRequired = false)
    {
        $this->registerRoute('PUT', $uri, $action, $authRequired);
    }

    public function delete($uri, $action, $authRequired = false)
    {
        $this->registerRoute('DELETE', $uri, $action, $authRequired);
    }

    /**
     * Xử lý routing.
     */
    public function route($uri)
    {
        $requestMethod = $_SERVER['REQUEST_METHOD'];
        if ($requestMethod === 'POST' && isset($_POST['_method'])) {
            $requestMethod = strtoupper($_POST['_method']);
        }

        foreach ($this->routes as $route) {
            $uriSegments = explode('/', trim($uri, '/'));
            $routeSegments = explode('/', trim($route['uri'], '/'));

            if ($this->matchRoute($routeSegments, $uriSegments, $route['method'], $requestMethod)) {
                $params = $this->extractParams($routeSegments, $uriSegments);

                // Kiểm tra yêu cầu quyền truy cập
                if ($route['authRequired'] && !$this->checkAuthorization()) {
                    with('error', 'Vui lòng đăng nhập!');
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
    private function matchRoute($routeSegments, $uriSegments, $routeMethod, $requestMethod)
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
    private function extractParams($routeSegments, $uriSegments)
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
    private function checkAuthorization()
    {
        // Kiểm tra người dùng đã đăng nhập
        if (!isset($_SESSION['user'])) {
            return false;
        }

        // Có thể bổ sung kiểm tra quyền tại đây (vd: role-based authorization)
        return true;
    }
}
