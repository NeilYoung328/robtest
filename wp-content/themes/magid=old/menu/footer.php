<?php
/**
 * The Primary Site navigation
 *
 * @package Magid
 */
if ( has_nav_menu( 'footer' ) ) : // Check if there's a menu assigned to the 'footer' location.
    ?>

    <nav <?php hybrid_attr( 'menu', 'footer' ); ?>>
        <?php
        wp_nav_menu( [
            'theme_location' => 'footer',
        ] );
        ?>
    </nav><!-- #menu-footer -->

<?php endif; // End check for menu. ?>