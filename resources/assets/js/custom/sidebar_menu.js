listenKeyup('#menuSearch', function () {
    let value = $(this).val().toLowerCase()
    $('.menu-search').filter(function () {
        $('.no-record').addClass('d-none')
        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        checkEmpty()
    })
})

function checkEmpty () {
    if ($('.menu-search:visible').last().length == 0) {
        $('.no-record').removeClass('d-none')
    }
}

listenClick('.sidebar-aside-toggle', function () {
    if ($(this).hasClass('active') === true) {
        $('.sidebar-search-box').addClass('d-none')
    } else {
        $('.sidebar-search-box').removeClass('d-none')
    }
})
