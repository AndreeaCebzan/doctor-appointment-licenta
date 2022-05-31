document.addEventListener('turbo:load', loadAppointmentFilterDate)

let appointmentFilterDate = $('#appointmentDateFilter')

function loadAppointmentFilterDate () {
    if (!$('#appointmentDateFilter').length) {
        return
    }

    let appointmentStart = moment().startOf('week')
    let appointmentEnd = moment().endOf('week')

    function cb (start, end) {
        $('#appointmentDateFilter').html(
            start.format('YYYY-MM-DD') + ' - ' + end.format('YYYY-MM-DD'))
    }

    $('#appointmentDateFilter').daterangepicker({
        startDate: appointmentStart,
        endDate: appointmentEnd,
        ranges: {
            'Today': [moment(), moment()],
            'Yesterday': [
                moment().subtract(1, 'days'),
                moment().subtract(1, 'days')],
            'This Week': [moment().startOf('week'), moment().endOf('week')],
            'Last 30 Days': [moment().subtract(29, 'days'), moment()],
            'This Month': [moment().startOf('month'), moment().endOf('month')],
            'Last Month': [
                moment().subtract(1, 'month').startOf('month'),
                moment().subtract(1, 'month').endOf('month')],
        },
    }, cb)

    cb(appointmentStart, appointmentEnd)
}

listenClick('#appointmentResetFilter', function () {
    $('#paymentStatus').val(0).trigger('change')
    $('#appointmentStatus').val(1).trigger('change')
    $('#appointmentDateFilter').data('daterangepicker').setStartDate(moment().startOf('week').format('MM/DD/YYYY'))
    $('#appointmentDateFilter').data('daterangepicker').setEndDate(moment().endOf('week').format('MM/DD/YYYY'))
})

listenClick('.appointment-delete-btn', function (event) {
    let recordId = $(event.currentTarget).data('id')
    deleteItem(route('appointments.destroy', recordId), 'Appointment')
})

listenChange('.appointment-status-change', function () {
    let appointmentStatus = $(this).val()
    let appointmentId = $(this).data('id')
    let currentData = $(this)

    $.ajax({
        url: route('change-status', appointmentId),
        type: 'POST',
        data: {
            appointmentId: appointmentId,
            appointmentStatus: appointmentStatus,
        },
        success: function (result) {
            $(currentData).children('option.booked').addClass('hide')
            livewire.emit('refresh')
            displaySuccessMessage(result.message)
        },
    });
});

listenChange('.appointment-change-payment-status', function () {
    let paymentStatus = $(this).val()
    let appointmentId = $(this).data('id')

    $('#paymentStatusModal').modal('show').appendTo('body')

    $('#paymentStatus').val(paymentStatus)
    $('#appointmentId').val(appointmentId)
})

listenChange('#appointmentDateFilter', function () {
    window.livewire.emit('changeDateFilter', $(this).val())
})

listenChange('#paymentStatus', function () {
    window.livewire.emit('changePaymentTypeFilter', $(this).val())
})

listenChange('#appointmentStatus', function () {
    window.livewire.emit('changeStatusFilter', $(this).val())
})

listenSubmit('#appointmentPaymentStatusForm', function (event) {
    event.preventDefault()
    let paymentStatus = $('#paymentStatus').val()
    let appointmentId = $('#appointmentId').val()
    let paymentMethod = $('#paymentType').val()

    $.ajax({
        url: route('change-payment-status', appointmentId),
        type: 'POST',
        data: {
            appointmentId: appointmentId,
            paymentStatus: paymentStatus,
            paymentMethod: paymentMethod,
        },
        success: function (result) {
            if (result.success) {
                displaySuccessMessage(result.message);
                $('#paymentStatusModal').modal('hide');
                location.reload();
            }
        },
        error: function (result) {
            displayErrorMessage(result.responseJSON.message);
        },
    });
});
