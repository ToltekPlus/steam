// TODO декомпозировать код: использовать созданные функции и получать список роутов из json-файла
// TODO написать валидацию данных на js

const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 2000,
    timerProgressBar: true,
    didOpen: (toast) => {
        toast.addEventListener('mouseenter', Swal.stopTimer)
        toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
});

document.addEventListener('DOMContentLoaded', () => {
    // Создаем массив объектов, в котором соотносятся страницы с роутерами
    let type = [
        {
            "page": "add",
            "action": "store",
            "redirect": "",
            "message": "Данные добавлены"
        },
        {
            "page": "edit",
            "action": "update",
            "redirect": "",
            "message": "Данные обновлены"
        },
        {
            "page": "list",
            "action": "delete",
            "redirect": "list",
            "message": "Данные удалены"
        },
    ];

    // собираем url без get параметров
    let urlPATH = window.location.origin + window.location.pathname;

    // ищем соответствующий метод для работы
    let operation = type.filter(item => {
        return item.page === urlPATH.split('/').pop();
    });

    const send = async (formData) => {
        const fetchResponse = await fetch(operation[0].action, {
            method: 'POST',
            body: formData
        });
        if (!fetchResponse.ok) {
            throw new Error(`Ошибка по адресу ${url}, статус ошибки ${fetchResp.status}`);
        }
        return await fetchResponse.text();
    };

    const forms = document.querySelectorAll('form');
    forms.forEach(form => {
        form.addEventListener('submit', function (e) {
            e.preventDefault();
            const formData = new FormData(this);

            send(formData)
                .then((response) => {
                    Toast.fire({
                        icon: "success",
                        text: operation[0].message
                    });

                    form.reset();
                })
                .catch((err) => console.error(err));


            function redirect() {
                if(operation[0]['redirect']){
                    location = operation[0]['redirect'];
                }
            }

            setTimeout(redirect, 1000);
        });
    });
});