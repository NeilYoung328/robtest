<?php

namespace Magid\App;

use Magid\App\Interfaces\WordPressHooks;
use Magid\App\ACF;

/**
 * Class Forms
 *
 * @package Magid\App
 */
class Forms implements WordPressHooks {

    /**
     * Add class hooks.
     */
    public function addHooks() {
        add_filter( 'gform_pre_render', [ $this, 'populateInstitutesDropdown' ] );
        add_filter( 'gform_confirmation', [ $this, 'redirectWhitepaperForm' ], 10, 4 );
    }

    /**
     * Populate institutes dropdown field with dynamic posts list
     *
     * @param $form
     *
     * @return mixed
     */
    public function populateInstitutesDropdown( $form ) {

        // loop through fields and check for institutes dropdown
        foreach ( $form['fields'] as $field ) {
            if ( $field->label === 'Select An Institute' ) {
                // Get institutes posts
                $posts = get_posts( [
                    'post_type'      => 'institute',
                    'posts_per_page' => 50,
                    'orderby'        => 'title',
                    'order'          => 'ASC'
                ] );

                //Creating item array.
                $items = [];

                //Adding post titles to the items array
                foreach ( $posts as $post ) {
                    $items[] = [ 'value' => $post->post_title, 'text' => $post->post_title ];
                }

                $field->choices = $items;
            }
        }

        return $form;
    }

    /**
     * Filter form confirmation to redirect to the set whitepaper url on post
     *
     * @param $confirmation
     * @param $form
     * @param $entry
     * @param $ajax
     *
     * @return array
     */
    public function redirectWhitepaperForm( $confirmation, $form, $entry, $ajax ) {
        global $post;

        // get site options
        $options            = ( new ACF() )->getACFOptions();
        $whitepaper_form_id = isset( $options['whitepaper_form_id'][0] ) ? $options['whitepaper_form_id'][0] : false;
        $whitepaper_url     = get_field( 'whitepaper_download_url', $post->ID );

        if ( $form['id'] == $whitepaper_form_id && $whitepaper_url ) {
            $confirmation = [
                'redirect' => $whitepaper_url
            ];
        }

        return $confirmation;
    }
}