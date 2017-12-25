<?php
/**
 * Blog page template header for archive and posts
 *
 * @package Magid
 */

use Magid\App\Posts\PostAttributes;

// get module content
if ( ! has_post_thumbnail() ) {
    $blog_query = ( new PostAttributes() )->blogModuleQuery( true );
    if ( isset( $blog_query->posts[0] ) ) {
        $blog_meta = get_post_meta( $blog_query->posts[0] );
        $image     = wp_get_attachment_image_src( $blog_meta['background_image'][0], 'featured-xl' );
        $color     = isset( $blog_meta['background_color'][0] ) ? $blog_meta['background_color'][0] : '#4A4A4A';
    }
} else {
    $image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'featured-xl' );
    $color = '#4A4A4A';
}

if ( ! $image ) {
    return;
}

// built style attributes
$background_style = "background-color: $color;";
?>

<section class="module module-hero" style="<?php echo $background_style; ?>">
    <div class="hero hero--post">
        <img class="visible-xs" data-src="<?php echo esc_url( $image[0] ); ?>"
             alt="<?php the_title(); ?>"
             title="<?php the_title(); ?>"/>
    </div>
    <div class="hero__image hidden-xs" data-bkg="<?php echo esc_url( $image[0] ); ?>"></div>
</section>