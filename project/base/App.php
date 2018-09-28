<?php

namespace app\base;


use app\trains\TSingleton;
use \app\services\exception\ControllerException;


class App
{
  use TSingleton;
  
  public $config;
  
  private $components;
  
  public static function call() {
    return static::getInstance();
  }
  
  public function run($config) {
    $this->config = $config;
    $this->components = new Storage();
    try {
      $this->runController();
    } catch (ControllerException $e) {
      echo $this->renderer->render('404', ['message' => $e->getMessage()]);
    } catch (\Exception | \Error $e) {
      echo $this->renderer->render('404', ['message' => 'Произошла ошибка']);
      //отправляем данные ошибки на почту
    }
  }
  
  private function runController() {
    $controllerName = $this->request->getControllerName() ?: $this->config['defaultController'];
    $action = $this->request->getActionName();
    
    $controllerClass = $this->config['controllersNamespace'] . "\\" . ucfirst($controllerName) . "Controller";
    
    if (class_exists($controllerClass)) {
      $controller = new $controllerClass($this->renderer, $this->request);
      $controller->run($action);
    } else {
      throw new ControllerException('Запрашивемая страница не найдена');
    }
  }
  
  public function createComponent($name) {
    if (isset($this->config['components'][$name])) {
      $params = $this->config['components'][$name];
      $class = $params['class'];
      if (class_exists($class)) {
        $reflection = new \ReflectionClass($class);
        unset($params['class']);
        return $reflection->newInstanceArgs($params);
      }
      throw new ControllerException('Не определен класс компонента');
    }
    throw new ControllerException("Компонент {$name} не описан");
  }
  
  public function __get($name) {
    return $this->components->get($name);
  }
}