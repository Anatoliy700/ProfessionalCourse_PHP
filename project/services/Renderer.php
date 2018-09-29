<?php

namespace app\services;


use app\base\App;
use app\interfaces\IRenderer;

class Renderer implements IRenderer
{
  private $layout = 'main';
  private $renderer;
  
  /**
   * Renderer constructor.
   * @param $renderer []
   */
  public function __construct($renderer) {
    $this->renderer = new $renderer;
  }
  
  public function render($template, $params = [], $layout = true) {
    if ($layout) {
      if (isset($params['menu'])) {
        $menu = (include App::call()->config['templatesDir'] . 'menu.php')[$params['menu']];
      } else {
        $menu = (include App::call()->config['templatesDir'] . 'menu.php')['noAuth'];
      }
      $content = $this->renderTemplate($template, $params);
      return $this->renderTemplate("layouts/{$this->layout}", ['content' => $content, 'menu' => $menu]);
    }
    return $this->renderTemplate($template, $params);
  }
  
  public function renderTemplate($template, $params = []) {
    return $this->renderer->render($template, $params);
  }
}