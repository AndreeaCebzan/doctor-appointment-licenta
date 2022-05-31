document.addEventListener('turbo:load', loadSettingData)


let loadData = false;
function loadSettingData () {
    let settingCountryId = $('#settingCountryId').val();
    let settingStateId = $('#settingStateId').val();
    let settingCityId = $('#settingCityId').val();
    if (settingCountryId != '') {
        $('#settingCountryId').val(settingCountryId).trigger('change')

        setTimeout(function () {
            $('#settingStateId').val(settingStateId).trigger('change')
        }, 800)

        setTimeout(function () {
            $('#settingCityId').val(settingCityId).trigger('change')
        }, 400)

        loadData = true
    }
}

listenChange('#settingCountryId', function () {
    $.ajax({
        url: route('states-list'),
        type: 'get',
        dataType: 'json',
        data: {settingCountryId: $(this).val()},
        success: function (data) {
            $('#settingStateId').empty()
            $('#settingCityId').empty()
            $('#settingStateId').append(
                $('<option value=""></option>').text('Select State'))
            $('#settingCityId').append(
                $('<option value=""></option>').text('Select City'))
            $.each(data.data.states, function (i, v) {
                $('#settingStateId').append(
                    $(`<option ${(!loadData && i == data.data.state_id) ? 'selected' : ''}></option>`)
                    .attr('value', i).text(v))
            })
        },
    })
})

listenChange('#settingStateId', function () {
    $('#settingCityId').empty()
    $.ajax({
        url: route('cities-list'),
        type: 'get',
        dataType: 'json',
        data: {stateId: $(this).val()},
        success: function (data) {
            $('#settingCityId').empty()
            $('#settingCityId').append(
                $('<option value=""></option>').text('Select City'))
            $.each(data.data.cities, function (i, v) {
                $('#settingCityId').append($(`<option ${(loadData && i == data.data.city_id) ? 'selected' : ''}></option>`)
                .attr('value', i).text(v))
            })
        },
    })
})

// listenSubmit('#generalSettingForm', function () {
//     let checkedPaymentMethod = $(
//         'input[name="payment_gateway[]"]:checked').length
//     if (!checkedPaymentMethod) {
//         displayErrorMessage('Please select any one payment gateway')
//         return false
//     }
//
//     if ($('#error-msg').text() !== '') {
//         $('#phoneNumber').focus()
//         displayErrorMessage(`Contact number is ` + $('#error-msg').text())
//         return false
//     }
// })

listenClick('#settingSubmitBtn', function () {
    let checkedPaymentMethod = $(
        'input[name="payment_gateway[]"]:checked').length
    if (!checkedPaymentMethod) {
        displayErrorMessage('Please select any one payment gateway')
        return false
    }

    if ($('#error-msg').text() !== '') {
        $('#phoneNumber').focus()
        displayErrorMessage(`Contact number is ` + $('#error-msg').text())
        return false
    }
})
