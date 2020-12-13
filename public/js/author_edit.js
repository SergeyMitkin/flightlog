var elRowAuthors = document.getElementById("row-authors");
var elAuthorCreateDiv = document.getElementById("div-author-create-form");
var elAuthorCreateForm = document.getElementById("author-create-form");
var elAuthorCreateFormButton = document.getElementById("author-create-form-button");

// Прикрепляем событие к кнопке "Добавить автора"
elAuthorCreateFormButton.addEventListener("click", event =>{
    var elAuthorCreateFormSection = document.getElementById("author-create-form-section"); // Секция для формы создания/редактирования

    elAuthorCreateFormSection.appendChild(elAuthorCreateDiv); // Помещаем форму в соответсвующую секцию
    elAuthorCreateDiv.removeAttribute("hidden"); // Показываем форму
    event.target.setAttribute("hidden", ""); // Скрываем кнопку "Создать задачу"
    showEditButton(); // Показываем кнопку "Редактировать", если была скрыта
    resetAuthorCreateForm(); // Очищаем поля формы
})

// Прикрепляем событие к кнопкам "Редактировать"
elRowAuthors.addEventListener("click", event =>{

    if (event.target.classList.contains("edit-button")){

        var author_id = event.target.id.split("_")[1]; // Id автора
        var elAuthorItemDiv = document.getElementById("author-item_" + author_id); // Карточка автора

        showEditButton(); // Отображаем кнопку "Редактировать", если была скрыта
        resetAuthorCreateForm(); // Очищаем поля формы
        fillAuthorCreateForm(author_id); // Заполняем форму
        elAuthorCreateFormButton.removeAttribute("hidden") // Показываем кнопку "Добавить автора", если была скрыта

        elAuthorItemDiv.appendChild(elAuthorCreateDiv); // Помещаем форму редактирования в карточку полёта

        elAuthorCreateDiv.removeAttribute("hidden");
        event.target.setAttribute("hidden", ""); // Скрываем кнопку "Редактировать"
    }
})

// Показываем кнопку "Редактировать", если была скрыта
function showEditButton() {
    var elEditButtons = document.querySelectorAll(".edit-button"); // Массив с кнопками

    // Удаляем атрибут hidden
    for (var i=0; i<elEditButtons.length; i++){
        elEditButtons[i].removeAttribute("hidden");
    }
}

// Очищаем форму создания/редактирования автора при повторном открытии
function resetAuthorCreateForm() {
    elAuthorCreateForm.reset() // Очищаем инпуты
    elAuthorCreateForm.querySelector("#input-author-id").value = 0; // id автора = 0
}

// Заполняем форму создания/редактирования автора при редактировании
function fillAuthorCreateForm(author_id) {

    // Элементы формы редактирования
    var elDivAuthorItem = document.getElementById("author-item_" + author_id); // Карточка задачи

    // Помещаем текущие значения в форму редактирования
    elAuthorCreateForm.querySelector("#input-author-id").value = author_id;
    elAuthorCreateForm.querySelector("#author-name-input").value = elDivAuthorItem.querySelector(".author-name-span").textContent;

}