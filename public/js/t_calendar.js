// Элементы календаря
var elTrainingCalendar = document.getElementById("training-calendar");
var elFlightButtonBack = document.getElementById("flight-button-back");
var elFlightButtonForward = document.getElementById("flight-button-forward");

// Получаем дату по календарю
function getDate() {
    var date = elTrainingCalendar.value;
    var elFlightsTitle = document.getElementById("flights-title");
    elFlightsTitle.innerText = "Полёты на  " + formatDate(date);

    return date;
}

// Получаем полёты по дате
function getItemsByDate(classname = "row-item") {
    var date = getDate();

    // Скрываем полёты, не соответсвующие дате
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

// При загрузке страницы и при смене даты, выводим полёты по дате
document.addEventListener("DOMContentLoaded", getItemsByDate());
elTrainingCalendar.addEventListener('change', event => {
    getItemsByDate();
})

// Получаем полёты на предыдущий день
elFlightButtonBack.addEventListener('click', event => {

    var d = new Date(getDate());
    d.setDate(d.getDate() - 1);

    var day = d.getDate();
    var day_str = String(day);

    // Ставим 0 перед значением дня, если нужно
    if(day_str.length == 1){
        day = "0" + day;
    }

    // Получаем месяц
    var month = d.getMonth()+1;
    var month_str = String(month);

    // Ставим 0 перед значением месяца, если нужно
    if(month_str.length == 1){
        month = "0" + month;
    }

    // Получаем год
    var year = d.getFullYear();
    var previous_day = year + '-' + month + '-' + day;

    elTrainingCalendar.value = previous_day;
    getItemsByDate();
});

// Получаем задачи на следующий день
elFlightButtonForward.addEventListener('click', event => {
    var d = new Date(getDate());
    d.setDate(d.getDate() + 1);

    var day = d.getDate();
    var day_str = String(day);

    // Ставим 0 перед значением дня, если нужно
    if(day_str.length == 1){
        day = "0" + day;
    }

    // Получаем месяц
    var month = d.getMonth()+1;
    var month_str = String(month);

    // Ставим 0 перед значением месяца, если нужно
    if(month_str.length == 1){
        month = "0" + month;
    }

    // Получаем год
    var year = d.getFullYear();
    var next_day = year + '-' + month + '-' + day;

    elTrainingCalendar.value = next_day;
    getItemsByDate();
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

