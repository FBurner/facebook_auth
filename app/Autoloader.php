<?php

class Autoloader {
    public function loadController($controller) {
        set_include_path(__DIR__ . DIRECTORY_SEPARATOR . 'controllers');
        if (file_exists(get_include_path() . DIRECTORY_SEPARATOR . $controller . '.php')) {
            include($controller .'.php');
        }
    }

    public function loadModels($model) {
        set_include_path(__DIR__ . DIRECTORY_SEPARATOR . 'models');
        if (file_exists(get_include_path() . DIRECTORY_SEPARATOR . $model . '.php')) {
            include($model .'.php');
        }
    }
}