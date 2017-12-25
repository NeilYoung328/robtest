<?php
/**
 * Module: Icon Grid
 *
 * @package Magid
 */

$headline = get_sub_field( 'headline' );
$icons    = get_sub_field( 'icons' );

if ( ! $icons ) {
    return;
}

include( MAGID_THEME_DIR . 'assets/images/icons/icon-list.svg' );
?>

<section id="icon-list-<?php echo $module_id; ?>" class="module module-icon-list">
    <div class="container--lg">
        <div class="row">
            <div class="list__header col-md-4 col-lg-3">
                <?php echo $headline ? '<h2 class="hdg hdg--2 hdg--mb-15">' . $headline . '</h2>' : ''; ?>
            </div>
            <div class="list__items col-md-8 col-lg-9">
                <?php foreach ( $icons as $item ) : ?>
                    <?php // check for image icons
                    $icon_image = isset( $item['icon_image'] ) ? esc_url( $item['icon_image']['url'] ) : false;
                    ?>
                    <div class="list-item <?php echo empty($icon_image) ? 'list-item--empty' : ''; ?>">
                        <?php if( $icon_image ) : ?>
                            <div class="list-item__icon">
                                <img src="<?php echo $icon_image; ?>" alt="<?php echo esc_html( $item['title'] ); ?>" />
                            </div>
                        <?php endif; ?>
                        <div class="list-item__content">
                            <?php
                            echo ! empty( $item['title'] ) ? '<strong>' . esc_html( $item['title'] ) . '</strong>' : '';
                            echo ! empty( $item['title'] ) && ! empty( $item['description'] ) ? '<strong>:</strong> ' : '';
                            printf( __( '%s', 'magid' ), $item['description'] );
                            ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>
