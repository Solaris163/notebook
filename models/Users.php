<?php

namespace app\models;

use app\engine\Db;
use app\engine\VarDump;


/**
 * Класс отвечает за работу с таблицей users базы данных и обработку данных из этой таблицы
 * Class Users
 * @package app\models
 */
class Users extends Model
{
    public $id;
    public $login;
    public $pass;
    
    public function __construct
    (
        $login = null,
        $pass = null
    )
    {
        $this->login = $login;
        $this->pass = $pass;
    }

    /**
     * Метод возвращает название таблицы, которая в базе данных соответствует данному классу
     */
    public static function getTableName()
    {
        return "users";
    }

    public function getProperties() {
        return [
            'login'=>$this->login,
            'pass'=>$this->pass,
        ];
    }

    /**
     * Метод проверяет есть ли пользователь в сессии если есть возвращает true,
     * если нет, проверяет есть ли хеш в cookie, если есть то записывает пользователя в сессию
     */
    public static function isAuth(){
        if (isset($_SESSION['login'])) { //проверяем, есть ли в сессии логин пользователя
            return true;
        } elseif (isset($_COOKIE['hash'])) { //проверяем, есть ли в COOKIE хеш
            $hash = $_COOKIE['hash'];
            //поверим, есть ли в таблице сессий такой хеш,
            //найдем в таблице пользователей пользователя, которому принадлежит этот хеш,
            //найдем в таблице structure группы этого пользователя и
            //проверим, обладают ли эти группы правами администратора
            $sql = "SELECT users.login, groups.id as group_id, groups.is_admin FROM users
            LEFT JOIN session ON session.user_id = users.id
            LEFT JOIN structure ON users.id = structure.user_id
            LEFT JOIN groups ON structure.group_id = groups.id
            WHERE session.hash = '{$hash}';";
            $resultArr = Db::getInstance()->queryAll($sql);
            //VarDump::varDump($resultArr);

            if(!empty($resultArr)) { //проверяем нашелся ли пользователь в базе.
                $_SESSION['login'] = $resultArr[0]["login"]; //записываем в сессию логин пользователя
                //Переберем массив $resultArr, и получим массив групп, в которые входит пользователь
                //Также перебирая массив, проверим, является ли хоть одна из групп административной
                $groupsArr = []; //массив групп пользователя
                $is_admin = false;
                foreach ($resultArr as $result) {
                    $groupsArr[] = $result["group_id"];
                    if ($result["is_admin"] === '1') {$is_admin = true;}
                }
                $_SESSION['is_admin'] = $is_admin; //запишем в сессию является ли пользователь администратором
                return true;
            } else return false;
        } else return false;
    }

    public static function isAdmin() {
        return $_SESSION['is_admin'];
    }

    public static function getLogin() {
        return $_SESSION['login'];
    }
}