<?php

$query = rtrim($_SERVER['REQUEST_URI'], '/');
$query = strlen($query) > 1 && $query[0] == '/' ? substr($query, 1) : $query;

define('APP', dirname(__DIR__) . '/app');

require '../vendor/core/Router.php';
require '../vendor/libs/functions.php';

spl_autoload_register(function ($class) {
    $file = APP . "/controllers/$class.php";
    if (file_exists($file)) {
        require_once $file;
    }
});

Router::add('^$', ['controller' => 'Main', 'action' => 'index']);
Router::add('^(?P<controller>[a-z-]+)/?(?P<action>[a-z-]+)?$');

Router::dispatch($query);
