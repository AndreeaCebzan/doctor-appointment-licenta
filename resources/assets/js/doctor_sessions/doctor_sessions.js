listenClick('.doctor-session-delete-btn', function (event) {
    let doctorSessionRecordId = $(event.currentTarget).data('id')
    let doctorSessionUrl = $('#doctorSessionUrl').val();
    deleteItem((doctorSessionUrl + '/' + doctorSessionRecordId),
        'Doctor Schedule')
})
