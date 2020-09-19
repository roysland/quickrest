<?php

namespace Pageup\Base;
/**
 * Middleware class
 * 
 * Middleware class description
 * 
 * @param array $path A matched route
 */
class Middleware {
    protected $path;
    public function construct ($path) {
        $this->path = $path;
    }

    public function __destruct()
    {
        $this->handle();
    }
}