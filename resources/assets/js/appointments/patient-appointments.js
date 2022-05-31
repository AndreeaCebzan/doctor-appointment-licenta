document.addEventListener('turbo:load',
    loadPatientPanelAppointmentFilterData)

function loadPatientPanelAppointmentFilterData () {
    if (!$('#patientAppointmentDate').length) {
        return
    }

    let patientPanelApptmentStart = moment().startOf('week')
    let patientPanelApptmentEnd = moment().endOf('week')

    function cb (start, end) {
        $('#patientAppointmentDate').html(
            start.format('YYYY-MM-DD') + ' - ' + end.format('YYYY-MM-DD'))
    }

    $('#patientAppointmentDate').daterangepicker({
        startDate: patientPanelApptmentStart,
        endDate: patientPanelApptmentEnd,
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

    cb(patientPanelApptmentStart, patientPanelApptmentEnd)
}

listenClick('#patientPanelApptmentResetFilter', function () {
    livewire.emit('refresh')
    $('#patientPaymentStatus').val(0).trigger('change')
    $('#patientAppointmentStatus').val(1).trigger('change')
    $('#patientAppointmentDate').data('daterangepicker').setStartDate(moment().startOf('week').format('MM/DD/YYYY'))
    $('#patientAppointmentDate').data('daterangepicker').setEndDate(moment().endOf('week').format('MM/DD/YYYY'))
})

listenChange('#patientAppointmentDate', function () {
    window.livewire.emit('changeDateFilter', $(this).val())
})

listenChange('#patientPaymentStatus', function () {
    window.livewire.emit('changePaymentTypeFilter', $(this).val())
})

listenChange('#patientAppointmentStatus', function () {
    window.livewire.emit('changeStatusFilter', $(this).val())
})

document.addEventListener('livewire:load', function () {
    window.livewire.hook('message.processed', () => {
        if ($('#patientPaymentStatus').length) {
            $('#patientPaymentStatus').select2()
        }
        if ($('#patientAppointmentStatus').length) {
            $('#patientAppointmentStatus').select2()
        }
    })
})

listenClick('.patient-panel-apptment-delete-btn', function (event) {
    let userRole = $('#userRole').val();
    let patientPanelApptmentRecordId = $(event.currentTarget).data('id')
    let patientPanelApptmentRecordUrl = !isEmpty(userRole) ? route(
        'patients.appointments.destroy',
        patientPanelApptmentRecordId) : route('appointments.destroy',
        patientPanelApptmentRecordId)
    deleteItem(patientPanelApptmentRecordUrl, 'Appointment')
})

listenClick('.patient-cancel-appointment', function (event) {
    let appointmentId = $(event.currentTarget).data('id')
    cancelAppointment(route('patients.cancel-status'), 'Appointment',
        appointmentId)
})

window.cancelAppointment = function (url, header, appointmentId) {
    Swal.fire({
        title: 'Cancelled Appointment !',
        text: 'Are you sure want to cancel this ' + header + ' ?',
        type: 'warning',
        icon: 'warning',
        showCancelButton: true,
        closeOnConfirm: false,
        confirmButtonColor: '#266CB0',
        showLoaderOnConfirm: true,
        cancelButtonText: 'No',
        confirmButtonText: 'Yes',
    }).then(function (result) {
        if (result.isConfirmed) {
            deleteItemAjax(url, header, appointmentId)
        }
    });
};

function deleteItemAjax (url, header, appointmentId) {

    $.ajax({
        url: route('patients.cancel-status'),
        type: 'POST',
        data: { appointmentId: appointmentId },
        success: function (obj) {
            if (obj.success) {
                livewire.emit('refresh')
            }
            Swal.fire({
                title: 'Cancelled Appointment!',
                text: header + ' has been Cancelled.',
                icon: 'success',
                confirmButtonColor: '#266CB0',
                timer: 2000,
            });
        },
        error: function (data) {
            Swal.fire({
                title: 'Error',
                icon: 'error',
                text: data.responseJSON.message,
                type: 'error',
                confirmButtonColor: '#266CB0',
                timer: 5000,
            });
        },
    });
}

listenClick('#submitBtn', function (event) {
    event.preventDefault();
    let paymentGatewayType = $('#paymentGatewayType').val()
    let stripeMethod = 2;
    let paystackMethod = 3;
    let paypalMethod = 4;
    let razorpayMethod = 5;
    let authorizeMethod = 6;
    let paytmMethod = 7;
    
    let appointmentId = $('#patientAppointmentId').val()
    let btnSubmitEle = $("#patientPaymentForm").find('#submitBtn')
    setAdminBtnLoader(btnSubmitEle)

    if (paymentGatewayType == stripeMethod) {
        $.ajax({
            url: route('patients.appointment-payment'),
            type: 'POST',
            data: { appointmentId: appointmentId },
            success: function (result) {
                let sessionId = result.data.sessionId;
                stripe.redirectToCheckout({
                    sessionId: sessionId,
                }).then(function (result) {
                    manageAjaxErrors(result);
                });
            },
        });
    }

    if (paymentGatewayType == paytmMethod) {
        window.location.replace(route('paytm.init', { 'appointmentId': appointmentId }));
    }

    if (paymentGatewayType == paystackMethod) {

        window.location.replace(route('paystack.init', { 'appointmentData': appointmentId }));
    }

    if (paymentGatewayType == authorizeMethod) {

        window.location.replace(route('authorize.init',{'appointmentId': appointmentId}));
    }

    if (paymentGatewayType == paypalMethod) {
        $.ajax({
            type: 'GET',
            url: route('paypal.init'),
            data: { 'appointmentId': appointmentId},
            success: function (result) {
                if (result.statusCode == 201) {
                    let redirectTo = '';

                    $.each(result.result.links,
                        function (key, val) {
                            if (val.rel == 'approve') {
                                redirectTo = val.href;
                            }
                        });
                    location.href = redirectTo;
                }
            },
            error: function (result) {
            },
            complete: function () {
            },
        });
    }

    if (paymentGatewayType == razorpayMethod) {
        $.ajax({
            type: 'POST',
            url: route('razorpay.init'),
            data: {'appointmentId': appointmentId },
            success: function (result) {
                if (result.success) {
                    let { id, amount, name, email, contact } = result.data

                    options.amount = amount
                    options.order_id = id
                    options.prefill.name = name
                    options.prefill.email = email
                    options.prefill.contact = contact
                    options.prefill.appointmentID = appointmentId

                    let razorPay = new Razorpay(options)
                    razorPay.open()
                    razorPay.on('payment.failed', storeFailedPayment)
                }
            },
            error: function (result) {
            },
            complete: function () {
            },
        })
    }

    return false;
});

function storeFailedPayment (response) {
    $.ajax({
        type: 'POST',
        url: route('razorpay.failed'),
        data: {
            data: response,
        },
        success: function (result) {
            if (result.success) {
                displaySuccessMessage(result.message);
            }
        },
        error: function () {
        },
    });
}

listenClick('.payment-btn', function (event) {
    let appointmentId = $(this).data('id')
    $('#paymentGatewayModal').modal('show').appendTo('body')
    $('#patientAppointmentId').val(appointmentId)
})

listen('hidden.bs.modal', '#paymentGatewayModal', function (e) {
    $('#patientPaymentForm')[0].reset();
    $('#paymentGatewayType').val(null).trigger('change');
});
