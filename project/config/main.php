<?php
define('DS', DIRECTORY_SEPARATOR);
return [
  'rootDir' => __DIR__ . DS . '..' . DS,
  'templatesDir' => __DIR__ . DS . '..' . DS . 'views' . DS,
  'defaultController' => 'product',
  'controllersNamespace' => 'app\controllers',
  'components' => [
    'db' => [
      'class' => \app\services\Db::class,
      'driver' => 'mysql',
      'host' => 'localhost',
      'login' => 'root',
      'password' => '',
      'database' => 'project_php_2',
      'charset' => 'utf8'
    ],
    'request' => [
      'class' => \app\services\Request::class
    ],
    'renderer' => [
      'class' => \app\services\Renderer::class,
      'use' => \app\services\TemplateRenderer::class
    ],
    'session' => [
      'class' => \app\services\Session::class
    ],
    'authorization' => [
      'class' => \app\models\Authorization::class
    ]
  ]
];