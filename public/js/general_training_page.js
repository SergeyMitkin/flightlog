var elDivTaskCreateForm = document.getElementById("div-task-create-form");
var elTaskCreateFormButton = document.getElementById("task-create-form-button");

elTaskCreateFormButton.addEventListener("click", event =>{
    elDivTaskCreateForm.removeAttribute("hidden");
    event.target.setAttribute("hidden", "");
})

var elDivTopicCreateForm = document.getElementById("div-topic-create-form");
var elTopicCreateFormButton = document.getElementById('topic-create-form-button');

elTopicCreateFormButton.addEventListener("click", event =>{
    elDivTopicCreateForm.removeAttribute("hidden");
    event.target.setAttribute("hidden", "");
})