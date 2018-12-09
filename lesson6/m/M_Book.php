<?php
/**
 * Created by PhpStorm.
 * User: kayn23
 * Date: 09.12.2018
 * Time: 15:42
 */

class M_Book
{
    //todo Добавить пагнинацию
    public function getAllBooks(){
        return DB::select('products');
    }
}