<?php

include_once('C_Base.php');
include_once ('../models/m_tasks.php');
include_once ('../models/m_flights.php');
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

       if (isset($_POST['month-year'])){
           $month_year = $_POST['month-year'];

           $general_tasks = $_POST['general-task-item'];
           $aviation_topics = $_POST['aviation-topic-item'];
           $aerodynamics_topics = $_POST['aerodynamics-topic-item'];
           $navigation_topics = $_POST['navigation-topic-item'];
           $guidelines_topics = $_POST['guidelines-topic-item'];
           $tactics_topics = $_POST['tactics-topic-item'];

           $file_template = 'files/f_4465fad8d613a549.docx';
           $output_file = 'files/outputfile.docx';
           editDocx($file_template, $output_file, $month_year, $general_tasks, $aviation_topics,
               $aerodynamics_topics, $navigation_topics, $guidelines_topics, $tactics_topics);
       }

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


	    if (isset($_POST['flight-name'])){

	        $flight_id = $_POST['flight-id'];
            $flight_name = $_POST['flight-name'];
            $date = $_POST['flight-date'];
            $time_start = $_POST['time-start'];
            $time_end = $_POST['time-end'];
            $dawn_sunset = $_POST['dawn-sunset'];
            $exercise = $_POST['exercise'];
            $crew = $_POST['crew'];
            $individual_task = $_POST['individual-task'];
            $security_measures = $_POST['security-measures'];
            $self_preparation_task = $_POST['self-preparation-task'];
            $trainers = $_POST['trainers'];
            $self_preparation = $_POST['self-preparation'];

            setFlight($flight_id, $flight_name, $date, $time_start, $time_end, $dawn_sunset, $exercise, $crew,
                $individual_task, $security_measures, $self_preparation_task, $trainers, $self_preparation);
        }

        $flights = getFlights();
	    $exercises = getFlightExercises();
        $flights_crew = getFlightsCrew();
        $date = date('Y-m-d');
        $crew = getCrew();

        $this->content = $this->Template(VIEW_DIR . '/v_training.php', array(
                'date' => $date,
                'crew' => $crew,
                'flights' => $flights,
                'exercises' => $exercises,
                'flights_crew' => $flights_crew
            )
        );
    }
}
