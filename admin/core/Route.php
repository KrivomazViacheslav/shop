<?php
class Route
{
    public static function run()
    {
        $controllers_dir = 'controllers/';
        $uri = parse_url($_SERVER['REQUEST_URI']);
        $uri_array = array(
            '/admin/'          => 'MainAdmin',
            '/admin/products/' => 'CatalogAdmin',
            '/admin/product/'  => 'ProductAdmin',
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