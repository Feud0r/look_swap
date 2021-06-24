//make region
let ajax = $.ajax({
    type: 'POST',
    url: './core/api.php',
    data: 'getSettings',
    success: response => {
        buildPage(JSON.parse(response));
    }
});
}

function buildPage(settings) {
    $('[data-header="exchange"]').text(settings.title);
    $('input[name="title"]').val(settings.title);
    $('input[name="exchange_file_path"]').val(settings.path_to_1c_exchange);
}

$(document).ready(function () {
    loadPage();
});
//endregion


//region Обмен
$('form[name="main"]').on("submit", function (e) {
    e.preventDefault();
    if ($(this.file).val() === null) return showError('Отсутствует файл. Загрузиге xml файл в /upload/1c_catalog/ и перезагрузите страницу.');
    $('.exchange-sections__loader').show();
    exchange($(this.file).val(), $(this.params).val());
});

function exchange(filename, type) {
    $.ajax({
        type: 'GET',
        url: $('input[name="exchange_file_path"]').val(),
        data: {
            "filename": filename,
            "type": type,
            "mode": "import",
        },
        success: response => {
            $('.exchange-logs__text').append(`<p>${response}</p>`);
            (/failure/.test(response) || /success/.test(response))
                ? $('.exchange-sections__loader').hide()
                : exchange(filename, type);
        }
    });
}

//endregion


//region form of settings
$('form[name="settings"]').on("submit", function (e) {
    e.preventDefault();
    $.ajax({
        type: 'POST',
        url: './core/api.php',
        data: {
            'saveSettings': true,
            'title': $(this.title).val().trim(),
            'file_path': $(this.exchange_file_path).val().trim(),
        },
        success: response => {
            if (response !== '') {
                showError(response);
            } else location.reload();
        }
    });
});
//endregion


//region tune of visible
$('.exchange-menu').on("click", '.exchange-menu__item', e => {
    let activeTab = document.querySelector('.exchange-menu :checked+.exchange-menu__item');
    if (activeTab === e.target) return;

    loadPage();
    $(`[data-section="${$(activeTab).attr('for')}"]`).hide();
    $(`[data-section="${$(e.target).attr('for')}"]`).show();
});

function showError(error) {
    $('.exchange-errors').append(`
        <div class="exchange-error">
            <div class="exchange-error__title">Ошибка:</div><div class="exchange-error__text">${error}</div>
            <div class="exchange-error__close">x</div>
        </div>
    `);
    $('.exchange-error__close').off("click").on("click", function () {
        $(this).parent().remove();
    });
}

//endregion