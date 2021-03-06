document.addEventListener('turbo:load', loadAppointmentCreateEditData)

let appointmentDate = $('#appointmentDate')
let selectedDate
let selectedSlotTime

let timezoneOffsetMinutes = new Date().getTimezoneOffset()
timezoneOffsetMinutes = timezoneOffsetMinutes === 0
    ? 0
    : -timezoneOffsetMinutes

function loadAppointmentCreateEditData () {
    if (!$('#appointmentDate').length) {
        return
    }

    $('#appointmentDate').flatpickr({
        minDate: new Date(),
        disableMobile: true,
    });

    // setTimeout(function () {
    //     let appointmentIsEdit = $('#appointmentIsEdit');
    //     if (appointmentIsEdit.length) {
    //         appointmentDate.val(date).trigger('change');
    //         $('#appointmentServiceId').trigger('change');
    //     }
    // }, 1000);

    $('.no-time-slot').removeClass('d-none');
}

listenChange('#appointmentDate', function () {
    selectedDate = $(this).val();
    let userRole = $('#patientRole').val();
    let appointmentIsEdit = $('#appointmentIsEdit').val();
    $('.appointment-slot-data').html('');
    let url = !isEmpty(userRole)
        ? route('patients.doctor-session-time')
        : route('doctor-session-time');
    $.ajax({
        url: url,
        type: 'GET',
        data: {
            'adminAppointmentDoctorId': $('#adminAppointmentDoctorId').val(),
            'date': selectedDate,
            'timezone_offset_minutes': timezoneOffsetMinutes,
        },
        success: function (result) {
            if (result.success) {
                $.each(result.data['slots'], function (index, value) {
                    if (appointmentIsEdit && fromTime == value) {
                        $('.no-time-slot').addClass('d-none');
                        $('.appointment-slot-data').append(
                            '<span class="time-slot col-2  activeSlot" data-id="' +
                            value + '">' + value + '</span>');
                    } else {
                        $('.no-time-slot').addClass('d-none');
                        if (result.data['bookedSlot'] == null) {
                            $('.appointment-slot-data').append(
                                '<span class="time-slot col-2" data-id="' +
                                    value + '">' + value + '</span>');
                        } else {
                            if ($.inArray(value,
                                result.data['bookedSlot']) !== -1) {
                                $('.appointment-slot-data').
                                    append(
                                        '<span class="time-slot col-2 bookedSlot " data-id="' +
                                        value + '">' + value + '</span>');
                            } else {
                                $('.appointment-slot-data').
                                    append(
                                        '<span class="time-slot col-2" data-id="' +
                                        value + '">' + value + '</span>');
                            }

                        }
                    }
                });
            }
        },
        error: function (result) {
            displayErrorMessage(result.responseJSON.message);
        },
    });
});

listenClick('.time-slot', function () {
    if ($('.time-slot').hasClass('activeSlot')) {
        $('.time-slot').removeClass('activeSlot');
        selectedSlotTime = $(this).addClass('activeSlot');
    } else {
        selectedSlotTime = $(this).addClass('activeSlot');
    }
    let fromToTime = $(this).attr('data-id').split('-');
    let fromTime = fromToTime[0];
    let toTime = fromToTime[1];
    $('#timeSlot').val('');
    $('#toTime').val('');
    $('#timeSlot').val(fromTime);
    $('#toTime').val(toTime);
});

let charge;
let addFees = parseInt($('#addFees').val());
let totalFees;
listenChange('#adminAppointmentDoctorId', function () {
    $('#chargeId').val('');
    $('#payableAmount').val('');
    appointmentDate.val('');
    $('#addFees').val('');
    $('.appointment-slot-data').html('');
    $('.no-time-slot').removeClass('d-none');
    let url = !isEmpty(userRole) ? route('patients.get-service') : route(
        'get-service');

    $.ajax({
        url: url,
        type: 'GET',
        data: {
            'adminAppointmentDoctorId': $(this).val(),
        },
        success: function (result) {
            if (result.success) {
                $('#appointmentDate').removeAttr('disabled');
                $('#appointmentServiceId').empty();
                $('#appointmentServiceId').append($('<option value=""></option>').text('Select Service'));
                $.each(result.data, function (i, v) {
                    $('#appointmentServiceId').append($('<option></option>').attr('value', v.id).text(v.name));
                });
            }
        },
    });
});

listenChange('#appointmentServiceId', function () {
    let url = !isEmpty(userRole) ? route('patients.get-charge') : route(
        'get-charge');

    $.ajax({
        url: url,
        type: 'GET',
        data: {
            'chargeId': $(this).val(),
        },
        success: function (result) {
            if (result.success) {
                $('#chargeId').val('');
                $('#addFees').val('');
                $('#payableAmount').val('');
                if (result.data) {
                    $('#chargeId').val(result.data.charges);
                    $('#payableAmount').val(result.data.charges);
                    charge = result.data.charges;
                }
            }
        },
    });
});

listenKeyup('#addFees', function (e) {
    if (e.which != 8 && isNaN(String.fromCharCode(e.which))) {
        e.preventDefault();
    }
    totalFees = '';
    totalFees = parseFloat(charge) +
        parseFloat($(this).val() ? $(this).val() : 0);
    $('#payableAmount').val(totalFees.toFixed(2));
});

listenSubmit('#addAppointmentForm', function (e) {
    e.preventDefault();
    let data = new FormData($(this)[0]);
    let btnSubmitEle = $(this).find('#submitBtn');
    setAdminBtnLoader(btnSubmitEle);
    $.ajax({
        url: $(this).attr('action'),
        type: 'POST',
        data: data,
        processData: false,
        contentType: false,
        success: function (mainResult) {
            if (mainResult.success) {
                let appID = mainResult.data.appointmentId;
                displaySuccessMessage(mainResult.message);

                $('#addAppointmentForm')[0].reset();
                $('#addAppointmentForm').val('').trigger('change');

                if (mainResult.data.payment_type == $('#paystackMethod').val()) {
                    return location.href = mainResult.data.redirect_url;
                }

                if (mainResult.data.payment_type == $('#paytmMethod').val()) {
                    window.location.replace(route('paytm.init', {'appointmentId': appID}));
                }

                if (mainResult.data.payment_type == $('#authorizeMethod').val()) {
                    // return location.href = route('authorize.init',{'appointmentId': appID});
                    Turbo.visit(route('authorize.init', {'appointmentId': appID}));
                }

                if (mainResult.data.payment_type == $('#paypalMethod').val()) {
                    $.ajax({
                        type: 'GET',
                        url: route('paypal.init'),
                        data: {'appointmentId': appID},
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

                if (mainResult.data.payment_type == $('#manuallyMethod').val()) {
                    setTimeout(function () {
                        location.href = mainResult.data.url;
                    }, 1500);
                }

                if (mainResult.data.payment_type == $('#stripeMethod').val()) {
                    let sessionId = mainResult.data[0].sessionId;
                    stripe.redirectToCheckout({
                        sessionId: sessionId,
                    }).then(function (mainResult) {
                        manageAjaxErrors(mainResult);
                    });
                }

                if (mainResult.data.payment_type == $('#razorpayMethodMethod').val()) {
                    $.ajax({
                        type: 'POST',
                        url: route('razorpay.init'),
                        data: {'appointmentId': appID},
                        success: function (result) {
                            if (result.success) {
                                let {id, amount, name, email, contact} = result.data
                                options.amount = amount
                                options.order_id = id
                                options.prefill.name = name
                                options.prefill.email = email
                                options.prefill.contact = contact
                                options.prefill.appointmentID = appID

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
            }
        },
        error: function (result) {
            displayErrorMessage(result.responseJSON.message);
        },
        complete: function () {
            setAdminBtnLoader(btnSubmitEle);
        },
    });
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
