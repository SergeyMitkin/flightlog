<?php
?>

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
<div id="row-tasks" class="row">
    <?php
    foreach($general_tasks as $task){
        ?><p class="general-task-item" data-sort-date="<?php echo substr($task['date'], 0, 7);?>"><?php echo $task['name'];?></p>
    <?php
    }
    ?>
</div>




