$( document ).ready(function() {
    initAjaxForm();
});

function initAjaxForm()
{
    $('#form-wrapper').on('submit', 'form', function (e) {
        var formErrors = $('.upload-form-errors');
        var formSuccess = $('.upload-form-success');

        formErrors.hide();
        formSuccess.hide();

        e.preventDefault();

        $.ajax({
            type: $(this).attr('method'),
            url: $(this).attr('action'),
            data: new FormData(this),
            processData: false,
            contentType: false
        })
            .done(function (data) {
                if (typeof data.message !== 'undefined') {
                    {
                        console.log(data.message);
                        formSuccess.html('<li>' + data.message + '</li>');
                        formSuccess.show();
                    }
                }
            })
            .fail(function (jqXHR, textStatus, errorThrown) {

                if (typeof jqXHR.responseJSON !== 'undefined') {
                    if (jqXHR.status === 400)
                    {
                        formErrors.html('<li>' + jqXHR.responseJSON['errors'] + '</li>');
                        formErrors.show();
                    }

                } else {
                    formErrors.html('<li>' + errorThrown + '</li>');
                    formErrors.show();

                }

            });
    });
}
