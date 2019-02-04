<?php

namespace CBX;

class Config
{
    private $language = '';
    private $domain = '';
    private $api;
    private $collectionUrls = [];
    private $loaded = false;

    public function __construct($language, $domain, $api) {
        if (Validate::language($language)) {
            $this->language = $language;
        } else {
            trigger_error("I18NClass Config Data Error. Language '{$language}' is not valid.");
        }
        if (Validate::domain($domain)) {
            $this->domain = $domain;
        } else {
            trigger_error("I18NClass Config Data Error. Domain '{$domain}' is not valid.");
        }
        $this->api = $api;
    }

    public function getAPI() {
        return $this->api;
    }

    public function getLanguage() {
        return $this->language;
    }

    public function getDomain() {
        return $this->domain;
    }

    public function getCollectionUrl($collection) {
        $this->loadCollectionUrls();
        if (isset($this->collectionUrls[$collection])) {
            return $this->collectionUrls[$collection];
        }
        return false;
    }

    public function loadCollectionUrls() {
        if (!$this->loaded) {
            $this->loaded = true;
            $configData = $this->api->fetchConfig($this->getLanguage(), $this->getDomain());
            if ($configData) {
                if (isset($configData['collections'])) {
                    $this->collectionUrls = $configData['collections'];
                } else {
                    trigger_error("I18NClass Config Error. Config loaded, but collections are missing.");
                }
            }
        }
    }
}
