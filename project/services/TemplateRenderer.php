<?php
/**
 * Created by PhpStorm.
 * User: Anatoliy
 * Date: 21.09.2018
 * Time: 16:30
 */

namespace app\services;


use app\interfaces\IRenderer;

class TemplateRenderer implements IRenderer
{
  public function render($template, $params = []) {
    ob_start();
    extract($params);
    $templatePath = TEMPLATES_DIR . $template . ".php";
    include $templatePath;
    return ob_get_clean();
  }
}