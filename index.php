<?php
/**
 * Created by PhpStorm.
 * User: MAV
 * Date: 12.03.2017
 * Time: 23:55
 */

error_reporting(E_ALL);
ini_set('display_errors', true);
ini_set('html_errors', true);

//$host = $_SERVER['HTTP_HOST'];
//$uri = $_SERVER['REQUEST_URI'];
//if (isset($host) && isset($uri)){
//    header("Location: http://".$host.$uri."list.php", true, 301);
//}
require_once 'functions.php';
if (isPOST()) {
    if (empty(getParam('login')) && empty(getParam('password')) ) {
        setcookie('fio', getParam('fio'));
        $userData = getUser('guest');
        $_SESSION['user'] = $userData;
        header('Location: list.php');
        die;
    }
    if(!auth(getParam('login'), getParam('password'))) {
        die('Данные введены неверно');
    } else {
        setcookie('fio', getParam('fio'));
        header('Location: list.php');
        die;
    }
}

?>
<!DOCTYPE html>
<html lang="ru-RU">
<head>
    <meta charset="UTF-8">
    <title>Вход на сайт</title>

    <link rel="stylesheet" href="css/normalize.css">

    <link rel='stylesheet prefetch'
          href='http://fonts.googleapis.com/css?family=Roboto:400,100,300,500,700,900|RobotoDraft:400,100,300,500,700,900'>

    <link rel="stylesheet" href="css/font-awesome.css">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/index.css">


</head>

<body>
<!-- Form Mixin-->
<!-- Input Mixin-->
<!-- Button Mixin-->
<!-- Pen Title-->
<!--<div class="pen-title">-->
<!--    <h1>Flat Login Form</h1><span>Pen <i class='fa fa-paint-brush'></i> + <i class='fa fa-code'></i> by <a href='http://andytran.me'>Andy Tran</a></span>-->
<!--</div>-->
<!-- Form Module-->
<div class="div-center"></div>

<div class="module form-module">
    <div class="toggle">
        <!--        <div class="tooltip">Click Me</div>-->
    </div>
    <div class="form-login">
        <h2>Вход на сайт</h2>
        <form method="post">
            <input type="text" name="login" placeholder="Логин"/>
            <input type="password" name="password" placeholder="Пароль"/>
            <input type="text" name="fio" placeholder="ФИО" required/>
            <button>Войти</button>
        </form>
    </div>
    <!--    <div class="form">-->
    <!--        <h2>Create an account</h2>-->
    <!--        <form>-->
    <!--            <input type="text" placeholder="Username"/>-->
    <!--            <input type="password" placeholder="Password"/>-->
    <!--            <input type="email" placeholder="Email Address"/>-->
    <!--            <input type="tel" placeholder="Phone Number"/>-->
    <!--            <button>Register</button>-->
    <!--        </form>-->
    <!--    </div>-->
    <!--    <div class="cta"><a href="http://andytran.me">Forgot your password?</a></div>-->
</div>
<!--<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>-->
<!--<script src='http://codepen.io/andytran/pen/vLmRVp.js'></script>-->
<!--<script src="js/index.js"></script>-->
</body>
</html>

