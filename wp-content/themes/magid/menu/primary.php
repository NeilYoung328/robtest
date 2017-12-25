<?php
/**
 * The Primary Site navigation
 *
 * @package Magid
 */
use Magid\App\ACF;

// get footer site options
$options   = ( new ACF() )->getACFOptions();
$menu_logo = ! empty( $options['menu_logo'] ) ? wp_get_attachment_image_src( $options['menu_logo'] ) : null;

if ( has_nav_menu( 'primary' ) ) : // Check if there's a menu assigned to the 'primary' location.
    ?>

    <div class="nav nav__tray">
        <nav <?php hybrid_attr( 'menu', 'primary' ); ?>>
            <?php
            wp_nav_menu( [
                'theme_location'  => 'primary',
                'container_class' => 'nav__menu'
            ] );
            ?>
        </nav><!-- #menu-primary -->

        <?php
        if ( $menu_logo ) {
            printf(
                __( '<a class="nav__logo hidden-xs" href="%1$s" title="%2$s"><img data-src="%4$s" class="%3$s" alt="%2$s" title="%2$s" /></a>', 'magid' ),
                esc_url( home_url( '/' ) ),
                get_bloginfo( 'name' ),
                'branding__logo',
                esc_url( $menu_logo[0] )
            );
        }

        // get site description
        if ( $description = get_bloginfo( 'description' ) ) {
            printf( __( '<div class="nav__tagline">%1$s</div>', 'magid' ), $description );
        }

        get_template_part( 'components/socials' ); // Loads the components/socials.php template.
        ?>
    </div>

    <div class="nav__utility">
        <div class="nav__toggle">
            <div class="hamburger hamburger--3dx">
                <div class="hamburger-box">
                    <div class="hamburger-inner"></div>
                    <svg class="icon icon-arrow">
                        <use xlink:href="#icon-arrow"></use>
                    </svg>
                </div>
                <span class="hamburger-label"><?php _e( 'Menu', 'magid' ); ?></span>
            </div>
        </div>

        <?php
        if ( $menu_logo ) {
            printf(
                __( '<a class="branding__mobile" href="%1$s" title="%2$s"><img src="%4$s" class="%3$s" alt="%2$s" title="%2$s" /></a>', 'magid' ),
                esc_url( home_url( '/' ) ),
                get_bloginfo( 'name' ),
                'branding__logo',
                esc_url( $menu_logo[0] )
            );
        }

        get_template_part( 'components/branding' ); // Loads the components/branding.php template.
        ?>
    </div>

<?php endif; // End check for menu. ?>