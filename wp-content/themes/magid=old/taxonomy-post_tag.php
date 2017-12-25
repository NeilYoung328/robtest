<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Magid
 */
use Magid\App\Posts\PostAttributes;
get_header(); 

?>
    <section class="module module-hero" style="background-color: #61c3ef;">
    <div class="container hero container--top">
        <div class="row">
                        <div class="col-md-9 col-lg-7 hero__content hero__content--white">
                <h1 class="hdg hdg--1 hdg--mb-30 hdg--white">Magid Mentions&nbsp;</h1><p>When your DNA is made up of understanding each person’s unique blend of qualities, you need a space to explore. Here, you can find everything related to our latest thinking, including original content, press releases, where you can meet us in person, news and announcements about our clients, and so much more.</p>
            </div>
        </div>
    </div>
    <div class="hero__image" data-bkg="http://magid.com/app/uploads/2017/04/CoffeeCups_iStock-504333530_edit-1-1440x960.jpg" style="background-image: url(&quot;http://magid.com/app/uploads/2017/04/CoffeeCups_iStock-504333530_edit-1-1440x960.jpg&quot;); opacity: 1;"></div>
</section>
<?php
get_template_part( 'components/blog', 'filters' );
$params   = PostAttributes::getBlogPostParams();
?>



      <section class="module module-mentions">
        <div class="container--lg">
            <div class="row">
                
                <div class="mentions mentions--blog" data-page="1"
                     data-posts="7" <?php echo $search_data . $term_data; ?>>
                    <?php
                    $index = 0;
                    if ( have_posts() ) {
                        while ( have_posts() ) {
                            the_post();
                            if ( ! isset( $params[ $index ] ) ) {
                                $index = 0;
                            }

                            $layout     = isset( $params[ $index ]['layout'] ) ? $params[ $index ]['layout'] : 'none';
                            //$layout = get_field( "content_position" );
                            //  $color =         get_field( "color" );
                                      
                            //print_r($layout);
                            $meta_color = isset( $params[ $index ]['meta'] ) ? $params[ $index ]['meta'] : '#FFFFFF';

                            echo '<div class="mention mention--' . $layout . '" style="background: ' . $params[ $index ]['bg'] . '">';
                          // echo '<div class="mention mention--' . $layout . '" style="background: ' .$color . '">';

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
            <?php if ( have_posts()  ) : ?>
                <div class="mentions__load-more">
                    <a href="javascript:;" class="btn btn--outline mentions__toggle">
                        <?php _e( 'Load More', 'magid' ); ?>
                    </a>
                </div>
                
            <?php endif; ?>
        </div>
    </section>

<?php 
do_action( 'magid_blog_modules' );
get_footer(); ?>