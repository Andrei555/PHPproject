<?php

use Library\Request;
use Library\Controller;
use Library\Config;
use Library\Session;
use Library\Container;
use Library\RepositoryManager;
use Library\Router;


define ('DS', DIRECTORY_SEPARATOR);
define ('ROOT', __DIR__ . DS . '..' . DS);
define ('VIEW_DIR', ROOT . 'View' . DS);
define ('LIB_DIR', ROOT . 'Library' . DS);
define('CONFIG_DIR', ROOT . 'Config' . DS);


spl_autoload_register(function($className){

    $file = ROOT . str_replace('\\', DS, $className) . '.php';

    if(!file_exists($file)){
        throw new \Exception("{$file} not found", 500);
    }

    require $file;
});

try{
    Session::start();

    $config = new Config();
    $request = new Request();

    $dsn = 'mysql: host=' . $config->dbhost . '; dbname=' . $config->dbname;
    $pdo = new \PDO($dsn, $config->dbuser, $config->dbpass);
    $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
    $repositoryManager = (new RepositoryManager())->setPDO($pdo);

    $router = new Router(CONFIG_DIR . 'routes.php');

    $container = new Container();
    $container->set('config', $config);
    $container->set('database_connection', $pdo);
    $container->set('repository_manager', $repositoryManager);
    $container->set('router', $router);


    $router->match($request);
    $route = $router->getCurrentRoute();

    $controller = 'Controller\\' . $route->controller . 'Controller';
    $action = $route->action . 'Action';
    $controller = new $controller();

    $controller->setContainer($container);

    if(!method_exists($controller, $action)){
        throw new \Exception('Page not found', 404);
    }

    $content = $controller->$action($request);

}catch(\Exception $e){
    $content = Controller::renderError($e->getMessage(), $e->getCode());
}

echo $content;
//require VIEW_DIR . 'default_layout.phtml';
