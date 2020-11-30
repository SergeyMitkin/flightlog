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
        // Выводим по 6 упражнений в строке
        $ex_array_div = array_chunk($ex_array[$flight['id']], 6);
        echo '<table class="exercises-table"> Упражнения: ';
            for ($i=0; $i<count($ex_array_div); $i++){
                //print_r($ex_array_div[$i]);
                echo '<tr>';
                    echo '<td>Время</td>';
                    for ($in=0; $in<count($ex_array_div[$i]); $in++){
                        echo '<td>' . explode('+php+',$ex_array_div[$i][$in])[0] . '</td>';
                    }
                echo '</tr>';

                echo '<tr>';
                    echo '<td>УПР</td>';
                    for ($in=0; $in<count($ex_array_div[$i]); $in++){
                        echo '<td>' . explode('+php+',$ex_array_div[$i][$in])[1] . '</td>';
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


