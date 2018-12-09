<?php
/**
 * Created by PhpStorm.
 * User: kayn23
 * Date: 07.12.2018
 * Time: 15:21
 */
include_once '../m/function.php';
class C_Controller
{
    protected $var;
    protected $page;

    public function __construct()
    {
    }

    public function Request($action)
    {
        $this->$action();   //$this->action_index
        $this->template();
    }

    protected function template() {
        $loader = new Twig_Loader_Filesystem('../v');
        $twig = new Twig_Environment($loader);
        echo $twig->render($this->page, $this->var);
    }
    public function __call($name, $params){
        die('Не пишите фигню в url-адресе!!! '.$name);
    }
}