<?php

namespace app\models;

use app\engine\Db;
use app\engine\VarDump;


/**
 * Класс отвечает за работу с таблицей category базы данных и обработку данных из этой таблицы
 * Class Category
 * @package app\models
 */
class Category extends Model
{
    public $id;
    public $name;
    
    public function __construct($name = null)
    {
        $this->name = $name;
    }

    /**
     * Метод возвращает название таблицы, которая в базе данных соответствует данному классу
     */
    public static function getTableName()
    {
        return "category";
    }

    public function getProperties() {
        return [
            'name'=>$this->name,
        ];
    }

    /**
     * Метод находит и отдает из базы все категории
     */
    public static function getAll() {
        $tableName = static::getTableName();
        $sql = "SELECT * FROM {$tableName}";
        return Db::getInstance()->queryAll($sql);
    }   
}