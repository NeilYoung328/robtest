<?php
/**
 * Module: Post List
 *
 * @package Magid
 */

use Magid\App\Modules\ModuleAttributes;

// get module content
$module_args = [
    'post_type',
    'posts_per_page',
    'background_color'
];
$attributes  = ModuleAttributes::getModuleSubFieldAttributes( $module_args );
extract( $attributes );

$args     = [
    'post_type'           => $post_type,
    'posts_per_page'      => $posts_per_page,
    'ignore_sticky_posts' => true
];
$wp_query = new WP_Query( $args );

// built style attributes
$background_style = "background-color: $background_color;";
?>

<section id="post-list-<?php echo $module_id; ?>" class="module module-post-list"
         style="<?php echo $background_style; ?>">
    <div class="container">
        <div class=" col-xs-12 col-md-10 col-md-offset-1">
            <div class="list__posts <?php echo $wp_query->found_posts > $posts_per_page ? 'list__posts--load-more' : ''; ?>"
                 data-posts="<?php echo $posts_per_page; ?>"
                 data-page="1" data-type="<?php echo $post_type; ?>">
                <?php
                if ( $wp_query->have_posts() ) {
                    $index = 0;
                    while ( $wp_query->have_posts() ) {
                        the_post();

                        echo '<div class="col-sm-6 list__post">';

                        // Loads the content/archive/content.php template.
                        include( locate_template( 'content/list/' . get_post_type() . '.php' ) );

                        echo '</div>';

                        $index ++;
                    }
                }
                ?>
            </div>

            <?php if ( $wp_query->found_posts > $posts_per_page ) : ?>
                <div class="list__posts-load">
                    <a href="javascript:;" class="list__posts-toggle btn btn--outline btn--outline-white">
                        <?php _e( 'Load More', 'magid' ); ?>
                    </a>
                </div>
            <?php endif; ?>

            <?php wp_reset_query(); ?>
            <div class="clearfix"></div>
        </div>
    </div>
</section>
