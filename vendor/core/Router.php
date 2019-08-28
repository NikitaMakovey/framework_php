<?php

namespace vendor\core;

class Router
{
    protected static $routes = [];
    protected static $route = [];

    public static function add($regexp, $route = []) {
        self::$routes[$regexp] = $route;
    }

    public static function getRoutes() {
        return self::$routes;
    }

    public static function getRoute() {
        return self::$route;
    }

    public static function matchRoute($url) {
        foreach (self::$routes as $pattern => $route) {
            if (preg_match("#$pattern#i", $url, $matches)) {
                foreach ($matches as $k => $v) {
                    if (is_string($k)) {
                        $route[$k] = $v;
                    }
                }
                if (!isset($route['action'])) {
                    $route['action'] = 'index';
                }
                $route['controller'] = self::upperCamelCase($route['controller']);
                self::$route = $route;
                return true;
            }
        }
        return false;
    }

    public static function dispatch($url) {
        $url = self::removeQueryString($url);
        if (self::matchRoute($url)) {
            $controller = 'app\controllers\\' . self::$route['controller'];
            if (class_exists($controller)) {
                $cObject = new $controller(self::$route);
                $action = self::lowerCamelCase(self::$route['action']) . "Action";
                if (method_exists($cObject, $action)) {
                    $cObject->$action();
                } else {
                    echo "Method <b>$controller::$action</b> doesn't exist!";
                }
            } else {
                echo "Controller <b>$controller</b> doesn't exist!";
            }
        } else {
            http_response_code(404);
            include '404.html';
        }
    }

    public static function upperCamelCase($name) {
        return $name = str_replace(" ", "", ucwords(str_replace("-", " ", $name)));
    }

    public static function lowerCamelCase($name) {
        return lcfirst(self::upperCamelCase($name));
    }

    protected static function removeQueryString($url) {
        if ($url) {
            $params = explode('?', $url);
            if (!strpos($params[0], '=')) {
                return rtrim($params[0], '/');
            } else {
                return '';
            }
        }
    }
}