<?php
use FastRoute\RouteCollector;
use Symfony\Component\Yaml\Yaml;
use Symfony\Component\Yaml\Exception\ParseException;

try {
    $value = Yaml::parseFile('../config/route.yaml');
} catch (ParseException $exception) {
    printf('Unable to parse the YAML string: %s', $exception->getMessage());
}
dump($value);

$route =    [
                ['GET', '/', ['App\Controller\HomeController','homepage']],
                ['GET', '/blog', ['App\Controller\BlogController', 'index']],
                ['GET', '/blog/', ['App\Controller\BlogController', 'index']],
                [['GET', 'POST'], '/blog/{id:\d+}', ['App\Controller\BlogController', 'view']],
                [ '/admin' => 
                    [
                        ['GET', '/articles', ['App\Controller\BlogController', 'admin_index']],
                        ['GET', '/categories', ['App\Controller\CategoryController', 'admin_index']],
                        ['GET', '/comments', ['App\Controller\CommentController', 'admin_index']]
                    ]
                ]
            ];
dump($route);

$dispatcher = FastRoute\simpleDispatcher(function (RouteCollector $router) {

    // $router->addRoute($method, $routePattern, $handler);

    $router->addRoute('GET', '/', ['App\Controller\HomeController','homepage']);
    $router->addRoute('GET', '/blog', ['App\Controller\BlogController', 'index']);
    $router->addRoute('GET', '/blog/', ['App\Controller\BlogController', 'index']);
    $router->addRoute(['GET', 'POST'], '/blog/{id:\d+}', ['App\Controller\BlogController', 'view']);

    $router->addGroup('/admin', function (RouteCollector $router) {

        $router->addRoute('GET', '/articles', ['App\Controller\BlogController', 'admin_index']);
        $router->addRoute('GET', '/categories', ['App\Controller\CategoryController', 'admin_index']);
        $router->addRoute('GET', '/comments', ['App\Controller\CommentController', 'admin_index']);

    });

});



