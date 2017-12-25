<?php
/**
 * @package Magid
 */

$tracks = get_field( 'track' );
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'list__post--course' ); ?>>

    <div class="section">
        <h2 class="hdg hdg--5 hdg--orange">
            <?php _e( 'Suite:', 'magid' ); ?>
        </h2>
        <?php the_title( '<p>', '</p>' ); ?>
    </div>

    <?php if ( $level = get_field( 'level' ) ) : ?>
        <div class="section">
            <h2 class="hdg hdg--5 hdg--orange">
                <?php _e( 'Level:', 'magid' ); ?>
            </h2>
            <p><?php echo esc_html( $level ); ?></p>
        </div>
    <?php endif; ?>

    <div class="section">
        <h2 class="hdg hdg--5 hdg--orange">
            <?php _e( 'Course:', 'magid' ); ?>
        </h2>
        <p><?php printf( __( '%s Courses:', 'magid' ), count( $tracks ) ); ?></p>
        <ul>
            <?php
            foreach ( $tracks as $track ) {
                echo '<li>' . $track['course'] . '</li>';
            }
            ?>
        </ul>
    </div>

</article><!-- #post-## -->