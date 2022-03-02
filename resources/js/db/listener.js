import { sendData } from './send';
import { list } from "../route/list";
import { notification } from '../notification/swal';
import { redirect } from './redirect';
import { clearForm } from "./clear_form";
import { addNewValueToCountContent } from "../content/statistics_for_table";

document.addEventListener('DOMContentLoaded', () => {
    // Создаем массив объектов, в котором соотносятся страницы с роутерами
    let type = list();

    // собираем url без get параметров
    let urlPATH = window.location.origin + window.location.pathname;

    // ищем соответствующий метод для работы
    let identityRoute = type.filter(item => {
        return item.page === urlPATH.split('/').pop();
    });

    // выворачиваем результат
    let operation = identityRoute.shift();

    // описываем способ отправки данных
    const send = sendData(FormData, operation.action);

    // описываем слушателя по клику в форме
    const forms = document.querySelectorAll('form');
    forms.forEach(form => {
        form.addEventListener('submit', function (e) {
            e.preventDefault();
            const formData = new FormData(this);

            send(formData)
                .then((response) => {
                    if (response.trim() == '') {
                        // запускаем всплывающее окно с сообщением, что все ок
                        // увеличиваем значение в статистике значений
                        addNewValueToCountContent();
                        notification(operation.message);
                    }else {
                        // запускаем всплывающее окно с сообщением, что произошла ошибка
                        notification(operation.message_error, 'error');
                    }

                    // очищаем форму
                    clearForm(form, '#file-js-example .file-name');
                })
                .catch((err) => console.error(err));

            // если поле редиректа не пустое, то редиректимся туда, куда описывает поле
            setTimeout(redirect(operation.redirect), 2000);
        });
    });
});