// TODO исправить добавление в корзину

var addToCart = document.getElementById("game-1");
addToCart.onclick = function() {
    alert('Номер заказа ' + addToCart.dataset.indexNumber);

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

    Toast.fire({
        icon: 'success',
        title: 'Товар в корзине'
    })
};