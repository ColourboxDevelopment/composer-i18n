<?php

require_once("./config.php");

use PHPUnit\Framework\TestCase;

// Globals
$api;
$config;
$collections;
$i18n;
$i18nFromFactory;

final class Test extends TestCase {
    public function testCanInstantiateApiOfflineObject(): void {
        global $api;
        $api = new CBX\APIOffline(JSONDIR);
        $this->assertInstanceOf(
            CBX\APIOffline::class,
            $api
        );
    }

    public function testCanInstantiateConfigObject(): void {
        global $api, $config;
        $config = new CBX\Config(LANGUAGE, DOMAIN, $api);
        $this->assertInstanceOf(
            CBX\Config::class,
            $config
        );
    }

    public function testCanInstantiateCollectionsObject(): void {
        global $api, $config, $collections;
        $collections = new CBX\Collections($config);
        $this->assertInstanceOf(
            CBX\Collections::class,
            $collections
        );
    }

    public function testCanInstantiateMainObject(): void {
        global $api, $config, $collections, $i18n;
        $i18n = new CBX\I18nClass($collections);
        $this->assertInstanceOf(
            CBX\I18nClass::class,
            $i18n
        );
    }

    public function testCanGetTranslation(): void {
        global $i18n;
        $this->assertEquals(
            '8901 marmora road, glasgow, d04 89gr',
            $i18n->_('companyAddress')
        );
    }

    public function testCanGetTranslationAndHtmlEscape(): void {
        global $i18n;
        $this->assertEquals(
            '&lt;p&gt;Test&lt;/p&gt;',
            $i18n->_htmlEscaped('htmlText')
        );
    }

    public function testCanGetTranslationAndReplacePlaceholders(): void {
        global $i18n;
        $this->assertEquals(
            'Add 1 + 2 = 3',
            $i18n->_('Add $0$ + $number$ = 3', [ 1, 'number' => '2' ])
        );
    }

    public function testCanHandleIfTranslationMissing(): void {
        global $i18n;
        $this->assertEquals(
            'notExistingIndex',
            $i18n->_('notExistingIndex')
        );
    }

    public function testCanCreateObjectWithFactory(): void {
        global $i18nFromFactory;
        $i18nFromFactory = CBX\I18nFactory::create(LANGUAGE, DOMAIN, APIURL);
        $this->assertEquals(
            APIURL,
            $i18nFromFactory->getAPIURL()
        );
        $this->assertEquals(
            LANGUAGE,
            $i18nFromFactory->getLanguage()
        );
        $this->assertEquals(
            DOMAIN,
            $i18nFromFactory->getDomain()
        );
    }

    public function testCanGetTranslationFromObjectCreatedWithFactory(): void {
        global $i18nFromFactory;
        $this->assertEquals(
            '8901 marmora road, glasgow, d04 89gr',
            $i18nFromFactory->_('companyAddress')
        );
    }

    public function testCanGetTranslationAndHtmlEscapeFromObjectCreatedWithFactory(): void {
        global $i18nFromFactory;
        $this->assertEquals(
            '&lt;p&gt;Test&lt;/p&gt;',
            $i18nFromFactory->_htmlEscaped('htmlText')
        );
    }

    public function testCanGetTranslationAndReplacePlaceholdersFromObjectCreatedWithFactory(): void {
        global $i18nFromFactory;
        $this->assertEquals(
            'Add 1 + 2 = 3',
            $i18nFromFactory->_('Add $0$ + $number$ = 3', [ 1, 'number' => '2' ])
        );
    }

    public function testCanHandleIfTranslationMissingFromObjectCreatedWithFactory(): void {
        global $i18nFromFactory;
        $this->assertEquals(
            'notExistingIndex',
            $i18nFromFactory->_('notExistingIndex')
        );
    }

}

?>