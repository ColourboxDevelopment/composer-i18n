<?php 

ini_set('display_errors','On');
error_reporting(E_ALL);

spl_autoload_register(function ($class_name) {
    require_once __DIR__ . '/../src/'.str_replace('\\', '/', $class_name).'.php';
});

CBX\i18n::setAPIURL("https://test-tb.cbx.xyz");
CBX\i18n::setLanguage('en_GB');
CBX\i18n::setDomain('i18n-develop-test');

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Colourbox\I18N</title>
</head>
<body>

    <p>API Host: <?=CBX\i18n::getAPIURL();?></p>
    <p>Language: <?=CBX\i18n::getLanguage();?></p>
    <p>Domain: <?=CBX\i18n::getDomain();?></p>

    <p>companyAddress: <?=CBX\i18n::_('companyAddress');?></p>
    <p>html escaped: <?=CBX\i18n::_htmlEscaped('<p>Test</p>');?></p>
    <p>placeholder: <?=CBX\i18n::_htmlEscaped('Add $0$ + $number$ = 3', [ 1, 'number' => '2' ]);?></p>
    <p>notExistingIndex: <?=CBX\i18n::_('notExistingIndex');?></p>

</body>
</html>
