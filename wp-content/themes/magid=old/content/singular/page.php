<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package Magid
 */

$tagline = get_field( 'tagline' );
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

    <header class="page__header">
        <?php
        the_title( '<h1 class="hdg hdg--1">', '</h1>' );
        echo $tagline ? '<h2 class="hdg hdg--4">' . $tagline . '</h2>' : '';
        ?>
    </header><!-- .entry__header -->

    <div class="entry__content page__content">
        <?php
        // if we're on a form template check for a gravity form ID
        if ( is_page_template( 'templates/template-form.php' ) ) {
            $form = get_field( 'form_id' );
            echo $form ? gravity_form( $form, false, false, false, false, false ) : '';
        } else {
            the_content();
        }
        ?>
    </div><!-- .entry__content -->

</article><!-- #post-## -->
