// Элементы календаря
var elTrainingCalendar = document.getElementById("training-calendar");
var elFlightButtonBack = document.getElementById("flight-button-back");
var elFlightButtonForward = document.getElementById("flight-button-forward");

function getDate() {
    var date = elTrainingCalendar.value;
    var elFlightsTitle = document.getElementById("flights-title");
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

// При загрузке страницы и при смене даты, выводим задачи по дате
document.addEventListener("DOMContentLoaded", getItemsByDate());
elTrainingCalendar.addEventListener('change', event => {
    getItemsByDate();
})

// Получаем задачи на предыдущий день
elFlightButtonBack.addEventListener('click', event => {
    var d = new Date(getDate());
    d.setDate(d.getDate() - 1);

    var day = d.getDate();
    var day_str = String(day);

    // Ставим 0 перед значением дня, если нужно
    if(day_str.length == 1){
        day = "0" + day;
    }

    var month = d.getMonth()+1;
    var month_str = String(month);

    // Ставим 0 перед значением месяца, если нужно
    if(month_str.length == 1){
        month = "0" + month;
    }

    var year = d.getFullYear();
    var previous_day = year + '-' + month + '-' + day;

    elTrainingCalendar.value = previous_day;
});


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

