var elRowFlights = document.getElementById("row-flights"); // Div со списком полётов
var elFlightCreateDiv = document.getElementById("flight-create-div"); // Div с формой добавления полёта

// При клике на кнопку "Реактировать", помещаем форму редактирования в карточку полёта
elRowFlights.addEventListener("click", event =>{
    if (event.target.className == "flight-edit-button"){
        var flight_id = event.target.id.split("_")[1];
        var elFlightItemDiv = document.getElementById("flight-item_" + flight_id);
        elFlightItemDiv.appendChild(elFlightCreateDiv);
        elFlightCreateDiv.removeAttribute("hidden");



        console.log(elFlightItemDiv);
    }
})
// var elFlightEditButtons = document.querySelectorAll(".flight-edit-button");

