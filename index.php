<?require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");

$settings = require_once "settings.php";
require_once("src/main.php");
?>

<div class="loader hide"></div>
<div class="exchange">
    <h1><?=$settings['default']['title']?></h1>
    <div class="exchange-select">
        <span class="exchange-select__title">File</span>
        <select data-submit="exchange" class="exchange-select__files">
            <option value="" disabled selected hidden></option>
            <?foreach ($files as $file):?>
            <option value="<?=$file?>"><?=$file?></option>
            <?endforeach?>
        </select>
    </div>
    <button class="exchange__btn" data-submit="exchange">Begin swap</button>
    <div class="exchange__logs" data-container="exchange"></div>
</div>


<link href="src/main.css" rel="stylesheet" />
<script src="src/main.js"></script>
<?require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php");