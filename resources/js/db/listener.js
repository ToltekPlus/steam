import { sendData } from './send';
import { list } from '../route/list';
import { validate } from '../content/validate';
import { notification } from '../notification/swal';
import { redirect } from './redirect';
import { clearForm } from './clear_form';
import { addNewValueToCountContent } from '../content/statistics_for_table';
import { identity_route } from '../cart/identity_route';

document.addEventListener('DOMContentLoaded', () => {
  // Создаем массив объектов, в котором соотносятся страницы с роутерами
  const type = list();

  const identityRoute = identity_route(type);

  // выворачиваем результат
  const operation = identityRoute.shift();

  // описываем способ отправки данных
  const send = sendData(FormData, operation.action);

  // описываем слушателя по клику в форме
  const forms = document.querySelectorAll('form');
  for (const form of forms) {
    form.addEventListener('submit', function (e) {
      const validateResult = validate();

      e.preventDefault();
      const formData = new FormData(this);

      if (validateResult == false) {
        notification('Не все данные введены', 'error');
      } else {
        send(formData)
          .then(response => {
            if (response.trim() == '') {
              // запускаем всплывающее окно с сообщением, что все ок
              // увеличиваем значение в статистике значений
              // addNewValueToCountContent();
              notification(operation.message);
            } else {
              // запускаем всплывающее окно с сообщением, что произошла ошибка
              notification(operation.message_error, 'error');
            }

            // очищаем форму
            clearForm(form, '#file-js-example .file-name');
          })
          .catch(error => console.error(error));
      }

      // если поле редиректа не пустое, то редиректимся туда, куда описывает поле
      setTimeout(redirect(operation.redirect), 2000);
    });
  }
});
