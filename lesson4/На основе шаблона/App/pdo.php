<?php
/**
 * Created by PhpStorm.
 * User: kayn23
 * Date: 05.12.2018
 * Time: 0:11
 */
define('DB_DRIVER','mysql');
define('DB_HOST','localhost');
define('DB_NAME','lesson4');
define('DB_USER','root');
define('DB_PASS','');
try
{
    $connect_str = DB_DRIVER . ':host='. DB_HOST . ';dbname=' . DB_NAME;
    $db = new PDO($connect_str,DB_USER,DB_PASS);
} catch (PDOException $e)
{
    die("Error: " . $e->getMessage());
}