$('button[data-submit="exchange"]').on("click", function() {
    exchange( $(this).prev().find('select').val() );
});
function exchange(file) {
    $('.loader').removeClass('hide');
    $('[data-submit="exchange"]').attr("disabled");
    $.ajax({
        /* "url": `https://${location.hostname}/bitrix/admin/1c_exchange.php`, */
        "url": `https://${location.hostname}/1c_exchange.php`,
        "type": "GET",
        "data": {
            "type": "catalog",
            "mode": "import",
            "filename": file
        },
        success: (data) => {
            $('.loader').addClass('hide');
            $('[data-container="exchange"]').append(data+'<br>');
            if (!(/failure/.test(data) || /success/.test(data))) {
                return exchange(file);
            }
            $('[data-submit="exchange"]').attr("disabled", "false");
        }
    })
}