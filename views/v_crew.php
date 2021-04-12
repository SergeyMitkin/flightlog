<?php
?>

<div id="row-crew">
    <ol>
        <?php
        foreach($crew as $crew_member){
            ?>
            <li>
                <div class="person-item" id="crew-item_<?php echo $crew_member['id']?>">
                    <span class="crew-name-span"><?php echo $crew_member['name'];?></span>
                    <span class="crew-id-span" data-id="<?php echo $crew_member['id']?>" hidden=""></span>

                    <div class="admin-elements edit-buttons-block" hidden="">
                        <button class="admin-elements crew-edit-button edit-button" id="crew-edit-button_<?php echo $crew_member['id']?>" hidden="">&#9998</button>
                        <button class="admin-elements delete-button" hidden=""><a href="/crew/?crew-delete=<?php echo $crew_member['id']?>" role="button">&#9747</a></button>
                    </div>
                </div>
            </li>
            <?php
        }
        ?>
    </ol>
</div>

<div id="crew-create-form-section">
    <div id="div-crew-create-form" hidden="">
        <form role="form" action="" method="post" class="form-horizontal" id="crew-create-form">

            <!-- При редактировании члена экипажа, в скрытый инпут помещаем его id, при создании, id аавтора = 0 -->
            <input type="hidden" id="input-crew-id" name="crew-id" value="0">

            <div class="form-group">
                <label for="crew-name-input">Введите имя: </label>
                <input required id="crew-name-input" class="form-control" name="crew-name" placeholder="Имя члена экипажа" value="">
                <button id="crew-create-submit-button" type="submit" class="button create-button">Отправить</button>
            </div>

        </form>
    </div>
</div>

<!-- Кнопка "Добавить члена экипажа" -->
<div id="div-topic-create-button" class="admin-elements" hidden="">
    <button type="button" class="btn create-button admin-elements" id="crew-create-form-button" hidden="">Добавить члена экипажа</button>
</div>

<!-- Подключаем js файлы для страницы -->
<script src="../js/crew_edit.js"></script>
