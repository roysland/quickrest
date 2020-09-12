<?php

namespace Pageup\Middleware;
use Pageup\Base\Headers;
use Pageup\Base\Response;

class Auth {
    protected $token = '1234';

    public function __construct() {
        $this->handle();
    }

    public function handle ()
    {
        $header = Headers::get('TOKEN');
        if ($header && $header === $this->token) {
            return;
        } else {
            Response::json([
                'msg' => 'Not authorized',
                'error' => true
            ], 401);
            exit();
        }
    }
}