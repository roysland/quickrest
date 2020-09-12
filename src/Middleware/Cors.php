<?php

namespace Pageup\Middleware;
use Pageup\Base\Headers;
use Pageup\Base\Response;

class Cors {
    public function __construct()
    {
        $this->catchPreflight();
        $this->setCors();
    }

    public function setCors () {
        Headers::set('Access-Control-Allow-Origin', '*');
    }

    public function catchPreflight () {
        if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
            Headers::set('Access-Control-Request-Method', 'POST, GET, OPTIONS, DELETE');
            Headers::set('Access-Control-Max-Age', 86400);
            http_response_code(200);
            die();
        }
    }
}