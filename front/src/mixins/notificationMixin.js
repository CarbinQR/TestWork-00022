import Swal from "sweetalert2";

export default function showNotification(message, type) {
    return Swal.fire({
        toast: true,
        position: 'top-right',
        icon: type,
        text: message,
        showConfirmButton: false,
        showCloseButton:true,
    })
}