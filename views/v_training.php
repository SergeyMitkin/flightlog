<?php
?>

<h1>Подготовка к полётам</h1>

<div id="flight-create-div">
    <form role="form" action="" method="post" class="form-horizontal" id="flight-create-form">

        <div class="form-group">
            <label for="flight-date-input">Полёты: </label>
            <input class="form-control" value="<?php echo $date ?>" type="date" id="flight-date-input" name="flight-date">
        </div>

        <div class="form-group">
            <label for="time">Начало полётов: </label>
            <input type="time" id="flight-start" name="time-start" value=""/>

            <label for="time">Конец полётов: </label>
            <input type="time" id="flight-end" name="time-end" value/>
        </div>

        <div class="form-group" id="flight-exercises-row"></div>

        <div id="div-flight-exercise-button">
            <button type="button" class="btn" id="add-flight-exercise-button">Добавить упражнение</button>
        </div>

        <div class="form-group">
            <button id="task-create-submit-button" type="button" class="button">Отправить</button>
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


