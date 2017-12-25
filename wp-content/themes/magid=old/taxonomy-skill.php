<?php
/**
 * skill texonomy Template
 */

use Magid\App\Modules\ModuleAttributes;
use Magid\App\SkillDropdownWalker;get_header();
if ( is_active_sidebar( 'custom-skill-bar' ) ) : ?>
    <?php dynamic_sidebar( 'custom-skill-bar' ); ?>
<?php endif; 

$module_args = [
    'headline',
    'description',
    'default_skill'
];
$attributes  = ModuleAttributes::getModuleSubFieldAttributes( $module_args );
extract( $attributes );

$queried_object = get_queried_object();
$default_skill = $queried_object->term_id;
if ( $default_skill ) {
    $term        = get_term_by( 'id', $default_skill, 'skill' );
    $headline    = $term->name;
    $description = $term->description;
}

?>

    <section id="members-<?php echo $module_id; ?>" class="module module-members">
    <h2 class='exp_expert'>Meet Our Experts</h2>
     <div class='exp_desktop'>
     <div class="container">
        <div class="row">
     
         <?php echo do_shortcode( '[DSKILLS]' ); ?>
        </div>
        </div>
        </div>
     <div class="container">
        <div class="row">
            
            
             <div class="col-sm-12">
            <?php 
                 echo $headline ? '<h2 id="memberTermName" class="hdg hdg--2 hdg--mb-15">' . $headline . '</h2>' : '';
                echo $description ? '<div id="memberTermDesc" class="entry__content">' . $description . '</div>' : '';
            ?>
            </div>
        </div>
    </div>
    <div class="container--lg">
        <div id="membersList" class="members" data-term="<?php echo $default_skill; ?>">
            <img class="members--loading" src="<?php echo MAGID_THEME_PATH_URL . 'assets/images/loading-grid.svg'; ?>"/>
        </div>
        
            <div class="Top_md">
                <h2  class="hdg hdg--2 hdg--mb-15"> Meet Another Team Of Experts </h2>  
                <div class="mentions__load-more">
                    <a class="btn btn--primary tbn" href="javascript:void(0);" style="">Back To Top</a>
                </div>  
            </div>
        
    </div>
    
</section>

<?php
// get blog template modules through custom WP_Query
do_action( 'magid_blog_modules' );

get_footer();