<?php

namespace Pageup\Base;

trait Database {

    public static function open ($dbName = DB) {
        try {
            $db = new \PDO("sqlite:". BASE.'/db//'.$dbName.'.sqlite');
            $db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            return $db;

        } catch (\Exception $e) {
            die($e->getMessage());
        }
    }

    

}