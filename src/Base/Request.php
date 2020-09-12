<?php

namespace Pageup\Base;

class Request {
    public static function input($name) {
        
        switch ($_SERVER['REQUEST_METHOD']) {
            case 'GET':
                return $_REQUEST[$name];
            break;
            default:
                $inputs = json_decode(file_get_contents('php://input', true));
                return $inputs->$name;
            break;
        }
    }

    public static function all () {
        return (array) json_decode(file_get_contents('php://input', true));
    }

    public static function param ($name) {
        return $_REQUEST[$name];
    }

    public static function params () {
        return $_REQUEST;
    }
}