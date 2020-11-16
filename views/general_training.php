<?php
?>

<form>
    <p>
        <label for="month">Месяц: </label>
        <input type="month" id="month" name="month"/>
    </p>
</form>

<!-- Выводим основные задачи -->
<div id="row-tasks" class="row">
    <?php
    foreach($general_tasks as $task){
        ?><p><?php echo $task['name'];?></p>
    <?php
    }
    ?>
</div>




