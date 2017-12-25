<?php

namespace Magid\App\Http;

use Magid\App\Interfaces\WordPressHooks;

use Magid\App\ACF;

/**
 * Class MemberController\Http
 *
 * @package Magid\App
 */
class MemberController implements WordPressHooks {

    /**
     * Add class hooks.
     */
    public function addHooks() {
        add_action( 'rest_api_init', [ $this, 'memberResponseFields' ] );
        add_action( 'rest_member_query', [ $this, 'orderMembersResponsePosts' ] );
    }

    /**
     * Order rest member query by last name
     *
     * @param $args
     *
     * @return mixed
     */
    public function orderMembersResponsePosts( $args ) {
        $args['orderby']  = 'meta_value';
        $args['meta_key'] = 'last_name';
        $args['order']    = 'ASC';

        if ( isset( $_GET['ignore_custom_sort'] ) ) {
            $args['ignore_custom_sort'] = true;
        }

        return $args;
    }

    /**
     * Add the fields to REST API responses for posts read and write
     */
    public function memberResponseFields() {
        register_rest_field( 'member',
            'position',
            [
                'get_callback' => [ $this, 'getMemberFieldValue' ],
                'schema'       => null,
            ]
        );
        register_rest_field( 'member',
            'linkedin_url',
            [
                'get_callback' => [ $this, 'getMemberFieldValue' ],
                'schema'       => null,
            ]
        );
        register_rest_field( 'member',
            '_thumbnail_id',
            [
                'get_callback' => [ $this, 'getMemberFeaturedImage' ],
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
    public function getMemberFieldValue( $object, $field_name, $request ) {
        return get_post_meta( $object['id'], $field_name, true );
    }


    /**
     * Grab the member featured image ID and return the src attribute
     *
     * @param array $object The object from the response
     * @param string $field_name Name of field
     * @param \WP_REST_Request $request Current request
     *
     * @return mixed
     */
    public function getMemberFeaturedImage( $object, $field_name, $request ) {
        $post_id = $object['id'];
        if ( ! has_post_thumbnail( $post_id ) ) {
            $options = ( new ACF() )->getACFOptions();
            $avatar  = ! empty( $options['default_avatar'] ) ? wp_get_attachment_image_src( $options['default_avatar'] ) : null;

            return esc_url( $avatar[0] );
        }

        $thumb_id  = get_post_meta( $post_id, $field_name, true );
        $thumb_url = wp_get_attachment_image_src( $thumb_id, 'featured-member', true );

        return $thumb_url[0];
    }
}