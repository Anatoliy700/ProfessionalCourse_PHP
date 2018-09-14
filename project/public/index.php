<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/../config/main.php';
include_once ROOT_DIR . 'services/Autoloader.php';
spl_autoload_register([(new app\services\Autoloader()), 'loadClass']);

use app\models\Car;
use app\models\Category;
use app\models\Order;
use app\models\Product;
use app\models\User;


//$user = new User();
//$order = new Order();
//$car = new Car();
//$category = new Category;
//$product = new Product();
$userData = [
  'first_name' => 'Сергей',
  'last_name' => 'Смирнов',
  'login' => 'ss10',
  'password' => '4444'
];
$orderData = [
  'id' => 1,
  'user_id' => '2',
  'total_price' => '777'
];
$categoryData = [
  'id' => 6,
//  'parent_id' => 0,
  'title' => 'test4'
];
$productData = [
  'id' => 2,
  'name' => 'test2',
  'description' => ';skdf;l sdfk;lskdf;lksfsjhhgfs shgjfhsgfjhgwhgh4jh gh34jh5g3j54h',
  'price' => 555,
  'producer' => 'qwerty',
  'category_id' => 5
];
//var_dump($user);
//$user->setDb();
//var_dump($user->getOne(1));
//var_dump($user->getAll());
//$user->insertDb($userData);
//$user->updateDd($userData);
//$user->deleteDb(['login' => 'ss10']);
//$order->insertDb($orderData);
//$order->updateDd($orderData);
//$order->deleteDb(['id' => 4]);
//var_dump($order->getAll());
//$category->insertDb($categoryData);
//$category->updateDd($categoryData);
//$category->deleteDb($categoryData);
//var_dump($category->getOne(3));
//$product->insertDb($productData);
//$product->updateDd($productData);
//$product->deleteDb($productData);
//var_dump($product->getOne(1));