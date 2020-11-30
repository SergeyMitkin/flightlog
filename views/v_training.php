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
            <h3 class="flight-title"><?php echo $flight['name'];?></h3>
            <p>Дата: <span class="flight-date"><?php echo $flight['date']?></span></p>
            <p>Начало полётов: <span class="flight-time-start"><?php echo substr($flight['time_start'], 0, 5)?></span></p>
            <p>Конец полётов: <span class="flight-time-end"><?php echo substr($flight['time_end'], 0, 5)?></span></p>
            <p>Время суток: <span><?php echo $flight['dawn_sunset']?></span></p>

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

            <div class="flight-crew-div">Экипаж:
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

            <div>
                <h2>Индивидуальное задание по запланированным полетным заданиям:</h2>
                <p><?php echo $flight['individual_task'] ?></p>
            </div>

            <div>
                <h2>Указания, меры безопасности:</h2>
                <p><?php echo $flight['security_measures'] ?></p>
            </div>

            <div>
                <h2>Задание на самоподготовку:</h2>
                <p><?php echo $flight['self_preparation_task'] ?></p>
            </div>

            <div>
                <h2>Тренажи:</h2>
                <p><?php echo $flight['trainers'] ?></p>
            </div>

            <div>
                <h2>Самостоятельная подготовка:</h2>
                <p><?php echo $flight['self_preparation'] ?></p>
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
        <input type="hidden" id="form-create-task_id" name="flight_id" value="0">

        <div class="form-group">
            <label for="flight-name-input">Название: </label>
            <input required id="flight-name-input" class="form-control" name="flight-name" value="">
        </div>

        <div class="form-group">
            <label for="flight-date-input">Дата: </label>
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

        <div class="form-group">
            <label for="individual-task-textarea">Индивидуальное задание по запланированным полетным заданиям:</label>
            <textarea id="individual-task-textarea" name="individual-task" placeholder="Индивидуальное задание по запланированным полетным заданиям"></textarea>
        </div>

        <div class="form-group">
            <label for="security-measures-textarea">Указания, меры безопасности:</label>
            <textarea id="security-measures-textarea" name="security-measures" placeholder="Указания, меры безопасности"></textarea>
        </div>

        <div class="form-group">
            <label for="self-preparation-task-textarea">Задание на самоподготовку:</label>
            <textarea id="self-preparation-task-textarea" name="self-preparation-task" placeholder="Задание на самоподготовку"></textarea>
        </div>

        <div class="form-group">
            <label for="trainers-textarea">Тренажи:</label>
            <textarea id="trainers-textarea" name="trainers" placeholder="Тренажи"></textarea>
        </div>

        <div class="form-group">
            <label for="self-preparation-textarea">Самостоятельная подготовка:</label>
            <textarea id="self-preparation-textarea" name="self-preparation" placeholder="Самостоятельная подготовка"></textarea>
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


