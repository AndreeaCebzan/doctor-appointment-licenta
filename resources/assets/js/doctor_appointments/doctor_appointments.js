document.addEventListener('turbo:load', loadDoctorAppointmentFilterDate)

let doctorAppointmentFilterDate = '#doctorPanelAppointmentDate';

function loadDoctorAppointmentFilterDate () {
    if (!$(doctorAppointmentFilterDate).length) {
        return
    }

    let doctorAppointmentStart = moment().startOf('week')
    let doctorAppointmentEnd = moment().endOf('week')

    function cb (start, end) {
        $('#doctorPanelAppointmentDate').html(
            start.format('YYYY-MM-DD') + ' - ' + end.format('YYYY-MM-DD'))
    }

    $('#doctorPanelAppointmentDate').daterangepicker({
        startDate: doctorAppointmentStart,
        endDate: doctorAppointmentEnd,
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

    cb(doctorAppointmentStart, doctorAppointmentEnd)
}

listenChange('.doctor-appointment-status-change', function () {
    let doctorAppointmentStatus = $(this).val()
    let doctorAppointmentId = $(this).data('id')
    let doctorAppointmentCurrentData = $(this)

    $.ajax({
        url: route('doctors.change-status', doctorAppointmentId),
        type: 'POST',
        data: {
            appointmentId: doctorAppointmentId,
            appointmentStatus: doctorAppointmentStatus,
        },
        success: function (result) {
            $(doctorAppointmentCurrentData).
                children('option.booked').
                addClass('hide')
            livewire.emit('refresh')
            displaySuccessMessage(result.message)
        },
    })
})

listenChange('.doctor-apptment-change-payment-status', function () {
    let doctorApptmentPaymentStatus = $(this).val()
    let doctorApptmentAppointmentId = $(this).data('id')

    $('#doctorAppointmentPaymentStatusModal').modal('show').appendTo('body')

    $('#doctorAppointmentPaymentStatus').val(doctorApptmentPaymentStatus)
    $('#doctorAppointmentId').val(doctorApptmentAppointmentId)
})

listenSubmit('#doctorAppointmentPaymentStatusForm', function (event) {
    event.preventDefault()
    let paymentStatus = $('#doctorAppointmentPaymentStatus').val()
    let appointmentId = $('#doctorAppointmentId').val()
    let paymentMethod = $('#doctorPaymentType').val()

    $.ajax({
        url: route('doctors.change-payment-status', appointmentId),
        type: 'POST',
        data: {
            appointmentId: appointmentId,
            paymentStatus: paymentStatus,
            paymentMethod: paymentMethod,
        },
        success: function (result) {
            if (result.success) {
                displaySuccessMessage(result.message)
                $('#doctorAppointmentPaymentStatusModal').modal('hide')
                location.reload()
            }
        },
        error: function (result) {
            displayErrorMessage(result.responseJSON.message)
        },
    })
})

listenChange('#doctorPanelAppointmentDate', function () {
    window.livewire.emit('changeDateFilter', $(this).val())
})

listenChange('#doctorPanelPaymentType', function () {
    window.livewire.emit('changePaymentTypeFilter', $(this).val())
})

listenChange('#doctorPanelAppointmentStatus', function () {
    window.livewire.emit('changeStatusFilter', $(this).val())
})

listenClick('#doctorPanelApptmentResetFilter', function () {
    $('#doctorPanelPaymentType').val(0).trigger('change')
    $('#doctorPanelAppointmentStatus').val(1).trigger('change')
    doctorAppointmentFilterDate.data('daterangepicker').
        setStartDate(moment().startOf('week').format('MM/DD/YYYY'))
    doctorAppointmentFilterDate.data('daterangepicker').
        setEndDate(moment().endOf('week').format('MM/DD/YYYY'))
})

document.addEventListener('livewire:load', function () {
    window.livewire.hook('message.processed', () => {
        if ($('#doctorPanelPaymentType').length) {
            $('#doctorPanelPaymentType').select2()
        }
        if ($('#doctorPanelAppointmentStatus').length) {
            $('#doctorPanelAppointmentStatus').select2()
        }
        if ($('.appointment-status').length) {
            $('.appointment-status').select2()
        }
        if ($('.payment-status').length) {
            $('.payment-status').select2()
        }
    })
})
