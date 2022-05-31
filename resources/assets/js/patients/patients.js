listenClick('.patient-delete-btn', function () {
    let patientId = $(this).attr('data-id')
    deleteItem(route('patients.destroy', patientId),
        'Patient')
})

listenChange('.patient-email-verified', function (e) {
    let patientRecordId = $(e.currentTarget).data('id')
    let value = $(this).is(':checked') ? 1 : 0
    $.ajax({
        type: 'POST',
        url: route('emailVerified'),
        data: {
            id: patientRecordId,
            value: value,
        },
        success: function (result) {
            livewire.emit('refresh')
            displaySuccessMessage(result.message)
        },
    })
})

listenClick('.patient-email-verification', function (event) {
    let userId = $(event.currentTarget).data('id')
    $.ajax({
        type: 'POST',
        url: route('resend.email.verification', userId),
        success: function (result) {
            livewire.emit('refresh')
            displaySuccessMessage(result.message)
        },
        error: function (result) {
            displayErrorMessage(result.responseJSON.message)
        },
    })
})

