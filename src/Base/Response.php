<?php

namespace Pageup\Base;
use Pageup\Base\Headers;
class Response {
    public function __construct () {
        Headers::set('Content-Type', 'application/json; charset=utf-8');
    }
    public static function json($obj, $status = 200) {
        Headers::set('Content-Type', 'application/json; charset=utf-8');
        http_response_code($status);
        echo json_encode([
            'status' => $status,
            'data' => $obj
        ]);

    }

    public static function cache ($option) {
        switch ($option) {
            case 'static':
                header('Cache-Control: public, max-age=604800, immutable');
            break;

            default:
                return;
            break;
        }
    }
}