<?php
define('DS', DIRECTORY_SEPARATOR);
define('ROOT_DIR', $_SERVER['DOCUMENT_ROOT'] . DS . '..' . DS);
define("TEMPLATES_DIR", ROOT_DIR . "views" . DS);
define("DEFAULT_CONTROLLER", "product");
define("CONTROLLERS_NAMESPACE", "app\\controllers");