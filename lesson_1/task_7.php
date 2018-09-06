<?php

class A
{
  public function foo() {
    static $x = 0;
    echo ++$x;
  }
}

class B extends A
{
}

$a1 = new A;  // при объявлении экземпяра класса если нет необходимости передавать параметры в конструктор,
              // то можно использовать синтаксис без скобок
$b1 = new B;
$a1->foo();
$b1->foo();
$a1->foo();
$b1->foo();