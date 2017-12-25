<?php
/**
 * Single Consortium template
 */

get_header();

if ( get_field( 'modules' ) ) {
    $index = 1;
    // loop through the rows of data
    while ( has_sub_field( 'modules' ) ) {
        $rowName      = get_row_layout();
        $module_id = 'module_' . $index;

        // include the module file
        include( locate_template( 'modules/' . $rowName . '.php' ) );

        $index ++;
    }
}

get_footer();