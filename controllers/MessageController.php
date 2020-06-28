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
    public function actionIndex($params){
        if ($this->is_admin){
            if (isset($params["id"])){ //если в гет параметрах задан id сообщения, получим сообщение из базы данных
                $message = Message::getOneRow(intval($params["id"]));
                $message['content'] = preg_replace( "/<br>/", "\n", $message['content']); //заменим <br> на переносы строк
            }
            $categoryes = Category::getAll(); //получим массив категорий для выбора категории добавляемого сообщения
            echo $this->render->renderPage('messageForm.php', ['categoryes' => $categoryes, 'message' => $message]);
        }else header("Location: /");
    }

    /**
     * Метод добавляет новое сообщение или изменяет существующее
     */
    public function actionAddMessage(){
        if ($this->is_admin){
            if (isset($_POST['send'])) {
                $id = $_POST['id'];
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
                
                $message = new Message($category_id, $content, $date, $id);
                $message->save();
            }
        }
        header("Location: /");
    }

}