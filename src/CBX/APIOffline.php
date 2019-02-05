<?php

namespace CBX;

class APIOffline
{
    private $dir = null;
    private $cache = null;

    public function __construct($dir, $cache) {
        if (file_exists($dir)) {
            $this->dir = $dir;
        } else {
            throw new \Exception("I18NClass API Error. API directory '{$dir}' is not exists.");
        }
        $this->cache = $cache;
    }

    public function getURL() {
        return $this->dir;
    }

    public function fetchConfig($language, $domain) {
        return $this->fetch("{$this->dir}/{$language}_{$domain}.json");
    }

    public function fetchCollection($file) {
        return $this->fetch($this->dir.'/'.$file);
    }

    private function fetch($path) {
        if (file_exists($path)) {
            $content = file_get_contents($path);
            if ($content) {
                $json = json_decode(trim($content), true);
                if (json_last_error() === 0) {
                    return $json;
                } else {
                    throw new \Exception("I18NClass API Error. (JSON) ".json_last_error_msg());
                }
            } else {
                throw new \Exception("I18NClass API Error. File '{$path}' is not exists.");
            }
        } else {
            throw new \Exception("I18NClass API Error. File '{$path}' is not exists.");
        }
        return false;
    }
}
