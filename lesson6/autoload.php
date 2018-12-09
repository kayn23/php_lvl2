<?php
include_once '../lib/Twig/Autoloader.php';
include_once 'm/function.php';
Twig_Autoloader::register();
spl_autoload_register("gbStandardAutoload");

function gbStandardAutoload($className) {
    $dirs = [
        'c',
        'lib/',
        'lib/smarty',
        'lib/commands',
        'm/'
    ];
    $found = false;
    foreach ($dirs as $dir) {
        $fileName = __DIR__ . '/' . $dir . '/' . $className . '.php';
        if (is_file($fileName)) {

            require_once($fileName);
            $found = true;
        }
    }
    //$obj = new A;
//    dd(__DIR__);
    if (!$found) {
        throw new Exception('Unable to load ' . $className);
    }
    return true;
}
?>