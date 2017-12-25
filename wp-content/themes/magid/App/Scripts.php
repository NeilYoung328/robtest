<?php

namespace Magid\App;

use Magid\App\Interfaces\WordPressHooks;
use Magid\App\Posts\PostAttributes;
use Magid\App\ACF;

/**
 * Class Scripts
 *
 * @package Magid\App
 */
class Scripts implements WordPressHooks {

    /**
     * Add class hooks.
     */
    public function addHooks() {
        add_action( 'wp_enqueue_scripts', [ $this, 'enqueueScripts' ] );
        add_action( 'wp_enqueue_scripts', [ $this, 'enqueueStyles' ] );
        add_action( 'wp_default_scripts', [ $this, 'dequeuejQueryMigrate' ] );
        add_action( 'wp_head', [ $this, 'enqueueTypeKitScript' ] );
    }

    /**
     * Load scripts for the front end.
     */
    public function enqueueScripts() {
        wp_enqueue_script(
            'magid-vendors',
            get_stylesheet_directory_uri() . '/build/js/vendor.min.js',
            [ 'jquery' ],
            THEME_VERSION,
            true
        );

        wp_enqueue_script(
            'magid-theme',
            get_stylesheet_directory_uri() . '/build/js/theme.min.js',
            [ 'magid-vendors' ],
            THEME_VERSION,
            true
        );

        // add Sharethis script if ID is set in the options panel
        if ( is_singular( 'post' ) ) {
            $options      = ( new ACF() )->getACFOptions();
            $sharethis_id = isset( $options['sharethis_id'] ) ? $options['sharethis_id'] : null;
            if ( $sharethis_id ) {
                wp_enqueue_script(
                    'magid-sharethis',
                    '//platform-api.sharethis.com/js/sharethis.js#property=' . $sharethis_id . '&product=custom-share-buttons',
                    false,
                    THEME_VERSION,
                    true
                );
            }
        }

        wp_localize_script( 'magid-theme', 'wpApiSettings', [
            'root'       => esc_url_raw( rest_url() ),
            'theme_path' => MAGID_THEME_PATH_URL,
            'nonce'      => wp_create_nonce( 'wp_rest' )
        ] );

        wp_localize_script( 'magid-theme', 'magidPostParams', PostAttributes::getBlogPostParams() );
    }

    /**
     * Load stylesheets for the front end.
     */
    public function enqueueStyles() {
        wp_enqueue_style(
            'magid',
            get_stylesheet_directory_uri() . '/build/css/style.min.css',
            [],
            THEME_VERSION
        );
    }

    /**
     * Removes the migrate script from the list of jQuery dependencies
     *
     * @param $scripts
     */
    public function dequeuejQueryMigrate( $scripts ) {
        if ( ! is_admin() && ! empty( $scripts->registered['jquery'] ) ) {
            $jquery_dependencies                 = $scripts->registered['jquery']->deps;
            $scripts->registered['jquery']->deps = array_diff( $jquery_dependencies, [ 'jquery-migrate' ] );
        }
    }

    /**
     * Load Typekit advanced embed into the wp_head()
     */
    public function enqueueTypeKitScript() {
        ?>
        <!-- TypeKit -->
        <script>
            (function (d) {
                var config = {
                        kitId: 'dbv5nrm',
                        scriptTimeout: 3000,
                        async: true
                    },
                    h = d.documentElement, t = setTimeout(function () {
                        h.className = h.className.replace(/\bwf-loading\b/g, "") + " wf-inactive";
                    }, config.scriptTimeout), tk = d.createElement("script"), f = false,
                    s = d.getElementsByTagName("script")[0], a;
                h.className += " wf-loading";
                tk.src = 'https://use.typekit.net/' + config.kitId + '.js';
                tk.async = true;
                tk.onload = tk.onreadystatechange = function () {
                    a = this.readyState;
                    if (f || a && a != "complete" && a != "loaded")return;
                    f = true;
                    clearTimeout(t);
                    try {
                        Typekit.load(config)
                    } catch (e) {
                    }
                };
                s.parentNode.insertBefore(tk, s)
            })(document);
        </script>
        <?php
    }
}