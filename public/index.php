<?php
require __DIR__.'/../vendor/autoload.php';
$configs = require __DIR__.'/../config/app.config.php';
use service\DBConnector;
DBConnector::setConfig($configs['db']);
$map =[
    '/register' => __DIR__ .'/../src/controller/register.php',
    '/login' => __DIR__ .'/../src/controller/login.php',
    '/tools_table' => __DIR__ .'/../src/controller/tools_table.php',
    '' => __DIR__ .'/../src/controller/index.php'
];
$url = $_SERVER['REQUEST_URI'];
if (substr($url, 0, strlen('/index.php')) == '/index.php') {
    $url = substr($url, strlen('/index.php'));
} else if ($url == '/') {
    $url = '';
}
if (array_key_exists($url, $map)) {
    include $map[$url];
}
?>