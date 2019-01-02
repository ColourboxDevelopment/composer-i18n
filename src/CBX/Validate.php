<?php

namespace CBX;

class Validate
{
    public static function language($language) {
        return $language && preg_match("/^[a-z]{2}(_[A-Z]{2})?$/", $language);
    }

    public static function domain($domain) {
        return $domain && preg_match("/^[a-zA-Z0-9_-]{1,255}$/", $domain);
    }

    public static function collection($collection) {
        return $collection && preg_match("/^[a-zA-Z0-9_-]{1,255}$/", $collection);
    }

    public static function index($index) {
        return $index && preg_match("/^[^\/]{1,255}$/", $index);
    }

    public static function url($url) {
        return $url;
    }
}
