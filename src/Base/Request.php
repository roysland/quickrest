<?php

namespace Pageup\Base;
/**
 * Request
 * 
 * Simple parser for Request headers
 */
class Request {

    /**
     * Request::input
     * 
     * Get value of post body or get param
     * 
     * @param name string Name of the parameter
     */
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


    /**
     * Request::all()
     * 
     * Get the whole post body
     * @return array result
     */
    public static function all () {
        return (array) json_decode(file_get_contents('php://input', true));
    }

    /**
     * Request::param()
     * 
     * Get the specified parameter
     * @param $name The param to get
     * @return string Value of parameter
     */
    public static function param ($name) {
        return $_REQUEST[$name];
    }


    /**
     * Request::params
     * 
     * Get all parameters
     */
    public static function params () {
        return $_REQUEST;
    }
}