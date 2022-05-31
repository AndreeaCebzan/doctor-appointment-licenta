listenClick('.subscriber-delete-btn', function () {
    let subscriberId = $(this).attr('data-id')
    deleteItem(route('subscribers.destroy', subscriberId),
        'Subscriber')
})
