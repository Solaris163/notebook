<?php


namespace app\engine;

use app\models\Users;
use app\engine\VarDump;


/**
 * Класс рендерит страницу
 * Class Render
 * @package app\engine
 */
class Render
{
    /**
     * @var string Нижний шаблон странцы, куда будет добавляться содержимое
     */
    public $layout = 'layout.php';

    public $auth; //аутентифицирован ли пользователь
    public $login; //логин пользователя
    public $is_admin; //является ли пользователь администратором

    public function __construct($auth = null, $login = null, $is_admin = null){
        $this->auth = $auth;
        $this->login = $login;
        $this->is_admin = $is_admin;
    }


    /**
     * Метод рендерит шаблон
     * @param string $template Шаблон страницы
     * @param array $params Параметры с содержимым страницы
     * @return string
     */
    public function renderTemplate($template, $params = []) {
        ob_start();
        extract($params);

        $template = '../views/' . $template;
        include $template;
        return ob_get_clean();
    }

    /**
     * Метод дважды рендерит шаблон (рендерит нижний шаблон layout и передает ему в качестве пареметров отрендеренный
     * второй шаблон)
     * @param string $template Шаблон страницы
     * @param array $params Параметры с содержимым страницы
     * @return string
     */
    public function renderPage($template, $params = [], $layout = null) {
        if (!isset ($layout)) {
            $layout = $this->layout; //если лэйаут не задан, берется по умолчанию
        }
        return $this->renderTemplate(
            //$this->layout,
            $layout,
            [
                'content' => $this->renderTemplate($template, $params),
                'auth' => $this->auth, //аутентифицирован ли пользователь
                'login' => $this->login, //логин пользователя
                'is_admin' => $this->is_admin, //является ли пользователь админом
            ]
        );
    }
}