<?php


namespace vendor\core\base;


class View
{
    public $route = [];
    public $view;
    public $layout;

    public function __construct($route, $layout = '', $view = '') {
        $this->route = $route;
        $this->layout = $layout ? : LAYOUT;
        $this->view = $view;
    }

    public function render() {
        $file_view = APP . "/view/{$this->route['controller']}/{$this->view}.php";
        if (is_file($file_view)) {
            require $file_view;
        } else {
            echo "<p>This view is not available<b>{$file_view}</b></p>";
        }
    }
}