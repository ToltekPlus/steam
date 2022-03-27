import MaskInput from "mask-input";
import { auth_validate } from "../content/auth_validate";

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
                    return [
                        document.getElementById('phone').value,
                        document.getElementById('password').value
                    ]
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
                            return [
                                document.getElementById('phone').value,
                                document.getElementById('password').value
                            ]
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
            }
        })
        new MaskInput(document.querySelector('.input-selector'), {
            mask: '+(000)-000-00-00',
            alwaysShowMask: true,
            maskChar: '_',
        });
    };
}