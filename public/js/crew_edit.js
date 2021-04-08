var elRowCrew = document.getElementById("row-crew");
var elCrewCreateDiv = document.getElementById("div-crew-create-form");
var elCrewCreateForm = document.getElementById("crew-create-form");
var elCrewCreateFormButton = document.getElementById("crew-create-form-button");

// Прикрепляем событие к кнопке "Добавить члена экипажа"
elCrewCreateFormButton.addEventListener("click", event =>{
    var elCrewCreateFormSection = document.getElementById("crew-create-form-section"); // Секция для формы создания/редактирования

    elCrewCreateFormSection.appendChild(elCrewCreateDiv); // Помещаем форму в соответсвующую секцию
    elCrewCreateDiv.removeAttribute("hidden"); // Показываем форму
    event.target.setAttribute("hidden", ""); // Скрываем кнопку "Создать задачу"
    showEditButton(); // Показываем кнопку "Редактировать", если была скрыта
    resetCrewCreateForm(); // Очищаем поля формы
})

// Прикрепляем событие к кнопкам "Редактировать"
elRowCrew.addEventListener("click", event =>{

    if (event.target.classList.contains("edit-button")){

        var crew_id = event.target.id.split("_")[1]; // Id члена экиажа
        var elCrewItemDiv = document.getElementById("crew-item_" + crew_id); // Карточка члена экипажа

        showEditButton(); // Отображаем кнопку "Редактировать", если была скрыта
        resetCrewCreateForm(); // Очищаем поля формы
        fillCrewCreateForm(crew_id); // Заполняем форму
        elCrewCreateFormButton.removeAttribute("hidden") // Показываем кнопку "Добавить члена экипажа", если была скрыта

        elCrewItemDiv.appendChild(elCrewCreateDiv); // Помещаем форму редактирования в карточку полёта

        elCrewCreateDiv.removeAttribute("hidden");
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

// Очищаем форму создания/редактирования члена экипажа при повторном открытии
function resetCrewCreateForm() {
    elCrewCreateForm.reset() // Очищаем инпуты
    elCrewCreateForm.querySelector("#input-crew-id").value = 0; // id члена экипажа = 0
}

// Заполняем форму создания/редактирования члена экипажа при редактировании
function fillCrewCreateForm(crew_id) {

    // Элементы формы редактирования
    var elDivCrewItem = document.getElementById("crew-item_" + crew_id); // Карточка задачи

    // Помещаем текущие значения в форму редактирования
    elCrewCreateForm.querySelector("#input-crew-id").value = crew_id;
    elCrewCreateForm.querySelector("#crew-name-input").value = elDivCrewItem.querySelector(".crew-name-span").textContent;
}