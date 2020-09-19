<?php

namespace Pageup\Base;
use \Pageup\Base\AltoRouter;

class App {
    public $router;
    public $match;
    public $middleware;
    protected static $_instance;

    public function __construct($options = ['mode' => 'dev']) {
        $this->router = new Router();
        $this->router->setBasePath('/personal/pagesiler');
        $this->options = $options;
        $this->middleware = [];
        
        self::$_instance = $this;
    }
    /**
     * getInstance
     * 
     * Return an instance of the class
     */
    public static function getInstance() {
        if (self::$_instance === null) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }
    /**
     * Get
     * 
     * Define a GET route
     * @param string $path Path for route
     * @param string $action class@action
     * @param string $name Name of route
     * @param string $middleware The middleware to use
     */
    public function get($path, $action, $name = 'null', $middleware = null) {
        $this->router->map('GET', $path, $action, $name, $middleware);
        return $this;
    }
    /**
     * Post
     * 
     * Define a POST route
     * @param string $path Path for route
     * @param string $action class@action
     * @param string $name Name of route
     * @param string $middleware The middleware to use
     */
    public function post($path, $action, $name = 'null', $middleware = null) {
        return $this->router->map('POST', $path, $action, $name, $middleware);
    }
    /**
     * hasMiddleware
     * 
     * Checks the current route and runs middleware if any
     * 
     * @param array $currentPath The matched route
     */
    public function hasMiddleware ($currentPath) {
        /* if (array_key_exists($path, $this->middleware)) {
            $className = 'Pageup\Middleware\\'. $this->middleware[$path];
            $mw = new $className();
        } */
        if ($currentPath['middleware']) {
            $className = 'Pageup\Middleware\\'. $currentPath['middleware'];
            return new $className($currentPath);
        }
    }

    public function run () {
        $cors = new \Pageup\Middleware\Cors();
        $match = $this->router->match(); // ['target' => A@index, 'params' => '', 'name' =>'']
        if (is_array($match)) {
            try {
                // Run middleware
                $this->hasMiddleware($match);
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