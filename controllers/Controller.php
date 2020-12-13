<?php

// Базовый класс контроллера

abstract class Controller
{
	// Генерация основного шаблона
	abstract function render();

	// Запрос произведен методом GET?
	protected function IsGet()
	{
		return $_SERVER['REQUEST_METHOD'] == 'GET';
	}

	// Запрос произведен методом POST?
	protected function IsPost()
	{
		return $_SERVER['REQUEST_METHOD'] == 'POST';
	}

	// Метод подставновки переменных в HTML шаблон
	protected function Template($fileName, $vars = array())
	{
		// Установка переменных для шаблона.
		foreach ($vars as $k => $v)
		{
			$$k = $v;
		}

		// Выводим шаблон на экран.
		ob_start();
		include "$fileName";
		return ob_get_clean();	
	}	
	
	// Если вызвали метод, которого нет - завершаем работу
	public function __call($name, $params){
        //die('Такого url-адреса не существует!');
	}
}
