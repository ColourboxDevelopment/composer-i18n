<?php

namespace CBX;

use CBX;

class i18nClass
{
    private $language = '';
    private $domain = '';
    private $api;
    private $configLoaded = false;

    public function __construct() {
        $this->api = new API();
    }

    public function getAPIURL() {
        return $this->api->getURL();
    }

    public function setAPIURL($url) {
        return $this->api->setURL($url);
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

    public function _($index) {
        $this->loadConfig();
    }

    private function loadConfig() {
        if (!$this->configLoaded && Validate::language($this->language) && Validate::domain($this->domain) && $this->api->isValid()) {
            echo $configFile = $this->api->getConfigURL($this->language, $this->domain);
            /*
            console.log('Load: ', configFile);
            const configFetch = this.api.fetchConfig($this->language, $this->domain);
            if (configFetch) {
                configFetch.then((response) => {
                    if (response.domain === $this->domain && response.locale === $this->language) {
                        console.log('Collections:', response.collections);
                        this.config.loaded = true;
                        Object.keys(response.collections).forEach((key) => {
                            let collection = this.collections.get(key);
                            if (!collection) {
                                collection = this.collections.add(key, response.collections[key]);
                            } else {
                                collection.setUrl(response.collections[key]);
                                collection.load();
                            }
                        });
                    }
                });
            }
            */
        }
    }

}
