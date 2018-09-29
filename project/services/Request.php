<?php

namespace app\services;


class Request
{
  private $controllerName;
  private $actionName;
  private $params;
  private $requestMethod;
  private $requestString;
  
  /**
   * Request constructor.
   */
  public function __construct() {
    $this->requestString = $_SERVER['REQUEST_URI'];
    $this->params = $_REQUEST;
    $this->requestMethod = $_SERVER['REQUEST_METHOD'];
    $this->parseRequest();
  }
  
  private function parseRequest() {
    $pattern = "#(?P<controller>\w+)[/]?(?P<action>\w+)?[/]?[?]?(?P<params>.*)#ui";
    if (preg_match_all($pattern, $this->requestString, $matches)) {
      $this->controllerName = $matches['controller'][0];
      $this->actionName = $matches['action'][0];
//      $this->params = $matches['params'][0];
    }
  }
  
  /**
   * @return mixed
   */
  public function getControllerName() {
    return $this->controllerName;
  }
  
  /**
   * @return mixed
   */
  public function getActionName() {
    return $this->actionName;
  }
  
  /**
   * @param null $name
   * @return null
   */
  public function getParams($name = null) {
    if (is_null($name)) {
      return $this->params;
    }
    if (isset($this->params[$name])) {
      return $this->params[$name];
    }
    return null;
  }
  
  public function isPost() {
    return $this->requestMethod == 'POST';
  }
  
  public function isGet() {
    return $this->requestMethod == 'GET';
  }
}