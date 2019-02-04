<?php 

ini_set('display_errors','On');
error_reporting(E_ALL);

spl_autoload_register(function ($class_name) {
    require_once __DIR__ . '/../src/'.str_replace('\\', '/', $class_name).'.php';
});

CBX\i18n::initialize("en_GB", "i18n-develop-example", "https://tb.colourbox.com");

$output = [
    "API Host: ".CBX\i18n::getAPIURL(),
    "Language: ".CBX\i18n::getLanguage(),
    "Domain: ".CBX\i18n::getDomain(),
    "\n",
    "companyAddress: ".CBX\i18n::_('companyAddress'),
    "html escaped: ".CBX\i18n::_htmlEscaped('htmlText'),
    'placeholder: '.CBX\i18n::_('addNumber', [ 'nr1' => 1, 'nr2' => 2, 'nr3' => 3 ]),
    "notExistingIndex: ".CBX\i18n::_('notExistingIndex'),
    "\n",
];

echo implode("\n", $output);

?>