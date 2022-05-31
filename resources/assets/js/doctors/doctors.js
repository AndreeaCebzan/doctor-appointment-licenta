listenClick('#doctorResetFilter', function () {
    $('#doctorStatus').val(2).trigger('change')
})

listenChange('#doctorStatus', function () {
    $('#doctorStatus').val($(this).val())
    window.livewire.emit('changeStatusFilter', $(this).val())
})

document.addEventListener('livewire:load', function () {
    window.livewire.hook('message.processed', () => {
        if ($('#doctorStatus').length) {
            $('#doctorStatus').select2()
        }
    })
})

listenClick('.doctor-delete-btn', function () {
    let userId = $(this).attr('data-id')
    let deleteUserUrl = route('doctors.destroy', userId)
    deleteItem(deleteUserUrl, 'Doctor')
})

listenClick('.add-qualification', function () {
    let userId = $(this).attr('data-id')
    $('#qualificationID').val(userId)
    $('#qualificationModal').modal('show')
})

listenSubmit('#qualificationForm', function (e) {
    e.preventDefault()
    $.ajax({
        url: route('add.qualification'),
        type: 'POST',
        data: $(this).serialize(),
        success: function (result) {
            if (result.success) {
                displaySuccessMessage(result.message)
                $('#year').val(null).trigger('change')
                $('#qualificationModal').modal('hide')
                livewire.emit('refresh')
            }
        },
        error: function (result) {
            displayErrorMessage(result.responseJSON.message)
        },
    })
})

listen('hidden.bs.modal', '#qualificationModal', function () {
    resetModalForm('#qualificationForm')
    $('#year').val(null).trigger('change')
})

listenClick('.doctor-status', function (event) {
    let doctorRecordId = $(event.currentTarget).data('id')

    $.ajax({
        type: 'PUT',
        url: route('doctor.status'),
        data: { id: doctorRecordId },
        success: function (result) {
            livewire.emit('refresh')
            displaySuccessMessage(result.message)
        },
    })
})

listenClick('.doctor-email-verification', function (event) {
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

listenChange('.doctor-email-verified', function (e) {
    let recordId = $(e.currentTarget).data('id')
    let value = $(this).is(':checked') ? 1 : 0
    $.ajax({
        type: 'POST',
        url: route('emailVerified'),
        data: {
            id: recordId,
            value: value,
        },
        success: function (result) {
            livewire.emit('refresh')
            displaySuccessMessage(result.message)
        },
    })
})
