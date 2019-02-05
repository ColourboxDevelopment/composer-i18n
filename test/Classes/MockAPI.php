<?php

class MockAPI
{
    private $dir = null;
    private $cache = null;

    public function __construct($dir, $cache) {
        $this->dir = $dir;
        $this->cache = $cache;
    }

    public function getURL() {
        return $this->dir;
    }

    public function fetchConfig($language, $domain) {
        return $this->fetch("{$this->dir}/{$language}_{$domain}.json");
    }

    public function fetchCollection($file) {
        $path = $this->dir.'/'.$file;
        $cacheKey = 'cbx-i18n-offline-'.md5($path);
        $cachedData = $this->cache->get($cacheKey);
        if ($cachedData) {
            if (gettype($cachedData) === "string") {
                $json = json_decode(trim($cachedData), true);
                if (json_last_error() !== 0) {
                    throw new \Exception("I18NClass API Error. Collection JSON. ".json_last_error_msg());
                }
                return $json;
            } else {
                return $cachedData;
            }
        }
        $data = $this->fetch($path);
        if ($data) {
            $this->cache->set($cacheKey, gettype($data) === "string" ? $data : json_encode($data));
        }
        return $data;
    }

    private function fetch($path) {
        if (!file_exists($path)) {
            throw new \Exception("I18NClass API Error. File '{$path}' is not exists.");
        }
        $content = file_get_contents($path);
        if (!$content) {
            throw new \Exception("I18NClass API Error. Can't get content of file '{$path}'.");
        }
        $json = json_decode(trim($content), true);
        if (json_last_error() !== 0) {
            throw new \Exception("I18NClass API Error. (JSON) ".json_last_error_msg());
        }
        return $json;
    }
}
