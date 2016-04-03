<?php

class IndexController extends Controller {
    public function indexAction() {
        $view = new View('index/index.php');
        $view->assign('config', $this->getConfig());
    }
}