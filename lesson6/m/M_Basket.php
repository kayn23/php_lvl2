<?php
/**
 * Created by PhpStorm.
 * User: kayn23
 * Date: 10.12.2018
 * Time: 10:57
 */

class M_Basket
{
    public function createBasket($user_id)
    {
        DB::insert('orders', ['user_id' => $user_id, 'status' => '0']);
        return DB::getPDO()->lastInsertId();
    }

    public function getBasketId($user_id)
    {
        $basket = DB::select('orders', [], "user_id='$user_id' AND status='0'", true);
        if (gettype($basket) != 'array') {
            return $this->createBasket($user_id);
        } elseif (isset($_COOKIE['order_id']) and ($_COOKIE['order_id'] != $basket['id'])) {

            DB::update('basket',['order_id'=>$basket['id']],'order_id='.$_COOKIE['order_id']);
            DB::delete('orders','id='.$_COOKIE['order_id']);
        }
        return $basket['id'];
    }

    public function addProduct($idProduct,$idBasket)
    {
        return DB::insert('basket', [
                        'order_id' => $idBasket,
                        'product_id' => $idProduct,
                        'amount' => 1
                    ]);
    }

    public function showBasket() {
        $id = $_COOKIE['order_id'];
        $products = DB::getRows("SELECT b.id,b.order_id,b.product_id,b.amount,p.price*b.amount as summ,p.name FROM basket as b join products as p where b.order_id='$id' and p.id=b.product_id");
        return $products;
    }
}