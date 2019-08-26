<?php

error_reporting(-1);

use vendor\core\Router;

$query = rtrim($_SERVER['REQUEST_URI'], '/');
$query = strlen($query) > 1 && $query[0] == '/' ? substr($query, 1) : $query;

define('APP', dirname(__DIR__) . '/app');
define('WWW', __DIR__);
define('ROOT', dirname(__DIR__));
define('CORE', dirname(__DIR__) . '/vendor/core');

require '../vendor/libs/functions.php';

spl_autoload_register(function ($class) {
    $file = ROOT . '/' . str_replace('\\', '/', $class) . '.php';
    if (file_exists($file)) {
        require_once $file;
    }
});

Router::add('^pages/?(?P<action>[a-z-]+)?$', ['controller' => 'Posts']);

Router::add('^$', ['controller' => 'Main', 'action' => 'index']);
Router::add('^(?P<controller>[a-z-]+)/?(?P<action>[a-z-]+)?$');

Router::dispatch($query);
