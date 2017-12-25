<?php
/**
 * The template for displaying single career posts.
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

                // Loads the content/singular/content.php template.
                hybrid_get_content_template();
            }
            ?>

            <div class="post__view-all">
                <a class="btn btn--primary" href="<?php echo esc_url( home_url('/careers') ); ?>">
                    <?php _e( 'View All Posts', 'magid' ); ?>
                </a>
            </div>

        </div><!-- #primary -->
    </div><!-- .container -->

<?php
get_footer();