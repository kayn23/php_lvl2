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
        } elseif (isset($_COOKIE['basket_id']) and ($_COOKIE['basket_id'] != $basket['id'])) {
            DB::update('basket',['order_id'=>$basket['id']],'order_id='.$basket['id']);
            DB::delete('orders','id='.$_COOKIE['basket_id']);
        }
        return $basket['id'];
    }

}