//  Открываем/скрываем форму создания/редактирования задачи
var elDivTaskCreateForm = document.getElementById("div-task-create-form"); // Div с формой создания/редактирования задачи
var elTaskCreateForm = document.getElementById("task-create-form"); // Форма создания/редактирования задачи
var elTaskCreateFormButton = document.getElementById("task-create-form-button"); // Кнопка "Создать задачу"

// Прикрепляем событие к кнопке "Создать задачу"
elTaskCreateFormButton.addEventListener("click", event =>{
    var elTaskCreateFormSection = document.getElementById("task-create-form-section"); // Секция для формы создания/редактирования

    elTaskCreateFormSection.appendChild(elDivTaskCreateForm); // Помещаем форму в соответсвующую секцию
    elDivTaskCreateForm.removeAttribute("hidden"); // Показываем форму
    event.target.setAttribute("hidden", ""); // Скрываем кнопку "Создать задачу"
    showEditButton(); // Показываем кнопку "Редактировать", если была скрыта
    resetTaskCreateForm(); // Очищаем поля формы
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
var elDivTopicCreateForm = document.getElementById("div-topic-create-form"); // Div с формой создания/редактирования задачи
var elTopicCreateForm = document.getElementById("topic-create-form"); // Форма создания/редактирования темы
var elTopicCreateFormButton = document.getElementById('topic-create-form-button'); // Кнопка "Создать тему"

// Прикрепляем событие к кнопке "Создать тему"
elTopicCreateFormButton.addEventListener("click", event =>{
    var elTopicCreateFormSection = document.getElementById("topic-create-form-section"); // Секция для формы создания/редактирования

    elTopicCreateFormSection.appendChild(elDivTopicCreateForm); // Помещаем форму создания/редактирования в соответсвующую секцию
    elDivTopicCreateForm.removeAttribute("hidden"); // Показываем форму
    event.target.setAttribute("hidden", ""); // Скрываем кнопку "Создать тему"
    showEditButton(); // Показываем кнопку "Редактировать", если была скрыта
    resetTopicCreateForm(); // Очищаем поля формы
})

// Очищаем форму создания/редактирования темы при повторном открытии
function resetTopicCreateForm() {
    var elAuthorsSelect = document.getElementById("topic-author-select"); // Select с авторами
    var elTypesSelect = document.getElementById("topic-type-select"); // Select с типами тем

    elTopicCreateForm.reset() // Очищаем инпуты
    elTopicCreateForm.querySelector("#input-topic-id").value = 0; // id темы = 0

    // Очищаем select с типами
    for (var i=0; i<elTypesSelect.querySelectorAll("option").length; i++){
        elTypesSelect.querySelectorAll("option")[i].removeAttribute("selected");
    }

    // Очищаем select с авторами
    for (var i=0; i<elAuthorsSelect.querySelectorAll("option").length; i++){
        elAuthorsSelect.querySelectorAll("option")[i].removeAttribute("selected");
    }

    // Очищаем textarea
    for (var i=0; i<elTopicCreateForm.querySelectorAll("textarea").length; i++){
        elTopicCreateForm.querySelectorAll("textarea")[i].textContent = "";
    }
}

// Заполняем форму создания/редактирования темы при редактировании
function fillTopicCreateForm(topic_id) {

    // Элементы формы редактирования
    var elDivTopicItem = document.getElementById("topic-item_" + topic_id); // Карточка задачи

    // Помещаем текущие значения в форму редактирования
    elTopicCreateForm.querySelector("#input-topic-id").value = topic_id;
    elTopicCreateForm.querySelector("#topic-title-input").value = elDivTopicItem.querySelector(".topic-title-h").textContent;
    elTopicCreateForm.querySelector("#topic-description-textarea").textContent = elDivTopicItem.querySelector(".topic-description-p").textContent;
    elTopicCreateForm.querySelector("#topic-date-input").value = elDivTopicItem.querySelector(".topic-date-span").textContent;

    // Помечаем как выбранный, исходный тип темы
    var topic_type = elDivTopicItem.querySelector(".topic-type-p").getAttribute("data-type");
    var elTypesSelect = elTopicCreateForm.querySelector("#topic-type-select");
    var elTypeOption = elTypesSelect.querySelector("option[value='" + topic_type + "']");
    elTypeOption.setAttribute("selected", "");

    // Помечаем как выбранного, исходного автора темы
    var author_id = elDivTopicItem.querySelector(".topic-author-p").getAttribute("data-id");
    var elAuthorsSelect = elTopicCreateForm.querySelector("#topic-author-select");
    var elAuthorOption = elAuthorsSelect.querySelector("option[value='" + author_id + "']");
    elAuthorOption.setAttribute("selected", "");
}

// Проверяем строку на пустоту
function isEmptyStr(str) {
    if (str.trim() == '')
        return true;

    return false;
}

// Удаляем get-параметр из url
function removeURLParameter(url, parameter){

    var urlparts= url.split('?');

    if (urlparts.length>=2) {
        var prefix= encodeURIComponent(parameter)+'=';
        var pars= urlparts[1].split(/[&;]/g);

        for (var i= pars.length; i-- > 0;) {
            if (pars[i].lastIndexOf(prefix, 0) !== -1) {
                pars.splice(i, 1);
            }
        }
        url= urlparts[0] + (pars.length > 0 ? '?' + pars.join('&') : "");
        return url;
    } else {
        return url;
    }

}