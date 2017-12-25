<?php
/**
 * Component for displaying blog search and category filters
 *
 * @package Magid
 */

$term_filter = filter_input( INPUT_GET, 'term', FILTER_SANITIZE_NUMBER_INT );
?>

<div class="filter pad-xs--45 pad-sm--60">
    <div class="container">
        <div class="row">
            <form role="search" method="get" class="search__form" action="<?php echo get_permalink(); ?>">
                <div class="col-sm-6 col-lg-5 filter__search">
                    <?php get_search_form(); ?>
                </div>
                <div class="col-sm-6 col-lg-5 col-lg-offset-2 filter__terms">
                    <?php
                    $args = [
                        'show_option_all' => __( 'Filter by Category', 'magid' ),
                        'class'           => 'filter__terms-select',
                        'taxonomy'        => 'category',
                        'name'            => 'term',
                        'selected'        => $term_filter ?: 0,
                    ];
                    wp_dropdown_categories( $args );
                    ?>
                </div>
            </form>
        </div>
    </div>
</div>
