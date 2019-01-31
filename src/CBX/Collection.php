<?php

namespace CBX;

class Collection
{
    private $i18n;
    private $index;
    private $indexData;
    private $url;
    private $loaded = false;
    private $translations;

    public function __construct($I18NObject, $index, $url = false) {
        $this->i18n = $I18NObject;
        $this->translations = new Translations($this->i18n);
        $this->index = $index;
        $this->indexData = Index::getCollectionIndexData($index, $this->i18n->getLanguage(), $this->i18n->getDomain());
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
            if ($this->getUrl()) {
                $pathinfo = pathinfo($this->getUrl());
                $parts = explode('/', $pathinfo['dirname']);
                $collectionData = [];
                if (count($parts) > 0) {
                    $folder = $parts[count($parts) - 1];
                    $i18nTempFolder = sys_get_temp_dir().'/colourbox-i18n';
                    $cacheJsonName = $folder.'-'.$pathinfo['basename'];
                    $cacheJson = $i18nTempFolder.'/'.$cacheJsonName;
                    if (file_exists($cacheJson)) {
                        $collectionData = json_decode(file_get_contents($cacheJson), true);
                    } else {

                        /** Delete old files - 7 days */
                        $files = glob($i18nTempFolder."/*.json");
                        foreach($files as $file) {
                            $filemtime = filemtime($file);
                            if (time() - $filemtime >= 3600 * 24 * 7) {
                                unlink($file);
                            }
                        }

                        /** Get new collection */
                        $collectionData = $this->i18n->getAPI()->fetchCollection($this->getUrl());
                        if ($collectionData) {
                            if (!file_exists($i18nTempFolder)) {
                                mkdir($i18nTempFolder);
                            }
                            file_put_contents($cacheJson, json_encode($collectionData));
                        }
                    }
                    if ($collectionData && count($collectionData) > 0) {
                        foreach ($collectionData as $key => $value) {
                            $this->translations->add($key, $value['text']);
                        }
                        $this->setLoaded(true);
                        return true;
                    }
                }
            }
        } else {
            return true;
        }
        return false;
    }

    public function isTranslationIndex($index) {
        if (gettype($index) === "string" && count(explode("/", $index)) === 1) {
            return $this->toTranslationIndex($index);
        }
        $indexData = Index::getIndexData($index, $this->i18n->getLanguage(), $this->i18n->getDomain());
        return $indexData->language === $this->indexData->language
                && $indexData->domain === $this->indexData->domain
                && $indexData->collection === $this->indexData->index ? $indexData->fullIndex : false;
    }

    public function toTranslationIndex($index) {
        $indexData = Index::getIndexData($index, $this->i18n->getLanguage(), $this->i18n->getDomain());
        return "{$this->indexData->language}/{$this->indexData->domain}/{$this->indexData->index}/{$indexData->index}";
    }

    public function is($index) {
        $fullIndex = $this->isTranslationIndex($index);
        return $fullIndex ? $this->translations->is($index) : false;
    }

    public function get($index) {
        $fullIndex = $this->isTranslationIndex($index);
        return $fullIndex ? $this->translations->get($fullIndex) : false;
    }
}
