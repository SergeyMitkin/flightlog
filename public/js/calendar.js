// Элементы календаря
var elTaskCalendarDiv = document.getElementById("task-calendar-div");
var elTaskButtonBack = document.getElementById("task-button-back");
var elTaskButtonForward = document.getElementById("task-button-forward");
var elSelectYear = document.getElementById("year-task-select");
var elSelectMonth = document.getElementById("month-task-select");
var elGeneralTrainingPrintButton = document.getElementById("general-training-print-button");

// Делаем неактивными кнопки "вперёд" и "назад" при крайних датах
if (elSelectYear.value == "2000"){
    if (elSelectMonth.value == "01"){
        elTaskButtonBack.setAttribute("disabled", "");
    }
}
if (elSelectYear.value == "2050"){
    if (elSelectMonth.value == "12"){
        elTaskButtonForward.setAttribute("disabled", "");
    }
}

// Получаем задачи и темы на определённый месяц
function getTasksByMonth(){

    // Вставляем в заголовок название месяца и год
    var month_name = elSelectMonth.querySelector('option[value="' + elSelectMonth.value + '"]').textContent;
    var year = elSelectYear.querySelector('option[value="' + elSelectYear.value + '"]').textContent;
    var elTaskTitle = document.getElementById("general-tasks-title");
    elTaskTitle.innerText = "Основные задачи на  " + month_name.toLowerCase() + ' ' + year;

    var task_date = elSelectYear.value + '-' + elSelectMonth.value;

    var m, k;
    m=document.querySelectorAll(".task-or-topic-item");
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

    if (elTaskButtonForward.hasAttribute("disabled")){
        elTaskButtonForward.removeAttribute("disabled");
    }

    var m = elSelectMonth.value;
    var new_value = m - 1 + ""; // Уменьшаем значение месяца и преобразовываем в строку

    if(typeof new_value[1] == "undefined"){

        new_value = "0" + new_value;
        // Переходим с января на декабрь
        if (new_value == "00"){
            new_value = "12";

            var y = elSelectYear.value;
            var new_y = y - 1;
            if (new_y == "1999"){
                new_y = "2000";
            }
        }
    }

    elSelectMonth.value = new_value;
    getTasksByMonth();

    if (elSelectYear.value == "2000"){
        if (elSelectMonth.value == "01"){
            elTaskButtonBack.setAttribute("disabled", "");
        }
    }
});

// Получаем задачи на следующий месяц
elTaskButtonForward.addEventListener('click', event => {

    if (elTaskButtonBack.hasAttribute("disabled")){
        elTaskButtonBack.removeAttribute("disabled");
    }

    var m = elSelectMonth.value;
    var new_value = m;
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

    if (elSelectYear.value == "2050"){
        if (elSelectMonth.value == "12"){
            elTaskButtonForward.setAttribute("disabled", "");
        }
    }
});

