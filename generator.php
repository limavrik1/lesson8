<?php
require_once 'functions.php';

if (!hasRole('auth-user') && !hasRole('administrator')) {
    http_response_code(403);
    die('Доступ запрещен');
}
echo hashPassword($_GET['login'],$_GET['password']);