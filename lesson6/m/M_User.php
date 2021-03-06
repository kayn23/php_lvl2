<?php
/**
 * Created by PhpStorm.
 * User: kayn23
 * Date: 07.12.2018
 * Time: 11:45
 */

class M_User
{
    public $id;
    public $name;
    public $email;
    public $status;
    public function __construct()
    {
//        include_once '../m/DB.php';
        if (isset($_COOKIE['user'])) {
            $user = $this->getInfoUser($_COOKIE['user']);
            $this->id = $user['id'];
            $this->name = $user['name'];
            $this->email = $user['email'];
            $this->getStatus($user['name']);
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
            $this->getStatus($login);
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
        $this->getStatus($login);
        setcookie('user', $login, time() + 3600*24*7*365, '/');
    }

    /**
     *
     */
    public function logout() {
        setcookie('user', '', -20, '/');
        setcookie('userstatus','',-20,'/');
        setcookie('order_id','',-20, '/');
    }

    public function getOrders() {
        $user_id = $this->id;
        $orders = DB::getRows("SELECT 
                                      o.id,o.created_at,s.status,
                                      (SELECT sum(b.amount*p.price) 
                                        FROM basket as b JOIN products as p 
                                        WHERE b.product_id=p.id AND b.order_id=o.id) as price
                                      FROM 
                                      orders as o 
                                      JOIN 
                                      status_order as s 
                                      WHERE o.status=s.id 
                                      AND 
                                      o.user_id='$user_id'
                                      AND o.status<>0");
        return $orders;
    }


    /**
     * @param $name
     * @param $pass
     * @return bool
     */
    private function checkUser($name, $pass) {
        $user = DB::select('users',[],"name='".$name."'",true);
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
        $user = DB::select('users',[],"name='".$name."'",true);
        $user['status'] = DB::select('user_role',['role'],'user_id='.$user['id'],true)['role'];
        return $user;
    }

    public function checkLogin() {
        if (isset($_COOKIE['user'])) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * возвращает роль пользователя
     * @param $name
     */
    private function getStatus($name) {
        $user = DB::select('users',['id'],"name='$name'",true);
        $userStatus = DB::select('user_role',['role'],'user_id='.$user['id'],true)['role'];
        setcookie('userstatus',$userStatus,time() + 3600*24*7*365,'/');
    }
}