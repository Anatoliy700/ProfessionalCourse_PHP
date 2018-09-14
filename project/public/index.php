<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/../config/main.php';
include_once ROOT_DIR . 'services/Autoloader.php';
spl_autoload_register([(new app\services\Autoloader()), 'loadClass']);

use app\models\Car;
use app\models\Category;
use app\models\Order;
use app\models\Product;
use app\models\User;


$order = new Order();
$car = new Car();
$category = new Category;
$product = new Product();
$user = new User();
