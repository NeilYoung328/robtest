<?php
/**
 * Module: Hero
 *
 * @package Magid
 */

use Magid\App\Modules\ModuleAttributes;

// get module content
$module_args = [
    'headline',
    'subheadline',
    'description',
    'background_image',
    'background_image_small',
    'background_color',
    'headline_color',
    'content_color',
    'content_position'
];
$attributes  = ModuleAttributes::getModuleSubFieldAttributes( $module_args );
extract( $attributes );

// built style attributes
$background_style = "background-color: $background_color;";
// heading attributes
$heading_margin = $subheadline ? 'hdg--mb-15' : 'hdg--mb-30';
?>

<section id="hero-<?php echo $module_id; ?>" class="module module-hero module-hero--<?php echo $content_color; ?>"
         style="<?php echo $background_style; ?>">
    <div class="container hero container--top">
        <div class="row">
            <?php echo 'right' === $content_position ? '<div class="col-lg-5"></div>' : ''; ?>
            <div class="col-lg-7 hero__content hero__content--<?php echo $content_color; ?>">
                <?php
                echo $headline ? '<h1 class="hdg hdg--1 ' . $heading_margin . ' hdg--' . $headline_color . '">' . $headline . '</h1>' : '';
                echo $subheadline ? '<h4 class="hdg hdg--4 hdg--white hdg--mb-30">' . $subheadline . '</h4>' : '';
                echo $description ?: '';
                ?>
            </div>
        </div>
    </div>
    <div class="hero__image <?php echo $background_image_small ? 'hidden-xs' : ''; ?>"
         data-bkg="<?php echo $background_image['sizes']['featured-xl']; ?>"></div>

    <?php if ( $background_image_small ) : ?>
        <div class="hero__image visible-xs"
             data-bkg="<?php echo $background_image_small['sizes']['featured-sm']; ?>"></div>
    <?php endif; ?>

</section>
