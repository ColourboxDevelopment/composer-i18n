<?php

namespace CBX;

class I18nClass
{
    private $collections;

    public function __construct(Collections $collections) {
        $this->collections = $collections;
    }

    public function getAPIURL() {
        return $this->collections->getAPIURL();
    }

    public function getLanguage() {
        return $this->collections->getLanguage();
    }

    public function getDomain() {
        return $this->collections->getDomain();
    }

    public function _($index, $placeholders = []) {
        $text = $index;
        $indexData = Index::getIndexData($index);
        if ($indexData) {
            $translation = $this->collections->getTranslation($indexData->collection, $indexData->index);
            if ($translation) {
                $text = $translation;
            }
        } else {
            trigger_error("I18NClass Error. Index '{$index}' is not valid index. Please use 'index' or 'collection/index'.");
        }
        return $this->replacePlaceholders($text, $placeholders);
    }

    public function _htmlEscaped($index, $placeholders = []) {
        return str_replace(["<", ">", "'", '"'], ["&lt;", "&gt;", "&#39;", '&#34;'], $this->_($index, $placeholders));
    }

    private function replacePlaceholders($text, $placeholders = []) {
        $from = [];
        $to = [];
        if (count($placeholders) > 0) {
            foreach ($placeholders as $key => $value) {
                $from[] = "$".$key."$";
                $to[] = $value;
            }
        }
        return str_replace($from, $to, $text);
    }
}
