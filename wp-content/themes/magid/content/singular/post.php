<?php
/**
 * @package Magid
 */

use Magid\App\Posts\PostAttributes;
use Magid\App\ACF;

// get site options
$options            = ( new ACF() )->getACFOptions();
$whitepaper_form_id = isset( $options['whitepaper_form_id'][0] ) ? $options['whitepaper_form_id'][0] : false;

global $post;

$blog_query = ( new PostAttributes() )->blogModuleQuery( true );
$whitepaper = ( new PostAttributes() )->getPostWhitePaper( $post->ID );
?>

    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <header class="entry__header entry__header--post">
            <?php the_title( '<h1 class="hdg hdg--1 hdg--mb-15">', '</h1>' ); ?>
            <?php if ( ! $whitepaper ) : ?>
                <div class="entry__meta">
                    <div class="meta__date">
                        <?php
                        printf(
                            __( 'By %s | %s', 'magid' ),
                            esc_html( ( new PostAttributes() )->getPostAuthor( $post->ID, $post->post_author ) ),
                            get_the_date( 'm/d/y' )
                        );
                        ?>
                    </div>
                    <?php
                    if ( 'post' === get_post_type() ) {
                        hybrid_post_terms( [
                            'taxonomy' => 'category',
                        ] );
                    }
                    ?>
                </div>
            <?php endif; ?>
        </header><!-- .entry__header -->

        <?php
        if ( ! $whitepaper ) {
            do_action( 'magid_social_shares', 'top' );
        }
        ?>

        <div class="entry__content">
            <?php the_content(); ?>
        </div><!-- .entry__content -->

        <?php
        if ( ! $whitepaper ) {
            do_action( 'magid_social_shares', 'bottom' );
        } else {
            // output our whitepaper form if set
            echo '<div class="entry__whitepaper">';
            gravity_form( $whitepaper_form_id, false, false, false, false, true );
            echo '</div>';
        }
        ?>

        <?php if ( isset( $blog_query->posts[0] ) ) : ?>
            <div class="post__view-all">
                <a class="btn btn--primary" href="<?php echo esc_url( get_permalink( $blog_query->posts[0] ) ); ?>">
                    <?php _e( 'View All Posts', 'magid' ); ?>
                </a>
            </div>
        <?php endif; ?>

    </article><!-- #post-## -->

<?php
if ( ! $whitepaper ) {
    // get author profile template if set
    do_action( 'magid_author_profile', get_the_ID() );
}
