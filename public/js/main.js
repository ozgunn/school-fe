const Toast = (icon, title, text, html) => {
    Swal.fire({
        icon: icon,
        title: title,
        text: text,
        html: html,
        toast: true,
        position: "top-end",
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.onmouseenter = Swal.stopTimer;
            toast.onmouseleave = Swal.resumeTimer;
        }
    })
};
