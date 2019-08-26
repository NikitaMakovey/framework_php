<?php

namespace app\controllers;

use vendor\core\base\Controller;

class Posts extends Controller
{
    public function testAction() {
        echo "Posts::test";
    }

    public function indexAction() {
        echo "Posts::index";
    }
}