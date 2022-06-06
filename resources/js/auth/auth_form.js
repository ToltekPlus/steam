import MaskInput from 'mask-input';
import { auth_validate } from '../content/auth_validate';
import { sendData } from '../db/send';

const buttonAuth = document.querySelector('#enterToAccount');
if (buttonAuth) {
  buttonAuth.addEventListener('click', function () {
    Swal.fire({
      title: 'Войти в аккаунт',
      html:
        '<input id="phone" type="tel" class="auth-field input-selector" placeholder="Номер телефона">' +
        '<input id="password" type="password" class="auth-field" placeholder="Пароль">',
      preConfirm: () => {
        if (!auth_validate()) {
          Swal.showValidationMessage('Не все данные введены!');
        } else {
          send_data('auth', 'Введён неверный логин или пароль');
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
      '<input id="password" type="password" class="auth-field" placeholder="Пароль">',
    preConfirm: () => {
      if (!auth_validate()) {
        Swal.showValidationMessage('Не все данные введены!');
      } else {
        send_data('register', 'Такой пользователь уже зарегестрирован');
      }
    },
    showConfirmButton: true,
    background: 'linear-gradient(135deg, #dfe9f3 10%, #ffffff 100%)',
    confirmButtonColor: '#0C57C7',
    confirmButtonText: 'Зарегестрироваться',
  }).then(result => {
    if (result.isConfirmed && auth_validate()) {
      Swal.fire('Вы успешно зарегестрировались', '', 'success');
    }
  });
  new MaskInput(document.querySelector('.input-selector'), {
    mask: '+7-(000)-000-00-00',
    alwaysShowMask: true,
    maskChar: '_',
  });
}

function send_data(path, message) {
  const header = {
    header: 'application/x-www-form-urlencoded',
  };

  const data = {
    phone: document.querySelector('#phone').value,
    password: document.querySelector('#password').value,
  };

  const data_send = JSON.stringify(data);
  const send = sendData(data_send, path, header.header);
  send(data_send, path, header.header)
    .then(response => {
      if (response != 0) {
        window.setTimeout(function () {
          window.location = '/';
        }, 500);
      } else {
        Swal.fire(message, '', 'error');
      }
    })
    .catch(error => {
      console.log(error);
    });
}
