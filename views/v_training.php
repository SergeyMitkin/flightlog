<?php
?>
<h1>Подготовка к полётам</h1>

<div id="flight-create-div">
    <form role="form" action="training" method="post" class="form-horizontal" id="flight-create-form">

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

        <form form role="form" action="training" method="post" class="form-horizontal" id="flight-exercise-form">
            <div class="form-group">
                <label for="flight-exercise-input">Упражнение: </label>
                <input type="text" id="flight-exercise-input" name="flight-exercise" value/>
            </div>
        </form>

        <div id="div-flight-exercise-button">
            <button type="button" class="btn" id="task-create-form-button">Добавить упражнение</button>
        </div>
    </form>
</div>

<div id="div-flight-create-button">
    <button type="button" class="btn" id="task-create-form-button">Добавить полёт</button>
</div>


