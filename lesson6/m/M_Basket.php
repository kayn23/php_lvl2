<?php
/**
 * Created by PhpStorm.
 * User: kayn23
 * Date: 10.12.2018
 * Time: 10:57
 */

class M_Basket
{
    private function createBasket($user_id) {
        $order_id = DB::select('orders',['id'],"user_id='$user_id'",true)['id'];
        return $order_id;
    }

    public function getBasketId($user_id) {
        $basket = DB::select('orders',[],"user_id='$user_id' AND status='0'",true);

        if (gettype($basket) != 'array') {
            return $this->createBasket($user_id);
        }
        return $basket['id'];
    }

}