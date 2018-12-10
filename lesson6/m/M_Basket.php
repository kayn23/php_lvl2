<?php
/**
 * Created by PhpStorm.
 * User: kayn23
 * Date: 10.12.2018
 * Time: 10:57
 */

//todo слелать изменение изменение количества по ajax
class M_Basket
{
    public function createBasket($user_id)
    {
        DB::insert('orders', ['user_id' => $user_id, 'status' => '0']);
        $order_id = DB::getPDO()->lastInsertId();
        setcookie('order_id', $order_id,
            time() + 3600 * 24 * 7 * 365, '/');
    }

    public function getBasketId($user_id)
    {
        $basket = DB::select('orders', [], "user_id='$user_id' AND status='0'", true);
        if ((gettype($basket) != 'array') and isset($_COOKIE['order_id'])) {
//            dd('точка');
            DB::update('orders',['user_id'=>$user_id],"id='".$_COOKIE['order_id']."'");
            $basket['id']=$_COOKIE['order_id'];
        } elseif (gettype($basket) != 'array') {
            $this->createBasket($user_id);
        } elseif (isset($_COOKIE['order_id']) and ($_COOKIE['order_id'] != $basket['id'])) {

            DB::update('basket', ['order_id' => $basket['id']], 'order_id=' . $_COOKIE['order_id']);
            DB::delete('orders', 'id=' . $_COOKIE['order_id']);
        }
        setcookie('order_id', $basket['id'],
            time() + 3600 * 24 * 7 * 365, '/');
        return $basket['id'];
    }

    public function addProduct($idProduct, $idBasket)
    {
        return DB::insert('basket', [
            'order_id' => $idBasket,
            'product_id' => $idProduct,
            'amount' => 1
        ]);
    }

    /**
     * вывод всех записей из корзины
     * @return array
     */
    public function showBasket()
    {
        $id = $_COOKIE['order_id'];
        $products = DB::getRows("SELECT b.id,b.order_id,b.product_id,b.amount,p.price*b.amount as summ,p.name FROM basket as b join products as p where b.order_id='$id' and p.id=b.product_id");
        return $products;
    }

    /**
     * Удаление позиции из корзины
     * @param $id
     * @param $order_id
     * @return bool
     */
    public function delete($id, $order_id)
    {
        if (DB::delete('basket', "order_id='$order_id' and product_id='$id'") == 1) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * оформление заказа
     * @param $order_id
     * @return bool|false|string
     */
    public function checkout($order_id)
    {
        $date = $this->date();
        $user_id = DB::select('users',[],"name='".$_COOKIE['user']."'",true)['id'];
        if (DB::update('orders',['status'=>'1','created_at'=>$date],"id='$order_id'") == 1) {
            $this->createBasket($user_id);
            return $date;
        } else {
            return false;
        }
    }

    //Админская часть

    /**
     * Возвращает списов оформленных заказов
     * @return array
     */
    public function getOrders() {
        $orders = [];
        $orders['new'] = DB::getRows("SELECT o.id,u.name,u.email,o.created_at FROM orders as o JOIN users as u WHERE o.user_id = u.id AND o.status = 1 ORDER BY o.created_at"); //заказы неподтвержденные
        $orders['progress'] = DB::getRows("SELECT o.id,u.name,u.email,o.accepted_at FROM orders as o JOIN users as u WHERE o.user_id = u.id AND o.status = 2 ORDER BY o.accepted_at"); //заказы подтвержденные
        return $orders;
    }

    public function getOneOrder($order_id)
    {
        $order['user'] = DB::getRows("SELECT u.name,u.email FROM users AS u JOIN orders as o WHERE u.id=o.user_id AND o.id='$order_id'")[0];
        $order['products'] = DB::getRows("SELECT b.id,b.order_id,b.product_id,b.amount,p.price*b.amount as summ,p.name,(SELECT s.status FROM orders as o JOIN status_order as s WHERE o.id=b.order_id and s.id=o.status) as status FROM basket as b join products as p where b.order_id='$order_id' and p.id=b.product_id");
        return $order;
    }

    /**
     * Изменяет статус заказа на 2 - выполняется
     * @param $order_id
     */
    public function acceptOrder($order_id)
    {
        DB::update('orders',['status'=>'2','accepted_at'=>$this->date()],"id='$order_id'");
    }

    /**
     * Изменяет статус заказа на 3 - выполнен
     * @param $order_id
     */
    public function closeOrder($order_id)
    {
        DB::update('orders',['status'=>'3','closed_at'=>$this->date()],"id='$order_id'");
    }

    /**
     * Удаляет заказ
     * @param $order_id
     */
    public function deleteOrder($order_id)
    {
        DB::delete('orders',"id='$order_id'");
    }

    private function date()
    {
        return date('Y-m-d H:i:s');
    }

    public function summa($arr = []) {
        $sum = 0;
        foreach ($arr as $item) {
            $sum += $item['summ'];
        }
        return $sum;
    }
}