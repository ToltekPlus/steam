export function notification(message, type = "success") {
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
        icon: type,
        text: message
    })
}

export function confirmWindow(message){
    const Window = Swal.mixin({
        confirmButtonText: 'Подтвердить',
        icon: 'warning',
        showCancelButton: true,
        position: 'center'
        });

    Window.fire({text: message})
}