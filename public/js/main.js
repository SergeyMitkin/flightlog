var elMenu = document.getElementById("menu"); // Меню

// При клике на ссылку в меню, устанавливаем текущую дату, если необходимо
elMenu.addEventListener("click", event => {
    event.preventDefault();

    if (event.target.id == "menu-general-training-href") {
        location.href = location.origin + "?current-date=on";
    }

    if (event.target.id == "menu-training-href") {
        location.href = location.origin + "/training/";
    }

    if (event.target.id == "menu-authors-href") {
        location.href = location.origin + "/authors/";
    }
})

