<?php

namespace Pageup\Base;
use Pageup\Base\Headers;

/**
 * Response
 * 
 * Set a json response
 */
class Response {
    public function __construct () {
        Headers::set('Content-Type', 'application/json; charset=utf-8');
    }
    /**
     * Response::json
     * 
     * Response write a json body
     * @param array $obj Array or object to output
     * @param int $status Status code to return. Defaults to 200
     */
    public static function json($obj, $status = 200) {
        Headers::set('Content-Type', 'application/json; charset=utf-8');
        http_response_code($status);
        echo json_encode([
            'status' => $status,
            'data' => $obj
        ]);
        return new static;

    }

    /**
     * Response::cache
     * 
     * Set cache headers for this response
     * @param string $option Static, None
     */
    public static function cache ($option) {
        switch ($option) {
            case 'static':
                header('Cache-Control: public, max-age=604800, immutable');
            break;

            default:
                return;
            break;
        }
        return new static;
    }
}