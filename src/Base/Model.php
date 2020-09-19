<?php

namespace Pageup\Base;

/**
 * Model
 */

class Model {
    use \Pageup\Base\Database;

    protected $table;
    protected $primaryKey = 'id';
    protected $columns = [];
    protected $db;
    public $createTableSql = '';

    public function __construct($table) {
        $this->table = $table;
        $this->db = Database::open(DB);
    }
    /**
     * AddColumn
     * 
     * Add a property to the model
     * @param string $def The column type
     * @param string $type The type
     * @param string $name Name of property / column
     */
    public function addColumn($def, $type, $name) {
    
        return $this->columns[$name] = [
            'def' => $def,
            'type' => $type,
            'name' => $name
        ];
    }
    /**
     * Define a string type
     * @param string $column Name of the column
     */
    public function string ($column) {
        return $this->addColumn('string', 'TEXT', $column);
    }
    /**
     * Define a text type
     * @param string $column Name of the column
     */
    public function text ($column) {
        return $this->addColumn('text', 'TEXT', $column);
    }
    /**
     * Define a boolean type
     * @param string $column Name of the column
     */
    public function boolean($column) {
        return $this->addColumn('boolean', 'NUMERIC', $column);
    }
    /**
     * Define a Number type
     * @param string $column Name of the column
     */
    public function number($column) {
        return $this->addColumn('integer', 'INTEGER', $column);
    }
    /**
     * Define a Float type
     * @param string $column Name of the column
     */
    public function float($column) {
        return $this->addColumn('float', 'NUMERIC', $column);
    }
    /**
     * Save model
     */
    public function save() {
        $this->columns['id'] = [
            'def' => 'integer',
            'type' => 'INTEGER',
            'name' => 'id'
        ];
        $this->createTableSql = 'CREATE TABLE IF NOT EXISTS '. $this->table .'(';
        $this->createTableSql .= 'id INTEGER PRIMARY KEY,';
        /* for ($i = 0; $i < count($this->columns); $i++) {
            if ($i !== count($this->columns) - 1) {
                $this->createTableSql .= $this->columns[$i]['name'] ." ". $this->columns[$i]['type'] . ",";
            } else {
                $this->createTableSql .= $this->columns[$i]['name'] ." ". $this->columns[$i]['type'] .");";
            }
        } */
        foreach($this->columns as $column) {
            $this->createTableSql .= $column['name'] ." ". $column['type'] . ",";
        }
        $this->createTableSql .= 'createdAt INTEGER);';

        $this->db->exec($this->createTableSql);
        return $this->createTableSql;
    }
    /**
     * Get
     * 
     * Get the model
     */
    public function get () {
        $model = [];
        $model['id'] = null;
        foreach($this->columns as $col) {
            $model[$col['name']] = null;
        }
        return $model;
    }

    public function sanitize ($model) {
        $m = [];
        if (!$model) {
            return null;
        }
        foreach($model as $key => $value) {
            if ($this->columns[$key]['type'] == 'INTEGER') {
                $m[$key] = intval($model[$key]);
            } else {
                $m[$key] = $model[$key];
            }
        }
        return $m;
    }
    /**
     * Find
     * 
     * Find a model 
     * @param int $id Id of model
     * @return array Instance of model
     */
    public function find ($id) {
        $stmt = $this->db->prepare("SELECT * FROM $this->table WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $row = $stmt->fetch(\PDO::FETCH_ASSOC);
        return $this->model->sanitize($row);
    }
    
}