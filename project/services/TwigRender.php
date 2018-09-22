<?php

namespace app\services;


use app\interfaces\IRenderer;

class TwigRender implements IRenderer
{
  protected $templater;
  
  /**
   * TwigRender constructor.
   */
  public function __construct() {
    $loader = new \Twig_Loader_Filesystem(TEMPLATES_DIR . 'twig');
    $loader->addPath(TEMPLATES_DIR . 'layouts/twig', 'layouts');
    $this->templater = new \Twig_Environment($loader);
    
  }
  
  public function render($template, $params = []) {
    if (isset($params['content'])) {
      $template = '@' . $template;
    }
    $template .= '.twig';
    return $this->templater->render($template, $params);
  }
  
}