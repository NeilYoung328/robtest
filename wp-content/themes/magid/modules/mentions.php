<?php
/**
 * Module: Mentions
 *
 * @package Magid
 */

use Magid\App\Core\Transients;
use Magid\App\Modules\ModuleAttributes;

$transient_key = 'page_' . get_the_ID() . '_' . $module_id;
$output        = get_transient( $transient_key ) ?: false;

if ( $output ) {
    echo $output;

    return;
}

ob_start();

// get module content
$module_args = [
    'headline',
    'mentions'
];
$attributes  = ModuleAttributes::getModuleSubFieldAttributes( $module_args );
extract( $attributes );
?>

    <section id="members-<?php echo $module_id; ?>" class="module module-mentions">
        <?php if ( $headline ) : ?>
            <div class="container pad-xs--30 pad-sm--60 pad--md-75 content--center">
                <h2 class="hdg hdg--2"><?php echo $headline; ?></h2>
            </div>
        <?php endif; ?>
        <?php if ( $mentions ) : ?>
            <div class="container--lg">
                <div class="row">
                    <div class="mentions">
                        <?php foreach ( $mentions as $mention ) : ?>
                            <?php
                            $background_color = isset( $mention['background_color'] ) ? $mention['background_color'] : '#F47637';
                            $args             = [
                                'post_type'      => [ 'post', 'career' ],
                                'posts_per_page' => 1,
                                'p'              => $mention['item']
                            ];
                            $metion_post      = new WP_Query( $args );
                            ?>
                            <?php if ( $metion_post->have_posts() ) : ?>
                                <div class="mention" style="background: <?php echo $background_color; ?>">
                                    <?php
                                    while ( $metion_post->have_posts() ) {
                                        $metion_post->the_post();

                                        // Loads the content/archive/content.php template.
                                        include( locate_template( 'content/archive/mention.php' ) );
                                    }
                                    wp_reset_query();
                                    ?>
                                </div>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </div>
                    <div class="mentions__load-more">
                        <a class="btn btn--outline" href="<?php echo home_url( '/magid-mentions/' ) ?>">View All</a>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </section>
<?php
$output = ob_get_contents();
ob_end_clean();

// cache our returned output in a transient to reduce page queries
( new Transients() )->registerTransients( $transient_key );
set_transient( $transient_key, $output );

echo $output;
