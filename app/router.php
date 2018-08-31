<?php
use FastRoute\RouteCollector;



$dispatcher = FastRoute\simpleDispatcher(function (RouteCollector $r) {
    $r->addRoute('GET', '/', 'App\Controller\HomeController');
    $r->addRoute('GET', '/blog', ['App\Controller\BlogController', 'index']);
    $r->addRoute('GET', '/blog/', ['App\Controller\BlogController', 'index']);
    $r->addRoute('GET', '/blog/{id}', ['App\Controller\BlogController', 'view']);
});

$route = $dispatcher->dispatch($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI']);
dump($route);
switch ($route[0]) {
    case FastRoute\Dispatcher::NOT_FOUND: // 0
        throw new Exception('404 Not Found');
        break;
    case FastRoute\Dispatcher::METHOD_NOT_ALLOWED: // 2
        throw new Exception('405 Method Not Allowed');
        break;
    case FastRoute\Dispatcher::FOUND: // 1
        $controller = $route[1];
        $parameters = $route[2];
        // We could do $container->get($controller) but $container->call()
        // does that automatically
        //$container->call([App\Controller\HomeController::class, 'index']);
        //$container->call([Test::class, 'test']);
        //$container->call($controller, $parameters);
        break;
}



dump(Test::class);
dump(App\Controller\HomeController::class);
class Test{
    public function test(){
        dump('ok');
    }
}