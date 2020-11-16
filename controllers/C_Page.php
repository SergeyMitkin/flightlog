<?php

// include_once('inc/model.php');
include_once('C_Base.php');
include_once ('../models/m_tasks.php');

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
		$general_tasks = getGeneralTasks();
		$tasks_count = count($general_tasks);
		$this->content = $this->Template(VIEW_DIR . '/general_training.php', array(
		        'text' => $text,
                'general_tasks' => $general_tasks,
            )
        );
	}

    public function action_training(){

        $this->title .= '';
        $text = 'training';
        $this->content = $this->Template(VIEW_DIR . '/training.php', array('text' => $text));
    }
}
