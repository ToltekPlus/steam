import MaskInput from 'mask-input';
import { auth_validate } from '../content/auth_validate';
import { sendData } from '../db/send';

// TODO декомпозировать код, убрать ненужные блоки
const buttonAuth = document.querySelector('#enterToAccount');
if (buttonAuth) {
  buttonAuth.addEventListener('click', function () {
    Swal.fire({
      title: 'Войти в аккаунт',
      html:
        '<input id="phone" type="tel" class="auth-field input-selector" placeholder="Номер телефона">' +
        '<div id="phoneErrDiv"></div>' +
        '<input id="password" type="password" class="auth-field" placeholder="Пароль">' +
        '<div id="passwordErrDiv"></div>',
      preConfirm: () => {
        if (!auth_validate()) {
          Swal.showValidationMessage('Проверьте правильность введных данных');
        } else {
          const auth = {
            header: 'application/x-www-form-urlencoded',
          };

          const path = 'auth';

          const data = {
            phone: document.querySelector('#phone').value,
            password: document.querySelector('#password').value,
          };

          const data_send = JSON.stringify(data);
          const send = sendData(data_send, path, auth.header);
          send(data_send, path, auth.header)
            .then(response => {
              if (response == 1) {
                window.setTimeout(function () {
                  window.location = '/';
                }, 500);
              } else {
                Swal.showValidationMessage(
                  'Проверьте правильность введных данных',
                );
              }
            })
            .catch(error => {
              console.log(error);
            });
        }
      },
      backdrop: `
              rgba(18,97,199,0.4)
              url("/images/nyan-cat.gif")
              left tops
              no-repeat
            `,
      showConfirmButton: true,
      showDenyButton: true,
      background: 'linear-gradient(135deg, #dfe9f3 10%, #ffffff 100%)',
      confirmButtonColor: '#0C57C7',
      confirmButtonText: 'Войти',
      denyButtonText: 'или зарегестрироваться',
    }).then(result => {
      if (result.isConfirmed) {
        Swal.fire('Вы успешно вошли', '', 'success');
      } else if (result.isDenied) {
        registerForm();
      }
    });
    new MaskInput(document.querySelector('.input-selector'), {
      mask: '+7-(000)-000-00-00',
      alwaysShowMask: true,
      maskChar: '_',
    });
  });
}

function registerForm() {
  Swal.fire({
    title: 'Зарегестрироваться',
    html:
      '<input id="phone" type="tel" class="auth-field input-selector" placeholder="Номер телефона">' +
      '<div id="phoneErrDiv"></div>' +
      '<input id="password" type="password" class="auth-field" placeholder="Пароль">' +
      '<div id="passwordErrDiv"></div>',
    preConfirm: () => {
      if (!auth_validate()) {
        Swal.showValidationMessage('Проверьте правильность введных данных');
      } else {
        const register = {
          header: 'application/x-www-form-urlencoded',
        };

        const path = 'register';

        const data = {
          phone: document.querySelector('#phone').value,
          password: document.querySelector('#password').value,
        };

        const data_send = JSON.stringify(data);
        const send = sendData(data_send, path, register.header);
        send(data_send, path, register.header)
          .then(response => {
            console.log(response);
          })
          .catch(error => {
            console.log(error);
          });
      }
    },
    showConfirmButton: true,
    background: 'linear-gradient(135deg, #dfe9f3 10%, #ffffff 100%)',
    confirmButtonColor: '#0C57C7',
    confirmButtonText: 'Зарегестрироваться',
  }).then(result => {
    if (result.isConfirmed && auth_validate()) {
      Swal.fire('Вы успешно зарегестрировались', '', 'success');
      window.setTimeout(function () {
        window.location = '/basket';
      }, 500);
    }
  });
  new MaskInput(document.querySelector('.input-selector'), {
    mask: '+7-(000)-000-00-00',
    alwaysShowMask: true,
    maskChar: '_',
  });
}
