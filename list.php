<?php
/**
 * Created by PhpStorm.
 * User: MAV
 * Date: 26.02.2017
 * Time: 17:50
 */

error_reporting(E_ALL);
ini_set('display_errors', true);

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

</head>
<body>
<!--[if lte IE 9]>
<p>
    Ваш браузер устарел! Скачайте новую версию <a href="http://browsehappy.com/locale=ru_ru">браузера</a>
</p>
<![endif]-->
<div class="wrapper wrapper_center">
    <div class="content">
        <ul class="tests__list">
            <div class="list__div">
                <h3>Список тестов:</h3>
                <?php
                if (!empty(glob("data/*.json"))) {
                    foreach (glob("data/*.json") as $filename) {
                        if ($contents = file_get_contents($filename)) {
                            $results = json_decode($contents, true);
                            if (array_key_exists('title', $results)) {
                                ?>
                                <li class="tests__list-item">
                                    <a href="test.php?id=<?= pathinfo($filename)['filename'] ?>" class="tests__list-link">
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
                    echo '<br/><a href="admin.php">Загрузить тесты ...</a>';
                } ?>
            </div>
        </ul>
    </div>
</div>
</body>
</html>