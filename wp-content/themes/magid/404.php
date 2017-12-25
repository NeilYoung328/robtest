<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @package Magid
 */

get_header();

get_template_part( 'components/headers/404', 'header' );

// get blog template modules through custom WP_Query
do_action( 'magid_blog_modules' );

get_footer();