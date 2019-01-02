<?php

namespace CBX;

use CBX;

class Collection
{
    private $i18n;
    private $index;
    private $indexData;
    private $url;
    private $loaded = false;

    public function __construct($I18NObject, $index, $url = false) {
        $this->i18n = $I18NObject;
        $this->index = $index;
        $this->indexData = Index::getCollectionIndexData($index);
        $this->url = $url;
    }

    public function setUrl($url) {
        $this->url = $url;
    }

    public function getUrl() {
        return $this->url;
    }

    private function setLoaded($loaded) {
        $this->loaded = $loaded;
    }

    public function isLoaded() {
        return $this->loaded;
    }

    public function load() {
        if (!$this->isLoaded()) {
            $collectionData = $this->i18n->getAPI()->fetchCollection($this->getUrl());
            print_r($collectionData);
            /*
            const $collectionFetch = this.i18n.api.fetchCollection(this.getUrl());
            if (collectionFetch) {
                this.loading = true;
                collectionFetch.then((response) => {
                    this.loading = false;
                    this.setLoaded(true);
                    Object.keys(response).forEach((key) => {
                        const index = this.toTranslationIndex(key);
                        let translation = this.data.get(index);
                        if (!translation) {
                            translation = this.data.add(index, response[key].text);
                        }
                        translation.setText(response[key].text, true);
                    });
                    this.trigger('loaded', this);
                })
                    .catch((error) => {
                        this.loading = false;
                        console.error(`Error loading collection file for: ${this.index}`, error); // eslint-disable-line no-console
                    });
            }
            */
        } else {
            return true;
        }
        return false;
    }
}
