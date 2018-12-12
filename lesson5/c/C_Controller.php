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
    protected $twig;

    public function __construct($twig)
    {
        $this->twig = $twig;
    }

    public function Request($action)
    {
        $this->$action();   //$this->action_index
        $this->template();
    }

    protected function template() {
        echo $this->twig->render($this->page, $this->var);
    }
    public function __call($name, $params){
        die('Не пишите фигню в url-адресе!!! '.$name);
    }
}