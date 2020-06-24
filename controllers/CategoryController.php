<?php

namespace app\controllers;

use app\engine\Render;
use app\models\Users;
use app\models\Category;
use app\engine\VarDump;

/**
 * Class CategoryController
 * @package app\controllers
 * Класс выполняет
 */
class CategoryController extends Controller
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
     * Метод показывает страницу с формой для создания новой категории
     */
    public function actionIndex(){
        if ($this->is_admin){
            echo $this->render->renderPage('categoryForm.php');
        }else header("Location: /");
    }

    /**
     * Метод добавляет новую категорию
     */
    public function actionAddCategory(){
        if ($this->is_admin){
            if (isset($_POST['send'])) {
                $name = $_POST['name'];
                
                $category = new Category($name);
                $category->save();
            }
        }
        header("Location: /");
    }

}