<?php
/**
 * The template for displaying all single posts.
 *
 * @package Magid
 */

// check for external url post option
$external     = get_field( 'external_resource' );
$external_url = get_field( 'external_url' );
if ( $external && $external_url ) {
    wp_redirect( home_url( '/' ), 301 );
    exit();
}

get_header();

get_template_part( 'components/headers/post', 'header' );
?>
    <div class="post__container">
        <div class="container">
            <?php
            while ( have_posts() ) {
                the_post();

                // Loads the content/singular/content.php template.
                hybrid_get_content_template();
            }
            ?>
        </div><!-- .container -->
    </div>

<?php
// get blog template modules through custom WP_Query
do_action( 'magid_blog_modules' );

get_footer();