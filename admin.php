<?php
/**
 * Created by PhpStorm.
 * User: MAV
 * Date: 25.02.2017
 * Time: 21:03
 * http://www.quirksmode.org/dom/inputfile.html
 */

error_reporting(E_ALL);
ini_set('display_errors', true);
ini_set('html_errors', true);

require_once 'functions.php';

mb_internal_encoding('UTF-8');

if (isset($_FILES['testFile'])) {
    $tmp_files = $_FILES['testFile']['tmp_name'];
//    $fileName = 'data/' . $_FILES['testFile']['name'];
    $fileName =  incrementFileName( 'data/', 'json' );
//    if (file_exists($fileName)) {
//        echo 'Пожалуйста, переименуйте файл. Такой файл существует';
//        die(0);
//    }
    if (move_uploaded_file($tmp_files, $fileName)) {
        echo 'Файл загружен успешно.';
    } else {
        echo 'Возникли проблемы с сохранением загруженного файла';
    }
    echo '<br/><a href="admin.php">Назад к загрузке</a>';
} else { ?>
    <!DOCTYPE html>
    <html lang="ru-RU">

    <head>
        <meta charset="UTF-8">
        <meta name="description" content="Форма">
        <meta name="keywords" content="сайт, тесты, html, css">
        <meta name="author" content="Андрюс Микялёнис">
        <meta http-equiv="X-UA-COMPATIBLE" content="IE=edge">

        <title>Загрузка тестов</title>

        <link rel="stylesheet" href="css/normalize.css">
        <link rel="stylesheet" href="css/fonts.css">
        <link rel="stylesheet" href="css/font-awesome.css">
        <link rel="stylesheet" href="css/main.css">

    </head>
    <body>
    <!--[if lte IE 9]>
    <p>
        Ваш браузер устарел! Скачайте новую версию <a href="http://browsehappy.com/locale=ru_ru">браузера</a>
    </p>
    <![endif]-->
    <div class="wrapper wrapper_center">
        <div class="content">
            <div class="test">
                <h1>Загрузка тестов</h1>
            </div>
            <div class="form">
                <form method="post" enctype="multipart/form-data">
                    <input type="hidden" name="MAX_FILE_SIZE" value="1000000"/>
                    <div class="file-upload btn btn-info">
                        <span>Выбрать файл</span>
                        <input name="testFile" class="testFile" type="file" accept="application/json"/>
                    </div>
                    <input type="submit" value="Отправить" class="file-upload btn btn-info" title="Максимальный размер 1 Мб" />
                </form>
                <div class="file-upload btn btn-info">
                    <a href="list.php">Перейти к списку тестов</a>
                </div>
            </div>
        </div>
    </div>
    </body>
    </html>
<?php } ?>