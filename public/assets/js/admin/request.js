const process = (data, url, callback) => {
    $.ajax({
        url: url,
        type: "POST",
        data: data,
        dataType: "json",
        beforeSend: function () {
            $("#loader").removeClass("d-none");
        },
        success: function (response) {
            callback(response);
        },
        error: function (xhr, ajaxOptions, thrownError) {
            const response = {
                xhr: xhr,
                ajaxOptions: ajaxOptions,
                thrownError: thrownError,
            };

            callback(response);
        },
        complete: function () {
            $("#loader").addClass("d-none");
        },
    });
};

export default process;
