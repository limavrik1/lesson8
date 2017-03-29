<?php
require_once 'functions.php';

if (!hasRole('auth-user') && !hasRole('administrator')) {
    http_response_code(403);
    die('Доступ запрещен');
}

if (isset($_GET['login']) && isset($_GET['password'])) {
    echo hashPassword($_GET['login'], $_GET['password']);
} else {
    echo 'Передайте GET параметры login и password';
}
