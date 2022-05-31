listenClick('#changePassword', function () {
    $('#changePasswordForm')[0].reset()
    $('.pass-check-meter div.flex-grow-1').removeClass('active')
    $('#changePasswordModal').modal('show').appendTo('body')
})

listenClick('#passwordChangeBtn', function () {
    $.ajax({
        url: changePasswordUrl,
        type: 'PUT',
        data: $('#changePasswordForm').serialize(),
        success: function (result) {
            $('#changePasswordModal').modal('hide')
            $('#changePasswordForm')[0].reset()
            displaySuccessMessage(result.message)
            setTimeout(function () {
                location.reload()
            }, 1000)
        },
        error: function error (result) {
            displayErrorMessage(result.responseJSON.message)
        },
    })
})

window.printErrorMessage = function (selector, errorResult) {
    $(selector).show().html('')
    $(selector).text(errorResult.message)
}

listenClick('#emailNotification', function () {
    $('#emailNotificationModal').modal('show').appendTo('body')
    $('#emailNotificationForm')[0].reset()
})

listenClick('#emailNotificationChange', function () {
    $.ajax({
        url: route('emailNotification'),
        type: 'PUT',
        data: $('#emailNotificationForm').serialize(),
        success: function (result) {
            $('#emailNotificationModal').modal('hide')
            displaySuccessMessage(result.message)
        },
        error: function error (result) {
            displayErrorMessage(result.responseJSON.message)
        },
    })
})

listenClick('.changeLanguage', function () {
    let languageName = $(this).data('prefix-value')

    $.ajax({
        type: 'POST',
        url: updateLanguageURL,
        data: { languageName: languageName },
        success: function (result) {
            displaySuccessMessage(result.message)
            setTimeout(function () {
                location.reload()
            }, 1000)
        },
    })
})
