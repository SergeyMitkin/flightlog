<?php

include_once('C_Base.php');
include_once ('../models/m_tasks.php');
include_once ('../models/m_topics.php');
include_once ('../models/m_authors.php');
include_once ('../models/m_print_docx.php');

// Конттроллер страниц

class C_Page extends C_Base
{
	// Конструктор
	function __construct(){		
		parent::__construct();
	}
	
	public function action_generalTraining(){

	    //saveDocx();

       if (isset($_POST['task-name'])){
           $task_name = $_POST['task-name'];
           $description = $_POST['description'];
           $author_id = $_POST['author'];
           $date = $_POST['date'];
           setGeneralTask($task_name, $description, $author_id, $date);
       }

        if (isset($_POST['topic-name'])){
            $topic_name = $_POST['topic-name'];
            $description = $_POST['description'];
            $topic_type = $_POST['type'];
            $author_id = $_POST['author'];
            $date = $_POST['date'];
            setGeneralTopic($topic_name, $description, $topic_type, $author_id, $date);
        }

        $year_array = range(2000, 2050);
        $current_year = date('Y');
        $month_array = range(1,12);
        $formatted_month_array = array(
            "01" => "Январь", "02" => "Февраль", "03" => "Март", "04" => "Апрель",
            "05" => "Май", "06" => "Июнь", "07" => "Июль", "08" => "Август",
            "09" => "Сентябрь", "10" => "Октябрь", "11" => "Ноябрь", "12" => "Декабрь",
        );
        $current_month = date('m');
		$general_tasks = getGeneralTasks();
		$aviation_technology_topics = getGeneralTopics('aviation_technology');
		$aerodynamics_topics = getGeneralTopics('aerodynamics');
		$navigation_topics = getGeneralTopics('navigation');
		$guidelines_topics = getGeneralTopics('guidelines');
		$tactics_topics = getGeneralTopics('tactics');
		$authors = getAuthors();

		$this->content = $this->Template(VIEW_DIR . '/v_general_training.php', array(
		        'year_array' => $year_array,
                'current_year' => $current_year,
                'month_array' => $month_array,
                'formatted_month_array' => $formatted_month_array,
                'current_month' => $current_month,
                'general_tasks' => $general_tasks,
                'aviation_technology_topics' => $aviation_technology_topics,
                'aerodynamics_topics' => $aerodynamics_topics,
                'navigation_topics' => $navigation_topics,
                'guidelines_topics' => $guidelines_topics,
                'tactics_topics' => $tactics_topics,
                'authors' => $authors
            )
        );
	}

    public function action_training(){

        $this->title .= '';
        $text = 'training';
        $this->content = $this->Template(VIEW_DIR . '/v_training.php', array('text' => $text));
    }
}
