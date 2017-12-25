<?php
/**
 * Template Name: Blog
 */

use Magid\App\Posts\PostAttributes;

get_header();

get_template_part( 'components/headers/blog', 'header' );
get_template_part( 'components/blog', 'filters' );

$paged        = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
$args         = [
    'post_type'           => 'post',
    'posts_per_page'      => 7,
    'paged'               => $paged,
    'ignore_sticky_posts' => true
];
$search_query = filter_input( INPUT_GET, 'search', FILTER_SANITIZE_SPECIAL_CHARS );
$term_filter  = filter_input( INPUT_GET, 'term', FILTER_SANITIZE_NUMBER_INT );
if ( $search_query ) {
    $args['s'] = $search_query;
}
if ( $term_filter ) {
    $args['category__in'] = $term_filter;
}
$wp_query = new WP_Query( $args );
$params   = PostAttributes::getBlogPostParams();

$search_data = $search_query ? 'data-search="' . $search_query . '"' : '';
$term_data   = $term_filter ? ' data-term="' . $term_filter . '"' : '';
?>

    <section class="module module-mentions">
        <div class="container--lg">
            <div class="row">
                <?php if ( $search_query || $term_filter ) : ?>
                    <div class="mentions__headline">
                        <h2 class="hdg hdg--2">
                            <?php echo $search_query ? 'Search Results for: ' . $search_query : ''; ?>
                        </h2>
                    </div>
                <?php endif; ?>
                <div class="mentions mentions--blog" data-page="1"
                     data-posts="7" <?php echo $search_data . $term_data; ?>>
                    <?php
                    $index = 0;
                    if ( $wp_query->have_posts() ) {
                        while ( $wp_query->have_posts() ) {
                            the_post();
                            if ( ! isset( $params[ $index ] ) ) {
                                $index = 0;
                            }

                            //$layout     = isset( $params[ $index ]['layout'] ) ? $params[ $index ]['layout'] : 'none';
							$layout = get_field( "content_position" );
							  $color =         get_field( "color" );
							          
							//print_r($layout);
                            $meta_color = isset( $params[ $index ]['meta'] ) ? $params[ $index ]['meta'] : '#FFFFFF';

                           // echo '<div class="mention mention--' . $layout . '" style="background: ' . $params[ $index ]['bg'] . '">';
						   echo '<div class="mention mention--' . $layout . '" style="background: ' .$color . '">';

                            // Loads the content/archive/content.php template.
                            include( locate_template( 'content/archive/content.php' ) );

                            echo '</div>';

                            $index ++;
                        }
                    } else {
                        echo '<div class="mentions__not-found">';
                        _e( '<p>Sorry, but nothing matched your search terms. Please try again with some different keywords.</p>', 'magid' );
                        echo '</div>';
                    }
                    ?>
                </div>
            </div>
            <?php if ( $wp_query->have_posts() && $wp_query->found_posts > 7 ) : ?>
                <div class="mentions__load-more">
                    <a href="javascript:;" class="btn btn--outline mentions__toggle">
                        <?php _e( 'Load More', 'magid' ); ?>
                    </a>
                </div>
                <?php wp_reset_query(); ?>
            <?php endif; ?>
        </div>
    </section>

<?php
// get blog template modules through custom WP_Query
do_action( 'magid_blog_modules' );

get_footer();