<div class="wrap-reg">
  <h2>Регистрация нового пользователя</h2>
  <p><?= $message ?></p>
  <form action="/registration/add" method="post">
    <input type="hidden" name="reg" value="1">
    <input type="text" name="first-name" placeholder="Ваше Имя" required pattern="[A-Za-zА-Яа-яЁё]{3,}">
    <input type="text" name="last-name" placeholder="Ваша Фамилия" required pattern="[A-Za-zА-Яа-яЁё]{3,}">
    <input type="text" name="login" placeholder="Ваш login" required pattern="[A-Za-z][A-Za-z_\-\d]{2,}">
    <input type="password" name="pass" placeholder="Ваш пароль" required pattern="[A-Za-z_\-\d]{3,}">
    <input type="submit" value="Зарегистрироваться">
  </form>
</div>