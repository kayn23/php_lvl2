<?php
/**
 * Created by PhpStorm.
 * User: kayn23
 * Date: 07.12.2018
 * Time: 11:24
 */
spl_autoload_register(function ($class_name) {
    include 'm/'.$class_name . '.php';
});

$user = new User();
$user->autorization('kayn23','232111');
//$user->logout();
echo $user->name."<br>";
echo "<pre>";
print_r($_COOKIE);
