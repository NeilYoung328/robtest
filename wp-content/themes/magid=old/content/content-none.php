<?php
/**
 * The template part for displaying a message that posts cannot be found.
 *
 * @package Magid
 */
?>

<section class="no-results not-found">

    <div class="page__content">
        <?php
        if ( is_home() && current_user_can( 'publish_posts' ) ) {

            printf( __( '<p>Ready to publish your first post? <a href="%1$s">Get started here</a>.</p>', 'magid' ), esc_url( admin_url( 'post-new.php' ) ) );

        } elseif ( is_search() ) {

            _e( '<p>Sorry, but nothing matched your search terms. Please try again with some different keywords.</p>', 'magid' );

        } else {

            _e( '<p>It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.</p>', 'magid' );

        }
        ?>
    </div><!-- .page__content -->

</section><!-- .no-results -->
