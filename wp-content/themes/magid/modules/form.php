<?php
/**
 * Module: Form
 *
 * @package Magid
 */

use Magid\App\Modules\ModuleAttributes;

// get module content
$module_args = [
    'headline',
    'form_id'
];
$attributes  = ModuleAttributes::getModuleSubFieldAttributes( $module_args );
extract( $attributes );

$columns = 'col-md-10 col-md-offset-1';
?>

<section id="form-<?php echo $module_id; ?>" class="module module-form">
    <div class="container">
        <div class="row">
            <div class="<?php echo $columns; ?> pad-xs--30 pad-md--45 content--center">
                <?php
                echo $headline ? '<h2 class="hdg hdg--2 hdg--mb-30">' . $headline . '</h2>' : '';
                gravity_form( $form_id, false, false, false, false, true );
                ?>
            </div>
        </div>
    </div>
</section>
