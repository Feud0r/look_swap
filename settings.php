<?
return [
    'default' =>
    [
        'title'                 => 'Manual Swap',
        'path_to_xml_directory' => '/upload/1c_catalog',
        'path_to_exchange_file' => '/bitrix/admin/1c_exchange.php',
    ],
    'security' =>
    [
        'admin_only'  => true,
        'user_object' => $GLOBALS['USER'],
        'redirect'    => "https://".$_SERVER['SERVER_NAME']."/bitrix/admin/#authorize",
    ],
];