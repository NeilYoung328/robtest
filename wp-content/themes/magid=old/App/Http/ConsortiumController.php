<?php

namespace Magid\App\Http;

use Magid\App\Interfaces\WordPressHooks;

use Magid\App\ACF;

/**
 * Class ConsortiumController\Http
 *
 * @package Magid\App
 */
class ConsortiumController implements WordPressHooks {

    /**
     * Add class hooks.
     */
    public function addHooks() {
        add_action( 'rest_api_init', [ $this, 'consortiumResponseFields' ] );
    }

    /**
     * Add the fields to REST API responses for posts read and write
     */
    public function consortiumResponseFields() {
        register_rest_field( 'consortium',
            'excerpt',
            [
                'get_callback' => [ $this, 'getExcerptFieldValue' ],
                'schema'       => null,
            ]
        );
    }

    /**
     * Handler for getting custom field data.
     *
     * @param array $object The object from the response
     * @param string $field_name Name of field
     * @param \WP_REST_Request $request Current request
     *
     * @return mixed
     */
    public function getExcerptFieldValue( $object, $field_name, $request ) {
        return get_field( 'post_excerpt', $object['id'] );
    }
}