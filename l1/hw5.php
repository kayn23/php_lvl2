<?
class A {
  public function foo() {
      static $x = 0;
      echo ++$x;
  }
}
$a1 = new A();
$a2 = new A();
$a1->foo();
$a2->foo();
$a1->foo();
$a2->foo();

/*
В данном случае у класса общее статическое поле, поэтому результат 1234
*/