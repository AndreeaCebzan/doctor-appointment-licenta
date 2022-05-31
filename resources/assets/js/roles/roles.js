listenClick('.role-delete-btn', function (event) {
    let roleRecordId = $(event.currentTarget).data('id')
    deleteItem(route('roles.destroy', roleRecordId), 'Role')
})
