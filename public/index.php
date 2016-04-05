<?php

error_reporting(E_ALL);
ini_set('display_errors', '1');

defined('APPLICATION_PATH')
|| define('APPLICATION_PATH', __DIR__ . '/../app');

require_once APPLICATION_PATH . '/Bootstrap.php';
require_once APPLICATION_PATH . '/Autoloader.php';

$autoLoader = new Autoloader();

spl_autoload_register(array($autoLoader, 'loadController'));
spl_autoload_register(array($autoLoader, 'loadModels'));

$configPath = APPLICATION_PATH . DIRECTORY_SEPARATOR . 'configs' . DIRECTORY_SEPARATOR . 'config.php';
if (!file_exists($configPath)) {
    throw new Exception('config not found - create a config file according to "app/configs/config.example.php"');
}

$config = include($configPath);

$config = array_merge($config['production'], $config[getenv('APPLICATION_ENV')]);

$bootstrap = new Bootstrap();
$bootstrap->run();

$frontController = new FrontController($config);
$frontController->run();
