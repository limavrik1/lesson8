<?php
/**
 * Created by PhpStorm.
 * User: MAV
 * Date: 25.02.2017
 * Time: 21:03
 */
error_reporting(E_ALL);
ini_set('display_errors', true);
ini_set('html_errors', true);

require_once 'functions.php';

if (!hasRole('auth-user') && !hasRole('administrator') && !hasRole('guest')) {
    http_response_code(403);
    die('Доступ запрещен');
}

mb_internal_encoding('UTF-8');

$testId = 'data/' . filter_input(INPUT_GET, 'id') . '.json';

if (!empty($_POST) && isset($_GET['id'])) {

    if ($testId !== NULL || $testId !== false) {
        if ($testContents = file_get_contents($testId)) {
            $results = json_decode($testContents, true);
            $title = $results['title'];
            $questionCount = count($results['data']);

            $inputValueCount = array();

            for ($i = 0; $i < $questionCount; $i++) {
                $inputValueCount[] = count($results['data'][$i]['inputValue']);
            }
            ?>
            <!DOCTYPE html>
            <html lang="ru-RU">

            <head>
                <meta charset="UTF-8">
                <meta name="description" content="Результаты теста">
                <meta name="keywords" content="сайт, тесты, html, css">
                <meta name="author" content="Андрюс Микялёнис">
                <meta http-equiv="X-UA-COMPATIBLE" content="IE=edge">

                <title>Результаты теста</title>

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
            <div class="wrapper wrapper_title">
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
            <!--            <div class="center"></div>            -->
            <div class="content content__test">
            <div class="test">
                <!--                <h1>Результаты теста: --><?//= $title ?><!--</h1>-->
            </div>
            <div class="result">
            <?php
            $resultScore = 0;
            $dataID = 0;
            foreach ($_POST as $questionKey => $questionValue) {
//                if ($questionKey !== 'fio') {
                    for ($id = 0; $id < $inputValueCount[$dataID]; $id++) {
                        if ($questionValue === $results['data'][$dataID]['inputValue'][$id]) {
                            $resultScore += $results['data'][$dataID]['inputValueScore'][$id];
                        }
                    }
//                }
                $dataID++;
            }
            echo '<img src="data:image/png;base64,' . base64_encode(renderCertificate($title, $_COOKIE['fio'], $resultScore, $questionCount)) . '" />';
//            echo '</br>';
//            echo '<strong>Правильно: ' . $resultScore . " из $postCount </strong></br>";
//            echo '<br/><a href="list.php">Назад к списку тестов</a>'; ?>

            <div class="file-upload btn btn-info">
                <a href="list.php">Назад к списку тестов</a>
            </div>
            <div class="footer"></div>
            <?php
        }
        ?>
        </div>
        </div>
    </div>
    </body>
        </html>
        <?php
    } else {
        echo 'Неправильный номер теста';
        echo '<br/><a href="list.php">Назад к списку тестов</a>';
        die (0);
    }

} else {
    $filesList = glob("data/*.json");
    if ($testId !== NULL && $testId !== false && in_array($testId, $filesList, true) !== false) {
        if ($testContents = file_get_contents($testId)) {
            $results = json_decode($testContents, true);
            $title = $results['title'];
            $questionCount = count($results['data']);
            $inputValueCount = array();

            for ($i = 0; $i < $questionCount; $i++) {
                $inputValueCount[] = count($results['data'][$i]['inputValue']);
            }
            ?>
            <!DOCTYPE html>
            <html lang="ru-RU">

            <head>
                <meta charset="UTF-8">
                <meta name="description" content="Форма">
                <meta name="keywords" content="сайт, тесты, html, css">
                <meta name="author" content="Андрюс Микялёнис">
                <meta http-equiv="X-UA-COMPATIBLE" content="IE=edge">

                <title>Тестирование</title>

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
            <div class="wrapper wrapper_title">
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
<!--                <div class="center"></div>-->
                <div class="content content__test">
                    <h1><?= $title ?></h1>
                    <form method="post" target="_blank">
                        <ol>
                            <div class="list__div">
                                <?php
                                for ($li = 0; $li < $questionCount; $li++) {
                                    echo '<div class="div_li">';
                                    echo '<li>';
                                    echo '<h3>' . $results['data'][$li]['question'] . '</h3>';
                                    echo '<div class="questions">';
                                    for ($divCount = 0; $divCount < $inputValueCount[$li]; $divCount++) {
                                        echo '<div class="question">';
                                        $inputValue = $results['data'][$li]['inputValue'][$divCount];
                                        echo '<input type="' . $results['data'][$li]['inputType'] . '" name="question-answers-' . $li . '" id="question-answers-' . $li . '-' . $inputValue . '" value="' . $inputValue . '"/>';
                                        echo '<label for="question-answers-' . $li . '-' . $inputValue . '">' . $results['data'][$li]['inputLabelValue'][$divCount] . '</label>';
                                        echo '</div>';
                                    }
                                    echo '</div>';
                                    echo '</li>';
                                    echo '</div>';
                                }
                                ?>
                            </div>
                        </ol>
<!--                        <div class="fio">-->
<!--                            <label for="fio">Ваше имя:</label>-->
<!--                            <input id="fio" type="text" name="fio">-->
<!--                        </div>-->
                        <div>
                            <button class="file-upload btn btn-info">Отправить</button>
                        </div>
                    </form>
                </div>
                <div class="footer"></div>
            </div>
            </body>
            </html>
            <?php
        }
    } else {
//        header('HTTP/1.1 404 Not Found'); //This may be put inside err.php instead
        $_GET['e'] = 404; //Set the variable for the error code (you cannot have a
        include '404.php';
//        http_response_code(404);
        exit;
    }
}
?>