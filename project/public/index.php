<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/../config/main.php';
require_once ROOT_DIR . '/vendor/autoload.php';
//include_once ROOT_DIR . 'services/Autoloader.php';
//spl_autoload_register([(new app\services\Autoloader()), 'loadClass']);

session_start();

$request = new \app\services\Request();

$controllerName = $request->getControllerName() ?: DEFAULT_CONTROLLER;
$action = $request->getActionName();

$controllerClass = CONTROLLERS_NAMESPACE . "\\" . ucfirst($controllerName) . "Controller";

if (class_exists($controllerClass)) {
  $controller = new $controllerClass(new \app\services\TemplateRenderer(), $request);
  $controller->run($action);
}