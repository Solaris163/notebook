<?php

namespace app\controllers;

use app\engine\Render;
use app\models\Users;
use app\models\Message;
use app\models\Category;
use app\engine\VarDump;

/**
 * Class MessageController
 * @package app\controllers
 * Класс выполняет
 */
class MessageController extends Controller
{
    /**
     * @var Render
     */
    public $render;

    /**
     * MessageController constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->render = new Render($this->auth, $this->login, $this->is_admin); //создадим экземпляр класса Render для рендеринга страниц
    }




    /**
     * Метод показывает страницу с формой для сообщения
     */
    public function actionIndex(){
        if ($this->is_admin){
            $categoryes = Category::getAll(); //получим массив категорий для выбора категории добавляемого сообщения
            echo $this->render->renderPage('messageForm.php', ['categoryes' => $categoryes]);
        }else header("Location: /");
    }

    /**
     * Метод добавляет новое сообщение
     */
    public function actionAddMessage(){
        if ($this->is_admin){
            if (isset($_POST['send'])) {
                $category_id = $_POST['category_id'];
                $content = $_POST['content'];
                $date = $_POST['date'];
                $date = date("Y-m-d", strtotime($_POST['date']));
                if ($date == '1970-01-01') { //проверка, если стоит дата по умолчанию
                    echo 'Вы не выбрали дату';
                    exit();
                }
                //VarDump::varDump($date);
                $content = preg_replace( "#\r?\n#", "<br>", $content); //заменим переносы строк на <br>
                
                $message = new Message($category_id, $content, $date);
                $message->save();
            }
        }
        header("Location: /");
    }

}