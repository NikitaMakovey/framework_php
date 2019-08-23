<?php

$query = rtrim($_SERVER['REQUEST_URI'], '/');
$query = strlen($query) > 1 && $query[0] == '/' ? substr($query, 1) : $query;

require '../vendor/core/Router.php';
require '../vendor/libs/functions.php';
require '../app/controllers/Main.php';
require '../app/controllers/Posts.php';
require '../app/controllers/PostsNew.php';

Router::add('^$', ['controller' => 'Main', 'action' => 'index']);
Router::add('^(?P<controller>[a-z-]+)/?(?P<action>[a-z-]+)?$');

Router::dispatch($query);
