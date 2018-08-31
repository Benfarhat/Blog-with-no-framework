<?php
use FastRoute\RouteCollector;



$dispatcher = FastRoute\simpleDispatcher(function (RouteCollector $router) {
    // $router->addRoute($method, $routePattern, $handler);
    $router->addRoute('GET', '/', 'App\Controller\HomeController');
    $router->addRoute('GET', '/blog', ['App\Controller\BlogController', 'index']);
    $router->addRoute('GET', '/blog/', ['App\Controller\BlogController', 'index']);
    $router->addRoute(['GET', 'POST'], '/blog/{id:\d+}', ['App\Controller\BlogController', 'view']);
    $router->addGroup('/admin', function (RouteCollector $router) {
        $router->addRoute('GET', '/articles', ['App\Controller\BlogController', 'admin_index']);
        $router->addRoute('GET', '/categories', ['App\Controller\CategoryController', 'admin_index']);
        $router->addRoute('GET', '/comments', ['App\Controller\CommentController', 'admin_index']);
    }, [
        'cacheFile' => __DIR__ . '/route.cache', /* required */
        'cacheDisabled' => IS_DEBUG_ENABLED,     /* optional, enabled by default */
    ]);
});

// Fetch method and URI from somewhere
$httpMethod = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];

// Strip query string (?foo=bar) and decode URI
if (false !== $pos = strpos($uri, '?')) {
    $uri = substr($uri, 0, $pos);
}
$uri = rawurldecode($uri);

$routeInfo = $dispatcher->dispatch($httpMethod, $uri);

switch ($routeInfo[0]) {
    case FastRoute\Dispatcher::NOT_FOUND: // 0
        throw new Exception('404 Not Found');
        break;
    case FastRoute\Dispatcher::METHOD_NOT_ALLOWED: // 2
        throw new Exception('405 Method Not Allowed');
        break;
    case FastRoute\Dispatcher::FOUND: // 1
        $handler = $routeInfo[1];
        $vars = $routeInfo[2];
        // We could do $container->get($controller) but $container->call()
        // does that automatically
        try {
            $container->call($handler, $vars);
        } catch (MyException $e) {
            throw new Exception($e->getMessage());
        }

        break;
}


