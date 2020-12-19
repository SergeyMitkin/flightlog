// Элементы календаря
var elTaskCalendarDiv = document.getElementById("task-calendar-div"); // Div с календарём
var elTaskButtonBack = document.getElementById("task-button-back"); // Кнопка "Назад"
var elTaskButtonForward = document.getElementById("task-button-forward"); // Кнопка "Вперёд"
var elSelectYear = document.getElementById("year-task-select"); // Селект для года
var elSelectMonth = document.getElementById("month-task-select"); // Селект для месяца
var elPrintFormItems = document.getElementById("print-form-items"); // Форма вывода страницы на печать

// Получаем текущий месяц
function getCurrentMonthAndYear(){

    // Вставляем в заголовок название месяца и год
    var month_name = elSelectMonth.querySelector('option[value="' + elSelectMonth.value + '"]').textContent;
    var year = elSelectYear.querySelector('option[value="' + elSelectYear.value + '"]').textContent;
    var elTaskTitle = document.getElementById("general-tasks-title");
    elTaskTitle.innerText = "Основные задачи на  " + month_name.toLowerCase() + ' ' + year;

    // Вставляем месяц и год в input формы распечатки файла
    var elMonthYearInput = document.getElementById("month-year-input");
    elMonthYearInput.value = month_name.toLowerCase() + ' ' + year;

    // Дата для sql-запросов
    var task_date = elSelectYear.value + '-' + elSelectMonth.value;

    return task_date;
}

// Получаем записи по месяцу
function getItemsByMonth(classname = "row-item"){

    // Получаем необходимый месяц
    var task_date = getCurrentMonthAndYear();

    // Очищаем форму печати страницы, если необходимо
    while (elPrintFormItems.firstChild) {
        elPrintFormItems.removeChild(elPrintFormItems.firstChild);
    }

    // Скрываем темы и задачи не соответсвующие дате
    var m, k;
    m=document.querySelectorAll("." + classname);
    k=m.length;
    while(k--){
        m[k].setAttribute('hidden', '');

        if (m[k].getAttribute('data-sort-date') == task_date){
            m[k].removeAttribute('hidden');
        }
    }
    // Вставляем в форму печати списки с задачми и темами
    printGeneralTasks();
    printAviationTopics();
    printAerodynamicsTopics();
    printNavigationTopics();
    printGuidelinesTopics();
    printTacticsTopics();
}

// Получаем год, отображённый на календаре
function getCalendarYear(){
    var calendar_year = elSelectYear.value;
    return calendar_year;
}

// Получаем месяц, отображённый на календаре
function getCalendarMonth() {
    var calendar_month = elSelectMonth.value;
    return calendar_month;
}

// События при загрузке страницы
document.addEventListener("DOMContentLoaded", event=>{
    getItemsByMonth();
    // Удалеям get-параметры task-delete и topic-delete из url если они были
    var new_url = removeURLParameter(document.location.href, 'task-delete');
    new_url = removeURLParameter(new_url, 'topic-delete');
    new_url = removeURLParameter(new_url, 'current-date');
    history.pushState('', '', new_url);

    insertDateInUrl(); // Добавляем дату в get-параметры

    // Добавляем дату в кнопки "Удалить"
    for (var i=0; i<elRowTasks.querySelectorAll(".delete-href").length; i++){
        var task_id = elRowTasks.querySelectorAll(".delete-href")[i].id.split("_")[1];
        elRowTasks.querySelectorAll(".delete-href")[i].href = document.location.href + "&task-delete=" + task_id;
    }
});

// События при смене select года или месяца
elTaskCalendarDiv.addEventListener('change', event => {
    if (event.target.className == 'general-task-select'){
        getItemsByMonth(); // Выводим задачи по дате
        insertDateInUrl(); // Добавляем дату в get-параметры
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
    getItemsByMonth(); // Получаем записи на месяц
    insertDateInUrl(); // Добавляем дату в get-параметры

    // Делаем неактивной ссылку "назад" при крайней дате
    if (elSelectYear.value == "2000"){
        if (elSelectMonth.value == "01"){
            elTaskButtonBack.setAttribute("disabled", "");
        }
    }
});

// Получаем записи на следующий месяц
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
    getItemsByMonth(); // Получаем записи на месяц
    insertDateInUrl(); // Добавляем дату в get-параметры

    // Делаем неактивной ссылку "вперёд" при крайней дате
    if (elSelectYear.value == "2050"){
        if (elSelectMonth.value == "12"){
            elTaskButtonForward.setAttribute("disabled", "");
        }
    }
});

// Добавляем дату в get-параметры
function insertDateInUrl(){
    // Обновляем гет-параметры в url
    var calendar_year = getCalendarYear();
    var calendar_month = getCalendarMonth();

    // В параметре send-form, указываем, что не отправляем форму
    var new_url = "/?year=" + calendar_year + "&month=" + calendar_month + "&send-form=off";
    history.pushState('', '', new_url);
}
