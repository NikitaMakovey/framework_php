<?php

//echo $query = rtrim(substr($_SERVER['QUERY_STRING'], 10), "/");
echo $query = rtrim($_SERVER['REQUEST_URI'], '/');

require '../vendor/core/Router.php';
require '../vendor/libs/functions.php';

//Router::add('posts/add', ['controller' => 'Posts', 'action' => 'add']);
//Router::add('posts', ['controller' => 'Posts', 'action' => 'index']);
//Router::add('', ['controller' => 'Main', 'action' => 'index']);

Router::add('^?', ['controller' => 'Main', 'action' => 'index']);
Router::add('(?P<controller>[a-z-]+)/?(?P<action>[a-z-]+)?');

debug(Router::getRoutes());

Router::dispatch($query);

//if (Router::matchRoute($query)) {
//    debug(Router::getRoute());
//} else {
//    echo '404';
//}