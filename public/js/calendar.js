var elTaskRow = document.getElementById("row-tasks");
var elTaskCalendarDiv = document.getElementById("task-calendar-div");
var elTaskButtonBack = document.getElementById("task-button-back");
var elTaskButtonForward = document.getElementById("task-button-forward");
var elSelectYear = document.getElementById("year-task-select");
var elSelectMonth = document.getElementById("month-task-select");

function getTasksByMonth(){
    var task_date = elSelectYear.value + '-' + elSelectMonth.value;

    var m, k;
    m=elTaskRow.querySelectorAll(".general-task-item");
    k=m.length;
    while(k--){
        m[k].setAttribute('hidden', '');

        if (m[k].getAttribute('data-sort-date') == task_date){
            m[k].removeAttribute('hidden');
        }
    }
}

// При загрузке страницы и при смене select года или месяца, выводим задачи по дате
document.addEventListener("DOMContentLoaded", getTasksByMonth);
elTaskCalendarDiv.addEventListener('change', event => {
    if (event.target.className == 'general-task-select'){
        getTasksByMonth();
    }
})

// Получаем задачи на предыдущий месяц
elTaskButtonBack.addEventListener('click', event => {
    var n = elSelectMonth.value;
    var new_value = n - 1 + ""; // Уменьшаем значение месяца и преобразовываем в строку

    if(typeof new_value[1] == "undefined"){
        new_value = "0" + new_value;
        // Переходим с января на декабрь
        if (new_value == "00"){
            new_value = "12";
        }
    }

    elSelectMonth.value = new_value;
    getTasksByMonth();
});

// Получаем задачи на следующий месяц
elTaskButtonForward.addEventListener('click', event => {
    var n = elSelectMonth.value;
    var new_value = n;
    new_value = Number.parseInt(new_value) + 1 + ""; // Преобразовываем в число, увеличиваем на единицу и преобразовываем в строку

    // Ставим 0 перед значением месяца, если нужно
    if(typeof new_value[1] == "undefined"){
        new_value = "0" + new_value;
        console.log(new_value);
    }

    if (new_value == "13"){
        new_value = "01";
    }

    elSelectMonth.value = new_value;
    getTasksByMonth();
});

