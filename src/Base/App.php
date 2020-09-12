<?php

namespace Pageup\Base;

class App {
    public $router;
    public $match;
    public $middleware;
    protected static $_instance;

    public function __construct($options = ['mode' => 'dev']) {
        $this->router = new \AltoRouter();
        $this->router->setBasePath('/personal/pagesiler');
        $this->options = $options;
        $this->middleware = [
            '/admin' => 'Auth'
        ];
        
        self::$_instance = $this;
    }

    public static function getInstance() {
        if (self::$_instance === null) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    public function get($path, $action, $name = 'null') {
        $this->router->map('GET', $path, $action, $name);
        return $this;
    }

    public function post($path, $action, $name = 'null') {
        return $this->router->map('POST', $path, $action, $name);
    }

    public function hasMiddleware ($path) {
        if (array_key_exists($path, $this->middleware)) {
            $className = 'Pageup\Middleware\\'. $this->middleware[$path];
            $mw = new $className();
        }
    }

    public function run () {
        $cors = new \Pageup\Middleware\Cors();
        $match = $this->router->match(); // ['target' => A@index, 'params' => '', 'name' =>'']
        if (is_array($match)) {
            try {
                // Run middleware
                $this->hasMiddleware($match['path']);
                list($controller, $action) = explode('@', $match['target']);
                $fullClass = 'Pageup\Controllers\\'. $controller;
                $className = new $fullClass;
                // $className->$action());
                call_user_func_array(array($className, $action), $match['params']);
            } catch (\Exception $e) {
                print_r($e);
            }
        } else {
            header( $_SERVER["SERVER_PROTOCOL"] . ' 404 Not Found');
            print_r($match);
        }
    }

}