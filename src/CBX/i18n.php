<?php

namespace CBX;

use CBX;

class i18n
{
    private static $i18nObject = null;

    public static function init() {
        self::$i18nObject = new i18nClass();
    }

    /** 
    * Overloading methods
    */
    public static function __callStatic( $name, $parameters ) {
        try {
            return forward_static_call_array( array( self::$i18nObject, $name ), $parameters );
        } catch (Exception $e) {
            trigger_error( __METHOD__.': '.$e->getMessage() );
        }
        return false;
    }

}

i18n::init();