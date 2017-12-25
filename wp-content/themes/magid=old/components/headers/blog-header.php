<?php
/**
 * Blog page template header for archive and posts
 *
 * @package Magid
 */

// get module content
$blog_meta   = get_post_meta( get_the_ID() );
$headline    = isset( $blog_meta['headline'][0] ) ? $blog_meta['headline'][0] : get_the_title( get_the_ID() );
$description = isset( $blog_meta['description'][0] ) ? wpautop( $blog_meta['description'][0] ) : null;
if ( isset( $blog_meta['background_image'][0] ) ) {
    $background_image = wp_get_attachment_image_src( $blog_meta['background_image'][0], 'featured-xl' );
}
$background_color = isset( $blog_meta['background_color'][0] ) ? $blog_meta['background_color'][0] : '#4A4A4A';
$headline_color   = isset( $blog_meta['headline_color'][0] ) ? $blog_meta['headline_color'][0] : 'white';
$content_color    = isset( $blog_meta['content_color'][0] ) ? $blog_meta['content_color'][0] : 'white';
$content_position = isset( $blog_meta['content_position'][0] ) ? $blog_meta['content_position'][0] : 'left';

// built style attributes
$background_style = "background-color: $background_color;";
?>

<section class="module module-hero" style="<?php echo $background_style; ?>">
    <div class="container hero container--top">
        <div class="row">
            <?php echo 'right' === $content_position ? '<div class="col-md-3 col-lg-5"></div>' : ''; ?>
            <div class="col-md-9 col-lg-7 hero__content hero__content--<?php echo $content_color; ?>">
                <?php
                echo $headline ? '<h1 class="hdg hdg--1 hdg--mb-30 hdg--' . $headline_color . '">' . $headline . '</h1>' : '';
                echo $description;
                ?>
            </div>
        </div>
    </div>
    <div class="hero__image" data-bkg="<?php echo $background_image[0]; ?>"></div>
</section>