document.addEventListener('turbo:load', loadDoctorShowApptmentFilterDate)

let doctorShowApptmentFilterDate = $('#doctorShowAppointmentDateFilter')

function loadDoctorShowApptmentFilterDate () {
    if (!$('#doctorShowAppointmentDateFilter').length) {
        return
    }

    let doctorShowApptmentStart = moment().startOf('week')
    let doctorShowApptmentEnd = moment().endOf('week')

    function cb (start, end) {
        $('#doctorShowAppointmentDateFilter').html(
            start.format('YYYY-MM-DD') + ' - ' + end.format('YYYY-MM-DD'))
    }

    $('#doctorShowAppointmentDateFilter').daterangepicker({
        startDate: doctorShowApptmentStart,
        endDate: doctorShowApptmentEnd,
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

    cb(doctorShowApptmentStart, doctorShowApptmentEnd)
}

listenClick('.doctor-show-apptment-delete-btn', function (event) {
    let doctorShowApptmentRecordId = $(event.currentTarget).data('id')
    let doctorShowApptmentUrl = !isEmpty($('#patientRoleDoctorDetail').val()) ? route(
        'patients.appointments.destroy',
        doctorShowApptmentRecordId) : route('appointments.destroy',
        doctorShowApptmentRecordId)
    deleteItem(doctorShowApptmentUrl, 'Appointment')
})

listenChange('.doctor-show-apptment-status', function () {
    let doctorShowAppointmentStatus = $(this).val()
    let doctorShowAppointmentId = $(this).data('id')
    let currentData = $(this)

    $.ajax({
        url: route('change-status', doctorShowAppointmentId),
        type: 'POST',
        data: {
            appointmentId: doctorShowAppointmentId,
            appointmentStatus: doctorShowAppointmentStatus,
        },
        success: function (result) {
            $(currentData).children('option.booked').addClass('hide')
            livewire.emit('refresh')
            displaySuccessMessage(result.message)
        },
    });
});

listenChange('#doctorShowAppointmentDateFilter', function () {
    window.livewire.emit('changeDateFilter', $(this).val())
})

listenChange('#doctorShowAppointmentStatus', function () {
    window.livewire.emit('changeStatusFilter', $(this).val())
})

listenClick('#doctorShowApptmentResetFilter', function () {
    $('#doctorShowAppointmentStatus').val(1).trigger('change')
    $('#doctorShowAppointmentDateFilter').
        val(moment().startOf('week').format('MM/DD/YYYY') + ' - ' +
            moment().endOf('week').format('MM/DD/YYYY')).
        trigger('change')
    livewire.emit('refresh')
})

document.addEventListener('livewire:load', function () {
    window.livewire.hook('message.processed', () => {
        if ($('#doctorShowAppointmentStatus').length) {
            $('#doctorShowAppointmentStatus').select2()
        }
        if ($('.doctor-show-apptment-status').length) {
            $('.doctor-show-apptment-status').select2()
        }
    })
})
