<?php

namespace CBX;

class API
{
    private $url = null;

    public function __construct($url) {
        if ($url) {
            $this->url = $url;
        } else {
            trigger_error("I18NClass API Error. API url '{$url}' is not valid.");
        }
    }

    public function getURL() {
        return $this->url;
    }

    public function fetchConfig($language, $domain) {
        return $this->fetch("{$this->getURL()}/translation/config/{$language}/{$domain}");
    }

    public function fetchCollection($url) {
        return $this->fetch($url);
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
                    trigger_error("I18NClass API Error. (JSON) ".json_last_error_msg());
                }
            } else {
                trigger_error("I18NClass API Error. (CURL) ".curl_error($ch));
            }
        } else {
            trigger_error("I18NClass API Error. Url '{$url}' is not valid. ");
        }
        return false;
    }
}
