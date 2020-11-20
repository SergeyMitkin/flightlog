<?php
?>

<h2>Основные задачи на месяц</h2>

<div id="task-calendar-div">

    <button id="task-button-back"><</button>

    <!-- выводим выпадающий список -->
    <select class="general-task-select" id="month-task-select" name="month">
        <?php
        foreach ($month_array as $month) {
            // Изначально выбран текущий месяц
            $selected = ($month == $current_month) ? 'selected' : '';
            $month = str_pad($month, 2, "0", STR_PAD_LEFT);
            echo '<option '.$selected.' value="'.$month.'">'.$formatted_month_array[$month].'</option>';
        }
        ?>
    </select>

    <!-- выводим выпадающий список -->
    <select class="general-task-select" id="year-task-select" name="year">
        <?php
        foreach ($year_array as $year) {
            // Изначально выбран текущий год
            $selected = ($year == $current_year) ? 'selected' : '';
            echo '<option '.$selected.' value="'.$year.'">'.$year.'</option>';
        }
        ?>
    </select>

    <button id="task-button-forward">></button>
</div>

<!-- Выводим основные задачи -->
<div id="row-tasks" class="row-tasks-and-topics">
    <?php
    foreach($general_tasks as $task){
        ?><div class="task-or-topic-item" data-sort-date="<?php echo substr($task['date'], 0, 7);?>">
            <h4><?php echo $task['task_name'];?></h4>
            <p><?php echo $task['description']?></p>
            <p>Автор: <?php echo $task['author_name']?></p>
            <p>Дата: <?php echo $task['date']?></p>
        </div>
    <?php
    }
    ?>
</div>

<div id="div-task-create-form" class="div-edit-form" hidden>
    <form role="form" action="" method="post" class="form-horizontal" id="task-create-form">

        <div class="form-group">
            <label for="task-name">Введите название задачи</label>
            <input required type="text" class="form-control" id="task-title-input"
                   placeholder="Название задачи" name="task-name">
        </div>

        <div class="form-group">
            <label for="description">Введите описание задачи</label>
            <textarea class="form-control" id="task-description-textarea" name="description"
                      placeholder="Описание задачи">
            </textarea>
        </div>

        <div class="form-group">
            <label for="">Выберите автора</label>
            <select required id="task-author-select" name="author">
                <?php
                foreach ($authors as $author) {
                    echo '<option value="' . $author['id'] . '">'
                        . $author['name'] . '</option>';
                }
                ?>
            </select>
        </div>

        <div class="form-group">
            <label for="date">Введите дату: </label>
            <input class="form-control" type="date" id="task-date-input" name="date" required/>
        </div>

        <div class="form-footer">
            <button id="task-create-submit-button" type="submit" class="button">Отправить</button>
        </div>
    </form>
</div>

<div id="div-task-create-button">
    <button type="button" class="btn" id="task-create-form-button">Создать задачу</button>
</div>

<!-- Выводим темы общей подготовки -->
<h2>Темы общей подготовки:</h2>
<h3>Авиационная техника:</h3>
<div id="row-topics-aviation-technology" class="row-tasks-and-topics">
    <?php
    foreach($aviation_technology_topics as $topic){
        ?><div class="task-or-topic-item" data-sort-date="<?php echo substr($topic['date'], 0, 7);?>">
            <h4><?php echo $topic['topic_name'];?></h4>
            <p><?php echo $topic['description']?></p>
            <p>Автор: <?php echo $topic['author_name']?></p>
            <p>Дата: <?php echo $topic['date']?></p>
        </div>
        <?php
    }
    ?>
</div>

<h3>Аэродинамика:</h3>
<div id="row-topics-aerodynamics" class="row-tasks-and-topics">
    <?php
    foreach($aerodynamics_topics as $topic){
        ?><div class="task-or-topic-item" data-sort-date="<?php echo substr($topic['date'], 0, 7);?>">
            <h4><?php echo $topic['topic_name'];?></h4>
            <p><?php echo $topic['description']?></p>
            <p>Автор: <?php echo $topic['author_name']?></p>
            <p>Дата: <?php echo $topic['date']?></p>
        </div>
        <?php
    }
    ?>
</div>

<h3>Навигация:</h3>
<div id="row-topics-navigation" class="row-tasks-and-topics">
    <?php
    foreach($navigation_topics as $topic){
        ?><div class="task-or-topic-item" data-sort-date="<?php echo substr($topic['date'], 0, 7);?>">
        <h4><?php echo $topic['topic_name'];?></h4>
        <p><?php echo $topic['description']?></p>
        <p>Автор: <?php echo $topic['author_name']?></p>
        <p>Дата: <?php echo $topic['date']?></p>
        </div>
        <?php
    }
    ?>
</div>

<h3>Руководящие документы:</h3>
<div id="row-topics-guidelines" class="row-tasks-and-topics">
    <?php
    foreach($guidelines_topics as $topic){
        ?><div class="task-or-topic-item" data-sort-date="<?php echo substr($topic['date'], 0, 7);?>">
        <h4><?php echo $topic['topic_name'];?></h4>
        <p><?php echo $topic['description']?></p>
        <p>Автор: <?php echo $topic['author_name']?></p>
        <p>Дата: <?php echo $topic['date']?></p>
        </div>
        <?php
    }
    ?>
</div>

<h3>Тактика:</h3>
<div id="row-topics-tactics" class="row-tasks-and-topics">
    <?php
    foreach($tactics_topics as $topic){
        ?><div class="task-or-topic-item" data-sort-date="<?php echo substr($topic['date'], 0, 7);?>">
        <h4><?php echo $topic['topic_name'];?></h4>
        <p><?php echo $topic['description']?></p>
        <p>Автор: <?php echo $topic['author_name']?></p>
        <p>Дата: <?php echo $topic['date']?></p>
        </div>
        <?php
    }
    ?>
</div>

<div id="div-topic-create-form" class="div-edit-form" hidden>
    <form role="form" action="" method="post" class="form-horizontal" id="topic-create-form">

        <div class="form-group">
            <label for="topic-name">Введите название темы</label>
            <input required type="text" class="form-control" id="topic-title-input"
                   placeholder="Название темы" name="topic-name">
        </div>

        <div class="form-group">
            <label for="description">Введите описание темы</label>
            <textarea class="form-control" id="topic-description-textarea" name="description"
                      placeholder="Описание задачи">
            </textarea>
        </div>

        <div class="form-group">
            <label for="">Выберите тип</label>
            <select required id="topic-type-select" name="type">
                <option value="aviation_technology">Авиационная техника</option>
                <option value="aerodynamics">Аэродинамика</option>
                <option value="navigation">Навигация</option>
                <option value="guidelines">Руководящие докуиенты</option>
                <option value="tactics">Тактика</option>
            </select>
        </div>

        <div class="form-group">
            <label for="">Выберите автора</label>
            <select required id="task-author-select" name="author">
                <?php
                foreach ($authors as $author) {
                    echo '<option value="' . $author['id'] . '">'
                        . $author['name'] . '</option>';
                }
                ?>
            </select>
        </div>

        <div class="form-group">
            <label for="date">Введите дату: </label>
            <input class="form-control" type="date" id="task-date-input" name="date" required/>
        </div>

        <div class="form-footer">
            <button id="task-create-submit-button" type="submit" class="button">Отправить</button>
        </div>
    </form>
</div>

<div id="div-topic-create-button">
    <button type="button" class="btn" id="topic-create-form-button">Создать тему</button>
</div>



