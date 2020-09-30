function swalError(message) {
    let msg;

    if (message == null) {
        msg = 'Have an error! Please contact developers';
    } else {
        msg = message;
    }

    return swal({
        title: 'Failed',
        text: msg,
        icon: 'error'
    });
}