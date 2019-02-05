<?php

require_once("./config.php");
require_once("./Classes/MockI18nFactory.php");

use PHPUnit\Framework\TestCase;

final class Test extends TestCase {
    protected $i18n;

    protected function setUp()
    {
        $this->i18n = MockI18nFactory::create(LANGUAGE, DOMAIN, JSONDIR, MEMCACHED_HOST, MEMCACHED_PORT);
    }

    public function testCanGetTranslation(): void {
        $this->assertEquals(
            '8901 marmora road, glasgow, d04 89gr',
            $this->i18n->_('companyAddress')
        );
    }

    public function testCanGetTranslationAndHtmlEscape(): void {
        $this->assertEquals(
            '&lt;p&gt;Test&lt;/p&gt;',
            $this->i18n->_htmlEscaped('htmlText')
        );
    }

    public function testCanGetTranslationAndReplacePlaceholders(): void {
        $this->assertEquals(
            'Add 1 + 2 = 3',
            $this->i18n->_('Add $0$ + $number$ = 3', [ 1, 'number' => '2' ])
        );
    }

    public function testCanHandleIfTranslationMissing(): void {
        $this->assertEquals(
            'notExistingIndex',
            $this->i18n->_('notExistingIndex')
        );
    }
}

?>