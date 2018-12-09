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
    public function getAllBooks()
    {
        return DB::select('products');
    }

    public function getOne($id) {
        return DB::select('products',[],"id=$id",true);
    }


    public function create($post,$file)
    {
        $book['name'] = (isset($post['name']))?validation($post['name']):false;
        $book['price'] = (isset($post['price']))?validation($post['price']):false;
        $book['description'] = (isset($post['desc']))?validation($post['description']):false;
        $book['author'] = (isset($post['author']))?validation($post['author']):false;
        $book['img'] = 'img/load/' . translit($book['name']) . '.jpg';
        $path = (isset($file['photo']['tmp_name']))?$file['photo']['tmp_name']:false;
        if (!$path || $this->checkData($book)) {
            return false;
        }

        if (DB::insert('products', $book) == 1) {
            min_img($path, $book['img']);
            return true;
        } else {
            return false;
        }
    }

    public function delete($id){
        return DB::delete('products',"id=$id");
    }
    private function checkData($data = []) {
        foreach ($data as $item) {
            if (!$item) {
                return false;
            }
        }
        return true;
    }


}