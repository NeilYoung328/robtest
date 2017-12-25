<?php

namespace Magid\App;

use Magid\App\Interfaces\WordPressHooks;

/**
 * Class Media
 *
 * @package Magid\App
 */
class Media implements WordPressHooks {

    public function __construct() {
        $this->addImageSizes();
    }

    /**
     * Add class hooks.
     */
    public function addHooks() {
        add_filter( 'upload_mimes', [ $this, 'mimeTypes' ] );
        add_filter( 'wp_check_filetype_and_ext', [ $this, 'checkFiletype' ], 10, 4 );
        add_action( 'admin_head', [ $this, 'svgFix' ] );
        add_action( 'wp_head', [ $this, 'siteFavicons' ] );
    }

    /**
     * Register new image sizes
     *
     * Use this method to register additional image sizes in the theme
     *
     * @since 1.0.1
     */
    public function addImageSizes() {
        add_image_size( 'featured-member', 320, 320, true );
        add_image_size( 'mention-sm', 480, 240, true );
        add_image_size( 'mention-md', 460, 560, true );
        add_image_size( 'featured-sm', 800, 9999 ); // 800 pixels wide (and unlimited height)
        add_image_size( 'featured-xl', 1440, 9999 ); // 1440 pixels wide (and unlimited height)
    }

    public function siteFavicons() {
        $assets_dir = MAGID_THEME_PATH_URL . '/assets/images/favicon/';
        ?>
        <link rel="shortcut icon" href="<?php echo $assets_dir; ?>favicon.ico" type="image/x-icon"/>
        <link rel="apple-touch-icon" sizes="57x57" href="<?php echo $assets_dir; ?>apple-touch-icon-57x57.png">
        <link rel="apple-touch-icon" sizes="60x60" href="<?php echo $assets_dir; ?>apple-touch-icon-60x60.png">
        <link rel="apple-touch-icon" sizes="72x72" href="<?php echo $assets_dir; ?>apple-touch-icon-72x72.png">
        <link rel="apple-touch-icon" sizes="76x76" href="<?php echo $assets_dir; ?>apple-touch-icon-76x76.png">
        <link rel="apple-touch-icon" sizes="114x114" href="<?php echo $assets_dir; ?>apple-touch-icon-114x114.png">
        <link rel="apple-touch-icon" sizes="120x120" href="<?php echo $assets_dir; ?>apple-touch-icon-120x120.png">
        <link rel="apple-touch-icon" sizes="144x144" href="<?php echo $assets_dir; ?>apple-touch-icon-144x144.png">
        <link rel="apple-touch-icon" sizes="152x152" href="<?php echo $assets_dir; ?>apple-touch-icon-152x152.png">
        <link rel="apple-touch-icon" sizes="180x180" href="<?php echo $assets_dir; ?>apple-touch-icon-180x180.png">
        <link rel="icon" type="image/png" href="<?php echo $assets_dir; ?>favicon-16x16.png" sizes="16x16">
        <link rel="icon" type="image/png" href="<?php echo $assets_dir; ?>favicon-32x32.png" sizes="32x32">
        <link rel="icon" type="image/png" href="<?php echo $assets_dir; ?>favicon-96x96.png" sizes="96x96">
        <link rel="icon" type="image/png" href="<?php echo $assets_dir; ?>android-chrome-192x192.png" sizes="192x192">
        <?php
    }

    /**
     * @param $data
     * @param $file
     * @param $filename
     * @param $mimes
     *
     * @return array
     */
    public function checkFiletype( $data, $file, $filename, $mimes ) {
        global $wp_version;
        if ( $wp_version !== '4.7.2' ) {
            return $data;
        }

        $filetype = wp_check_filetype( $filename, $mimes );

        return [
            'ext'             => $filetype['ext'],
            'type'            => $filetype['type'],
            'proper_filename' => $data['proper_filename']
        ];
    }

    /**
     * @param $mimes
     *
     * @return mixed
     */
    public function mimeTypes( $mimes ) {
        $mimes['svg'] = 'image/svg+xml';

        return $mimes;
    }

    /**
     *
     */
    public function svgFix() {
        echo '<style type="text/css">
        .attachment-266x266, .thumbnail img {
             width: 100% !important;
             height: auto !important;
        }
        </style>';
    }
}