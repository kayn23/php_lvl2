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
    }

    function action_index() {

    }
}