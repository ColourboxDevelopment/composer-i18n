<?php

namespace CBX;

class I18nFactory
{
    public static function create($language, $domain, $apiUrl, $cacheHost, $cachePort) {
        return new I18nClass(new Collections(new Config($language, $domain, new API($apiUrl, new Cache($cacheHost, $cachePort)))));
    }
}
