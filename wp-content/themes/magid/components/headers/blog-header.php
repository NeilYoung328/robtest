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
if ( isset( $blog_meta['background_image_small'][0] ) ) {
    $background_image_small = wp_get_attachment_image_src( $blog_meta['background_image_small'][0], 'featured-xl' );
}
$background_color = isset( $blog_meta['background_color'][0] ) ? $blog_meta['background_color'][0] : '#4A4A4A';
$subheading       = isset( $blog_meta['subheadline'][0] ) ? $blog_meta['subheadline'][0] : null;
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
                echo $subheading ? '<h4 class="hdg hdg--4 hdg--white hdg--mb-30">' . $subheading . '</h4>' : '';
                echo $description;
                ?>
            </div>
        </div>
    </div>
   

    <div class="hero__image <?php echo $background_image_small ? 'hidden-xs' : ''; ?>"
         data-bkg="<?php echo $background_image[0]; ?>"></div>

    <?php if ( $background_image_small ) : ?>
        <div class="hero__image visible-xs"
             data-bkg="<?php echo $background_image_small['0']; ?>"></div>
    <?php endif; ?>
</section>