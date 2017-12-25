<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Magid
 */

get_header(); ?>

<div class="container">
    <div class="row">

        <div <?php hybrid_attr( 'primary', 'full' ); ?>>

            <?php
            if ( have_posts() ) {
                while ( have_posts() ) {
                    the_post();

                    // Loads the content/archive/content.php template.
                    hybrid_get_content_template();
                }
            } else {
                get_template_part( 'content/content', 'none' );
            }
            ?>

        </div><!-- #primary -->

    </div><!-- .row -->
</div><!-- .container -->

<?php get_footer(); ?>
