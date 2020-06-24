<?php

namespace app\controllers;

use app\engine\Render;
use app\models\Users;
use app\engine\VarDump;

/**
 * Class UserController
 * @package app\controllers
 * Класс выполняет авторизацию пользователя
 */
class UserController extends Controller
{
    /**
     * @var Render
     */
    public $render;

    /**
     * UserController constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->render = new Render($this->auth, $this->login, $this->is_admin); //создадим экземпляр класса Render для рендеринга страниц
    }

    /**
     * Метод проверяет был ли послан запрос на авторизацию и делает аутентификацию пользователя
     */
    public function actionLogin() {
        if (isset($_POST['send'])) {
            $login = $_POST['login'];
            $pass = $_POST['pass'];
            $user = Users::getOneWhere('login', $login);
            if (!(password_verify($pass, $user->pass))) { //функция password_verify() сравнивает пользовательский пароль и хеш, записанный в базе данных
                Die('Не верный логин пароль');
            } else {
                $_SESSION['login'] = $user->login; //записывает в сессию логин пользователя из базы
                if (isset($_POST['save'])) { //проверка выбран ли чек-бокс "запомнить"
                    $hash = uniqid(rand(), true); //генерирование произвольного значения
                    $user->hash = $hash; //присваиваем свойству $hash объекта $user новое значение $hash
                    $user->save(); //обновляем объект в таблице (метод save() или сохраняет или обновляет)
                    setcookie("hash", $hash, time() + 3600, "/"); //запишем хеш в cookie
                }
            }
        }
        header("Location: /");
    }

    /**
     * Метод реализует разлогинивание
     */
    public function actionLogout() {
        unset($_SESSION['login']);
        setcookie("hash", null, -1, "/");
        header("Location: /");
    }

    /**
     * Метод показывает страницу с формой для авторизации
     */
    public function actionLoginForm(){
        echo $this->render->renderPage('loginForm.php', []);
    }
}