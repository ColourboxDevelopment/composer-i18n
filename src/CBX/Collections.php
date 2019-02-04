<?php

namespace CBX;

class Collections
{
    private $config;
    private $collections;

    public function __construct(Config $config) {
        $this->config = $config;
        $this->collections = [];
    }

    public function getAPIURL() {
        return $this->config->getAPI()->getURL();
    }

    public function getLanguage() {
        return $this->config->getLanguage();
    }

    public function getDomain() {
        return $this->config->getDomain();
    }

    public function getTranslation($collection, $index) {
        $collectionData = $this->getCollectionByName($collection);
        if ($collectionData && isset($collectionData[$index])) {
            return $collectionData[$index]['text'];
        }
        return false;
    }

    private function getCollectionByName($collection) {
        if (isset($this->collections[$collection])) {
            return $this->collections[$collection];
        } else {
            return $this->addCollection($collection);
        }
    }

    private function addCollection($collection) {
        if (isset($this->collections[$collection])) {
            return $this->collections[$collection];
        }
        if (Validate::collection($collection)) {
            $collectionUrl = $this->config->getCollectionUrl($collection);
            if ($collectionUrl) {
                if ($collectionData = $this->config->getAPI()->fetchCollection($collectionUrl)) {
                    $this->collections[$collection] = $collectionData;
                    return $this->collections[$collection];
                }
            } else {
                trigger_error("I18NClass Collections Error. Collection URL not found in config file for '{$collection}'.");
            }
        } else {
            trigger_error("I18NClass Collections Error. Collection '{$collection}' is not valid.");
        }
        return false;
    }
}
