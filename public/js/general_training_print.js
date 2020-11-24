// Функция вывода на печать задач
function printGeneralTasks() {

    var elGeneralTasksRow = document.getElementById("row-tasks");
    var m = elGeneralTasksRow.querySelectorAll('div:not([hidden])');

    for (var i = 0; i < m.length; i++){
        var n = i+1;// Порядковый номер задачи в списке
        elPrintFormItems.innerHTML += '<input name="general-task-item[' + i + '][gt]" value="№' + n + '">'
            + '<input name="general-task-item[' + i + '][task-title]" value="' + m[i].children[0].textContent + '">'
            + '<input name="general-task-item[' + i + '][task-description]" value="Описание: ' + m[i].children[1].textContent + '" >'
            + '<input name="general-task-item[' + i + '][task-author]" value="' + m[i].children[2].textContent + '" >'
            + '<input name="general-task-item[' + i + '][task-date]" value="' + m[i].children[3].textContent + '" >'
    }
}

function printAviationTopics() {

    var elAviationRow = document.getElementById("row-topics-aviation-technology");
    var m = elAviationRow.querySelectorAll('div:not([hidden])');

    for (var i = 0; i < m.length; i++){
        var n = i+1;// Порядковый номер темы в списке
        elPrintFormItems.innerHTML += '<input name="aviation-topic-item[' + i + '][av]" value="№' + n + '">'
            + '<input name="aviation-topic-item[' + i + '][av-topic-title]" value="' + m[i].children[0].textContent + '">'
            + '<input name="aviation-topic-item[' + i + '][av-topic-description]" value="Описание: ' + m[i].children[1].textContent + '" >'
            + '<input name="aviation-topic-item[' + i + '][av-topic-author]" value="' + m[i].children[2].textContent + '" >'
            + '<input name="aviation-topic-item[' + i + '][av-topic-date]" value="' + m[i].children[3].textContent + '" >'
    }
}

function printAerodynamicsTopics() {

    var elAerodynamicsRow = document.getElementById("row-topics-aerodynamics");
    var m = elAerodynamicsRow.querySelectorAll('div:not([hidden])');

    for (var i = 0; i < m.length; i++){
        var n = i+1;// Порядковый номер темы в списке
        elPrintFormItems.innerHTML += '<input name="aerodynamics-topic-item[' + i + '][aer]" value="№' + n + '">'
            + '<input name="aerodynamics-topic-item[' + i + '][aer-topic-title]" value="' + m[i].children[0].textContent + '">'
            + '<input name="aerodynamics-topic-item[' + i + '][aer-topic-description]" value="Описание: ' + m[i].children[1].textContent + '" >'
            + '<input name="aerodynamics-topic-item[' + i + '][aer-topic-author]" value="' + m[i].children[2].textContent + '" >'
            + '<input name="aerodynamics-topic-item[' + i + '][aer-topic-date]" value="' + m[i].children[3].textContent + '" >'
    }
}


