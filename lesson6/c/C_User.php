<?php
/**
 * Created by PhpStorm.
 * User: kayn23
 * Date: 07.12.2018
 * Time: 15:28
 */

class C_User extends C_Controller
{
    private $user;
    public function __construct()
    {
        $this->user = new M_User();
    }

    public function action_index() {
        $this->page = 'main.twig';
        $this->var = [
            'title' => 'Главная',
            'user' => (isset($_COOKIE['user']))?($_COOKIE['user']):"anonimus",
            'userstatus' => (isset($_COOKIE['userstatus'])) ? ($_COOKIE['userstatus']) : "anonimus"
        ];
    }

    public function action_autorization() {
        $name = (isset($_POST['name']))?validation($_POST['name']):'';
        $pass = (isset($_POST['pass']))?validation($_POST['pass']):'';
        $email = (isset($_POST['email']))?validation($_POST['email']):'';
        $method = (isset($_POST['action']))?$_POST['action']:"login";
        if ($method == 'login') {
            $this->user->autorization($name, $pass);
        } else {
            $this->user->registration($name,$pass,$email);
        }
        header('location: http://localhost/php2/lesson6/public/index.php');
    }

    public function action_logout() {
        $this->user->logout();
        header('location: http://localhost/php2/lesson6/public/index.php');
    }

    public function action_loginPage() {
        $this->page = 'login_page.twig';
        $this->var = [
            'title' => 'Личный кабинет',
            'user' => (isset($_COOKIE['user']))?($_COOKIE['user']):"anonimus",
            'userstatus' => (isset($_COOKIE['userstatus'])) ? ($_COOKIE['userstatus']) : "anonimus",
            'email' => $this->user->email
        ];
    }
}