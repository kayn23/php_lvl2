<?
abstract class Product 
{
  private $price;
  public function __construct($price)
  {
    $this->$price = $price;
  }
  abstract public function getPrice();
}

class digitalProduct extends Product
{
  public function getPrice() {
    return $this->price / 2;
  }
}



