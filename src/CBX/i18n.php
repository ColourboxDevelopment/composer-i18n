<?php

namespace CBX;

class i18n
{
    public static function create($language, $domain, $apiUrl) {
        return new i18nClass(new Collections(new Config($language, $domain, new API($apiUrl))));
    }

    public static function createOffline($language, $domain, $jsonDir) {
        return new i18nClass(new Collections(new Config($language, $domain, new APIOffline($jsonDir))));
    }
}
