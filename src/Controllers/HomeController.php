<?php
namespace Pageup\Controllers;
use Pageup\Base\Request;
use Pageup\Base\Response;
class HomeController extends Controller {
    public function index () {
        $name = Request::input('name');
        Response::cache('static');
        Response::json(['data' => $name]);
    }

    public function store () {
        print_r(json_decode(file_get_contents('php://input', true)));
    }

    public function user (int $id) {
        Response::json([
            'data' => $id,
            'conf' => $this->app->options
        ]);
    }
}