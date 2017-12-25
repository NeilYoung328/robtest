<?php
/**
 * Template Name: Form
 *
 * @package Magid
 */

get_header();
?>

    <div class="container container--top">
        <div <?php hybrid_attr( 'primary', get_post_type() ); ?>>

            <?php
            while ( have_posts() ) {
                the_post();

                // Loads the content/singular/page.php template.
                hybrid_get_content_template();
            }
            ?>

        </div><!-- #primary -->
    </div><!-- .container -->

<?php get_footer(); ?>