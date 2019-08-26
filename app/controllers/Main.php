<?php

namespace app\controllers;

use vendor\core\base\Controller;

class Main extends Controller
{
    public function testAction() {
        echo "Main::test";
    }

    public function indexAction() {
        echo "Main::index";
    }
}