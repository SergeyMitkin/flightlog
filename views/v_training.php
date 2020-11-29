<?php
?>

<h1>Подготовка к полётам</h1>

<div id="flight-calendar-div">
    <button id="flight-button-back"><</button>
    <input id="training-calendar" type="date" value="<?php echo $date?>">
    <button id="flight-button-forward">></button>
</div>

<!-- Выводим полёты -->
<h2 id="flights-title">Полёты на </h2>
<div id="row-flights" class="row-flights">
    <?php
    foreach($flights as $flight){
        ?><div class="row-item" id="flight-item_<?php echo $flight['id']?>" data-sort-date="<?php echo $flight['date']?>">
            <h4><?php echo $flight['name'];?></h4>
            <p>Дата: <?php echo $flight['date']?></p>
            <p>Начало полётов: <?php echo $flight['time_start']?></p>
            <p>Конец полётов: <?php echo $flight['time_end']?></p>
            <p>Время суток: <?php echo $flight['dawn_sunset']?></p>

        <?php

        $ex_array[$flight['id']] = array();
        for ($i=0; $i<count($exercises); $i++) {

            if ($exercises[$i]['flight_id'] == $flight['id']) {
               array_push($ex_array[$flight['id']], $exercises[$i]['name'] . '+php+' .  $exercises[$i]['time']);
            }
        }

        $rows = 2;

        echo '<table border="1"> Упражнения: ';

        for ($tr=1; $tr<=$rows; $tr++){ // в этом цикле счётчик $tr
            // следит за количеством строк и всегда равен текущему номеру строки.
            // То есть в начале $tr=1, так как в начале у нас 1 строка, затем
            // каждый раз прибавляем единицу, пока не дойдём до заданного количества
            // $rows.
            echo '<tr>';
            for ($td=1; $td<=count($ex_array[$flight['id']])+1; $td++){ // в этом цикле счётчик $td аналогичен
                // счётчику $tr.
                if ($tr == 1 && $td ==1){
                    echo '<td>Время</td>';
                } if ($tr == 2 && $td == 1){
                    echo '<td>УПР</td>';
                }
                else if (($tr % 2) != 0 && $td != count($ex_array[$flight['id']])+1){
                    echo '<td>'. explode('+php+', $ex_array[$flight['id']][$td-1])[1] .'</td>';
                }
                else if (($tr % 2) == 0){
                    echo '<td>'. explode('+php+', $ex_array[$flight['id']][$td-2])[0].'</td>';
                }
            }
            echo '</tr>';
        }
        echo '</table>';


        ?>

        <div>Экипаж:
                <ol>
                    <?
                    for ($i=0; $i<count($flights_crew); $i++){
                        if ($flights_crew[$i]['flight_id'] == $flight['id']){
                            echo '<li>' . $flights_crew[$i]['name'] . '</li>';
                        }
                    }
                    ?>
                </ol>
            </div>
            <button class="flight-edit-button" id="flight-edit-button_<?php echo $flight['id']?>">Редактировать</button>
        </div>
        <?php
    }
    ?>
</div>

<!-- Форма создания/редактирования полёта -->
<div id="flight-create-div" hidden>
    <form role="form" action="" method="post" class="form-horizontal" id="flight-create-form">

        <!-- В скрытый инпут помещаем id полёта при редактировании, при создании id полёта = 0 -->
        <input type="hidden" id="form-create-task_id" name="id" value="0">

        <div class="form-group">
            <label for="flight-name-input">Название: </label>
            <input required id="flight-name-input" class="form-control" name="flight-name" value="">
        </div>

        <div class="form-group">
            <label for="flight-date-input">Полёты: </label>
            <input required class="form-control" value="<?php echo $date ?>" type="date" id="flight-date-input" name="flight-date">
        </div>

        <div class="form-group">
            <label for="flight-start">Начало полётов: </label>
            <input required type="time" id="flight-start" name="time-start" value=""/>

            <label for="flight-end">Конец полётов: </label>
            <input required type="time" id="flight-end" name="time-end" value=""/>
        </div>

        <div class="form-group">
            <p><input required name="dawn-sunset" type="radio" value="Рассвет">Рассвет
            <input required name="dawn-sunset" type="radio" value="Закат">Закат</p>
        </div>

        <div class="form-group" id="flight-exercises-row"></div>

        <div id="div-flight-exercise-button">
            <button type="button" class="btn" id="add-flight-exercise-button">Добавить упражнение</button>
        </div>

        <div class="form-group">
            <label for="flight-crew-select">Выберите членов экипажа</label>
            <br>
            <select required id="flight-crew-select" name="crew[]" multiple size="3">
                <?php
                foreach ($crew as $crew_member) {
                    echo '<option value="' . $crew_member['id'] . '">'
                        . $crew_member['name'] . '</option>';
                }
                ?>
            </select>
        </div>

        <div class="form-footer">
            <button id="task-create-submit-button" type="submit" class="button">Отправить</button>
        </div>
    </form>
</div>

<div id="div-flight-create-button">
    <button type="button" class="btn" id="task-create-form-button">Добавить полёт</button>
</div>

<script src="../js/training_page.js"></script>
<script src="../js/t_calendar.js"></script>
<script src="../js/flight_edit.js"></script>


