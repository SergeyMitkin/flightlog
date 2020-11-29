// Элементы календаря
var elTrainingCalendar = document.getElementById("training-calendar");
var elFlightButtonBack = document.getElementById("flight-button-back");
var elFlightButtonForward = document.getElementById("flight-button-forward");

getItemsByDate();

function getDate() {
    var date = elTrainingCalendar.value;
    var elFlightsTitle = document.getElementById("flights-title");
    console.log(date);
    console.log(formatDate(date));
    elFlightsTitle.innerText = "Полёты на  " + formatDate(date);

    return date;
}

function getItemsByDate(classname = "row-item") {
    var date = getDate();

    var m, k;
    m=document.querySelectorAll("." + classname);
    k=m.length;
    while(k--){
        m[k].setAttribute('hidden', '');

        if (m[k].getAttribute('data-sort-date') == date){
            m[k].removeAttribute('hidden');
        }
    }
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

