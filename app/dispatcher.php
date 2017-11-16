<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 11/10/17
 * Time: 17:20
 */


$dispatcher = FastRoute\simpleDispatcher(function(FastRoute\RouteCollector $r) {
    $r->addRoute('GET', '/', 'Home/index');
    $r->addRoute('POST', '/login', 'LogIn/logIn');
    $r->addRoute('GET', '/logout', 'LogIn/logOut');
    $r->addRoute('GET', '/session', 'LogIn/session');
    $r->addRoute('GET', '/projets', 'Projects/index');
    $r->addRoute('GET', '/monCompte', 'Giver/index');
    $r->addRoute('POST', '/inscription', 'Signin/index');
    $r->addRoute('GET', '/tag/{tag}', 'sortByTag/index');
    $r->addRoute('GET', '/espace-porteur', 'ProjectHolderSpace/index');
    $r->addRoute(['POST', 'GET'], '/depot', 'Deposit/index');
    $r->addRoute(['POST', 'GET'], '/depot/form1', 'Deposit/form1');
    $r->addRoute(['POST', 'GET'], '/depot/form2', 'Deposit/form2');
    $r->addRoute(['POST', 'GET'], '/depot/form3', 'Deposit/form3');
    $r->addRoute(['POST', 'GET'], '/depot/form4', 'Deposit/form4');
    $r->addRoute(['POST', 'GET'], '/depot/form5', 'Deposit/form5');
    $r->addRoute('GET', '/depot/publication', 'Deposit/publish');
    $r->addRoute(['POST','GET'], '/projets/{id}/{titleReplace}', 'showOneProject/index');

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
    case FastRoute\Dispatcher::NOT_FOUND:
        // ... 404 Not Found
        break;
    case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        $allowedMethods = $routeInfo[1];
        // ... 405 Method Not Allowed
        break;
    case FastRoute\Dispatcher::FOUND:
        $handler = $routeInfo[1];
        $vars = $routeInfo[2];
        list($class, $method) = explode("/", $handler, 2);
        $class = APP_CONTROLLER_NAMESPACE . $class;
        echo call_user_func_array(array(new $class, $method), $vars);
        break;
}
