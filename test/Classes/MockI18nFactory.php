<?php

require_once("MockAPI.php");

class MockI18nFactory
{
    public static function create($language, $domain, $apiUrl, $cacheHost, $cachePort) {
        return new CBX\I18nClass(new CBX\Collections(new CBX\Config($language, $domain, new MockAPI($apiUrl, new CBX\Cache($cacheHost, $cachePort)))));
    }
}
