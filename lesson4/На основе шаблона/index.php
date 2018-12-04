<?php
/**
 * Created by PhpStorm.
 * User: kayn23
 * Date: 05.12.2018
 * Time: 0:19
 */
include_once 'Twig/Autoloader.php';
include_once 'App/pdo.php';
Twig_Autoloader::register();
$loader = new Twig_Loader_Filesystem('template');
$twig = new Twig_Environment($loader, array(
    'cache'       => 'compilation_cache',
    'auto_reload' => true
));

$obg = $db->query('SELECT * FROM products')->fetchAll();
echo $twig->render('products.twig', array('products'=>$obg));