var elRowFlights = document.getElementById("row-flights"); // Div со списком полётов
var elFlightCreateDiv = document.getElementById("flight-create-div"); // Div с формой добавления полёта
var elFlightCreateForm = document.getElementById("flight-create-form"); // Форма полёта

// При клике на кнопку "Реактировать", помещаем форму редактирования в карточку полёта
elRowFlights.addEventListener("click", event =>{
    if (event.target.className == "flight-edit-button"){
        var flight_id = event.target.id.split("_")[1];
        var elFlightItemDiv = document.getElementById("flight-item_" + flight_id);

        // Снимаем галочку с radio
        elFlightCreateForm.querySelector("#flight-d").removeAttribute("checked");
        elFlightCreateForm.querySelector("#flight-s").removeAttribute("checked");
        var ex_td = elFlightItemDiv.querySelector(".exercises-table").querySelectorAll("td") // Столбики таблицы упражнений
        var elExercisesDiv = document.getElementById("flight-exercises-row");

        var d_s  = elFlightItemDiv.querySelector(".flight-d-s").textContent // Узнаём время суток полёта

        elFlightItemDiv.appendChild(elFlightCreateDiv);
        elFlightCreateDiv.removeAttribute("hidden");

        // Помещаем текущие значения в форму редактирования
        elFlightCreateForm.querySelector("#form-create-task_id").value = flight_id;
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

                    // Создаём div для одного упражнения
                    var d = document.createElement("div");
                    d.classList = "flight-exercise-div_old_" + exercise_id;
                    d.id = "flight-exercise-item_old_" + exercise_id;

                    var l_t = document.createElement("label");
                    l_t.setAttribute("for", "exercise-time-input_old_" + exercise_id);
                    l_t.textContent = "Время: ";

                    var i_t = document.createElement("input");
                    i_t.type = "time";
                    i_t.id = "exercise-time-input_old_" + exercise_id;
                    i_t.value = ex_td[i].textContent; // Вставляем в инпут исходное значение

                    var b = document.createElement("button");
                    b.id = "exercise-remove-button_old_" + exercise_id;
                    b.classList = "button exercise-remove-button-old";
                    b.type = "button";
                    b.textContent = "Удалить";

                    d.appendChild(l_t);
                    d.appendChild(i_t);
                    d.appendChild(b);

                    elExercisesDiv.appendChild(d);

                    // Выводим инпуты с названиями упражнений
                } else if (ex_td[i].id.split("_")[0] == "ex-name-td"){

                    d = document.getElementById("flight-exercise-item_old_" + exercise_id);
                    var l_n = document.createElement("label");
                    l_n.setAttribute("for", "exercise-name-input_old_" + exercise_id);
                    l_n.textContent = "Упражнение: ";

                    var i_n = document.createElement("input");
                    i_n.type = "text";
                    i_n.id = "exercise-name-input_old_" + exercise_id;
                    i_n.value = ex_td[i].textContent; // Вставляем в инпут исходное значение

                    // Объединяем значения из инпутов имени и времени упражнения
                    var input3 = document.createElement("input");
                    input3.id = "input-common_" + exercise_id;
                    input3.name = "exercise[]";
                    // input3.setAttribute("hidden", "");

                    var i_t = document.getElementById("exercise-time-input_old_" + exercise_id);
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
                        console.log(event.target.id);
                    }, false);

                    var firstChild = d.firstChild;
                    d.insertBefore(l_n, firstChild);
                    d.insertBefore(i_n, firstChild);
                    d.insertBefore(input3, firstChild);
                }
            }
        }

        var elExerciseOldRemoveButtons = document.querySelectorAll(".exercise-remove-button-old");
        elExerciseOldRemoveButtons.forEach( elem => {
            elem.addEventListener('click', event =>{
                exerciseOldRemove(Number.parseInt(elem.attributes["id"].value.split("_")[2]));
            })
        })

        function exerciseOldRemove(exercise_id) {
            var elItemForDelete = elExercisesDiv.querySelector("#flight-exercise-item_old_" + exercise_id);
            elFlightExercisesRow.removeChild(elItemForDelete);
        }

        // Определяем членов экипажа
        var elCrewOl = document.getElementById("flight-crew-ol_" + flight_id);
        var elCrewSelect = document.getElementById("flight-crew-select");
        var crew_li = elCrewOl.querySelectorAll("li");

        // Помечаем как выбранных исходные значения
        for (var i=0; i<crew_li.length; i++){
            var option = elCrewSelect.querySelector("option[value='" + crew_li[i].value + "']");
            option.setAttribute("selected", "");
        }

        //console.log(crew_li);


    }
})
// var elFlightEditButtons = document.querySelectorAll(".flight-edit-button");



