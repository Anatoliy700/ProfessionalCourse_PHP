<?php

namespace app\controllers;


use app\interfaces\IRenderer;
use app\services\Request;

abstract class Controller
{
  private $action;
  private $defaultAction = 'index';
  protected $layout = 'main';
  protected $useLayout = true;
  private $renderer;
  protected $request;
  
  /**
   * Controller constructor.
   * @param IRenderer $renderer
   * @param Request $request
   */
  public function __construct(IRenderer $renderer, Request $request) {
    $this->renderer = $renderer;
    $this->request = $request;
  }
  
  
  public function run($action = null) {
    $this->action = $action ?: $this->defaultAction;
    $method = "action" . ucfirst($this->action);
    if (method_exists($this, $method)) {
      $this->$method();
    } else {
      echo "404";
    }
  }
  
  public function render($template, $params = []) {
    if ($this->useLayout) {
      $content = $this->renderTemplate($template, $params);
      return $this->renderTemplate("layouts/{$this->layout}", ['content' => $content]);
    }
    return $this->renderTemplate($template, $params);
  }
  
  
  public function renderTemplate($template, $params = []) {
    return $this->renderer->render($template, $params);
  }
}