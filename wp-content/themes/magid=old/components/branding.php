<?php
/**
 * Template part for displaying the site branding.
 */

use Magid\App\ACF;

// get footer site options
$options      = ( new ACF() )->getACFOptions();
$site_logo    = ! empty( $options['site_logo'] ) ? wp_get_attachment_image_src( $options['site_logo'] ) : null;
$branding_tag = is_front_page() || is_home() ? 'h1' : 'p';

if ( empty( $site_logo ) ) {
    return;
}
?>


<div <?php hybrid_attr( 'branding' ); ?>>
    <<?php echo $branding_tag; ?> <?php hybrid_attr( 'site-title' ); ?>>
        <?php
        printf(
            __( '<a href="%1$s" title="%2$s"><img src="%4$s" class="%3$s" alt="%2$s" title="%2$s" /></a>', 'magid' ),
            esc_url( home_url('/') ),
            get_bloginfo( 'name' ),
            'branding__logo',
            esc_url( $site_logo[0] )
        );
        ?>
    </<?php echo $branding_tag; ?>>
</div><!-- .site-branding -->