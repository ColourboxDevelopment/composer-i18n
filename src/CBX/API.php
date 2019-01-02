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
}
