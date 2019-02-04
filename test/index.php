<?php 

ini_set('display_errors','On');
error_reporting(E_ALL);

spl_autoload_register(function ($class_name) {
    require_once __DIR__ . '/../src/'.str_replace('\\', '/', $class_name).'.php';
});

$i18n = CBX\I18nFactory::create("en_GB", "i18n-develop-example", "https://tb.colourbox.com");

$output = [
    "API Host: ".$i18n->getAPIURL(),
    "Language: ".$i18n->getLanguage(),
    "Domain: ".$i18n->getDomain(),
    "\n",
    "companyAddress: ".$i18n->_('companyAddress'),
    "html escaped: ".$i18n->_htmlEscaped('htmlText'),
    'placeholder: '.$i18n->_('addNumber', [ 'nr1' => 1, 'nr2' => 2, 'nr3' => 3 ]),
    "notExistingIndex: ".$i18n->_('notExistingIndex'),
    "\n",
];

echo implode("\n", $output);

?>