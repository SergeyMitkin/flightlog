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

        console.log(elFlightItemDiv);
    }
})
// var elFlightEditButtons = document.querySelectorAll(".flight-edit-button");

