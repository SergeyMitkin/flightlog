var elFlightCreateDiv = document.getElementById("flight-create-div"); // Div с формой добавления полёта
var elDivFlightCreateButton = document.getElementById("div-flight-create-button"); // Div с кнопкой "Добавить полёт"

// Открываем форму при нажатии кнопки "Добавить полёт"
elDivFlightCreateButton.querySelector("button").addEventListener("click", event=>{
    elFlightCreateDiv.removeAttribute("hidden")
})

var elAddFlightExerciseButton = document.getElementById("add-flight-exercise-button");
var elFlightExercisesRow = document.getElementById("flight-exercises-row");

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

    var l = document.createElement("label");
    l.for = "flight-exercise-input";
    l.textContent = "Упражнение :";

    var i = document.createElement("input");
    i.type = "text";
    i.id = "flight-exercise-input";
    i.name = "flight-exercise[]";

    var b = document.createElement("button");
    b.id = "exercise-remove-button_" + new_exercise_id;
    b.classList = "button exercise-remove-button";
    b.type = "button";
    b.textContent = "Удалить";

    d.appendChild(l);
    d.appendChild(i);
    d.appendChild(b);

    elFlightExercisesRow.appendChild(d);

    var elExerciseRemoveButtons = document.querySelectorAll(".exercise-remove-button");
    elExerciseRemoveButtons.forEach( elem => {
        elem.addEventListener('click', event =>{
            exerciseRemove(Number.parseInt(elem.attributes["id"].value.split("_")[1]));
        })
    })

})

function exerciseRemove(exercise_tmp_id) {
    var elItemForDelete = elFlightExercisesRow.querySelector("#flight-exercise-item_" + exercise_tmp_id);
    elFlightExercisesRow.removeChild(elItemForDelete);
}