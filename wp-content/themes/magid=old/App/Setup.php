<?php

namespace Magid\App;

use Magid\App\Interfaces\WordPressHooks;
use Magid\App\ACF;

/**
 * Class Setup
 *
 * @package Magid\App
 */
class Setup implements WordPressHooks {

    /**
     * Add class hooks.
     */
    public function addHooks() {
        add_action( 'init', [ $this, 'registerMenus' ] );
        add_action( 'widgets_init', [ $this, 'registerSidebars' ], 5 );
        add_action( 'admin_menu', [ $this, 'hideAdminMenuItems' ], 5 );
        add_action( 'login_enqueue_scripts', [ $this, 'loginLogo' ] );
        add_action( 'login_headerurl', [ $this, 'loginLogoUrl' ] );
    }

    /**
     * Registers nav menu locations.
     */
    public function registerMenus() {
        register_nav_menu( 'primary', __( 'Primary', 'magid' ) );
        register_nav_menu( 'footer', __( 'Footer', 'magid' ) );
    }

    /**
     * Registers sidebars.
     */
    public function registerSidebars() {
        register_sidebar( [
            'id'          => 'primary',
            'name'        => __( 'Sidebar', 'magid' ),
            'description' => __( 'Main sidebar area displayed on right side of page via trigger.', 'magid' ),
        ] );
    }

    /**
     * Remove top level and sub level menu items
     */
    public function hideAdminMenuItems() {
        remove_menu_page( 'edit-comments.php' ); // Comments
        remove_submenu_page( 'themes.php', 'widgets.php' );
        remove_submenu_page( 'themes.php', 'customize.php' );
    }

    /**
     * Replace default WordPress logo on login page with site options logo if set
     */
    public function loginLogo() {
        $options   = ( new ACF() )->getACFOptions();
        $site_logo = ! empty( $options['site_logo'] ) ? wp_get_attachment_image_src( $options['site_logo'] ) : null;
        if ( ! $site_logo ) {
            return;
        }
        ?>
        <style type="text/css">
            #login h1 a, .login h1 a {
                background: url(<?php echo esc_url( $site_logo[0] ); ?>) no-repeat center center;
                background-size: auto 100%;
                height: 100px;
                width: 320px;
                outline: none;
                box-shadow: none;
            }

            #login h1 a:focus, .login h1 a:focus {
                outline: none;
                box-shadow: none;
            }
        </style>
        <?php
    }

    /**
     * Allow login logo to link to site url
     *
     * @return string
     */
    public function loginLogoUrl() {
        return home_url('/');
    }
}