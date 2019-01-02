<?php

namespace CBX;

class Index
{
    public static function global() {
        return 'global';
    }

    public static function toIndexFromComponents($language, $domain, $collection, $index) {
        if (!Validate::index($index)) {
            // console.error(`Invalid index: ${index}`); // eslint-disable-line no-console
            return false;
        }
        if (!Validate::collection($collection)) {
            // console.error(`Invalid collection: ${collection}`); // eslint-disable-line no-console
            return false;
        }
        if (!Validate::domain($domain)) {
            // console.error(`Invalid domain: ${domain}`); // eslint-disable-line no-console
            return false;
        }
        if (!Validate::language($language)) {
            // console.error(`Invalid language: ${language}`); // eslint-disable-line no-console
            return false;
        }
        return "{$language}/{$domain}/{$collection}/{$index}";
    }

    public static function toIndex($index, $language = null, $domain = null) {
        $indexData = Index::getIndexData($index, $language, $domain);
        return $indexData->fullIndex;
    }

    public static function getIndexData($cIndex, $language = null, $domain = null) {
        if ($cIndex) {
            $splits = explode("/", $cIndex);
            $language = $language ? $language : i18n::getLanguage();
            $domain = $domain ? $domain : i18n::getDomain();
            $collection = Index::global();
            $index = '';
            if (count($splits) === 1) {
                $index = $cIndex;
            } else if (count($splits) === 2) {
                $collection = splits[0];
                $index = splits[1];
            } else if (count($splits) === 3) {
                $domain = splits[0];
                $collection = splits[1];
                $splits = splits[2];
            } else if (count($splits) === 4) {
                $language = splits[0];
                $domain = splits[1];
                $collection = splits[2];
                $splits = splits[3];
            }
            if (!Validate::index($index)) {
                // console.error(`Invalid index: ${index} in ${cIndex}`); // eslint-disable-line no-console
                return false;
            }
            if (!Validate::collection($collection)) {
                // console.error(`Invalid collection: ${collection} in ${cIndex}`); // eslint-disable-line no-console
                return false;
            }
            if (!Validate::domain($domain)) {
                // console.error(`Invalid domain: ${domain} in ${cIndex}`); // eslint-disable-line no-console
                return false;
            }
            if (!Validate::language($language)) {
                // console.error(`Invalid language: ${language} in ${cIndex}`); // eslint-disable-line no-console
                return false;
            }
            if (Validate::language($language)
                && Validate::domain($domain)
                && Validate::collection($collection)
                && Validate::index($index)) {
                return (object)[
                    'fullIndex' => "{$language}/{$domain}/{$collection}/{$index}",
                    'language' => $language,
                    'domain' => $domain,
                    'collection' => $collection,
                    'index' => $index,
                ];
            }
        }
        return false;
    }

    public static function toCollectionIndex($index, $language = null, $domain = null) {
        $indexData = Index::getCollectionIndexData($index, $language, $domain);
        return $indexData ? $indexData->fullIndex : false;
    }

    public static function getCollectionIndexData($cIndex, $language = null, $domain = null) {
        if ($cIndex) {
            $splits = explode('/', $cIndex);
            $language = $language ? $language : i18n::getLanguage();
            $domain = $domain ? $domain : i18n::getDomain();
            $index = '';
            if (count($splits) === 1) {
                $index = $cIndex;
            } else if (count($splits) === 2) {
                $domain = $splits[0];
                $index = $splits[1];
            } else if (count($splits) === 3) {
                $language = $splits[0];
                $domain = $splits[1];
                $index = $splits[2];
            }
            if (!Validate::collection($index)) {
                // console.error(`Invalid collection: ${index} in ${cIndex}`); // eslint-disable-line no-console
                return false;
            }
            if (!Validate::domain($domain)) {
                // console.error(`Invalid domain: ${domain} in ${cIndex}`); // eslint-disable-line no-console
                return false;
            }
            if (!Validate::language($language)) {
                // console.error(`Invalid language: ${language} in ${cIndex}`); // eslint-disable-line no-console
                return false;
            }
            if (Validate::language($language) && Validate::domain($domain) && Validate::collection($index)) {
                return (object)[
                    'fullIndex' => "{$language}/{$domain}/{$index}",
                    'language' => $language,
                    'domain' => $domain,
                    'index' => $index,
                ];
            }
        }
        return false;
    }
}
