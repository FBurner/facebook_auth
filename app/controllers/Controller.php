<?php

class Controller {

    protected $_config;
    protected $_view;
    protected $_params;

    public function __construct($config = null) {
        $this->_config = $config;
    }

    /**
     * @return null
     */
    public function getConfig() {
        return $this->_config;
    }

    /**
     * @param null $config
     */
    public function setConfig($config) {
        $this->_config = $config;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getParams() {
        return $this->_params;
    }

    /**
     * @param mixed $params
     */
    public function setParams($params) {
        $this->_params = $params;
    }

    /**
     * Get Base URL with protocol
     * @return string
     */
    public function getBaseUrl() {
        $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
        return $protocol . $_SERVER['HTTP_HOST'];
    }
}