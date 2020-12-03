var elFlightCreateDiv = document.getElementById("flight-create-div"); // Div с формой добавления полёта
var elDivFlightCreateButton = document.getElementById("div-flight-create-button"); // Div с кнопкой "Добавить полёт"
var elFlightFormSection = document.getElementById("flight-form-section");
var elAddFlightExerciseButton = document.getElementById("add-flight-exercise-button");
var elFlightExercisesRow = document.getElementById("flight-exercises-row");
var elEditButtons = document.querySelectorAll(".flight-edit-button");

// Открываем форму создания/редактирования полёта при нажатии кнопки "Добавить полёт"
elDivFlightCreateButton.querySelector("button").addEventListener("click", event=>{

    showEditButton(); // Показываем кнопку "Редактировать" в карточке полёта, если была скрыта
    resetFlightForm(); // Очищаем поля формы
    elFlightCreateForm.querySelector("#form-create-flight-id").value = 0; // Айди полёта = 0
    elFlightFormSection.appendChild(elFlightCreateDiv); // Помещаем форму в изначальный див, если до этого она была в карточке полёта
    elFlightCreateDiv.removeAttribute("hidden"); // Отображаем форму
})

// Вешаем событие на кнопку "Добавить упражнение" - добавляем инпут для ввода имени и времени
elAddFlightExerciseButton.addEventListener("click", event=>{

    if (elFlightExercisesRow.querySelector(".flight-exercise-div") == null){
        var new_exercise_id = 0;
    }else{
        var new_exercise_id = elFlightExercisesRow.lastChild.id.split("_")[1];
        new_exercise_id = (Number.parseInt(new_exercise_id)+1);
    }

    var d = document.createElement("div");
    d.classList = "flight-exercise-div";
    d.id = "flight-exercise-item_" + new_exercise_id;

    var l_n = document.createElement("label");
    l_n.setAttribute("for", "exercise-name-input_" + new_exercise_id);
    l_n.textContent = "Упражнение: ";

    var i_n = document.createElement("input");
    i_n.type = "text";
    i_n.id = "exercise-name-input_" + new_exercise_id;
    i_n.setAttribute("required", "");

    var l_t = document.createElement("label");
    l_t.setAttribute("for", "exercise-time-input_" + new_exercise_id);
    l_t.textContent = "Время: ";

    var i_t = document.createElement("input");
    i_t.type = "time";
    i_t.id = "exercise-time-input_" + new_exercise_id;
    i_t.setAttribute("required", "");

    var b = document.createElement("button");
    b.id = "exercise-remove-button_" + new_exercise_id;
    b.classList = "button exercise-remove-button";
    b.type = "button";
    b.textContent = "Удалить";

    // Объединяем значения из инпутов имени и времени упражнения
    var input3 = document.createElement("input");
    input3.name = "exercise[]";
    input3.setAttribute("hidden", "");

    i_n.addEventListener('input', joinValues, false);
    i_t.addEventListener('input', joinValues, false);

    function joinValues(){
        input3.value = i_n.value + '+php+' + i_t.value;
    }

    d.appendChild(l_n);
    d.appendChild(i_n);
    d.appendChild(l_t);
    d.appendChild(i_t);
    d.appendChild(input3);
    d.appendChild(b);

    elFlightExercisesRow.appendChild(d);

    var elExerciseRemoveButtons = document.querySelectorAll(".exercise-remove-button");
    elExerciseRemoveButtons.forEach( elem => {
        elem.addEventListener('click', event =>{
            exerciseRemove(Number.parseInt(elem.attributes["id"].value.split("_")[1]));
        })
    })

})

// Функция удаления упражнения
function exerciseRemove(exercise_tmp_id) {
    var elItemForDelete = elFlightExercisesRow.querySelector("#flight-exercise-item_" + exercise_tmp_id);
    elFlightExercisesRow.removeChild(elItemForDelete);
}