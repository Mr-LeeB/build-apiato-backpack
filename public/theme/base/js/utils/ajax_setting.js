async function handleCallAjax(url, data, method) {
    let response;

    await $.ajax({
        url: url,
        type: method,
        data: data,
        success: function (data, textStatus, xhr) {
            response = {
                data: data,
                status: xhr.status,
            }
        },
        error: function (xhr) {
            console.log("error delete");
            window.location.href = "/error/" + xhr.status;
        },
    });

    return response;
}