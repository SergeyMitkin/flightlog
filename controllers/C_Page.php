<?php

// include_once('inc/model.php');
include_once('C_Base.php');

// Конттроллер страниц

class C_Page extends C_Base
{
	// Конструктор
	function __construct(){		
		parent::__construct();
	}
	
	public function action_generalTraining(){

		$this->title .= '';
		$text = 'general training';
		$this->content = $this->Template(VIEW_DIR . '/general_training.php', array('text' => $text));
	}

    public function action_training(){

        $this->title .= '';
        $text = 'training';
        $this->content = $this->Template(VIEW_DIR . '/training.php', array('text' => $text));
    }
}
