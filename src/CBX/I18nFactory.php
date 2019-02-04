<?php

namespace CBX;

class I18nFactory
{
    public static function create($language, $domain, $apiUrl) {
        return new I18nClass(new Collections(new Config($language, $domain, new API($apiUrl))));
    }

    public static function createOffline($language, $domain, $jsonDir) {
        return new I18nClass(new Collections(new Config($language, $domain, new APIOffline($jsonDir))));
    }
}
