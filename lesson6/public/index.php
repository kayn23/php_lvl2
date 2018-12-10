<?php
/**
 * Created by PhpStorm.
 * User: kayn23
 * Date: 07.12.2018
 * Time: 11:24
 */

# автозагрузчик
include_once '../autoload.php';

#роутинг
$action = 'action_';
$action .= (isset($_GET['action'])) ? $_GET['action'] : 'index';

if (isset($_GET['c'])) {
    switch ($_GET['c']) {
        case 'page':
            $controller = new C_User();
            break;
        case 'basket':
            $controller = new C_Basket();
            break;
        default:
            $controller = new C_Book();
    }
} else {
    $controller = new C_Book();
}
$controller->Request($action);