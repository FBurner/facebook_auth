<?php

class View {
    protected $_data = array();
    protected $_render;

    public function __construct($template) {
        $file = __DIR__ . DIRECTORY_SEPARATOR . '..'. DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR . $template;


        if (file_exists($file)) {
           $this->_render = $file;
        } else {
            throw new Exception("template '$file' was not found", 2000);
        }
    }

    public function assign($variable, $value) {
        $this->_data[$variable] = $value;
    }

    public function __destruct() {
        extract($this->_data);
        include($this->_render);
    }

    public function getBaseUrl() {
        $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
        return $protocol . $_SERVER['HTTP_HOST'];
    }
}