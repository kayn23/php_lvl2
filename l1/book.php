<?
class Book {
  private $id;
  private $name;
  private $autor;
  private $description;
  private $number_page;
  private $price;

  public function __construct($id)
  {
    $book = $this->getBook($id);
    // присвоить все значения
    // -body
  }

  public function setPrice(){}
  public function setName(){}
  public function setDescription(){}
  public function getId(){}
  public function getName(){}
  public function getAutor(){}
  public function getDescription(){}
  public function getNumberPage(){}
  public function getPrice(){}
  
  public function getBook($id){
    //запрос на получение данных из бд
  }
}