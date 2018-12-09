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

# автозагрузчик
include_once '../autoload.php';

#роутинг
$action = 'action_';
$action .= (isset($_GET['action'])) ? $_GET['action'] : 'index';

if (isset($_GET['c'])) {
    switch ($_GET['c']) {
        default:
            $controller = new C_Page();
    }
} else {
    $controller = new C_Page();
}
$controller->Request($action);