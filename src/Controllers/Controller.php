<?php
namespace Pageup\Controllers;

class Controller {
    public function __construct() {
        $this->app = \Pageup\Base\App::getInstance();
    }
}