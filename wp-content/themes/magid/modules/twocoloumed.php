<?php
/**
 * Module: Twocoloumed
 *
 * @package Magid
 */

use Magid\App\Modules\ModuleAttributes;

// get module content
$module_args = [
    'headline',
	'mainheadline',
    'content',
	'gpheadline',
    'form_id'
];
$attributes  = ModuleAttributes::getModuleSubFieldAttributes( $module_args );
extract( $attributes );
$columns1 = 'col-sm-6 col-md-6';
$columns2 = 'col-sm-6 col-md-6';
?>
<section id="twocoloumed-<?php echo $module_id; ?>" class="module module-twocoloumed">
    <div class="container">
        <div class="row">
		    <?php  echo $mainheadline ? '<h2 class="hdg hdg--4 hdg--orange hdg--mb-15">' . $mainheadline . '</h2>' : ''; ?>
            <div class="<?php echo $columns1; ?> twocoloumed">
                        <?php
                         echo $headline ? '<h4 class="hdg hdg--4 hdg--orange hdg--mb-15">' . $headline . '</h4>' : '';
                         echo $content ? '<div class="entry__content">' . $content . '</div>' : '';
                        ?>
                 
            </div>
			
			 <div class="<?php echo $columns2; ?> twocoloumed">
                <?php
                echo $gpheadline ? '<h4 class="hdg hdg--4 hdg--orange hdg--mb-15">' . $gpheadline . '</h4>' : '';
                gravity_form( $form_id, false, false, false, false, true );
                ?>
            </div>
        </div>
</section>