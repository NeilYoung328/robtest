<?php
/**
 * @package Magid
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

    <div class="section job-title">
        <h2 class="hdg hdg--5 hdg--orange">
            <?php _e( 'Job Title', 'magid' ); ?>
        </h2>
        <?php the_title(); ?>
    </div>

    <div class="section office-location">
        <h2 class="hdg hdg--5 hdg--orange">
            <?php _e( 'Location', 'magid' ); ?>
        </h2>
        <?php the_field( 'office_location' ); ?>
    </div>

    <div class='btn__container'>
        <a class='btn btn--primary' href='<?php the_permalink(); ?>'>
            <?php _e( 'View Job Posting', 'magid' ); ?>
        </a>
    </div>

</article><!-- #post-## -->