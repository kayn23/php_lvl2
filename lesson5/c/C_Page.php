<?php
/**
 * Created by PhpStorm.
 * User: kayn23
 * Date: 07.12.2018
 * Time: 15:28
 */

class C_Page extends C_Controller
{
    public function action_index() {
        $this->page = 'main.twig';
        $this->var = [
            'title' => 'Главная',
            'user' => (isset($_COOKIE['user']))?($_COOKIE['user']):"anonimus"
        ];
    }

    public function action_autorization() {
        $user = new User();
        $name = (isset($_POST['name']))?validation($_POST['name']):'';
        $pass = (isset($_POST['pass']))?validation($_POST['pass']):'';
        $method = (isset($_POST['action']))?$_POST['action']:"login";
        if ($method == 'login') {
            $user->autorization($name, $pass);
        } else {
            $user->registration($name,$pass);
        }
        header('location: http://localhost/php2/lesson5/public/index.php');
    }

    public function action_logout() {
        $user = new User();
        $user->logout();
        header('location: http://localhost/php2/lesson5/public/index.php');
    }

}