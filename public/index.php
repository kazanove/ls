<?php
try {
    error_reporting(-1);
    ini_set('display_errors','on');
    include dirname(__DIR__) . DIRECTORY_SEPARATOR . 'bootstrap.php';
} catch (Throwable $e) {
    echo '<div><p>Ошибка: ' . $e->getCode() . '</p><p>' . $e->getMessage() . '</p><p>' . $e->getFile() . ' in line ' . $e->getLine() . '</p></div>';
}