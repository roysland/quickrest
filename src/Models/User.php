<?php

namespace Pageup\Models;
use \Pageup\Base\Model;
class User extends Model {
    use \Pageup\Base\Database;
    
    public $model;
    protected $table = 'users';
    public function __construct()
    {
        parent::__construct($this->table);
        $model = new Model('users');
        $model->string('name');
        $model->string('email');
        $model->string('password');
        $model->number('age');
        $model->save();
        $this->model = $model;
    }


    
}