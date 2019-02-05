<?php

namespace CBX;

class API
{
    private $url = null;
    private $cache = null;

    public function __construct($url, $cache) {
        if ($url) {
            $this->url = $url;
        } else {
            throw new \Exception("I18NClass API Error. API url '{$url}' is not valid.");
        }
        $this->cache = $cache;
    }

    public function getURL() {
        return $this->url;
    }

    public function fetchConfig($language, $domain) {
        return $this->fetch("{$this->getURL()}/translation/config/{$language}/{$domain}");
    }

    public function fetchCollection($url) {
        if ($url) {
            $cachedData = $this->cache->get($url);
            if ($cachedData) {
                if (gettype($cachedData) === "string") {
                    $json = json_decode(trim($cachedData), true);
                    if (json_last_error() === 0) {
                        return $json;
                    } else {
                        throw new \Exception("I18NClass API Error. Collection JSON. ".json_last_error_msg());
                    }
                } else {
                    return $cachedData;
                }
            }
            $data = $this->fetch($url);
            if ($data) {
                $this->cache->set($url, gettype($data) === "string" ? json_encode($data) : $data);
            }
            return $data;
        }
        return false;
    }

    private function fetch($url) {
        if ($url) {
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
                } else {
                    throw new \Exception("I18NClass API Error. (JSON) ".json_last_error_msg());
                }
            } else {
                throw new \Exception("I18NClass API Error. (CURL) ".curl_error($ch));
            }
        } else {
            throw new \Exception("I18NClass API Error. Url '{$url}' is not valid. ");
        }
        return false;
    }
}
