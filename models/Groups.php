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
    
    public function __construct
    (
        $name = null,
        $is_admin = null,
        $description = null
    )
    {
        $this->name = $name;
        $this->is_admin = $is_admin;
        $this->description = $description;
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
            'description'=>$this->description
        ];
    }
}