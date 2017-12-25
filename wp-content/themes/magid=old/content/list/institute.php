<?php
/**
 * @package Magid
 */

$institute_meta = get_post_meta( get_the_ID() );
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

    <div class="section">
        <h2 class="hdg hdg--5 hdg--orange">
            <?php the_title(); ?>
        </h2>

        <div class="institute__meta">
            <?php
            if ( isset( $institute_meta['date'][0] ) ) {
                echo '<p>' . $institute_meta['date'][0] . '</p>';
            }
            if ( isset( $institute_meta['location'][0] ) ) {
                echo '<p>' . $institute_meta['location'][0] . '</p>';
            }
            ?>
        </div>
    </div>

    <?php if ( $institute_meta['description'][0] ) : ?>
        <div class="section entry__content section__institute-description">
            <?php echo wpautop( $institute_meta['description'][0] ); ?>
        </div>
    <?php endif; ?>

    <?php if ( $institute_meta['sign_up_url'][0] ) : ?>
        <div class="btn__container">
            <a class="btn btn--primary" href="<?php echo esc_url( $institute_meta['sign_up_url'][0] ); ?>">
                <?php
                echo ! empty( $institute_meta['sign_up_button_text'][0] ) ? $institute_meta['sign_up_button_text'][0] : __( 'Sign Up Now', 'magid' );
                ?>
            </a>
        </div>
    <?php endif; ?>

</article><!-- #post-## -->