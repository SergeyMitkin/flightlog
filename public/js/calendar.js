// Элементы календаря
var elTaskCalendarDiv = document.getElementById("task-calendar-div");
var elTaskButtonBack = document.getElementById("task-button-back");
var elTaskButtonForward = document.getElementById("task-button-forward");
var elSelectYear = document.getElementById("year-task-select");
var elSelectMonth = document.getElementById("month-task-select");
var elPrintFormItems = document.getElementById("print-form-items");
// var elGeneralTrainingPrintButton = document.getElementById("general-training-print-button");

function getCurrentMonthAndYear(){

    // Вставляем в заголовок название месяца и год
    var month_name = elSelectMonth.querySelector('option[value="' + elSelectMonth.value + '"]').textContent;
    var year = elSelectYear.querySelector('option[value="' + elSelectYear.value + '"]').textContent;
    var elTaskTitle = document.getElementById("general-tasks-title");
    elTaskTitle.innerText = "Основные задачи на  " + month_name.toLowerCase() + ' ' + year;

    // Вставляем месяц и год в input формы распечатки файла
    var elMonthYearInput = document.getElementById("month-year-input");
    elMonthYearInput.value = month_name.toLowerCase() + ' ' + year;

    var task_date = elSelectYear.value + '-' + elSelectMonth.value;

    return task_date;
}

function getItemsByMonth(classname = "task-and-topic-item"){

    var task_date = getCurrentMonthAndYear();

    // Очищаем форму распечатки файла
    while (elPrintFormItems.firstChild) {
        elPrintFormItems.removeChild(elPrintFormItems.firstChild);
    }

    var m, k;
    m=document.querySelectorAll("." + classname);
    k=m.length;
    while(k--){
        m[k].setAttribute('hidden', '');

        if (m[k].getAttribute('data-sort-date') == task_date){
            m[k].removeAttribute('hidden');
        }
    }
    // Выводим на печть элементы сисков
    printGeneralTasks();
    printAviationTopics();
    printAerodynamicsTopics();
}

// При загрузке страницы и при смене select года или месяца, выводим задачи по дате
document.addEventListener("DOMContentLoaded", getItemsByMonth());
elTaskCalendarDiv.addEventListener('change', event => {
    if (event.target.className == 'general-task-select'){
        getItemsByMonth();
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
          // Уменьшаем год на 1
            elSelectYear.value--;
        }
    }

    elSelectMonth.value = new_value;
    getItemsByMonth();

    // Делаем неактивной ссылку "назад" при крайней дате
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
    }

    if (new_value == "13"){
        new_value = "01";
        // Увеличиваем год на 1
        elSelectYear.value++;
    }

    elSelectMonth.value = new_value;
    getItemsByMonth();

    // Делаем неактивной ссылку "вперёд" при крайней дате
    if (elSelectYear.value == "2050"){
        if (elSelectMonth.value == "12"){
            elTaskButtonForward.setAttribute("disabled", "");
        }
    }
});

