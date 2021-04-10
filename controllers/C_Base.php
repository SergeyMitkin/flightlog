<?php
include_once('Controller.php');

// Контроллер базового шаблона
abstract class C_Base extends Controller
{
	protected $title;		// Заголовок страницы
	protected $content;		// Содержание страницы
    protected $login;       // Кнопка вход/выход
    protected $auth;        // Get-параметр для входа/выхода

	// Конструктор
	function __construct()
	{		
		$this->title = 'Журнал подготовки к полётам';
        $this->login = 'Войти';
        $this->auth = 'auth';
		$this->content = '';

        // Если пользователь залогинен меняем кнопки в меню
        if(isset($_SESSION['user'])){
            $this->login = 'Выйти';
            $this->auth = 'logout';
        }
	}

	// Подставляем переменные в базовый шаблон
	public function render()
	{
		$vars = array(
		    'title' => $this->title,
            'content' => $this->content,
            'login' => $this->login,
            'auth' => $this->auth
        );
		$page = $this->Template(VIEW_DIR . '/v_main.php', $vars);
		echo $page;
	}	
}
