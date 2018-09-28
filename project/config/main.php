<?php
return [
  'ds' => DIRECTORY_SEPARATOR,
  'rootDir' => __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR,
  'templatesDir' => __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR,
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
    'templateRenderer' => [
      'class' => \app\services\TemplateRenderer::class
    ],
    'renderer' => [
      'class' => \app\services\Renderer::class,
      'use' => \app\services\TemplateRenderer::class
    ]
  ]
];