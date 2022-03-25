import MaskInput from "mask-input";
var buttonRegister = document.getElementById("registerAccount");
if (buttonRegister) {
    buttonRegister.onclick = function() {
        Swal.fire({
            title: 'Зарегестрироваться',
            html:
                '<input id="phone" type="tel" class="auth-field input-selector" placeholder="Номер телефона">' +
                '<input id="password" type="password" class="auth-field" placeholder="Пароль">',
            preConfirm: () => {
                return [
                    document.getElementById('phone').value,
                    document.getElementById('password').value
                ]
            },
            backdrop: `
            rgba(18,97,199,0.4)
            url("/images/nyan-cat.gif")
            left top
            no-repeat
          `,
            background: 'linear-gradient(135deg, #dfe9f3 10%, #ffffff 100%)',
            confirmButtonColor: '#0C57C7',
            confirmButtonText: 'Войти'
        });

        new MaskInput(document.querySelector('.input-selector'), {
            mask: '+(000)-00-00-000',
            alwaysShowMask: true,
            maskChar: '_',
        });
    };
}
