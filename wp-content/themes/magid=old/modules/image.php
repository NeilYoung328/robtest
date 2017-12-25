<?php
/**
 * Module: Image
 *
 * @package Magid
 */

$image    = get_sub_field( 'image' );
$image_sm = get_sub_field( 'image_small' );
$parallax = get_sub_field( 'parallax' );

if ( ! $image ) {
    return;
}
?>

<section id="image-<?php echo $module_id; ?>" class="module module-image">
    <?php if ( 'enabled' === $parallax ) : ?>
        <div class="image__parallax hidden-xs"
             data-bkg="<?php echo esc_url( $image['sizes']['featured-xl'] ); ?>"></div>

        <?php if ( ! $image_sm ) : ?>
            <img class="visible-xs" data-src="<?php echo esc_url( $image['sizes']['featured-xl'] ); ?>"
                 alt="<?php echo $image['alt']; ?>"
                 title="<?php echo $image['title']; ?>"/>
        <?php endif; ?>
    <?php else : ?>
        <img class="<?php echo $image_sm ? 'hidden-xs' : ''; ?>"
             data-src="<?php echo esc_url( $image['sizes']['featured-xl'] ); ?>"
             alt="<?php echo $image['alt']; ?>"
             title="<?php echo $image['title']; ?>"/>
    <?php endif; ?>

    <?php if ( $image_sm ) : ?>
        <img class="visible-xs" data-src="<?php echo esc_url( $image_sm['sizes']['featured-sm'] ); ?>"
             alt="<?php echo $image_sm['alt']; ?>"
             title="<?php echo $image_sm['title']; ?>"/>
    <?php endif; ?>
</section>
