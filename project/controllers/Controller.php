<?php

namespace app\controllers;


use app\base\App;
use app\interfaces\IRenderer;
use app\services\exception\ControllerException;
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
  
  protected function isAuth() {
    return App::call()->authorization->isAuth();
  }
  
  public function run($action = null) {
    $this->action = $action ?: $this->defaultAction;
    $method = "action" . ucfirst($this->action);
    if (method_exists($this, $method)) {
      $this->$method();
    } else {
      throw new ControllerException('Запрашиваемая страница не найдена');
    }
  }
  
  public function render($template, $params = []) {
    
    $params['menu'] = $this->isAuth() ? 'auth' : 'noAuth';
    return $this->renderer->render($template, $params, $this->useLayout);
  }
}