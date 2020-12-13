// Элементы для редактирования полёта
var elRowFlights = document.getElementById("row-flights"); // Div со списком полётов
var elFlightCreateDiv = document.getElementById("flight-create-div"); // Div с формой добавления полёта
var elFlightCreateForm = document.getElementById("flight-create-form"); // Форма полёта
var elCrewSelect = document.getElementById("flight-crew-select"); // Селект с членами экипажа

// Очищаем форму создания/редактирования полёта при повторном открытии
function resetFlightForm(){

    elFlightCreateForm.reset(); // Очищаем инпуты
    // Сбрасываем radio
    elFlightCreateForm.querySelector("#flight-d").removeAttribute("checked");
    elFlightCreateForm.querySelector("#flight-s").removeAttribute("checked");

    // Очищаем div с упражнениями
    while (elFlightExercisesRow.firstChild) {
        elFlightExercisesRow.removeChild(elFlightExercisesRow.firstChild);
    }

    // Очищаем select с членами экипажа
    for (var i=0; i<elCrewSelect.querySelectorAll("option").length; i++){
        elCrewSelect.querySelectorAll("option")[i].removeAttribute("selected");
    }

    // Очищаем все textarea
    for (var i=0; i<elFlightCreateForm.querySelectorAll("textarea").length; i++){
        elFlightCreateForm.querySelectorAll("textarea")[i].textContent = "";
    }
}

// Функция, отображающая кнопку "Редактировать" в карточке полёта, если она была скрыта
function showEditButton(){
    for (var i=0; i<elEditButtons.length; i++){
        elEditButtons[i].removeAttribute("hidden");
    }
}

// Заполняем форму полёта исходнами значениями при редактировании или отправке на печать
function fillFlightForm(flight_id, print = "off"){
    // Элементы формы редактирования
    var elFlightItemDiv = document.getElementById("flight-item_" + flight_id); // Карточка полёта
    var ex_td = elFlightItemDiv.querySelector(".exercises-table").querySelectorAll("td") // Столбики таблицы упражнений
    var elExercisesDiv = document.getElementById("flight-exercises-row"); // Div с упражнениями

    var d_s  = elFlightItemDiv.querySelector(".flight-d-s").textContent // Узнаём время суток полёта

    // Помещаем текущие значения в форму редактирования
    elFlightCreateForm.querySelector("#flight-print-input").value = print;
    elFlightCreateForm.querySelector("#form-create-flight-id").value = flight_id;
    elFlightCreateForm.querySelector("#flight-name-input").value = elFlightItemDiv.querySelector(".flight-title").textContent;
    elFlightCreateForm.querySelector("#flight-date-input").value = elFlightItemDiv.querySelector(".flight-date").textContent;
    elFlightCreateForm.querySelector("#flight-start").value = elFlightItemDiv.querySelector(".flight-time-start").textContent;
    elFlightCreateForm.querySelector("#flight-end").value = elFlightItemDiv.querySelector(".flight-time-end").textContent;
    if (elFlightCreateForm.querySelector("#flight-d").value == d_s){
        elFlightCreateForm.querySelector("#flight-d").setAttribute("checked", "");
    } else if (elFlightCreateForm.querySelector("#flight-s").value == d_s){
        elFlightCreateForm.querySelector("#flight-s").setAttribute("checked", "");
    }

    // Выводим список упражнений
    for (var i=0; i<ex_td.length; i++){
        // Выбираем только столбики с упражнениями (проверяем наличие атрибута id)
        if (ex_td[i].hasAttribute("id")){
            var exercise_id = ex_td[i].id.split("_")[1];

            // Выводим инпуты с временем упражнений
            if (ex_td[i].id.split("_")[0] == "ex-time-td"){

                // Создаём div для упражнения
                var d = document.createElement("div");
                d.classList = "flight-exercise-div_old_" + exercise_id;
                d.id = "flight-exercise-item_old_" + exercise_id;

                // Создаём лайбл для инпута времени упражнения
                var l_t = document.createElement("label");
                l_t.setAttribute("for", "exercise-time-input_old_" + exercise_id);
                l_t.textContent = "Время: ";

                // Создаём инпут времени упражнения
                var i_t = document.createElement("input");
                i_t.type = "time";
                i_t.id = "exercise-time-input_old_" + exercise_id;
                i_t.value = ex_td[i].textContent; // Вставляем в инпут исходное значение

                // Создаём кнопку удалить упражнение
                var b = document.createElement("button");
                b.id = "exercise-remove-button_old_" + exercise_id;
                b.classList = "button exercise-remove-button-old";
                b.type = "button";
                b.textContent = "Удалить";

                // Помещаем элементы в див с упражнениями
                d.appendChild(l_t);
                d.appendChild(i_t);
                d.appendChild(b);
                elExercisesDiv.appendChild(d);

                // Выводим инпуты с названиями упражнений
            } else if (ex_td[i].id.split("_")[0] == "ex-name-td"){

                d = document.getElementById("flight-exercise-item_old_" + exercise_id);  // div для упражнения

                // Создаём элемент для инпута имени упражнения
                var l_n = document.createElement("label");
                l_n.setAttribute("for", "exercise-name-input_old_" + exercise_id);
                l_n.textContent = "Упражнение: ";

                // Создаём инпут для ввода имени упражнения
                var i_n = document.createElement("input");
                i_n.type = "text";
                i_n.id = "exercise-name-input_old_" + exercise_id;
                i_n.value = ex_td[i].textContent; // Вставляем в инпут исходное значение

                var i_t = document.getElementById("exercise-time-input_old_" + exercise_id); // Инпут для ввода времени упражнения

                // Объединяем значения из инпутов имени и времени упражнения в скрытый инпут
                var input3 = document.createElement("input");
                input3.id = "input-common_" + exercise_id;
                input3.name = "exercise[]";
                input3.setAttribute("hidden", "");
                input3.value = i_n.value + "+php+" + i_t.value; // Помещаем в общий инпут изначальные значения

                // При заполнении инпутов времени иимени, заполняем общий инпут
                i_n.addEventListener('input', event=>{

                    var id = event.target.id.split("_")[2];
                    var elNameInput = document.getElementById("exercise-name-input_old_" + id);
                    var elTimeInput = document.getElementById("exercise-time-input_old_" + id);
                    var elCommonInput = document.getElementById("input-common_" + id);

                    elCommonInput.value = elNameInput.value + '+php+' + elTimeInput.value;

                }, false);

                i_t.addEventListener('input', event=>{

                    var id = event.target.id.split("_")[2];
                    var elNameInput = document.getElementById("exercise-name-input_old_" + id);
                    var elTimeInput = document.getElementById("exercise-time-input_old_" + id);
                    var elCommonInput = document.getElementById("input-common_" + id);

                    elCommonInput.value = elNameInput.value + '+php+' + elTimeInput.value;
                }, false);

                // Помещаем элементы в див упражнения
                var firstChild = d.firstChild;
                d.insertBefore(l_n, firstChild);
                d.insertBefore(i_n, firstChild);
                d.insertBefore(input3, firstChild);
            }
        }
    }

    // Прикрепляем события для удаления упражнений к кнопкам
    var elExerciseOldRemoveButtons = document.querySelectorAll(".exercise-remove-button-old");
    elExerciseOldRemoveButtons.forEach( elem => {
        elem.addEventListener('click', event =>{
            exerciseOldRemove(Number.parseInt(elem.attributes["id"].value.split("_")[2]));
        })
    })

    // Функция удаления упражнений
    function exerciseOldRemove(exercise_id) {
        var elItemForDelete = elExercisesDiv.querySelector("#flight-exercise-item_old_" + exercise_id);
        elFlightExercisesRow.removeChild(elItemForDelete);
    }

    // Определяем членов экипажа
    var elCrewOl = document.getElementById("flight-crew-ol_" + flight_id);
    var crew_li = elCrewOl.querySelectorAll("li");

    // Помечаем как выбранных исходные значения
    for (var i=0; i<crew_li.length; i++){
        var option = elCrewSelect.querySelector("option[value='" + crew_li[i].getAttribute("data-id") + "']");
        option.setAttribute("selected", "");
    }

    // Помещаем исходные значения в textarea
    var elIndividualTaskTextarea = document.getElementById("individual-task-textarea");
    elIndividualTaskTextarea.textContent = document.getElementById("individual-task_" + flight_id).textContent;

    var elSecurityMeasuresTextarea = document.getElementById("security-measures-textarea");
    elSecurityMeasuresTextarea.textContent = document.getElementById("security-measures_" + flight_id).textContent;

    var elSelfPreparationTaskTextarea = document.getElementById("self-preparation-task-textarea");
    elSelfPreparationTaskTextarea.textContent = document.getElementById("self-preparation-task_" + flight_id).textContent;

    var elTrainersTextarea = document.getElementById("trainers-textarea");
    elTrainersTextarea.textContent = document.getElementById("trainers_" + flight_id).textContent;

    var elSelfPreparationTextarea = document.getElementById("self-preparation-textarea");
    elSelfPreparationTextarea.textContent = document.getElementById("self-preparation_" + flight_id).textContent;
}

// Прикрепляем событи к кнопкам "Редактировать"
elRowFlights.addEventListener("click", event =>{

    if (event.target.className == "flight-edit-button"){

        showEditButton(); // Отображаем кнопку "Редактировать", если была скрыта
        resetFlightForm(); // Очищаем поля формы
        var flight_id = event.target.id.split("_")[1]; // Id полёта

        var elFlightItemDiv = document.getElementById("flight-item_" + flight_id); // Карточка полёта
        fillFlightForm(flight_id); // Заполняем форму данными полёта

        elFlightItemDiv.appendChild(elFlightCreateDiv); // Помещаем форму редактирования в карточку полёта

        elFlightCreateDiv.removeAttribute("hidden");
        event.target.setAttribute("hidden", ""); // Скрываем кнопку "Редактировать"
    }
})




