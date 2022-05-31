document.addEventListener('turbo:load', loadVisitData)

function loadVisitData () {
    let visitDate = '.visit-date'

    if (!$(visitDate).length) {
        return
    }

    $(visitDate).flatpickr({
        disableMobile: true,
    })
}

listenSubmit('#saveForm', function (e) {
    e.preventDefault()
    $('#btnSubmit').attr('disabled', true)
    $('#saveForm')[0].submit()
})
