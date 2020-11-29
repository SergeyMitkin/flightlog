// Элементы календаря
var elTrainingCalendar = document.getElementById("training-calendar");
var elFlightButtonBack = document.getElementById("flight-button-back");
var elFlightButtonForward = document.getElementById("flight-button-forward");

getDate()

function getDate() {
    var date = elTrainingCalendar.value;
    var elFlightsTitle = document.getElementById("flights-title");
    console.log(date);
    console.log(formatDate(date));
    elFlightsTitle.innerText = "Полёты на  " + formatDate(date);

    return date;
}



// Форматируем дату
function formatDate(date) {
    var monthNames = [
        "января", "февраля", "марта",
        "апреля", "мая", "июня", "июля",
        "августа", "сентября", "октября",
        "ноября", "декабря"
    ];

    var day = date.split("-")[2];
    var monthIndex = date.split("-")[1]-1;
    var year = date.split("-")[0];

    return day + ' ' + monthNames[monthIndex] + ' ' + year;
}

