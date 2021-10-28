import MaskInput from "mask-input";

var buttonAuth = document.getElementById("enterToAccount");
buttonAuth.onclick = function() {
    Swal.fire({
        title: 'Войти в аккаунт',
        html:
            '<a href="/register" class="register-link">или зарегистрироваться</a>' +
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
            url("../public/images/nyan-cat.gif")
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
