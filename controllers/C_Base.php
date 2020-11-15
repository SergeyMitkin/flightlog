<?php
include_once('Controller.php');

// Базовый контроллер сайта

abstract class C_Base extends Controller
{
	protected $title;		// заголовок страницы
	protected $content;		// содержание страницы

	//
	// Конструктор.
	//
	function __construct()
	{		
		$this->title = 'Журнал подготовки к полетам беспилотной авиационной системы';
		$this->content = '';
	}

	// Генерация базового шаблонаы
	public function render()
	{
		$vars = array('title' => $this->title, 'content' => $this->content);	
		$page = $this->Template('../views/main.php', $vars);
		echo $page;
	}	
}
