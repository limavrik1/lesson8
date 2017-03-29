<?php
/**
 * Created by PhpStorm.
 * User: MAV
 * Date: 29.03.2017
 * Time: 14:16
 */

error_reporting(E_ALL);
ini_set('display_errors', true);

require_once 'functions.php';

mb_internal_encoding('UTF-8');

if (!hasRole('auth-user') && !hasRole('administrator')) {
    http_response_code(403);
    die('Доступ запрещен');
}

if (isPOST()) {
    if (!getParam('testNumber')) {
        die('Неправильный номер теста');
    } else {
        if (unlink('data/' . getParam('testNumber') . '.json')) {
            header('Location: list.php');
            die;
        } else {
            die('Возникла ошибка при удалении теста');
        }
    }
}


