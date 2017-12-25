<?php
/**
 * @package Magid
 */

use Magid\App\Posts\PostContent;
use Magid\App\Posts\PostAttributes;
use Magid\App\ACF;

$options    = ( new ACF() )->getACFOptions();
$layout     = isset( $mention['image_layout'] ) ? $mention['image_layout'] : 'none';
$meta_color = isset( $mention['meta_color'] ) ? $mention['meta_color'] : '#4A4A4A';
$thumb_id   = get_post_thumbnail_id( get_the_ID() ) ?: $options['default_image'];

// check for external link settings
$meta             = get_post_meta( $post->ID );
$external         = isset( $meta['external_resource'][0] ) && $meta['external_resource'][0] ? $meta['external_resource'][0] : false;
$external_url     = isset( $meta['external_url'][0] ) && ! empty( $meta['external_url'][0] ) ? $meta['external_url'][0] : false;
$external_excerpt = isset( $meta['external_excerpt'][0] ) && ! empty( $meta['external_excerpt'][0] ) ? $meta['external_excerpt'][0] : false;
$post_url         = $external && $external_url ? $external_url : get_permalink();
$target           = $external && $external_url ? 'target="_blank"' : '';
?>


<?php if ( 'none' !== $layout ) : ?>
    <div class="entry__thumb">
        <a rel="bookmark" href="<?php echo esc_url( $post_url ); ?>" <?php echo $target; ?>>
            <?php $thumb = wp_get_attachment_image_src( $thumb_id, 'mention-sm' ); ?>
            <img data-src="<?php echo esc_url( $thumb[0] ); ?>" alt="<?php the_title(); ?>" itemprop="image"
                 height="<?php echo $thumb[2]; ?>" width="<?php echo $thumb[1]; ?>">
        </a>
    </div>
<?php endif; ?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

    <div class="entry__meta">
        <div class="meta__date" style="color:<?php echo $meta_color; ?>;">
            <?php
            printf(
                __( '<span class="meta__author">By %s</span>', 'magid' ),
                esc_html( ( new PostAttributes() )->getPostAuthor( $post->ID, $post->post_author ) )
            );
            echo get_the_date( 'm/d/y' );
            ?>
        </div>
        <?php
        if ( 'post' === get_post_type() ) {
            hybrid_post_terms( [
                'taxonomy' => 'category',
            ] );
        }
        if ( 'career' === get_post_type() ) {
            _e( 'Career', 'magid' );
        }
        ?>
    </div>

    <header class="entry__header">
        <h2 class="hdg hdg--3 hdg--medium">
            <a rel="bookmark" href="<?php echo esc_url( $post_url ); ?>" <?php echo $target; ?>>
                <?php ( new PostContent() )->getMentionsTitle( $layout ); ?>
            </a>
        </h2>
    </header><!-- .entry__header -->

    <?php if ( 'none' === $layout ) : ?>
        <div class="entry__excerpt">
            <?php
            if ( $external && $external_excerpt ) {
                echo wpautop( $external_excerpt );
            } else {
                ( new PostContent() )->getMentionsExcerpt();
            }
            ?>
        </div><!-- .entry__content -->
    <?php endif; ?>

    <a class="entry_read-more" href="<?php echo esc_url( $post_url ); ?>"
       style="color:<?php echo $meta_color; ?>;" <?php echo $target; ?>>
        <svg class="icon icon-arrow" style="fill: <?php echo $meta_color; ?>;">
            <use xlink:href="#icon-arrow"></use>
        </svg>
        <?php _e( 'Read More', 'magid' ); ?>
    </a>

</article><!-- #post-## -->