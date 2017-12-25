<?php
/**
 * @package Magid
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

    <div class="section">
        <h2 class="hdg hdg--5 hdg--orange">
            <?php the_title(); ?>
        </h2>
    </div>

    <?php if ( $excerpt = get_field( 'post_excerpt' ) ) : ?>
        <div class="section section--large">
            <?php echo $excerpt; ?>
        </div>
    <?php endif; ?>

    <div class='btn__container'>
        <a class='btn btn--primary' href='<?php the_permalink(); ?>'>
            <?php _e( 'View Now', 'magid' ); ?>
        </a>
    </div>

</article><!-- #post-## -->