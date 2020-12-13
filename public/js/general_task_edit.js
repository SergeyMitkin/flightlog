// Прикрепяем событие к кнопкам "Редактировать"
var elRowTasks = document.getElementById("row-tasks");

elRowTasks.addEventListener("click", event =>{

    if (event.target.classList.contains("task-edit-button")){

        var task_id = event.target.id.split("_")[1]; // Id задачи
        var elDivTaskItem = document.getElementById("task-item_" + task_id); // Карточка задачи

        elDivTaskItem.appendChild(elDivTaskCreateForm);
        elDivTaskCreateForm.removeAttribute("hidden");
        showCreateButton(); // Отображаем кнопку "Создать", если была скрыта
        showEditButton(); // Отображаем кнопку "Редактировать", если была скрыта
        resetTaskCreateForm(); // Очищаем форму создания/редактирования заадчи
        fillTaskCreateForm(task_id); // Заполняем форму данными полёта

        event.target.setAttribute("hidden", ""); // Скрываем кнопку "Редактировать"


        /*
        showEditButton(); // Отображаем кнопку "Редактировать", если была скрыта
        resetFlightForm(); // Очищаем поля формы
        var flight_id = event.target.id.split("_")[1]; // Id полёта

        var elFlightItemDiv = document.getElementById("flight-item_" + flight_id); // Карточка полёта
        fillFlightForm(flight_id); // Заполняем форму данными полёта

        elFlightItemDiv.appendChild(elFlightCreateDiv); // Помещаем форму редактирования в карточку полёта

        elFlightCreateDiv.removeAttribute("hidden");
        event.target.setAttribute("hidden", ""); // Скрываем кнопку "Редактировать"
        */
    }
})