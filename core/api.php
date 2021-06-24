<?
if (isset($_POST['getSettings'])) echo file_get_contents('../settings.json');

if (isset($_POST['saveSettings'])) {
    $file = json_decode(file_get_contents('../settings.json'), true);
    $file["title"] = filter_input(INPUT_POST, 'title', FILTER_VALIDATE_REGEXP, ["options" => ["regexp" => "/^[\w\h]{3,30}$/mu"]]);
    $path = filter_input(INPUT_POST, 'file_path', FILTER_VALIDATE_REGEXP, ["options" => ["regexp" => "#^/[\w/_]+\.php$#m"]]);
    $file["path_to_1c_exchange"] = file_exists($_SERVER['DOCUMENT_ROOT'] . $path) ? $path : false;

    if (!$file["title"]) die('Введите заголовок от 3 до 30 символов (буквы, пробел, подчеркивание).');
    if (!$file["path_to_1c_exchange"]) die('Файл обмена не найден.');

    if (!file_put_contents('../settings.json', json_encode($file, JSON_PRETTY_PRINT))) die('Не удалось записать файл, проверьте права.');
};