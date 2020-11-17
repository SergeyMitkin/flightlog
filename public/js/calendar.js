

var elTaskRow = document.getElementById("row-tasks");
var elTaskCalendarDiv = document.getElementById("task-calendar-div");

elTaskCalendarDiv.addEventListener('change', event =>{
    if (event.target.className == 'general-task-select'){
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

            //console.log(m[k].getAttribute('data-sort-date'));
        }
//if(m[k].parentNode.parentNode.tagName.search(/div/i)<0){
// или так
              //  if(m[k].parentNode.parentNode.tagName!="DIV"){
                //    m[k].style.display="none";}};




        //console.log(m);
    }
})


