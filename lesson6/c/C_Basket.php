<?php
/**
 * Created by PhpStorm.
 * User: kayn23
 * Date: 10.12.2018
 * Time: 10:57
 */

class C_Basket extends C_Controller
{
    private $basket;
    private $id;

    public function __construct()
    {
        $this->basket = new M_Basket();
        $this->page = 'catalog_addStatus.twig';
        $this->var = [
            'title' => 'Каталог',
            'user' => (isset($_COOKIE['user'])) ? ($_COOKIE['user']) : "anonimus",
            'userstatus' => (isset($_COOKIE['userstatus'])) ? ($_COOKIE['userstatus']) : "anonimus",
        ];
    }

    function action_index() {

    }

    public function action_addBasket() {
        $id = validation($_GET['id']); //id книги
        $idOrder = $_COOKIE['order_id']; //id корзины
        $position = DB::select('basket',[],"product_id='$id' and order_id='$idOrder'",true);
        if (gettype($position) == 'array') {
            if (DB::get("UPDATE basket SET amount=amount+1 WHERE id='".$position['id']."'")) {
                $this->var['action'] = 'Товар добавлен в корзину';
            }
        } elseif ($this->basket->addProduct($id,$idOrder)) {
            $this->var['action'] = 'Товар добавлен в корзину';
        } else {
            $this->var['action'] = 'Ошибка при добавлении товара';
        }
        $this->var['book_id'] = $id;
    }

    public function action_showBasket() {
        $this->page = 'basket.twig';
        $this->var['products'] = $this->basket->showBasket();
    }
}