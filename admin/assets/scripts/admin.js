
// Reuseable Toast
    function toastAlert(icon,message) {
        const Toast = Swal.mixin({
            toast: true,
            position: 'bottom-end',
            showConfirmButton: false,
            timer: 2000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        });
        Toast.fire({
            icon: icon,
            title: message
        });
   
    }
// Reuseable Alert
function  alertModal(icon,title,message){
    Swal.fire({
        icon:icon,
        title: title,
        text: message,
     
      });
}