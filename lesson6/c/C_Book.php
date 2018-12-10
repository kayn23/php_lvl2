<?php
/**
 * Created by PhpStorm.
 * User: kayn23
 * Date: 09.12.2018
 * Time: 17:10
 */

class C_Book extends C_Controller
{
    private $book;
    private $user;
    private $basket;

    public function __construct()
    {
        $this->book = new M_Book();
        $this->basket = new M_Basket();
        $this->var = [
            'title' => 'Главная',
            'user' => (isset($_COOKIE['user'])) ? ($_COOKIE['user']) : "anonimus",
            'userstatus' => (isset($_COOKIE['userstatus'])) ? ($_COOKIE['userstatus']) : "anonimus",
        ];
        if (isset($_COOKIE['user'])) {
            $this->user = new M_User();
            if (!isset($_COOKIE['basket'])) {
                setcookie('basket_id',$this->basket->getBasketId($this->user->id),
                    time() + 3600*24*7*365, '/');
            }
        } else {
            if (!isset($_COOKIE['basket'])) {
                setcookie('basket_id',$this->basket->createBasket('null'),
                    time() + 3600*24*7*365, '/');
            }
        }



    }

    public function action_index()
    {
        $this->page = 'main.twig';
        $this->var['books'] = $this->book->getAllBooks();

    }

    /**
     *  выводит информацию по одной книге
     * @ $_GET['id'] id книги
     */
    public function action_onebook()
    {
        $this->page = 'book_one.twig';
        $this->var['book'] = $this->book->getOne($_GET['id']);
    }

    /**
     *  Страниц для добавления книги
     */
    public function action_addbook()
    {
        $this->page = 'addBook.twig';
    }

    public function action_addedbook()
    {
        if (!empty($_POST)) {
            if ($this->book->create($_POST, $_FILES)) {
                $this->var['action'] = 'Книга добавлена';
            } else {
                $this->var['action'] = 'Ошибка при добавлении книги';
            }
            $this->page = 'book_good.twig';
        }
    }

    //todo настроить удаление только для админа
    public function action_delete() {
        if ($this->book->delete($_GET['id']) == 1) {
            $this->var['action'] = 'Книга удалена';
        } else {
            $this->var['action'] = 'Ошибка при удалении';
        }
        $this->page = 'book_good.twig';
    }
}