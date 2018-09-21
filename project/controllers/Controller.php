<?php

namespace app\controllers;


use app\interfaces\IRenderer;

abstract class Controller
{
  private $action;
  private $defaultAction = 'index';
  protected $layout = 'twig_main.html';
  protected $useLayout = true;
  private $renderer;
  
  /**
   * Controller constructor.
   * @param $renderer
   */
  public function __construct(\Twig_Environment $renderer) {
    $this->renderer = $renderer;
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
//      $content = $this->renderTemplate($template, $params);
//      return $this->renderTemplate("layouts/{$this->layout}", ['content' => $content]);
      $params["template"] = $template;
      return $this->renderTemplate("@layouts/{$this->layout}", $params);
    }
    return $this->renderTemplate($template, $params);
  }
  
  
  public function renderTemplate($template, $params = []) {
    return $this->renderer->render($template, $params);
  }
}