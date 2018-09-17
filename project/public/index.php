<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/../config/main.php';
include_once ROOT_DIR . 'services/Autoloader.php';
spl_autoload_register([(new app\services\Autoloader()), 'loadClass']);

session_start();

$controllerName = $_GET['c'] ?: DEFAULT_CONTROLLER;
$action = $_GET['a'];

$controllerClass = CONTROLLERS_NAMESPACE . "\\" . ucfirst($controllerName) . "Controller";

if (class_exists($controllerClass)) {
  $controller = new $controllerClass;
  $controller->run($action);
}


//$user = new app\models\User('first','last', 'log2', '1111');
//$user = \app\models\User::getOne(64);
//$user->last_name = 'new last';
//var_dump($user->first_name = 111);
//var_dump($user->updateProp);
//$user->save();

//var_dump(\app\models\Product::getOne(5));