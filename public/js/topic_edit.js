/*
var elRowTopicsAviation = document.getElementById("row-topics-aviation-technology");
var elRowTopicsAerodynamics = document.getElementById("row-topics-aerodynamics");
var elRowTopicsNavigation = document.getElementById("row-topics-navigation");
var elRowTopicsGuidelines = document.getElementById("row-topics-guidelines");
var elRowTopicsTactics = document.getElementById("row-topics-tactics");
*/

// Прикрепляем событие кнопкам редактировать
var elTopicsLists = document.querySelectorAll(".row-topics");

for (var i=0; i<elTopicsLists.length; i++){
    elTopicsLists[i].addEventListener("click", event=>{

        if (event.target.classList.contains("topic-edit-button")){

            var topic_id = event.target.id.split("_")[1]; // Id задачи
            var elDivTopicItem = document.getElementById("topic-item_" + topic_id); // Карточка темы

            elDivTopicItem.appendChild(elDivTopicCreateForm);
            elDivTopicCreateForm.removeAttribute("hidden");
            showCreateButton(); // Отображаем кнопку "Создать", если была скрыта
            showEditButton(); // Отображаем кнопку "Редактировать", если была скрыта
            resetTopicCreateForm(); // Очищаем форму создания/редактирования заадчи
            fillTopicCreateForm(topic_id); // Заполняем форму данными полёта

            event.target.setAttribute("hidden", ""); // Скрываем кнопку "Редактировать"
        }
    })
}

