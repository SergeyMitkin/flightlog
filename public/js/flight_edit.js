var elRowFlights = document.getElementById("row-flights"); // Div со списком полётов
var elFlightCreateDiv = document.getElementById("flight-create-div"); // Div с формой добавления полёта
var elFlightCreateForm = document.getElementById("flight-create-form"); // Форма полёта

// При клике на кнопку "Реактировать", помещаем форму редактирования в карточку полёта
elRowFlights.addEventListener("click", event =>{
    if (event.target.className == "flight-edit-button"){
        var flight_id = event.target.id.split("_")[1];
        var elFlightItemDiv = document.getElementById("flight-item_" + flight_id);
        elFlightItemDiv.appendChild(elFlightCreateDiv);
        elFlightCreateDiv.removeAttribute("hidden");

        elFlightCreateForm.querySelector("#form-create-task_id").value = flight_id; // Помещаем id полёта в скрытый input
        elFlightCreateForm.querySelector("#flight-name-input").value = elFlightItemDiv.querySelector(".flight-title").textContent;
        elFlightCreateForm.querySelector("#flight-date-input").value = elFlightItemDiv.querySelector(".flight-date").textContent;
        elFlightCreateForm.querySelector("#flight-start").value = elFlightItemDiv.querySelector(".flight-time-start").textContent;
        elFlightCreateForm.querySelector("#flight-end").value = elFlightItemDiv.querySelector(".flight-time-end").textContent;

        console.log(elFlightItemDiv);
    }
})
// var elFlightEditButtons = document.querySelectorAll(".flight-edit-button");

