<?php
/**
 * Created by PhpStorm.
 * User: Anatoliy
 * Date: 22.09.2018
 * Time: 17:08
 */

namespace app\services;


class Request
{
  private $controllerName;
  private $actionName;
  private $params;
  private $postParams;
  private $requestString;
  
  /**
   * Request constructor.
   */
  public function __construct() {
    $this->requestString = $_SERVER['REQUEST_URI'];
    $this->parseRequest();
    $this->getPost();
  }
  
  private function parseRequest() {
    $pattern = "#(?P<controller>\w+)[/]?(?P<action>\w+)?[/]?[?]?(?P<params>.*)#ui";
    if (preg_match_all($pattern, $this->requestString, $matches)) {
      $this->controllerName = $matches['controller'][0];
      $this->actionName = $matches['action'][0];
      $this->params = $matches['params'][0];
    }
  }
  
  private function getPost() {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $this->postParams = $_POST;
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
   * @return mixed
   */
  public function getParams() {
    parse_str($this->params, $params);
    return $params;
  }
  
  /**
   * @return mixed
   */
  public function getPostParams() {
    return $this->postParams;
  }
}