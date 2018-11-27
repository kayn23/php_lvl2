<?
abstract class Product 
{
  protected $price;
  public function __construct($price)
  {
    $this->price = $price;
  }
  abstract public function getPrice();
}

class digitalProduct extends Product
{
  public function getPrice() {
    return ($this->price / 2);
  }
}

class oneProduct extends Product
{
  public function getPrice()
  {
    return $this->price;
  }
}

class wholesaleProduct extends Product
{
  private $amount;
  public function setAmount($amount)
  {
    $this->amount = $amount;
  }
  public function getPrice()
  {
    return $this->price * $this->amount;
  }
}

$pd = new wholesaleProduct(300);
$pd->setAmount(1.5);
echo $pd->getPrice();

