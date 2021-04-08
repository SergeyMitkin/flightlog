<?php
?>

<div id="row-crew">
    <?php
    foreach($crew as $crew_member){
        ?><div class="row-item" id="crew-item_<?php echo $crew_member['id']?>">
            <span class="crew-name-span"><?php echo $crew_member['name'];?></span>
            <span class="crew-id-span" data-id="<?php echo $crew_member['id']?>" hidden=""></span>

            <button class="crew-edit-button edit-button" id="crew-edit-button_<?php echo $crew_member['id']?>">Редактировать</button>
            <button class="delete-button"><a href="/crew/?crew-delete=<?php echo $crew_member['id']?>" role="button">Удалить</a></button>
        </div>
        <?php
    }
    ?>
</div>

<div id="crew-create-form-section">
    <div id="div-crew-create-form" hidden="">
        <form role="form" action="" method="post" class="form-horizontal" id="crew-create-form">

            <!-- При редактировании члена экипажа, в скрытый инпут помещаем его id, при создании, id аавтора = 0 -->
            <input type="hidden" id="input-crew-id" name="crew-id" value="0">

            <div class="form-group">
                <label for="crew-name-input">Введите имя: </label>
                <input required id="crew-name-input" class="form-control" name="crew-name" placeholder="Имя члена экипажа" value="">
                <button id="crew-create-submit-button" type="submit" class="button">Отправить</button>
            </div>

        </form>
    </div>
</div>

<!-- Кнопка "Добавить члена экипажа" -->
<div id="div-topic-create-button">
    <button type="button" class="btn create-button" id="crew-create-form-button">Добавить члена экипажа</button>
</div>

<!-- Подключаем js файлы для страницы -->
<script src="../js/crew_edit.js"></script>
