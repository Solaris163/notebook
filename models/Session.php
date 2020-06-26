<?php

namespace app\models;

use app\engine\Db;
use app\engine\VarDump;


/**
 * Класс отвечает за работу с таблицей session базы данных и обработку данных из этой таблицы
 * Class Session
 * @package app\models
 */
class Session extends Model
{
    public $id;
    public $user_id;
    public $hash;
    
    public function __construct($user_id = null, $hash = null)
    {
        $this->user_id = $user_id;
        $this->hash = $hash;
    }

    /**
     * Метод возвращает название таблицы, которая в базе данных соответствует данному классу
     */
    public static function getTableName()
    {
        return "session";
    }

    public function getProperties() {
        return [
            'user_id'=>$this->user_id,
            'hash'=>$this->hash,
        ];
    }

    /**
     * Метод удаляет из таблицы строку, в которой хеш равен заданному
     */
    public static function deleteByHash($hash) {
        $tableName = static::getTableName();
        $sql = "DELETE FROM {$tableName} WHERE hash = :value";
        Db::getInstance()->execute($sql, [':value' => $hash]);
    }
}