<?php

namespace Magid\App\Http;

use Magid\App\Interfaces\WordPressHooks;

use Magid\App\ACF;

/**
 * Class CareerController\Http
 *
 * @package Magid\App
 */
class CareerController implements WordPressHooks {

    /**
     * Add class hooks.
     */
    public function addHooks() {
        add_action( 'rest_api_init', [ $this, 'careerResponseFields' ] );
    }

    /**
     * Add the fields to REST API responses for posts read and write
     */
    public function careerResponseFields() {
        register_rest_field( 'career',
            'location',
            [
                'get_callback' => [ $this, 'getLocationFieldValue' ],
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
    public function getLocationFieldValue( $object, $field_name, $request ) {
        return get_field( 'office_location', $object['id'] );
    }
}