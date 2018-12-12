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

    function action_index()
    {

    }

    /**
     * Добавление товара в корзину
     */
    public function action_addBasket()
    {
        $id = validation($_GET['id']); //id книги
        $idOrder = $_COOKIE['order_id']; //id корзины
        $position = DB::select('basket', [], "product_id='$id' and order_id='$idOrder'", true);
        if (gettype($position) == 'array') {
            if (DB::get("UPDATE basket SET amount=amount+1 WHERE id='" . $position['id'] . "'")) {
                $this->var['action'] = 'Товар добавлен в корзину';
            }
        } elseif ($this->basket->addProduct($id, $idOrder)) {
            $this->var['action'] = 'Товар добавлен в корзину';
        } else {
            $this->var['action'] = 'Ошибка при добавлении товара';
        }
        $this->var['book_id'] = $id;
    }

    /**
     * Отображение корзины для пользователя
     */
    public function action_showBasket()
    {
        $this->page = 'basket.twig';
        $this->var['title'] = 'Корзина';
        $this->var['products'] = $this->basket->showBasket();
        $this->var['summa'] = $this->basket->summa($this->var['products']);
    }

    /**
     * Удаление товара из корзины
     */
    public function action_delete()
    {
        $id = validation($_GET['id']);
        $order_id = $_COOKIE['order_id'];
        $this->basket->delete($id, $order_id);
        header('Location: http://localhost/php2/lesson6/public/index.php?c=basket&action=showBasket');
    }

    /**
     * Оформление заказа
     */
    public function action_checkout()
    {
        if (!isset($_COOKIE['user'])) {
            $this->page = 'basket_checkoff.twig';
            $this->var['title'] = 'Авторизация';
        } else {
            $this->page = 'basket_check.twig';
            $order_id = $_COOKIE['order_id'];
            $date = $this->basket->checkout($order_id);
            if ($date !== false) {
                $this->var['basket'] = [
                    'id' => $order_id,
                    'time' => $date
                ];
            }
        }
    }

    //Админская часть

    /**
     * Показать список всех заказов
     */
    public function action_showOrders()
    {
        $this->page = 'admin_order.twig';
        $this->var['title'] = 'Заказы';
        $this->var['orders'] = $this->basket->getOrders();
    }

    /**
     * Отобразить конкретный заказ
     */
    public function action_showOneOrder()
    {
        $order_id = validation($_GET['id']);
        $this->page = 'admin_one_order.twig';
        $order = $this->basket->getOneOrder($order_id);
        $this->var['product'] = $order['products'];
        $this->var['order_user'] = $order['user'];
        $this->var['summa'] = $this->basket->summa($this->var['product']);
    }

    /**
     * Переместить заказ в выполняется
     */
    public function action_acceptOrder()
    {
        $id = validation($_GET['id']);
        $this->basket->acceptOrder($id);
        header('Location: http://localhost/php2/lesson6/public/index.php?c=basket&action=showOrders');
    }

    /**
     * Выполнить заказ
     */
    public function action_closeOrder()
    {
        $id = validation($_GET['id']);
        $this->basket->closeOrder($id);
        header('Location: http://localhost/php2/lesson6/public/index.php?c=basket&action=showOrders');
    }

    /**
     * Удалить заказ
     */
    public function action_deleteOrder()
    {
        $id = validation($_GET['id']);

    }
}