<?php

namespace CBX;

class Index
{
    public static function global() {
        return 'global';
    }

    public static function getIndexData($cIndex) {
        if ($cIndex) {
            $splits = explode("/", $cIndex);
            $collection = Index::global();
            $index = '';
            if (count($splits) === 1) {
                $index = $cIndex;
            } else if (count($splits) === 2) {
                $collection = $splits[0];
                $index = $splits[1];
            } else {
                return false;
            }
            if (!Validate::index($index)) {
                return false;
            }
            if (!Validate::collection($collection)) {
                return false;
            }
            return (object)[
                'fullIndex' => "{$collection}/{$index}",
                'collection' => $collection,
                'index' => $index,
            ];
        }
        return false;
    }
}
