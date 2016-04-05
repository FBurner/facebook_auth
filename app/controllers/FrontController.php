<?php

class FrontController extends Controller {
    //** @todo refactor to singleton */
    const DEFAULT_CONTROLLER = 'IndexController';
    const DEFAULT_ACTION     = 'indexAction';

    protected $_controller    = self::DEFAULT_CONTROLLER;
    protected $_action        = self::DEFAULT_ACTION;
    protected $_params        = array();

    public function __construct($config) {
        parent::__construct($config);
        $this->parseURI();
    }

    /**
     * parse the current url and set controller action and params accordingly
     */
    private function parseURI() {
        $URL = trim(parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH), "/");
        // remove all non alphanumeric characters and not slash
        $URL = preg_replace('/[^a-zA-Z0-9]\//', '', $URL);

        if (strpos($URL, $this->getConfig()['basePath']) === 0) {
            $URL = substr($URL, strlen($this->getConfig()['basePath']));
        }

        $urlParts = explode("/", $URL, 3);

        if (!empty($urlParts[0])) {
            $this->setController($urlParts[0]);
        }
        if (!empty($urlParts[1])) {
            $this->setAction($urlParts[1]);
        }

        $params = array();
        if (!empty($urlParts[2])) {
            $params = explode("/", $urlParts[2]);
        }

        $this->setParams(array_merge($params, $_GET));
    }

    /**
     * @param $controller
     * @return $this
     */
    public function setController($controller) {
        $controller = ucfirst(strtolower($controller)) . 'Controller';
        if (!class_exists($controller)) {
            throw new InvalidArgumentException("The controller '$controller' has not been defined");
        }

        $this->_controller = $controller;
        return $this;
    }

    /**
     * @param $_action
     * @return $this
     */
    public function setAction($action) {
        $action = strtolower($action) . 'Action';

        $refelectedController = new ReflectionClass($this->_controller);
        if (!$refelectedController->hasMethod($action)) {
            throw new InvalidArgumentException("the action '$action' has not been defined'");
        }

        $this->_action = $action;
        return $this;
    }

    public function run() {
        $controller = new $this->_controller($this->getConfig());
        $controller->setParams($this->_params);
        try {
            call_user_func_array(array($controller, $this->_action), $this->getParams());
        } catch (Exception $error) {
            // @todo implement logging and exception handling
            throw $error;
        }

    }

}