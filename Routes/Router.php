<?php

namespace Routes;

use Models\AuthModel;

class Router
{
    private $routes;

    public function __construct($routes)
    {
        $this->routes = $routes;
    }

    public function dispatch($action)
        {
            foreach ($this->routes as $route) {

                if ($route['route'] !== $action) {
                    continue;
                }

                // AUTH
                if (empty($route['public'])) {

                    $model = new AuthModel();

                    if (
                        empty($_SESSION['is_logged_in']) ||
                        !$model->cekInfo($_SESSION['user']['id'])
                    ) {
                        header("Location: ?action=login_page");
                        exit;
                    }
                }

                // 2. CEK ROLE (MIDDLEWARE)
                // Pastikan Anda sudah menyimpan peran ke $_SESSION['user']['peran'] saat login
                if (isset($route['role'])) {
                    $userRole = $_SESSION['user']['peran'] ?? '';
                    
                    // Jika peran user tidak cocok dengan role yang diminta router
                    if ($route['role'] !== $userRole) {
                    // $_SESSION['alert'] = [
                    //     'icon' => 'warning',
                    //     'title' => 'TETTOTTT!',
                    //     'text' => 'Mohon maaf anda tidak dapat mengakses halaman ini',
                    //     'timer' => 5000
                    //     ];
                        header("Location: ?action=halaman_teknisi");
                        exit;
                    }
                }

                // API RESPONSE
                if (!empty($route['api'])) {

                    [$class, $method] = $route['controller'];

                    $controller = new $class();
                    $controller->$method();

                    exit;
                }

                // WEB RESPONSE
                require BASE_PATH . '/views/components/header.php';

                // VIEW ONLY
                if (isset($route['view'])) {

                    require BASE_PATH . '/views/pages/' . $route['view'];
                }

                // CONTROLLER
                elseif (isset($route['controller'])) {

                    [$class, $method] = $route['controller'];

                    $controller = new $class();
                    $controller->$method();
                }

                require BASE_PATH . '/views/components/footer.php';

                exit;
            }

            http_response_code(404);
            echo "404 Not Found";
        }
}