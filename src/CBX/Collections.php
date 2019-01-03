<?php

namespace CBX;

use CBX;

class Collections
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

    /** Add collection */
    public function add($index, $url = false) {
        $fullIndex = Index::toCollectionIndex($index, $this->i18n->getLanguage(), $this->i18n->getDomain());
        if (!$this->is($fullIndex)) {
            return $this->data[$fullIndex] = new Collection($this->i18n, $fullIndex, $url);
        }
        return $this->get($fullIndex);
    }

    /** Check for collection */
    public function is($index) {
        return isset($this->data[Index::toCollectionIndex($index, $this->i18n->getLanguage(), $this->i18n->getDomain())]);
    }

    /** Get collection */
    public function get($index) {
        $fullIndex = Index::toCollectionIndex($index, $this->i18n->getLanguage(), $this->i18n->getDomain());
        return $this->is($fullIndex) ? $this->data[$fullIndex] : false;
    }

}
