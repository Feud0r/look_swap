<?
if ($settings['security']['admin_only'] === true) {
    if (!(CUser::isAuthorized() && $settings['security']['user_object']->IsAdmin())) {
        http_response_code(403);
        header("Location: ".$settings['security']['redirect']);
    }
}

$files = array_diff($scan = scandir($_SERVER['DOCUMENT_ROOT'].$settings['default']['path_to_xml_directory']), [".", ".."]);
foreach ($files as $k => $check) {
    if (!preg_match('/\.xml$/m', $check)) {
        unset($files[$k]);
    }
}

return $files;