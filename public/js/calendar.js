var elTaskRow = document.getElementById("row-tasks");
var elTaskCalendarDiv = document.getElementById("task-calendar-div");

function getTasksByMonth(){
    var elSelectYear = document.getElementById("year-task-select");
    var elSelectMonth = document.getElementById("month-task-select");
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
elTaskCalendarDiv.addEventListener('change', event =>{
    if (event.target.className == 'general-task-select'){
        getTasksByMonth();
    }
})

