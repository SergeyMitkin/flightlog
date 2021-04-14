// Функция вывода на печать задач
function printGeneralTasks() {

    // Определяем задачи по дате (не скрытые)
    var currentTasks = document.querySelectorAll("#row-tasks > div:not([hidden])");

    // Помещаем в форму отрпавки страницы на печать
    for (var i = 0; i < currentTasks.length; i++){

        var n = i+1; // Порядковый номер задачи в списке

        elPrintFormItems.innerHTML += '<input name="general-task-item[' + i + '][gt]" value="№' + n + '">'
            + '<input name="general-task-item[' + i + '][task-title]" value="' + currentTasks[i].children[0].textContent + '">'
            + '<input name="general-task-item[' + i + '][task-description]" value="Описание: ' + currentTasks[i].children[1].textContent + '" >'
            + '<input name="general-task-item[' + i + '][task-author]" value="' + currentTasks[i].children[2].textContent + '" >'
            + '<input name="general-task-item[' + i + '][task-date]" value="' + currentTasks[i].children[3].textContent + '" >'
    }
}

// Функция вывода на печать тем по авиации
function printAviationTopics() {

    // Определяем темы по дате (не скрытые)
    var currentAviationTopics = document.querySelectorAll("#row-topics-aviation-technology > div:not([hidden])");

    // Помещаем в форму отрпавки страницы на печать
    for (var i = 0; i < currentAviationTopics.length; i++){
        var n = i+1; // Порядковый номер темы в списке
        elPrintFormItems.innerHTML += '<input name="aviation-topic-item[' + i + '][av]" value="№' + n + '">'
            + '<input name="aviation-topic-item[' + i + '][av-topic-title]" value="' + currentAviationTopics[i].children[0].textContent + '">'
            + '<input name="aviation-topic-item[' + i + '][av-topic-description]" value="Описание: ' + currentAviationTopics[i].children[1].textContent + '" >'
            + '<input name="aviation-topic-item[' + i + '][av-topic-author]" value="' + currentAviationTopics[i].children[2].textContent + '" >'
            + '<input name="aviation-topic-item[' + i + '][av-topic-date]" value="' + currentAviationTopics[i].children[3].textContent + '" >'
    }
}

// Функция вывода на печать тем по аэродинамике
function printAerodynamicsTopics() {

    // Определяем темы по дате (не скрытые)
    var currentAerodynamicsTopics = document.querySelectorAll("#row-topics-aerodynamics > div:not([hidden])");

    // Помещаем в форму отрпавки страницы на печать
    for (var i = 0; i <currentAerodynamicsTopics.length; i++){
        var n = i+1; // Порядковый номер темы в списке
        elPrintFormItems.innerHTML += '<input name="aerodynamics-topic-item[' + i + '][aer]" value="№' + n + '">'
            + '<input name="aerodynamics-topic-item[' + i + '][aer-topic-title]" value="' + currentAerodynamicsTopics[i].children[0].textContent + '">'
            + '<input name="aerodynamics-topic-item[' + i + '][aer-topic-description]" value="Описание: ' + currentAerodynamicsTopics[i].children[1].textContent + '" >'
            + '<input name="aerodynamics-topic-item[' + i + '][aer-topic-author]" value="' + currentAerodynamicsTopics[i].children[2].textContent + '" >'
            + '<input name="aerodynamics-topic-item[' + i + '][aer-topic-date]" value="' + currentAerodynamicsTopics[i].children[3].textContent + '" >'
    }
}

// Функция вывода на печать тем по навигации
function printNavigationTopics() {

    // Определяем темы по дате (не скрытые)
    var currentNavigationTopics = document.querySelectorAll("#row-topics-navigation > div:not([hidden])");

    // Помещаем в форму отрпавки страницы на печать
    for (var i = 0; i < currentNavigationTopics.length; i++){
        var n = i+1; // Порядковый номер темы в списке
        elPrintFormItems.innerHTML += '<input name="navigation-topic-item[' + i + '][nav]" value="№' + n + '">'
            + '<input name="navigation-topic-item[' + i + '][nav-topic-title]" value="' + currentNavigationTopics[i].children[0].textContent + '">'
            + '<input name="navigation-topic-item[' + i + '][nav-topic-description]" value="Описание: ' + currentNavigationTopics[i].children[1].textContent + '" >'
            + '<input name="navigation-topic-item[' + i + '][nav-topic-author]" value="' + currentNavigationTopics[i].children[2].textContent + '" >'
            + '<input name="navigation-topic-item[' + i + '][nav-topic-date]" value="' + currentNavigationTopics[i].children[3].textContent + '" >'
    }
}

// Функция вывода на печать руководящих документов
function printGuidelinesTopics() {

    // Определяем темы по дате (не скрытые)
    var currentGuidelinesTopics = document.querySelectorAll("#row-topics-guidelines > div:not([hidden])");

    // Помещаем в форму отрпавки страницы на печать
    for (var i = 0; i < currentGuidelinesTopics.length; i++){
        var n = i+1; // Порядковый номер темы в списке
        elPrintFormItems.innerHTML += '<input name="guidelines-topic-item[' + i + '][guide]" value="№' + n + '">'
            + '<input name="guidelines-topic-item[' + i + '][guide-topic-title]" value="' + currentGuidelinesTopics[i].children[0].textContent + '">'
            + '<input name="guidelines-topic-item[' + i + '][guide-topic-description]" value="Описание: ' + currentGuidelinesTopics[i].children[1].textContent + '" >'
            + '<input name="guidelines-topic-item[' + i + '][guide-topic-author]" value="' + currentGuidelinesTopics[i].children[2].textContent + '" >'
            + '<input name="guidelines-topic-item[' + i + '][guide-topic-date]" value="' + currentGuidelinesTopics[i].children[3].textContent + '" >'
    }
}

// Функция вывода на печать тем по тактике
function printTacticsTopics() {

    // Определяем темы по дате (не скрытые)
    var currentTacticsTopics = document.querySelectorAll("#row-topics-tactics > div:not([hidden])");

    // Помещаем в форму отрпавки страницы на печать
    for (var i = 0; i < currentTacticsTopics.length; i++){
        var n = i+1; // Порядковый номер темы в списке
        elPrintFormItems.innerHTML += '<input name="tactics-topic-item[' + i + '][tac]" value="№' + n + '">'
            + '<input name="tactics-topic-item[' + i + '][tac-topic-title]" value="' + currentTacticsTopics[i].children[0].textContent + '">'
            + '<input name="tactics-topic-item[' + i + '][tac-topic-description]" value="Описание: ' + currentTacticsTopics[i].children[1].textContent + '" >'
            + '<input name="tactics-topic-item[' + i + '][tac-topic-author]" value="' + currentTacticsTopics[i].children[2].textContent + '" >'
            + '<input name="tactics-topic-item[' + i + '][tac-topic-date]" value="' + currentTacticsTopics[i].children[3].textContent + '" >'
    }
}

