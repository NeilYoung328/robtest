<?php

namespace Magid\App\Http;

use Magid\App\Interfaces\WordPressHooks;

use Magid\App\ACF;

/**
 * Class InstituteController\Http
 *
 * @package Magid\App
 */
class InstituteController implements WordPressHooks {

    /**
     * Add class hooks.
     */
    public function addHooks() {
        add_action( 'rest_api_init', [ $this, 'instituteResponseFields' ] );
    }

    /**
     * Add the fields to REST API responses for posts read and write
     */
    public function instituteResponseFields() {
        register_rest_field( 'institute',
            'institute_date',
            [
                'get_callback' => [ $this, 'getDateFieldValue' ],
                'schema'       => null,
            ]
        );
        register_rest_field( 'institute',
            'institute_location',
            [
                'get_callback' => [ $this, 'getLocationFieldValue' ],
                'schema'       => null,
            ]
        );
        register_rest_field( 'institute',
            'description',
            [
                'get_callback' => [ $this, 'getDescriptionFieldValue' ],
                'schema'       => null,
            ]
        );
        register_rest_field( 'institute',
            'sign_up',
            [
                'get_callback' => [ $this, 'getSignUpFieldValue' ],
                'schema'       => null,
            ]
        );
        register_rest_field( 'institute',
            'sign_up_text',
            [
                'get_callback' => [ $this, 'getSignUpButtonFieldValue' ],
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
    public function getDateFieldValue( $object, $field_name, $request ) {
        return get_field( 'date', $object['id'] );
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
        return get_field( 'location', $object['id'] );
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
    public function getDescriptionFieldValue( $object, $field_name, $request ) {
        return get_field( 'description', $object['id'] );
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
    public function getSignUpFieldValue( $object, $field_name, $request ) {
        return get_field( 'sign_up_url', $object['id'] );
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
    public function getSignUpButtonFieldValue( $object, $field_name, $request ) {
        return get_field( 'sign_up_button_text', $object['id'] );
    }
}