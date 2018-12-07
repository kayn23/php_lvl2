<?php
/**
 * Created by PhpStorm.
 * User: kayn23
 * Date: 07.12.2018
 * Time: 11:45
 */

class User
{
    public $name;
    public $email;
    public $hobby;
    private $checkUser;
    private $createUser;
    public function __construct()
    {
        include_once 'PDO.php';
        $this->checkUser =  $db->prepare('SELECT * FROM users WHERE name = :name');
        $this->createUser = $db->prepare('INSERT INTO users(name,pass,email) VALUES (:name,:pass,:email)');
        if (isset($_COOKIE['user'])) {
            $user = $this->getInfoUser($_COOKIE['user']);
            $this->name = $user['name'];
            $this->email = $user['email'];
//            $this->hobby = $user['hobby'];
        }
    }

    /**
     * @param $login
     * @param $password
     * @return bool
     */
    public function autorization($login, $password)
    {
        if ($this->checkUser($login, $password) !== false) {
            setcookie('user', $login, time() + 3600*24*7*365, '/');
        } else {
            return false;
        }
    }

    /**
     *
     */
    public function logout() {
        setcookie('user', '', -20, '/');
    }


    /**
     * @param $name
     * @param $pass
     * @return bool
     */
    private function checkUser($name, $pass) {
        $this->checkUser->execute(array(':name'=>$name));
        $user = $this->checkUser->fetch(PDO::FETCH_ASSOC);
        if ($user['pass'] == $pass) {
            return $user;
        } else {
            return false;
        }
    }

    /**
     * @param $name
     * @return mixed
     */
    private function getInfoUser($name) {
        $this->checkUser->execute(array(':name'=>$name));
        return $this->checkUser->fetch(PDO::FETCH_ASSOC);
    }

    public function checkLogin() {
        if (isset($_COOKIE['user'])) {
            return true;
        } else {
            return false;
        }
    }
}