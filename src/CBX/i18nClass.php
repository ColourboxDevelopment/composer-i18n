<?php

namespace CBX;

use CBX;

class i18nClass
{
    private $language = '';
    private $domain = '';
    private $configLoaded = false;
    private $api;
    private $collections;

    public function __construct() {
        $this->api = new API();
        $this->collections = new Collections($this);
    }

    public function getAPIURL() {
        return $this->api->getURL();
    }

    public function setAPIURL($url) {
        return $this->api->setURL($url);
    }

    public function getAPI() {
        return $this->api;
    }

    public function setLanguage($language) {
        if (Validate::language($language)) {
            $this->language = $language;
            return $this->language;
        }
        return false;
    }

    public function getLanguage() {
        return $this->language;
    }

    public function setDomain($domain) {
        if (Validate::domain($domain)) {
            $this->domain = $domain;
            return $this->domain;
        }
        return false;
    }

    public function getDomain() {
        return $this->domain;
    }

    public function getIndexData($cIndex) {
        return Index::getIndexData($cIndex, $this->language, $this->domain);
    }

    public function toIndex($index) {
        return Index::toIndex($index, $this->language, $this->domain);
    }

    public function _($index) {
        $this->loadConfig();
        $indexData = $this->getIndexData($index);
        if ($indexData) {
            $collectionIndexData = Index::getCollectionIndexData($indexData->collection, $indexData->language, $indexData->domain);
            $collection = $this->collections->get($collectionIndexData->fullIndex);
            if ($collection) {
                if ($collection->load()) {
                    $translation = $collection->get($indexData->fullIndex);
                    if ($translation) {
                        return $translation->getDisplayText();
                    }
                }
            }
        }
        return $index;
    }

    private function loadConfig() {
        if (!$this->configLoaded && Validate::language($this->language) && Validate::domain($this->domain) && $this->api->isValid()) {
            $this->configLoaded = true;
            $config = $this->api->fetchConfig($this->language, $this->domain);
            if ($config && $config['domain'] === $this->domain && $config['locale'] === $this->language) {
                if (count($config['collections']) > 0) {
                    foreach ($config['collections'] as $collection => $url) {
                        $this->collections->add("{$this->language}/{$this->domain}/{$collection}", $url);
                    }
                }
            }
        }
    }

}
