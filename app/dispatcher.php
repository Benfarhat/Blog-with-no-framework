<?php
use FastRoute\RouteCollector;
use Symfony\Component\Yaml\Yaml;
use Symfony\Component\Yaml\Exception\ParseException;


$dispatcher = FastRoute\simpleDispatcher(function (RouteCollector $router) {

    try {
        $routes = Yaml::parseFile('../config/route.yaml');
    } catch (ParseException $exception) {
        printf('Unable to parse the YAML string: %s', $exception->getMessage());
    }

    foreach($routes as $route){ 
        // $router->addRoute($method, $routePattern, $handler);
        $router->addRoute($route["method"], $route["path"], [$route["controller"],$route["action"]]);
    }
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
        if (!is_array($handler)) {
            $handler = [
                "\\" . $routeInfo[1],
                'index'
            ];
        }
        $vars = $routeInfo[2] == '' ? 'index' : $routeInfo[2];

        try {
            $container->call($handler, $vars);
        } catch (MyException $e) {
            throw new Exception($e->getMessage());
        }
        break;
}