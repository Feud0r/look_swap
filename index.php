<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php"); ?>
<? CJSCore::Init(["jquery"]); ?>

    <h1 data-header="exchange"></h1>
    <div class="exchange">
        <div class="exchange-menu">
            <input type="radio" id="main" name="tab" checked>
            <label for="main" class="exchange-menu__item" tabindex="0">
                Обмен
            </label>
            <input type="radio" id="settings" name="tab">
            <label for="settings" class="exchange-menu__item" tabindex="0">
                Настройки
            </label>
        </div>
        <div class="exchange-wrapper">
            <div class="exchange-sections">

                <section data-section="main" class="exchange-sections__section">
                    <form class="exchange-form" name="main">
                        <div class="exchange-form__body">
                            <div class="exchange-form-row">
                                <span class="exchange-form-row__title">Файл в /upload/1c_catalog/</span>
                                <select name="file" class="exchange-form-row__list">
                                    <? foreach (scandir($_SERVER['DOCUMENT_ROOT'] . '/upload/1c_catalog/') as $file) :
                                        if ($file === '.' || $file === '..') continue;
                                        if (!preg_match('~.\.(?:xml)$~m', $file)) continue; ?>
                                        <option value="<?= $file ?>"><?= $file ?></option>
                                    <? endforeach; ?>
                                </select>
                            </div>
                            <div class="exchange-form-row">
                                <span class="exchange-form-row__title">Тип файла</span>
                                <select name="params" class="exchange-form-row__list">
                                    <option value="catalog">каталог / предложения</option>
                                    <option value="sale">заказы</option>
                                </select>
                            </div>
                        </div>
                        <button type="submit" class="exchange-form__submit">Begin swap</button>
                    </form>
                </section>

                <section data-section="settings" class="exchange-sections__section">
                    <form class="exchange-form" name="settings">
                        <div class="exchange-form__body">
                            <div class="exchange-form-row">
                                <span class="exchange-form-row__title">Заголовок страницы</span>
                                <input type="text" name="title" class="exchange-form-row__text" value=""
                                       autocomplete="off">
                            </div>
                            <div class="exchange-form-row">
                                <span class="exchange-form-row__title">Путь к 1c_exchange.php</span>
                                <input type="text" name="exchange_file_path" class="exchange-form-row__text" value="">
                            </div>
                        </div>
                        <button type="submit" class="exchange-form__submit">Сохранить</button>
                    </form>
                </section>

                <div class="exchange-sections__loader"></div>
            </div>
            <div class="exchange-errors">
                <!-- ajax -->
            </div>
            <div class="exchange-logs">
                <div class="exchange-logs__text">
                    <!-- ajax -->
                </div>
            </div>
        </div>
    </div>

    <link rel="stylesheet" href="core/main.css">
    <script src="core/main.js"></script>
<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php");