<?php
?>

<div id="row-authors">
    <?php
    foreach($authors as $author){
        ?><div class="row-item" id="author-item_<?php echo $author['id']?>">
            <span class="author-name-span"><?php echo $author['name'];?></span>
            <span class="author-id-span" data-id="<?php echo $author['id']?>" hidden=""></span>

            <div class="admin-elements" hidden="">
                <button class="author-edit-button edit-button" id="author-edit-button_<?php echo $author['id']?>">Редактировать</button>
                <button class="delete-button"><a href="/authors/?author-delete=<?php echo $author['id']?>" role="button">Удалить</a></button>
            </div>
        </div>
        <?php
    }
    ?>
</div>

<div id="author-create-form-section">
    <div id="div-author-create-form" hidden="">
        <form role="form" action="" method="post" class="form-horizontal" id="author-create-form">

            <!-- При редактировании автора, в скрытый инпут помещаем его id, при создании, id аавтора = 0 -->
            <input type="hidden" id="input-author-id" name="author-id" value="0">

            <div class="form-group">
                <label for="author-name-input">Введите имя: </label>
                <input required id="author-name-input" class="form-control" name="author-name" placeholder="Имя автора" value="">
                <button id="author-create-submit-button" type="submit" class="button">Отправить</button>
            </div>

        </form>
    </div>
</div>

<!-- Кнопка "Добавить автора" -->
<div id="div-topic-create-button" class="admin-elements" hidden="">
    <button type="button" class="btn create-button" id="author-create-form-button">Добавить автора</button>
</div>

<!-- Подключаем js файлы для страницы -->
<script src="../js/author_edit.js"></script>
