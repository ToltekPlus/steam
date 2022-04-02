import MaskInput from "mask-input";
import { auth_validate } from "../content/auth_validate";
import { sendData } from "../db/send";

var buttonAuth = document.getElementById("enterToAccount");
if (buttonAuth) {
    buttonAuth.onclick = function() {
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
                    let phone = document.getElementById('phone').value;
                    let password = document.getElementById('password').value;
                    const data = {
                        "phone": phone,
                        "password": password,
                    };
                    let auth = {
                        "header": "application/x-www-form-urlencoded"
                    };
                    let path = "login"
                    let data_send = JSON.stringify(data);
                    const send = sendData(data_send, path, auth.header);
                    send(data_send, path, auth.header)
                        .then(response => {
                            console.log(response);
                        })
                        .catch(error => {
                            console.log(error);
                        })
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
            denyButtonText: 'или зарегестрироваться'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire(
                    'Вы успешно вошли',
                    '',
                    'success'
                )
            }else if (result.isDenied) {
                registerForm();
            }
        })
        new MaskInput(document.querySelector('.input-selector'), {
            mask: '+0-(000)-000-00-00',
            alwaysShowMask: true,
            maskChar: '_',
        });

    };
}

function registerForm()
{
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
                let phone = document.getElementById('phone').value;
                let password = document.getElementById('password').value;
                const data = {
                    "phone": phone,
                    "password": password,
                };
                let register = {
                    "header": "application/x-www-form-urlencoded"
                };
                let path = "register"
                let data_send = JSON.stringify(data);
                const send = sendData(data_send, path, register.header);
                send(data_send, path, register.header)
                    .then(response => {
                        console.log(response);
                    })
                    .catch(error => {
                        console.log(error);
                    })
            }
        },
        showConfirmButton: true,
        background: 'linear-gradient(135deg, #dfe9f3 10%, #ffffff 100%)',
        confirmButtonColor: '#0C57C7',
        confirmButtonText: 'Зарегестрироваться',
    }).then((result) => {
        if (result.isConfirmed && auth_validate()) {
            Swal.fire(
                'Вы успешно зарегестрировались',
                '',
                'success'
            )
        }
    })
    new MaskInput(document.querySelector('.input-selector'), {
        mask: '+0-(000)-000-00-00',
        alwaysShowMask: true,
        maskChar: '_',
    });
}