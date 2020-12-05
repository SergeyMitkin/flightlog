// Функция вывода на печать задач
function printGeneralTasks() {

    // Определяем задачи по дате (не скрытые)
    var elGeneralTasksRow = document.getElementById("row-tasks");
    var m = elGeneralTasksRow.querySelectorAll('div:not([hidden])');

    // Помещаем в форму отрпавки страницы на печать
    for (var i = 0; i < m.length; i++){
        var n = i+1; // Порядковый номер задачи в списке
        elPrintFormItems.innerHTML += '<input name="general-task-item[' + i + '][gt]" value="№' + n + '">'
            + '<input name="general-task-item[' + i + '][task-title]" value="' + m[i].children[0].textContent + '">'
            + '<input name="general-task-item[' + i + '][task-description]" value="Описание: ' + m[i].children[1].textContent + '" >'
            + '<input name="general-task-item[' + i + '][task-author]" value="' + m[i].children[2].textContent + '" >'
            + '<input name="general-task-item[' + i + '][task-date]" value="' + m[i].children[3].textContent + '" >'
    }
}

// Функция вывода на печать тем по авиации
function printAviationTopics() {

    // Определяем темы по дате (не скрытые)
    var elAviationRow = document.getElementById("row-topics-aviation-technology");
    var m = elAviationRow.querySelectorAll('div:not([hidden])');

    // Помещаем в форму отрпавки страницы на печать
    for (var i = 0; i < m.length; i++){
        var n = i+1; // Порядковый номер темы в списке
        elPrintFormItems.innerHTML += '<input name="aviation-topic-item[' + i + '][av]" value="№' + n + '">'
            + '<input name="aviation-topic-item[' + i + '][av-topic-title]" value="' + m[i].children[0].textContent + '">'
            + '<input name="aviation-topic-item[' + i + '][av-topic-description]" value="Описание: ' + m[i].children[1].textContent + '" >'
            + '<input name="aviation-topic-item[' + i + '][av-topic-author]" value="' + m[i].children[2].textContent + '" >'
            + '<input name="aviation-topic-item[' + i + '][av-topic-date]" value="' + m[i].children[3].textContent + '" >'
    }
}

// Функция вывода на печать тем по аэродинамике
function printAerodynamicsTopics() {

    // Определяем темы по дате (не скрытые)
    var elAerodynamicsRow = document.getElementById("row-topics-aerodynamics");
    var m = elAerodynamicsRow.querySelectorAll('div:not([hidden])');

    // Помещаем в форму отрпавки страницы на печать
    for (var i = 0; i < m.length; i++){
        var n = i+1; // Порядковый номер темы в списке
        elPrintFormItems.innerHTML += '<input name="aerodynamics-topic-item[' + i + '][aer]" value="№' + n + '">'
            + '<input name="aerodynamics-topic-item[' + i + '][aer-topic-title]" value="' + m[i].children[0].textContent + '">'
            + '<input name="aerodynamics-topic-item[' + i + '][aer-topic-description]" value="Описание: ' + m[i].children[1].textContent + '" >'
            + '<input name="aerodynamics-topic-item[' + i + '][aer-topic-author]" value="' + m[i].children[2].textContent + '" >'
            + '<input name="aerodynamics-topic-item[' + i + '][aer-topic-date]" value="' + m[i].children[3].textContent + '" >'
    }
}

// Функция вывода на печать тем по навигации
function printNavigationTopics() {

    // Определяем темы по дате (не скрытые)
    var elNavigationRow = document.getElementById("row-topics-navigation");
    var m = elNavigationRow.querySelectorAll('div:not([hidden])');

    // Помещаем в форму отрпавки страницы на печать
    for (var i = 0; i < m.length; i++){
        var n = i+1; // Порядковый номер темы в списке
        elPrintFormItems.innerHTML += '<input name="navigation-topic-item[' + i + '][nav]" value="№' + n + '">'
            + '<input name="navigation-topic-item[' + i + '][nav-topic-title]" value="' + m[i].children[0].textContent + '">'
            + '<input name="navigation-topic-item[' + i + '][nav-topic-description]" value="Описание: ' + m[i].children[1].textContent + '" >'
            + '<input name="navigation-topic-item[' + i + '][nav-topic-author]" value="' + m[i].children[2].textContent + '" >'
            + '<input name="navigation-topic-item[' + i + '][nav-topic-date]" value="' + m[i].children[3].textContent + '" >'
    }
}

// Функция вывода на печать руководящих документов
function printGuidelinesTopics() {

    // Определяем темы по дате (не скрытые)
    var elGuidelinesRow = document.getElementById("row-topics-guidelines");
    var m = elGuidelinesRow.querySelectorAll('div:not([hidden])');

    // Помещаем в форму отрпавки страницы на печать
    for (var i = 0; i < m.length; i++){
        var n = i+1; // Порядковый номер темы в списке
        elPrintFormItems.innerHTML += '<input name="guidelines-topic-item[' + i + '][guide]" value="№' + n + '">'
            + '<input name="guidelines-topic-item[' + i + '][guide-topic-title]" value="' + m[i].children[0].textContent + '">'
            + '<input name="guidelines-topic-item[' + i + '][guide-topic-description]" value="Описание: ' + m[i].children[1].textContent + '" >'
            + '<input name="guidelines-topic-item[' + i + '][guide-topic-author]" value="' + m[i].children[2].textContent + '" >'
            + '<input name="guidelines-topic-item[' + i + '][guide-topic-date]" value="' + m[i].children[3].textContent + '" >'
    }
}

// Функция вывода на печать тем по тактике
function printTacticsTopics() {

    // Определяем темы по дате (не скрытые)
    var elTacticsRow = document.getElementById("row-topics-tactics");
    var m = elTacticsRow.querySelectorAll('div:not([hidden])');

    // Помещаем в форму отрпавки страницы на печать
    for (var i = 0; i < m.length; i++){
        var n = i+1; // Порядковый номер темы в списке
        elPrintFormItems.innerHTML += '<input name="tactics-topic-item[' + i + '][tac]" value="№' + n + '">'
            + '<input name="tactics-topic-item[' + i + '][tac-topic-title]" value="' + m[i].children[0].textContent + '">'
            + '<input name="tactics-topic-item[' + i + '][tac-topic-description]" value="Описание: ' + m[i].children[1].textContent + '" >'
            + '<input name="tactics-topic-item[' + i + '][tac-topic-author]" value="' + m[i].children[2].textContent + '" >'
            + '<input name="tactics-topic-item[' + i + '][tac-topic-date]" value="' + m[i].children[3].textContent + '" >'
    }
}

