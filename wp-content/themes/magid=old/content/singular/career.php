<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package Magid
 */

$location = get_field( 'office_location' );
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

    <header class="page__header">
        <?php
        the_title( '<h1 class="hdg hdg--1 hdg--orange">', '</h1>' );
        echo $location ? '<h2 class="hdg hdg--4">' . __( 'Office Location: ', 'magid' ) . $location . '</h2>' : '';
        ?>
    </header><!-- .entry__header -->

    <div class="entry__content page__content">
        <?php the_content(); ?>
    </div><!-- .entry__content -->

</article><!-- #post-## -->
