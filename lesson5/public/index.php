<?php
/**
 * Created by PhpStorm.
 * User: kayn23
 * Date: 07.12.2018
 * Time: 11:24
 */
/*
 * Подключаю twig раньше autoload
 * иначе программа ругается на его инициализыцию
 */
include_once '../lib/Twig/Autoloader.php';
Twig_Autoloader::register();
$loader = new Twig_Loader_Filesystem('../v');
global $twig;
$twig = new Twig_Environment($loader, array(
    'auto_reload' => true
));

# автозагрузчик
spl_autoload_register(function ($class_name) {
    include_once '../c/'.$class_name . '.php';
});

#роутинг
$action = 'action_';
$action .= (isset($_GET['action'])) ? $_GET['action'] : 'index';

if (isset($_GET['c'])) {
    switch ($_GET['c']) {
        default:
            $controller = new C_Page($twig);
    }
} else {
    $controller = new C_Page($twig);
}
$controller->Request($action);