<?php 

ini_set('display_errors','On');
error_reporting(E_ALL);

spl_autoload_register(function ($class_name) {
    require_once __DIR__ . '/../src/'.str_replace('\\', '/', $class_name).'.php';
});

$i18n = new CBX\i18nClass();
$i18n->setAPIURL('https://test-tb.cbx.xyz');
$i18n->setLanguage('en_GB');
$i18n->setDomain('i18n-develop-test');

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Colourbox\I18N</title>
</head>
<body>

    <p>API Host: <?=$i18n->getAPIURL();?></p>
    <p>Language: <?=$i18n->getLanguage();?></p>
    <p>Domain: <?=$i18n->getDomain();?></p>

    <p>companyAddress: <?=$i18n->_('companyAddress');?></p>
    <p>notExistingIndex: <?=$i18n->_('notExistingIndex');?></p>

</body>
</html>
