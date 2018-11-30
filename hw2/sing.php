<?
/**
 * 
 */
trait singlton
{
  protected static $_instance;
  private function __construct() {}
  public static function getInstance() {
    if (self::$_instance === null) {
      self::$_instance = new self;
    }
    return self::$_instance;
  }
  private function __clone() {}
  private function __wakeup(){}
}

class Example {
  use singlton;

  public function getAt(){
    echo "hello";
  }
}


Example::getInstance()->getAt();