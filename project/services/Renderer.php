<?php

namespace app\services;


use app\interfaces\IRenderer;

class Renderer implements IRenderer
{
  private $layout = 'main';
  private $renderer;
  
  /**
   * Renderer constructor.
   * @param $renderer
   */
  public function __construct(IRenderer $renderer) {
    $this->renderer = $renderer;
  }
  
  public function render($template, $params = [], $layout = true) {
    if ($layout) {
      $content = $this->renderTemplate($template, $params);
      return $this->renderTemplate("layouts/{$this->layout}", ['content' => $content]);
    }
    return $this->renderTemplate($template, $params);
  }
  
  public function renderTemplate($template, $params = []) {
    return $this->renderer->render($template, $params);
  }
}