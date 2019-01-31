<?php 

ini_set('display_errors','On');
error_reporting(E_ALL);

spl_autoload_register(function ($class_name) {
    require_once __DIR__ . '/../src/'.str_replace('\\', '/', $class_name).'.php';
});

CBX\i18n::setAPIURL("https://tb.colourbox.com");
CBX\i18n::setLanguage('en_GB');
CBX\i18n::setDomain('i18n-develop-example');

$output = [
    "API Host: ".CBX\i18n::getAPIURL(),
    "Language: ".CBX\i18n::getLanguage(),
    "Domain: ".CBX\i18n::getDomain(),
    "\n",
    "companyAddress: ".CBX\i18n::_('companyAddress'),
    "html escaped (<p>Test</p>): ".CBX\i18n::_htmlEscaped('<p>Test</p>'),
    'placeholder (Add $0$ + $number$ = 3): '.CBX\i18n::_('Add $0$ + $number$ = 3', [ 1, 'number' => '2' ]),
    "notExistingIndex: ".CBX\i18n::_('notExistingIndex'),
    "\n",
];

echo implode("\n", $output);

?>