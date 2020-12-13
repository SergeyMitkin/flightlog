//  Открываем/скрываем форму создания/редактирования задачи
var elDivTaskCreateForm = document.getElementById("div-task-create-form"); // Div с формой создания/редактирования задачи
var elTaskCreateForm = document.getElementById("task-create-form"); // Форма создания/редактирования задачи
var elTaskCreateFormButton = document.getElementById("task-create-form-button"); // Кнопка "Создать задачу"

elTaskCreateFormButton.addEventListener("click", event =>{
    var elTaskCreateFormSection = document.getElementById("task-create-form-section");

    elTaskCreateFormSection.appendChild(elDivTaskCreateForm);
    elDivTaskCreateForm.removeAttribute("hidden");
    event.target.setAttribute("hidden", "");
    showEditButton();
    resetTaskCreateForm();
})

// Показываем кнопку "Создать", если была скрыта
function showCreateButton() {
    var elCreateButtons = document.querySelectorAll(".create-button"); // Массив с кнопками

    // Удаляем атрибут hidden
    for (var i=0; i<elCreateButtons.length; i++){
        elCreateButtons[i].removeAttribute("hidden");
    }
}

// Показываем кнопку "Редактировать", если была скрыта
function showEditButton() {
    var elEditButtons = document.querySelectorAll(".edit-button"); // Массив с кнопками

    // Удаляем атрибут hidden
    for (var i=0; i<elEditButtons.length; i++){
        elEditButtons[i].removeAttribute("hidden");
    }
}

// Очищаем форму создания/редактирования задачи при повторном открытии
function resetTaskCreateForm() {
    var elAuthorsSelect = document.getElementById("task-author-select"); // Select с авторами

    elTaskCreateForm.reset() // Очищаем инпуты
    elTaskCreateForm.querySelector("#input-general-task-id").value = 0; // id задачи = 0

    // Очищаем select с авторами
    for (var i=0; i<elAuthorsSelect.querySelectorAll("option").length; i++){
        elAuthorsSelect.querySelectorAll("option")[i].removeAttribute("selected");
    }

    // Очищаем textarea
    for (var i=0; i<elTaskCreateForm.querySelectorAll("textarea").length; i++){
        elTaskCreateForm.querySelectorAll("textarea")[i].textContent = "";
    }
}

// Заполняем форму создания/редактирования задачи при редактировании
function fillTaskCreateForm(task_id) {

    // Элементы формы редактирования
    var elDivTaskItem = document.getElementById("task-item_" + task_id); // Карточка задачи

    // Помещаем текущие значения в форму редактирования
    elTaskCreateForm.querySelector("#input-general-task-id").value = task_id;
    elTaskCreateForm.querySelector("#task-title-input").value = elDivTaskItem.querySelector(".task-title-h").textContent;
    elTaskCreateForm.querySelector("#task-description-textarea").textContent = elDivTaskItem.querySelector(".task-description-p").textContent;
    elTaskCreateForm.querySelector("#task-date-input").value = elDivTaskItem.querySelector(".task-date-span").textContent;

    // Помечаем как выбранного, исходного автора задачи
    var author_id = elDivTaskItem.querySelector(".task-author-p").getAttribute("data-id");
    var elAuthorsSelect = elTaskCreateForm.querySelector("#task-author-select");
    var elAuthorOption = elAuthorsSelect.querySelector("option[value='" + author_id + "']");
    elAuthorOption.setAttribute("selected", "");
}

// Открываем/скрываем форму создания/редакитирования темы
var elDivTopicCreateForm = document.getElementById("div-topic-create-form");
var elTopicCreateFormButton = document.getElementById('topic-create-form-button');

elTopicCreateFormButton.addEventListener("click", event =>{
    elDivTopicCreateForm.removeAttribute("hidden");
    event.target.setAttribute("hidden", "");
})
