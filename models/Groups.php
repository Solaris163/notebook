<?php

namespace app\models;

use app\engine\Db;
use app\engine\VarDump;


class Groups extends Model
{
    public $id;
    public $name;
    public $is_admin;
    public $description;
    public $create_date;
    public $start_date;
    public $end_date;
    public $change_date;
    public $is_delete;
    
    public function __construct
    (
        $name = null,
        $is_admin = null,
        $description = null,
        $create_date = null,
        $start_date = null,
        $end_date = null,
        $change_date = null,
        $is_delete = null
    )
    {
        $this->name = $name;
        $this->is_admin = $is_admin;
        $this->description = $description;
        $this->create_date = $create_date;
        $this->start_date = $start_date;
        $this->end_date = $end_date;
        $this->change_date = $change_date;
        $this->is_delete = $is_delete;
    }

    /**
     * Метод возвращает название таблицы, которая в базе данных соответствует данному классу
     */
    public static function getTableName()
    {
        return "groups";
    }

    public function getProperties() {
        return [
            'name'=>$this->name,
            'is_admin'=>$this->is_admin,
            'description'=>$this->description,
            'create_date'=>$this->create_date,
            'start_date'=>$this->start_date,
            'end_date'=>$this->end_date,
            'change_date'=>$this->change_date,
            'is_delete'=>$this->is_delete
        ];
    }

    

}