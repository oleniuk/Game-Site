document.addEventListener("DOMContentLoaded", function() {
    var form = document.getElementById("email-form");

    form.addEventListener("submit", function(event) {
        event.preventDefault(); // Зупиняємо стандартну подію подання форми

        var formData = new FormData(form); // Створюємо об'єкт FormData з даних форми

        // Відправка даних форми на сервер
        fetch(form.action, {
            method: form.method,
            body: formData,
            headers: {
                "Accept": "application/json"
            }
        })
        .then(function(response) {
            if (response.ok) {
                return response.json(); // Повертаємо об'єкт JSON з відповіддю сервера
            }
            throw new Error("Network response was not ok.");
        })
        .then(function(data) {
            console.log(data); // Виводимо відповідь сервера у консоль
            // Тут ви можете виконати подальші дії після успішного надсилання форми, наприклад, відображення повідомлення про успішне відправлення
            alert("Ваше повідомлення успішно відправлено!");
        })
        .catch(function(error) {
            console.error("There was a problem with your fetch operation:", error);
            // Тут ви можете виконати додаткові дії в разі помилки відправлення форми
            alert("При відправленні форми виникла помилка. Будь ласка, спробуйте ще раз.");
        });
    });
});
