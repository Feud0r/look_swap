<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
global $APPLICATION;
$APPLICATION->SetTitle("Swap manual");
?>
    <link rel="stylesheet" href="style.css"/>
<?

if (!(CUser::isAuthorized() && $GLOBALS["USER"]->IsAdmin())) {
    header("Location: http://" . $_SERVER['SERVER_NAME'] . "/personal/profile/");
}

$files = array_diff($scan = scandir($_SERVER['DOCUMENT_ROOT'] . "/upload/1c_catalog"), [".", ".."]);
foreach ($files as $k => $check) {
    if (!preg_match('/\.xml/', $check)) {
        unset($files[$k]);
    }
}
?>

    <div class="loader hide"></div>

    <div class="exchange">
        <h1>Swap manual</h1>
        <div class="exchange-select">
            <span class="exchange-select__title">File</span>
            <select data-submit="exchange" class="exchange-select__files">
                <option value="" disabled selected hidden></option>
                <? foreach ($files as $file): ?>
                    <option value="<?= $file ?>"><?= $file ?></option>
                <? endforeach ?>
            </select>
        </div>
        <button class="exchange__btn" data-submit="exchange">Begin swap</button>
        <div class="exchange__logs" data-container="exchange"></div>
    </div>

    <script>
        $('button[data-submit="exchange"]').on("click", function () {
            exchange($(this).prev().find('select').val());
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
                    $('[data-container="exchange"]').append(data + '<br>');
                    if (!(/failure/.test(data) || /success/.test(data))) {
                        return exchange(file);
                    }
                    $('[data-submit="exchange"]').attr("disabled", "false");
                }
            })
        }
    </script>
<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php");