<?php

namespace CBX;

class Translation
{
    private $text;
    private $orignalText;
    private $index;
    private $translated;
    private $indexData;

    public function __construct($index, $text = false) {
        $this->text = $text;
        $this->orignalText = $text;
        $this->index = $index;
        $this->translated = false;
        $this->indexData = Index::getIndexData($index);
    }

    public function getIndex() {
        return $this->indexData->fullIndex;
    }

    public function getIndexShort($hideGlobal = false) {
        $indexGlobal = $this->indexData->collection === Index::global() && $hideGlobal ? '' : $this->indexData.collection;
        return "{$indexGlobal}/{$this->indexData->index}";
    }

    public function getIndexData() {
        return $this->indexData;
    }

    public function isTranslated() {
        return $this->translated;
    }

    public function getText() {
        return $this->text;
    }

    public function getOriginalText() {
        return $this->orignalText;
    }

    public function getDisplayText() {
        return $this->getText() ? $this->getText() : $this->getIndexShort();
    }
}
