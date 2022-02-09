document.querySelectorAll(".buy").forEach(btn =>
    btn.addEventListener("click", () => addGameToCart(btn.id))
);

function addGameToCart(id) {
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
        icon: "success",
        //title: "Товар под номером " + id + " в корзине"
        text: "Товар под номером " + id + " в корзине"
    })
}