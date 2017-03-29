<?php
/**
 * Created by PhpStorm.
 * User: MAV
 * Date: 26.02.2017
 * Time: 17:50
 */

error_reporting(E_ALL);
ini_set('display_errors', true);

require_once 'functions.php';

//var_dump($_COOKIE['fio']);

if (!hasRole('auth-user') && !hasRole('administrator') && !hasRole('guest')) {
    http_response_code(403);
    die('Доступ запрещен');
}

mb_internal_encoding('UTF-8');

?>
<!DOCTYPE html>
<html lang="ru-RU">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Список тестов">
    <meta name="keywords" content="сайт, тесты, html, css">
    <meta name="author" content="Андрюс Микялёнис">
    <meta http-equiv="X-UA-COMPATIBLE" content="IE=edge">

    <title>Список тестов</title>

    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/fonts.css">
    <link rel="stylesheet" href="css/font-awesome.css">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/header.css">

</head>
<body>
<!--[if lte IE 9]>
<p>
    Ваш браузер устарел! Скачайте новую версию <a href="http://browsehappy.com/locale=ru_ru">браузера</a>
</p>
<![endif]-->
<div class="wrapper wrapper_center">

    <header class="header">
        <div class="container clearfix">
            <div class="header__left">
                <div class="user__name">
                    <span><b> <?= getUserData()['name'] . ' ' . $_COOKIE['fio'] ?></b></span>
                </div>
            </div>
            <div class="header__right">
                <div class="contacts">
                    <a href="logout.php" class="contacts__link">
							<span class="contacts__link-text">
                            	Выход
                            </span>
                    </a>
                </div>
            </div>
        </div>
    </header>
    <div class="center"></div>
    <div class="content">
        <ul class="tests__list">
            <div class="list__div">
                <h3>Список тестов:</h3>
                <form method="post" action="delete.php">
                    <?php
                    if (!empty(glob("data/*.json"))) {

                        foreach (glob("data/*.json") as $filename) {
                            if ($contents = file_get_contents($filename)) {
                                $results = json_decode($contents, true);
                                if (array_key_exists('title', $results)) {
                                    ?>
                                    <li class="tests__list-item">
                                        <input type="radio" name="testNumber"
                                               value="<?= pathinfo($filename)['filename'] ?>">
                                        <a href="test.php?id=<?= pathinfo($filename)['filename'] ?>"
                                           class="tests__list-link">
                                            <i class="tests__list-icon fa fa-list"></i>
                                            <span class="tests__list-text">
                                        <?php echo $results['title']; ?>
                                    </span>
                                        </a>
                                    </li>
                                <?php } else {
                                    echo "Некорректный файл. Проверьте формат теста $filename. <br />";
                                }
                            }
                        }
                    } else {
                        echo 'Тесты не загружены.';
                    }
                    if (hasRole('auth-user') || hasRole('administrator')) {
                    ?>
                    <div class="file-upload btn btn-info">
                        <a href="admin.php">Загрузить тесты</a>
                    </div>
                    <!--                    <div class="file-upload">-->
                    <button class="file-upload btn btn-info">Удалить выбранный тест</button>
                    <!--                    </div>-->
                </form>
                <?php
                }
                //                echo '<br/><a href="admin.php">Загрузить тесты ...</a>';
                ?>
            </div>
        </ul>
    </div>
</div>
<script src="js/radioUnCheck.js"></script>
</body>
</html>