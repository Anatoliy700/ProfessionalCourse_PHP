<?php

use \app\services\exception\ControllerException;

include_once $_SERVER['DOCUMENT_ROOT'] . '/../config/main.php';
require_once ROOT_DIR . '/vendor/autoload.php';
//include_once ROOT_DIR . 'services/Autoloader.php';
//spl_autoload_register([(new app\services\Autoloader()), 'loadClass']);

session_start();

$request = new \app\services\Request();
$renderer = new \app\services\Renderer(new \app\services\TemplateRenderer());

$controllerName = $request->getControllerName() ?: DEFAULT_CONTROLLER;
$action = $request->getActionName();

$controllerClass = CONTROLLERS_NAMESPACE . "\\" . ucfirst($controllerName) . "Controller";
try {
  if (class_exists($controllerClass)) {
    $controller = new $controllerClass($renderer, $request);
    $controller->run($action);
  } else {
    throw new ControllerException('Запрашивемая страница не найдена');
  }
} catch (ControllerException $e) {
  echo $renderer->render('404', ['message' => $e->getMessage()]);
} catch (Exception | Error $e){
  echo $renderer->render('404', ['Произошла ошибка']);
  //отправляем данные ошибки на почту
}