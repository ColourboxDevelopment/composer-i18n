<?php

namespace CBX;

use CBX;

class Translations
{
    private $i18n;
    private $data;

    public function __construct($I18NObject) {
        $this->i18n = $I18NObject;
        $this->data = [];
    }

    /** Nr. of collections */
    public function length() {
        return count($this->data);
    }

    public function add($index, $text = false) {
        $fullIndex = Index::toIndex($index, $this->i18n->getLanguage(), $this->i18n->getDomain());
        if (!$this->is($fullIndex)) {
            $this->data[$fullIndex] = new Translation($fullIndex, $text);
            return $this->data[$fullIndex];
        }
        return $this->get($fullIndex);
    }

    public function is($index) {
        return isset($this->data[Index::toIndex($index, $this->i18n->getLanguage(), $this->i18n->getDomain())]);
    }

    public function get($index) {
        $fullIndex = Index::toIndex($index, $this->i18n->getLanguage(), $this->i18n->getDomain());
        return $this->is($fullIndex) ? $this->data[$fullIndex] : false;
    }
}
