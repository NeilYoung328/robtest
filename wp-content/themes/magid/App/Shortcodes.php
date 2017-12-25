<?php

namespace Magid\App;

use Magid\App\Interfaces\WordPressHooks;

/**
 * Class Shortcodes
 *
 * @package Magid\App
 */
class Shortcodes implements WordPressHooks {

    /**
     * Add class hooks.
     */
    public function addHooks() {
        add_shortcode( 'button', [ $this, 'registerButtonShortcode' ] );
        add_shortcode( 'list', [ $this, 'registerListShortcode' ] );
    }

    /**
     * Register a button shortcode to output button markup in content editor
     *
     * @param $params
     *
     * @return string
     */
    public function registerButtonShortcode( $params ) {
        $params = shortcode_atts( [
            'href'   => '#',
            'text'   => __( 'Learn More', 'magid' ),
            'target' => null,
        ], $params, 'button' );

        $url    = esc_url( $params['href'] );
        $text   = esc_html( $params['text'] );
        $target = $params['target'] ? 'target="' . $params['target'] . '" rel="noopener"' : '';

        return "<div class='btn__container'><a class='btn btn--primary' href='{$url}' {$target}>{$text}</a></div>";
    }

    /**
     * Register a list shortcode to output ul markup in content editor
     *
     * @param $params
     *
     * @return string
     */
    public function registerListShortcode( $params ) {
        $params = shortcode_atts( [
            'columns' => 2,
            'items'   => ''
        ], $params, 'list' );
        $output = '';

        $items = explode( ',', $params['items'] );
        if ( empty( $items ) ) {
            return $output;
        }
        $count = ceil( count( $items ) / $params['columns'] );
        $lists = array_chunk( $items, $count );
        switch ( (int) $params['columns'] ) {
            case 1 :
                $class = 'col-sm-12';
                break;
            case 3 :
                $class = 'col-sm-4';
                break;
            default :
                $class = 'col-sm-6';
        }

        $output .= '<div class="entry__list">';
        foreach ( $lists as $list ) {
            $output .= '<ul class="' . $class . '">';

            foreach ( $list as $item ) {
                $output .= '<li>' . esc_html( $item ) . '</li>';
            }

            $output .= '</ul>';
        }
        $output .= '</div>';

        return $output;
    }
}