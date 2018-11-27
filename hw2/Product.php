<?
abstract class Product 
{
  private $price;
  public function __construct($price)
  {
    $this->$price = $price;
  }
  abstract public function getFinalPrice() {}
}
