<?php
/**
 * Module: Icon Grid
 *
 * @package Magid
 */

$icons = get_sub_field( 'icons' );

if ( ! $icons ) {
    return;
}

include( MAGID_THEME_DIR . 'assets/images/icons/icon-grid.svg' );
?>

<section id="icon-grid-<?php echo $module_id; ?>" class="module module-icon-grid">
    <div class="container--lg container--no-padding">
        <div class="grid-items">
            <?php foreach ( $icons as $item ) : ?>
                <?php
                $icon_link     = isset( $item['icon_link'] ) ? esc_url( $item['icon_link'] ) : false;
                $target = '';
                if( strpos( $icon_link, 'mailto:' ) !== false ) {
                    $target = 'target="_blank"';
                }
                $element_start = $icon_link ? 'a href="' . $icon_link . '" '.$target : 'div';
                $element_end   = $icon_link ? 'a' : 'div';

                // check for image icons
                $icon_image = isset( $item['icon_image'] ) ? esc_url( $item['icon_image']['url'] ) : false;
                $icon_image_alt = isset( $item['icon_image_alt'] ) ? esc_url( $item['icon_image_alt']['url'] ) : false;
                ?>
                <<?php echo $element_start; ?> class="grid-item" data-active-class="grid-item--is-active">
                    <div class="grid-item--default">
                        <div class="grid-item-icon">
                            <?php if( $icon_image ) : ?>
                                <img data-src="<?php echo $icon_image; ?>" alt="<?php echo esc_html( $item['title'] ); ?>" />
                            <?php else : ?>
                                <svg class="icon icon-<?php echo $item['icon']; ?>">
                                    <use xlink:href="#icon-<?php echo $item['icon']; ?>"></use>
                                </svg>
                            <?php endif; ?>
                        </div>
                        <div class="grid-item-title">
                            <?php echo esc_html( $item['title'] ); ?>
                        </div>
                    </div>
                    <div class="grid-item--hover">
                        <div class="grid-item-icon">
                            <?php if( $icon_image ) : ?>
                                <?php $alt_image = $icon_image_alt ?: $icon_image; ?>
                                <img data-src="<?php echo $alt_image; ?>" alt="<?php echo esc_html( $item['title'] ); ?>" />
                            <?php else : ?>
                                <svg class="icon icon-<?php echo $item['icon']; ?>">
                                    <use xlink:href="#icon-<?php echo $item['icon']; ?>"></use>
                                </svg>
                            <?php endif; ?>
                        </div>
                        <div class="grid-item-title">
                            <?php echo esc_html( $item['title'] ); ?>
                        </div>
                        <div class="grid-item-description">
                            <?php echo esc_html( $item['description'] ); ?>
                        </div>
                    </div>
                </<?php echo $element_end; ?>>
            <?php endforeach; ?>
        </div>
    </div>
</section>
