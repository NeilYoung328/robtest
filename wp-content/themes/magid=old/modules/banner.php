<?php
/**
 * Module: Banner
 *
 * @package Magid
 */

use Magid\App\Core\Transients;
use Magid\App\Modules\ModuleAttributes;

// get module content
$module_args = [
    'headline',
    'content',
    'page_link',
    'external_link',
    'background_image',
    'background_image_mobile'
];
$attributes  = ModuleAttributes::getModuleSubFieldAttributes( $module_args );
extract( $attributes );

$button_url    = $page_link ? esc_url( $page_link ) : '#';
$button_text   = $external_link ? __( 'Visit Site', 'magid' ) : __( 'Learn More', 'magid' );
$button_target = $external_link ? 'target="_blank"' : '';

$columns = 'col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2';
?>

<section id="banner-<?php echo $module_id; ?>" class="module module-banner">
    <?php if ( ! $background_image_mobile ) : ?>
        <div class="module-banner__background"
             data-bkg="<?php echo $background_image['sizes']['featured-xl']; ?>"></div>
    <?php else : ?>
        <div class="module-banner__background visible-xs"
             data-bkg="<?php echo $background_image_mobile['sizes']['featured-sm']; ?>"></div>
        <div class="module-banner__background hidden-xs"
             data-bkg="<?php echo $background_image['sizes']['featured-xl']; ?>"></div>
    <?php endif; ?>
    <div class="container">
        <div class="row">
            <div class="<?php echo $columns; ?>">
                <div class="banner__content">
                    <div class="banner__hover">
                        <?php
                        echo $headline ? '<h2 class="hdg hdg--4 hdg--orange hdg--mb-15">' . $headline . '</h2>' : '';
                        echo $content ? '<div class="entry__content">' . $content . '</div>' : '';
                        echo $page_link ? '<a class="btn btn--outline" href="' . $button_url . '" ' . $button_target . '>' . $button_text . '</a>' : '';
                        ?>
                    </div>
                </div>
            </div>
        </div>
</section>