var elDivTaskCreateForm = document.getElementById("div-task-create-form");
var elTaskCreateFormButton = document.getElementById("task-create-form-button");

elTaskCreateFormButton.addEventListener("click", event =>{
    elDivTaskCreateForm.removeAttribute("hidden");
    event.target.setAttribute("hidden", "");
})