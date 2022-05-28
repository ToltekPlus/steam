import { sendData } from '../db/send';
import { notification } from '../notification/swal';
import { redirect } from '../db/redirect';

const button = document.querySelector('#deleteUserpic');
if (button) {
  button.addEventListener('click', function () {
    Swal.fire({
      title: 'Вы хотите удалить фото профиля?',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      cancelButtonText: 'Отмена',
      confirmButtonText: 'Да',
    }).then(result => {
      if (result.isConfirmed) {
        const header = {
          header: 'application/x-www-form-urlencoded',
        };

        const path = 'delete_userpic';

        const data_send = {};

        const send = sendData(data_send, path, header.header);
        send(data_send, path, header.header)
          .then(response => {
            if (response.trim() == '') {
              // запускаем всплывающее окно с сообщением, что все ок
              notification('Данные обновлены');
            } else {
              // запускаем всплывающее окно с сообщением, что произошла ошибка
              notification('Произошла ошибка', 'error');
            }
          })
          .catch(error => console.error(error));

        setTimeout(redirect('/account/edit'), 2000);
      }
    });
  });
}