<?php

use PHPUnit\Framework\TestCase;

$apiUrl = "https://tb.colourbox.com";
$language = 'en_GB';
$domain = 'i18n-develop-example';

CBX\i18n::setAPIURL($apiUrl);
CBX\i18n::setLanguage($language);
CBX\i18n::setDomain($domain);

final class Test extends TestCase {

    public function testCanInitialize(): void {
        global $apiUrl, $language, $domain;
        $this->assertEquals(
            $apiUrl,
            CBX\i18n::getAPIURL()
        );
        $this->assertEquals(
            $language,
            CBX\i18n::getLanguage()
        );
        $this->assertEquals(
            $domain,
            CBX\i18n::getDomain()
        );
    }

    public function testCanGetTranslation(): void {
        $this->assertEquals(
            '8901 marmora road, glasgow, d04 89gr',
            CBX\i18n::_('companyAddress')
        );
    }

    public function testCanGetTranslationAndHtmlEscape(): void {
        $this->assertEquals(
            '&lt;p&gt;Test&lt;/p&gt;',
            CBX\i18n::_htmlEscaped('<p>Test</p>')
        );
    }

    public function testCanGetTranslationAndReplacePlaceholders(): void {
        $this->assertEquals(
            'Add 1 + 2 = 3',
            CBX\i18n::_('Add $0$ + $number$ = 3', [ 1, 'number' => '2' ])
        );
    }

    public function testCanHandleIfTranslationMissing(): void {
        $this->assertEquals(
            'notExistingIndex',
            CBX\i18n::_('notExistingIndex')
        );
    }

}

?>