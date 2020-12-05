// Прикрепляем событие к кнопке "Распечатать" в карточке полёта
elRowFlights.addEventListener("click", event => {
    if (event.target.className == "flight-print-button"){

        var flight_id = event.target.id.split("_")[1]; // Id полёта
        var print = "on";

        fillFlightForm(flight_id, print); // Заполняем форму данными полёта

        elFlightCreateForm.submit(); // Отправляем форму
    }
})