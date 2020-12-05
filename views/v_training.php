<?php
?>

<!-- Шаблон страницы подготовки к полётам -->

<h1>Подготовка к полётам</h1>

<!-- Календарь -->
<div id="flight-calendar-div">
    <button id="flight-button-back"><</button>
    <input id="training-calendar" type="date" value="<?php echo $date?>">
    <button id="flight-button-forward">></button>
</div>

<!-- Выводим полёты -->
<h2 id="flights-title">Полёты на </h2>
<div id="row-flights" class="row-flights">
    <!-- Карточка полёта -->
    <?php
    foreach($flights as $flight){
        ?><div class="row-item" id="flight-item_<?php echo $flight['id']?>" data-sort-date="<?php echo $flight['date']?>">
            <h3 class="flight-title"><?php echo $flight['name'];?></h3>
            <p>Дата: <span class="flight-date"><?php echo $flight['date']?></span></p>
            <p>Начало полётов: <span class="flight-time-start"><?php echo substr($flight['time_start'], 0, 5)?></span></p>
            <p>Конец полётов: <span class="flight-time-end"><?php echo substr($flight['time_end'], 0, 5)?></span></p>
            <p>Время суток: <span class="flight-d-s"><?php echo $flight['dawn_sunset']?></span></p>

            <!-- Упражнения -->
            <?php
            $ex_array[$flight['id']] = array();
            for ($i=0; $i<count($exercises); $i++) {

                // Создаём массив с упражнениями для конкретного полёта
                if ($exercises[$i]['flight_id'] == $flight['id']) {
                   array_push($ex_array[$flight['id']], $exercises[$i]['name'] . '+php+' .  $exercises[$i]['time'] . '+php+' . $exercises[$i]['id']);
                }
            }

            // Выводим по 6 упражнений в строке
            $ex_array_div = array_chunk($ex_array[$flight['id']], 6);
            echo '<table class="exercises-table"> Упражнения: ';
                for ($i=0; $i<count($ex_array_div); $i++){
                    echo '<tr>';
                        echo '<td>Время</td>';
                        for ($in=0; $in<count($ex_array_div[$i]); $in++){
                            echo '<td id="ex-time-td_' . explode('+php+', $ex_array_div[$i][$in])[2] . '">' . substr(explode('+php+',$ex_array_div[$i][$in])[1], 0, 5) . '</td>';
                        }
                    echo '</tr>';

                    echo '<tr>';
                        echo '<td>УПР</td>';
                        for ($in=0; $in<count($ex_array_div[$i]); $in++){
                            echo '<td id="ex-name-td_' . explode('+php+', $ex_array_div[$i][$in])[2] . '">' . explode('+php+',$ex_array_div[$i][$in])[0] . '</td>';
                        }
                    echo '</tr>';
                }
            echo '</table>';
            ?>

            <!-- Члены экипажа -->
            <div class="flight-crew-div">Экипаж:
                <ol class="flight-crew-ol" id="flight-crew-ol_<?php echo $flight['id']?>">
                    <?
                    for ($i=0; $i<count($flights_crew); $i++){
                        if ($flights_crew[$i]['flight_id'] == $flight['id']){
                            echo '<li class = "flight-crew-li" data-id="'. $flights_crew[$i]['id'] .'">' . $flights_crew[$i]['name'] . '</li>';
                        }
                    }
                    ?>
                </ol>
            </div>

            <div>
                <h2>Индивидуальное задание по запланированным полётным заданиям:</h2>
                <p id="individual-task_<?php echo $flight['id']?>"><?php echo $flight['individual_task'] ?></p>
            </div>

            <div>
                <h2>Указания, меры безопасности:</h2>
                <p id="security-measures_<?php echo $flight['id']?>"><?php echo $flight['security_measures'] ?></p>
            </div>

            <div>
                <h2>Задание на самоподготовку:</h2>
                <p id="self-preparation-task_<?php echo $flight['id']?>"><?php echo $flight['self_preparation_task'] ?></p>
            </div>

            <div>
                <h2>Тренажи:</h2>
                <p id="trainers_<?php echo $flight['id']?>"><?php echo $flight['trainers'] ?></p>
            </div>

            <div>
                <h2>Самостоятельная подготовка:</h2>
                <p id="self-preparation_<?php echo $flight['id']?>"><?php echo $flight['self_preparation'] ?></p>
            </div>

            <button class="flight-edit-button" id="flight-edit-button_<?php echo $flight['id']?>">Редактировать</button>

            <button class="flight-print-button" id="flight-print-button_<?php echo $flight['id']?>" type="submit">Распечатать</button>

        </div>
        <?php
    }
    ?>
</div>

<div id="flight-form-section">
    <!-- Форма создания/редактирования полёта -->
    <div id="flight-create-div" hidden>
        <form role="form" action="" method="post" class="form-horizontal" id="flight-create-form">

            <!-- Здесь отмечаем - сохраняем файл для печати или нет -->
            <input type="hidden" id="flight-print-input" name="flight-print" value="off">

            <!-- При редактировании полёта, в скрытый инпут помещаем его id, при создании id полёта = 0 -->
            <input type="hidden" id="form-create-flight-id" name="flight-id" value="">

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
                <p><input id="flight-d" required name="dawn-sunset" type="radio" value="Рассвет">Рассвет
                <input id="flight-s" required name="dawn-sunset" type="radio" value="Закат">Закат</p>
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
</div>

<!-- Кнопка "Добавить полёт" -->
<div id="div-flight-create-button">
    <button type="button" class="btn" id="task-create-form-button">Добавить полёт</button>
</div>

<!-- Подключаем js файлы для страницы -->
<script src="../js/training_page.js"></script>
<script src="../js/t_calendar.js"></script>
<script src="../js/flight_edit.js"></script>
<script src="../js/flight_print.js"></script>


