<?php

class Bootstrap {
    public function run() {
        $this->_initSession();
    }

    protected function _initSession() {
        session_start();
    }
}