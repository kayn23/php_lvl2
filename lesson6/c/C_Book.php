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

    public function __construct()
    {
        $this->book = new Book();
    }

    public function action_index(){
        $this->page = 'main.twig';
        $this->var = [
            'title' => 'Главная',
            'user' => (isset($_COOKIE['user']))?($_COOKIE['user']):"anonimus",
            'books' => $this->book->getAllBooks()
        ];
    }
}