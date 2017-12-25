<?php
/**
 * Component for appending modules after page content
 *
 * @package Magid
 */

if ( $sections = get_field( 'modules', get_the_ID() ) ) {
    $index = 1;
    // loop through the rows of data
    while ( has_sub_field( 'modules', get_the_ID() ) ) {
        $rowName   = get_row_layout();
        $module_id = 'module_' . $index;

        // include the module file
        include( locate_template( 'modules/' . $rowName . '.php' ) );

        $index ++;
    }
}