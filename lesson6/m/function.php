<?php
/**
 * Created by PhpStorm.
 * User: kayn23
 * Date: 07.12.2018
 * Time: 21:56
 * @param $value
 * @return string
 */

/**
 * валидация данный
 */
function validation($value) {
    $value = trim($value);
    $value = stripslashes($value);
    $value = strip_tags($value);
    $value = htmlspecialchars($value);
    return $value;
}

/**
 * вывод данных на экран
 * @param $value
 */
function dd($value) {
    echo "<pre>";
    print_r($value);
    exit;
}