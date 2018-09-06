<?php

class A
{
  public function foo() {
    static $x = 0; //статическая переменная, значение которой сохраняется между вызовами метода
    echo ++$x;
  }
}

$a1 = new A();
$a2 = new A();
$a1->foo(); //выведет 1
$a2->foo(); //выведет 2, так как метод в контексте объектов существует тока один и просходит тока проброс this,
            // то и статическая переменная одна на все объекты
$a1->foo(); //выведет 3
$a2->foo(); //выведет 4