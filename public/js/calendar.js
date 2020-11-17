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
elTaskButtonBack.addEventListener('click', event => {
    //var month_number = elSelectMonth.value -1;

    /*
    // var myNode = document.getElementById("foo");
    while (elSelectMonth.firstChild) {
        elSelectMonth.removeChild(elSelectMonth.firstChild);
    }
    */

    var elSelectedOption = elSelectMonth.querySelector('option[selected=""]');
    console.log(elSelectedOption);

    var n = elSelectedOption.value;

    var new_value = n - 1 + ""; // Уменьшаем значение месяца и преобразовываем встроку

    if(typeof new_value[1] == "undefined"){
        new_value = "0" + new_value;
        console.log(new_value);
        if (new_value == "00"){
            new_value = "12";
        }
    }


    elSelectedOption.removeAttribute("selected");

    var elPreviousOption = elSelectMonth.querySelector('option[value="' + new_value + '"]')
    elPreviousOption.setAttribute("selected", "");

    //console.log(elPreviousOption);
    //var previous_month_number;

    //elSelectMonth.value = month_number;

    // previous_month_number = month_number - 1;
    // elSelectMonth.value = previous_month_number;
    //console.log(elSelectMonth.value);

    /*
   if (month_number[0] == 0){
       previous_month_number = month_number[1] - 1;
       console.log(previous_month_number);
   }

    console.log(elSelectMonth.value);
    */
});

