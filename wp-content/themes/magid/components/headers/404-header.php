<?php
/**
 * Blog page template header for archive and posts
 *
 * @package Magid
 */

use Magid\App\Posts\PostAttributes;

// get module content
$blog_query = ( new PostAttributes() )->blogModuleQuery( true );
if ( isset( $blog_query->posts[0] ) ) {
    $blog_meta = get_post_meta( $blog_query->posts[0] );
    $image     = wp_get_attachment_image_src( $blog_meta['background_image'][0], 'featured-xl' );
    $color     = isset( $blog_meta['background_color'][0] ) ? $blog_meta['background_color'][0] : '#4A4A4A';
}

// built style attributes
$background_style = "background-color: $color;";
?>

<section class="module module-hero" style="<?php echo $background_style; ?>">
    <div class="container hero container--top">
        <div class="row">
            <div class="col-md-9 col-lg-7 hero__content hero__content--white">
                <h1 class="hdg hdg--1 hdg--mb-15 hdg--white">
                    <?php _e( 'Page Not Found', 'magid' ); ?>
                </h1>
                <?php
                _e( '<p>It looks like the page you&rsquo;re looking for doesn&rsquo;t exist. Perhaps a quick look through these pages will help you find what you&rsquo;re looking for:</p>', 'magid' );

                wp_nav_menu( [
                    'theme_location' => 'primary'
                ] );
                ?>
            </div>
        </div>
    </div>
    <div class="hero__image" data-bkg="<?php echo esc_url( $image[0] ); ?>"></div>
</section>