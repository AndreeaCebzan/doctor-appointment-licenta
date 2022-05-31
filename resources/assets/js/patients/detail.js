document.addEventListener('turbo:load', loadPatientShowAppointmentDate)

let patientShowApptmentFilterDate = $('#patientShowPageAppointmentDate')

function loadPatientShowAppointmentDate () {
    if (!$('#patientShowPageAppointmentDate').length) {
        return
    }

    let patientShowApptmentStart = moment().startOf('week')
    let patientShowApptmentEnd = moment().endOf('week')

    function cb (start, end) {
        $('#patientShowPageAppointmentDate').html(
            start.format('YYYY-MM-DD') + ' - ' + end.format('YYYY-MM-DD'))
    }

    $('#patientShowPageAppointmentDate').daterangepicker({
        startDate: patientShowApptmentStart,
        endDate: patientShowApptmentEnd,
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

    cb(patientShowApptmentStart, patientShowApptmentEnd)
}

listenClick('.patient-show-apptment-delete-btn', function (event) {
    let patientShowApptmentRecordId = $(event.currentTarget).data('id')
    let patientShowApptmentUrl = !isEmpty($('#patientRolePatientDetail').val()) ? route(
        'patients.appointments.destroy',
        patientShowApptmentRecordId) : route('appointments.destroy',
        patientShowApptmentRecordId)
    deleteItem(patientShowApptmentUrl, 'Appointment')
})

listenChange('.patient-show-apptment-status-change', function () {
    let patientShowAppointmentStatus = $(this).val()
    let patientShowAppointmentId = $(this).data('id')
    let currentData = $(this)

    $.ajax({
        url: route('change-status', patientShowAppointmentId),
        type: 'POST',
        data: {
            appointmentId: patientShowAppointmentId,
            appointmentStatus: patientShowAppointmentStatus,
        },
        success: function (result) {
            $(currentData).children('option.booked').addClass('hide')
            livewire.emit('refresh')
            displaySuccessMessage(result.message)
        },
    })
})

listenClick('#patientAppointmentResetFilter', function () {
    $('#patientShowPageAppointmentStatus').val(1).trigger('change')
    $('#patientShowPageAppointmentDate').
        val(moment().startOf('week').format('MM/DD/YYYY') + ' - ' +
            moment().endOf('week').format('MM/DD/YYYY')).
        trigger('change')
})

listenChange('#patientShowPageAppointmentDate', function () {
    window.livewire.emit('changeDateFilter', $(this).val())
})

listenChange('#patientShowPageAppointmentStatus', function () {
    window.livewire.emit('changeStatusFilter', $(this).val())
})

document.addEventListener('livewire:load', function () {
    window.livewire.hook('message.processed', () => {
        if ($('#patientShowPageAppointmentStatus').length) {
            $('#patientShowPageAppointmentStatus').select2()
        }
        if ($('.patient-show-apptment-status-change').length) {
            $('.patient-show-apptment-status-change').select2()
        }
    })
})
