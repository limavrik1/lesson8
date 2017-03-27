<?php
/**
 * Created by PhpStorm.
 * User: MAV
 * Date: 12.03.2017
 * Time: 23:55
 */

//error_reporting(E_ALL);
//ini_set('display_errors', true);
//ini_set('html_errors', true);

$host = $_SERVER['HTTP_HOST'];
$uri = $_SERVER['REQUEST_URI'];
if (isset($host) && isset($uri)){
    header("Location: http://".$host.$uri."list.php", true, 301);
}
