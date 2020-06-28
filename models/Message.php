<?php

namespace app\models;

use app\engine\Db;
use app\engine\VarDump;
use app\models\Category;


/**
 * Класс отвечает за работу с таблицей message базы данных и обработку данных из этой таблицы
 * Class Message
 * @package app\models
 */
class Message extends Model
{
    public $id;
    public $category_id;
    public $content;
    public $date;
    
    public function __construct
    (
        $category_id = null,
        $content = null,
        $date = null,
        $id = null
    )
    {
        $this->category_id = $category_id;
        $this->content = $content;
        $this->date = $date;
        $this->id = $id;
    }

    /**
     * Метод возвращает название таблицы, которая в базе данных соответствует данному классу
     */
    public static function getTableName()
    {
        return "message";
    }

    public function getProperties() {
        return [
            'id'=>$this->id,
            'category_id'=>$this->category_id,
            'content'=>$this->content,
            'date'=>$this->date,
        ];
    }

    /**
     * Метод находит и отдает из базы сообщения с заданной категорией сортируя по дате
     */
    public static function getByCategory_id($category_id) {
        $tableName = static::getTableName();
        $sql = "SELECT * FROM {$tableName} WHERE category_id = :value ORDER BY date DESC";
        //VarDump::varDump($sql);
        return Db::getInstance()->queryAll($sql, [':value'=>$category_id]);
    }

    /**
     * Метод находит и отдает из базы все сообщения сортируя по дате
     */
    public static function getAll() {
        $tableName = static::getTableName();
        $sql = "SELECT * FROM {$tableName} ORDER BY date DESC";
        return Db::getInstance()->queryAll($sql);
    }
}