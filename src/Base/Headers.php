<?php
namespace Pageup\Base;

class Headers {
    public static function set ($name, $value) {
        /* $allowedHeaders = [
            'Content-Type',
            'Cache-Control',
            'Expires',
            'Last-Modified',
            'ETag',
            'If-Match',
            'If-None-Match',
            'If-Modified-Since',
            'If-Unmodified-Since',
            'Connection',
            'Keep-Alive',
            'Accept',
            'Cookie',
            'Set-Cookie',
            'Access-Control-Allow-Origin',
            'Access-Control-Allow-Credentials',
            'Access-Control-Allow-Headers',
            'Access-Control-Allow-Methods',
            'Access-Control-Request-Headers',
            'Access-Control-Request-Method',
            'Origin',
            'Content-Length',
            'Content-Encoding',
            'Referer',
            'Referer-Policy',
            'User-Agent',
            'Allow',
            'Server',
            'Content-Security-Policy',
            'Sec-Fetch-Site',
            'Sec-Fetch-Mode'
        ]; */
        header($name .': '. $value);
    }

    public static function get ($name) {
        return $_SERVER['HTTP_'.$name];
    }

}