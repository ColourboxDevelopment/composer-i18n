<?php

namespace CBX;

use CBX;

class API
{
    private $url = null;

    public function setURL($url) {
        if (Validate::url($url)) {
            $this->url = $url;
            return $this->url;
        }
        return false;
    }

    public function getURL() {
        return $this->url;
    }

    public function isValid() {
        return Validate::url($this->url);
    }

    public function getConfigURL($language, $domain) {
        if (Validate::language($language) && Validate::domain($domain) && $this->isValid()) {
            return "{$this->getURL()}/translation/config/{$language}/{$domain}";
        }
        return false;
    }

    public function fetchConfig($language, $domain) {
        $url = $this->getConfigURL($language, $domain);
        if (Validate::url($url)) {
            return $this->fetch($url);
        }
        return false;
    }

    public function fetchCollection($url) {
        if (Validate::url($url)) {
            return $this->fetch($url);
        }
        return false;
    }

    public function fetch($url) {
        if (Validate::url($url)) {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 3);
            curl_setopt($ch, CURLOPT_TIMEOUT, 3);
            $result = curl_exec($ch);
            curl_close($ch);
            if ($result) {
                $json = json_decode(trim($result), true);
                if (json_last_error() === 0) {
                    return $json;
                }
            }
        }
        return false;
    }
}
