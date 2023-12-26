/** callAjaxRequest */
function callAjaxRequest(event, item) {
    event.preventDefault();

    var confirmString = item.getAttribute('d-confirm');
    if(confirmString != null) {
        Swal.fire({
            text: confirmString,
            // icon: "warning",
            buttonsStyling: false,
            // confirmButtonText: "<i class='la la-headphones'></i> I am game!",
            showCancelButton: true,
            // cancelButtonText: "<i class='la la-thumbs-down'></i> No, thanks",
            customClass: {
                confirmButton: "btn btn-success",
                cancelButton: "btn btn-default"
            }
            }).then((result) => {
                // alert(result.value);
                // if(result.isConfirmed) {
                if(result.value === true) {
                    processAjaxRequest(item);
                } else {
                    // alert('Khong lam gi ca');
                }
                // console.log(result);
            });
    } else {
        excuteAjaxRequest(item);    
    }
    return(true);
}

/** processAjaxRequest */
function excuteAjaxRequest(item) {
    // Show notify: running
    var notify = $.notify("Đang xử lý, vui lòng chờ...", { allow_dismiss: false, type: "danger", delay: 5000 });    
    try {
        $.ajax({
            method: item.getAttribute('d-type'),
            url: item.getAttribute('d-url'),
            data:item.getAttribute('d-data'),
            success: function(data, status, request) {
                // Update notify: Success
                notify.update(
                { 
                    type: "success", 
                    message: "Đã xử lý thành công",
                    delay: 5000,
                });

                setTimeout(() => {
                    location.reload()                    
                }, 1000);

            }, 
            error: function(request, textStatus, errorMsg) {
                // Update notify: Error
                notify.update(
                { 
                    type: "danger", 
                    message: "Có lỗi xảy ra khi xử lý, vui lòng thông báo cho Admin: " + request.status, 
                    delay: 5000,
                });
            }
        });
    } catch(err) {
        console.log(err);
    }
}