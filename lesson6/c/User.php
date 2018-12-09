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
    public function __construct()
    {
        include_once '../m/PDO.php';
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
            return true;
        } else {
            return false;
        }
    }

    public function registration($login, $password,$email) {
        DB::insert('users',[
           'name'=>$login,
           'pass'=>md5($password),
           'email'=>$email
        ]);
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
        $user = DB::select('users',[],"name='$name'",true);
        if ($user['pass'] == md5($pass)) {
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
        return DB::select('users',[],"name='$name'",true);
    }

    public function checkLogin() {
        if (isset($_COOKIE['user'])) {
            return true;
        } else {
            return false;
        }
    }
}