<?php
include_once('Controller.php');

// Контроллер базового шаблона
abstract class C_Base extends Controller
{
	protected $title;		// заголовок страницы
	protected $content;		// содержание страницы

	//
	// Конструктор.
	//
	function __construct()
	{		
		$this->title = 'Журнал подготовки к полётам беспилотной авиационной системы';
		$this->content = '';
	}

	// Подставляем переменные в базовый шаблон
	public function render()
	{
		$vars = array('title' => $this->title, 'content' => $this->content);	
		$page = $this->Template('../views/v_main.php', $vars);
		echo $page;
	}	
}
