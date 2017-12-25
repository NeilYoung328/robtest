<?php

namespace Magid\App\Http;

use Magid\App\Interfaces\WordPressHooks;

use Magid\App\ACF;

/**
 * Class CourseController\Http
 *
 * @package Magid\App
 */
class CourseController implements WordPressHooks {

    /**
     * Add class hooks.
     */
    public function addHooks() {
        add_action( 'rest_api_init', [ $this, 'courseResponseFields' ] );
    }

    /**
     * Add the fields to REST API responses for posts read and write
     */
    public function courseResponseFields() {
        register_rest_field( 'course',
            'level',
            [
                'get_callback' => [ $this, 'getLevelFieldValue' ],
                'schema'       => null,
            ]
        );
        register_rest_field( 'course',
            'tracks',
            [
                'get_callback' => [ $this, 'getTracksFieldValue' ],
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
    public function getLevelFieldValue( $object, $field_name, $request ) {
        return get_field( 'level', $object['id'] );
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
    public function getTracksFieldValue( $object, $field_name, $request ) {
        return get_field( 'track', $object['id'] );
    }
}