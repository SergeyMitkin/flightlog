<?php
// Подкулючаем файлы
include_once('C_Base.php'); // Контроллер базового шаблона
include_once ('../models/m_tasks.php'); // Модель основных задач
include_once ('../models/m_topics.php'); // Модель тем общей подготовки
include_once ('../models/m_flights.php'); // Модель полётов
include_once ('../models/m_authors.php'); // Модель таблицы "authors"
include_once ('../models/m_print_docx.php'); // Модель вывода файлов на печать

// Конттроллер страниц
class C_Page extends C_Base
{
	// Конструктор
	function __construct(){		
		parent::__construct();
	}

	// Метод генерации страницы общей подготовки к полётам
	public function action_generalTraining(){

	    // Сохраняем файл для печати
        if (isset($_POST['month-year'])){
            $month_year = $_POST['month-year'];  // Месяц
            $general_tasks = $_POST['general-task-item']; // Массив с общими задачами
            $aviation_topics = $_POST['aviation-topic-item']; // Массив с темами по авиации
            $aerodynamics_topics = $_POST['aerodynamics-topic-item']; // Массив с темами по аэродинамике
            $navigation_topics = $_POST['navigation-topic-item']; // Массив с темами по навигации
            $guidelines_topics = $_POST['guidelines-topic-item']; // Массив с руководящими документами
            $tactics_topics = $_POST['tactics-topic-item']; // Массив с темами по тактике

            $file_template = 'files/f_4465fad8d613a549.docx'; // Шаблон для вывода файла на печать
            $output_file = 'files/outputfile.docx'; // Сохраняемый файл
            // Выводим файл на печать
            printGTPage($file_template, $output_file, $month_year, $general_tasks, $aviation_topics,
                $aerodynamics_topics, $navigation_topics, $guidelines_topics, $tactics_topics);
        }

        // Добавляем основную задачу
        if (isset($_POST['task-name'])){

            $task_id = $_POST['task-id']; // Id задачи
            $task_name = $_POST['task-name']; // Имя задачи
            $description = $_POST['description']; // Описание
            $author_id = $_POST['author']; // Автор
            $date = $_POST['date']; // Дата

            setGeneralTask($task_id, $task_name, $description, $author_id, $date);

            // Дату определяем как дату добавленной задачи
            $current_year = substr($date, 0, 4);
            $current_month = substr($date, 5, 2);
        }

        // Добавляем тему общей подготовки
        if (isset($_POST['topic-name'])){
            $topic_id = $_POST['topic-id']; // Id
            $topic_name = $_POST['topic-name']; // Имя
            $description = $_POST['description']; // Описание
            $topic_type = $_POST['type']; // Тип
            $author_id = $_POST['author']; // Автор
            $date = $_POST['date']; // Дата
            setGeneralTopic($topic_id, $topic_name, $description, $topic_type, $author_id, $date);

            // Дату определяем как дату добавленной темы
            $current_year = substr($date, 0, 4);
            $current_month = substr($date, 5, 2);
        }

        // Удаляем задачу
        if (isset($_GET['task-delete'])){
            deleteTask($_GET['task-delete']);
        }

        // Удаляем тему
        if (isset($_GET['topic-delete'])){
            deleteTopic($_GET['topic-delete']);
        }

        // Переменные для селектов с выбором года и месяца
        $year_array = range(2000, 2050);
        $month_array = range(1,12);

        if (!isset($_POST['date'])){
            $current_year = date('Y');
            $current_month = date('m');
        }

        if (isset($_GET['year']) && isset($_GET['month']) && $_GET['send-form'] == 'off' && !isset($_POST['date'])){
            $current_year = $_GET['year'];
            $current_month = $_GET['month'];
        }

        // Подставляем название месяца
        $formatted_month_array = array(
            "01" => "Январь", "02" => "Февраль", "03" => "Март", "04" => "Апрель",
            "05" => "Май", "06" => "Июнь", "07" => "Июль", "08" => "Август",
            "09" => "Сентябрь", "10" => "Октябрь", "11" => "Ноябрь", "12" => "Декабрь",
        );

		$general_tasks = getGeneralTasks(); // Получаем основные задачи
		$aviation_technology_topics = getGeneralTopics('aviation_technology'); // Получаем темы по авиации
		$aerodynamics_topics = getGeneralTopics('aerodynamics'); // Получаем темы по аэродинамике
		$navigation_topics = getGeneralTopics('navigation'); // Получаем темы по навигации
		$guidelines_topics = getGeneralTopics('guidelines'); // Получаем руководящие документы
		$tactics_topics = getGeneralTopics('tactics'); // Получаем темы по тактике
		$authors = getAuthors(); // Авторы

        // Подставляем переменные в шаблон страницы
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

    // Метод генерации страницы подготовки к полётам
    public function action_training(){

	    // Получаем данные из формы для редактирования/создания или вывода на печать полёта
	    if (isset($_POST['flight-name'])){
	        $flight_print = $_POST['flight-print']; // Определяем выводим на печать или редактируем
	        $flight_id = $_POST['flight-id']; // Id полёта
            $flight_name = $_POST['flight-name']; // Имя
            $date = $_POST['flight-date']; // Дата
            $time_start = $_POST['time-start']; // Начало полётов
            $time_end = $_POST['time-end']; // Конец полётов
            $dawn_sunset = $_POST['dawn-sunset']; // Время суток
            $exercise = $_POST['exercise']; // Массив с упражнениями
            $crew = $_POST['crew']; // Массив с членами экипажа
            $individual_task = $_POST['individual-task']; // Индивидуальное задание
            $security_measures = $_POST['security-measures']; // Указания, меры безопасности
            $self_preparation_task = $_POST['self-preparation-task']; // Задание на самоподготовку
            $trainers = $_POST['trainers'];  // Тренажи
            $self_preparation = $_POST['self-preparation']; // Самоподготовка

            // Выводим документ полёта на печать
            if ($flight_print == "on"){
                $file_template = 'files/f_7785fad8d785225f.docx'; // Шаблон документа
                $output_file = 'files/outputfile.docx'; // Сохраняемый файл

                printFlight($file_template, $output_file, $date, $dawn_sunset, $time_start, $time_end,
                    $exercise, $crew, $individual_task, $security_measures, $self_preparation_task, $trainers, $self_preparation);
            } else {
                // Редактируем или создаём новый полёт
                setFlight($flight_id, $flight_name, $date, $time_start, $time_end, $dawn_sunset, $exercise, $crew,
                    $individual_task, $security_measures, $self_preparation_task, $trainers, $self_preparation);

                // Дату определяем как дату добавленного полёта
                $current_date = $date;
            }
        }

        // Переменные на странице
        $flights = getFlights(); // Полёты
	    $exercises = getFlightExercises(); // Упражнения
        $flights_crew = getFlightsCrew(); // Члены экипажей полётов
        $crew = getCrew(); // Данные таблицы членов экипжей

        // Если нет параметров с датой, устанавливаем ткущую дату
        if (!isset($_POST['flight-date'])){
            $current_date = date('Y-m-d'); // Дата
        }

        // Если есть гет-параметр с датой, устанавливаем, передаём её в шаблон
        if (isset($_GET['calendar-date']) && $_GET['send-form'] == 'off' && !isset($_POST['flight-date'])){
            $current_date = $_GET['calendar-date'];
        }

        // Подставляем переменные в шаблон страницы
        $this->content = $this->Template(VIEW_DIR . '/v_training.php', array(
                'date' => $current_date,
                'crew' => $crew,
                'flights' => $flights,
                'exercises' => $exercises,
                'flights_crew' => $flights_crew
            )
        );
    }

    public function action_authors(){

	    // Создаём/редактируем автора
	    if (isset($_POST['author-name'])){
	        $author_id = $_POST['author-id'];
	        $author_name = $_POST['author-name'];
	        setAuthor($author_id, $author_name);
        }

        // Удаляем автора
        if (isset($_GET['author-delete'])){
            deleteAuthor($_GET['author-delete']);
        }

        $authors = getAuthors(); // Данные таблицы "authors"

        // Подставляем переменные в шаблон страницы
        $this->content = $this->Template(VIEW_DIR . '/v_authors.php', array(
                'authors' => $authors,
            )
        );
    }
}
