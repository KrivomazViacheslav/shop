<?php
class Route
{
    public static function run()
    {
        $models_dir = 'models/';
        $controllers_dir = 'controllers/';
        $uri = parse_url($_SERVER['REQUEST_URI']);
        $uri_array = array(
            '/' => 'Main',
            'catalog' => 'Catalog',
        );

        if ($uri['path']) {
            $path = $uri_array[$uri['path']];
            if (file_exists($controllers_dir . $path . '.php')) {
                require $controllers_dir . $path . '.php';
                $controller = new $path();
                if (method_exists($controller, 'fetch')) {
                    print $controller->fetch();
                } else {
                    Route::error404();
                }
            } else {
                Route::error404();
            }
        }
    }

    public static function error404()
    {
        echo 'error 404';
    }
}