<?php

namespace Pageup\Middleware;
use Pageup\Base\Headers;
use Pageup\Base\Response;

class Auth extends \Pageup\Base\Middleware {
    protected $token = '1234';

    public function handle ()
    {
        $header = Headers::get('TOKEN');
        if ($header === $this->token) {
            return;
        } else {
            Response::json([
                'msg' => 'Not authorized',
                'error' => true
            ], 401);
            die();
        }
    }
}