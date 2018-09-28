<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/../vendor/autoload.php';
$config = include $_SERVER['DOCUMENT_ROOT'] . '/../config/main.php';
\app\base\App::call()->run($config);