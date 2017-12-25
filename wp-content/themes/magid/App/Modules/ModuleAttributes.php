<?php

namespace Magid\App\Modules;

/**
 * Class ModuleAttributes
 *
 * @package Magid\App\Modules
 */
class ModuleAttributes {

    public static function getModuleSubFieldAttributes( $attributes ) {
        $values = [];
        foreach ( $attributes as $key => $attribute ) {
            $values[ $attribute ] = get_sub_field( $attribute ) ?: '';
        }

        return $values;
    }
}