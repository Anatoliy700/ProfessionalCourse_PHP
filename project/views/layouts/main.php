<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="shortcut icon" type="image/png" href="/img/favicon.ico"/>
  <link rel="stylesheet" href="/css/main.css">
  <!--  <script src="/js/vendor/jquery-3.3.1.js"></script>
    <script src="/js/main.js"></script>
  --> <title>PHP_2 Shop</title>
</head>
<body>
<p>
  <a href="/product">Каталог</a>&nbsp;&nbsp;
   <a href="/cart">Корзина</a>&nbsp;&nbsp;
  <!--<a href="/lk">Личный кабинет</a>&nbsp;&nbsp;
  <?php /*if (isAdmin()): */?>
    <?/*= $options['admin']; */?>&nbsp;&nbsp;
  <?php /*endif; */?>
  --><?/*= $options['login'] */?>
</p>
<p></p>
<?= $content ?>
</body>
</html>