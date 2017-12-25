<?php

namespace Magid\App\Http;

use Magid\App\Interfaces\WordPressHooks;

use Magid\App\Posts\PostAttributes;
use Magid\App\Posts\PostContent;
use Magid\App\ACF;

/**
 * Class PostsController\Http
 *
 * @package Magid\App
 */
class PostsController implements WordPressHooks {

    /**
     * Add class hooks.
     */
    public function addHooks() {
        add_action( 'rest_api_init', [ $this, 'postResponseFields' ] );
    }

    /**
     * Add the fields to REST API responses for posts read and write
     */
    public function postResponseFields() {
        register_rest_field( 'post',
            'title_small',
            [
                'get_callback' => [ $this, 'getTitleLimitFieldValue' ],
                'schema'       => null,
            ]
        );
        register_rest_field( 'post',
            'mention',
            [
                'get_callback' => [ $this, 'getMentionDataValues' ],
                'schema'       => null,
            ]
        );
        register_rest_field( 'post',
            'thumbnail',
            [
                'get_callback' => [ $this, 'getImgSrcFieldValue' ],
                'schema'       => null,
            ]
        );
		
	register_rest_field( 'post',
        'color',
      [
            'get_callback'    => [ $this, 'getColordFieldValue' ],
            'schema'          => null,
			]
        );
   
	
	
	register_rest_field( 'post',
        'cposition',
        [
            'get_callback'    => [ $this, 'getPositiondFieldValue' ],
            'schema'          => null,
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
    public function getTitleLimitFieldValue( $object, $field_name, $request ) {
        $title = get_the_title( $object['id'] );
        return ( new PostContent() )->limitStringLength( $title, 30 );
    }
	 public function getColordFieldValue( $object, $field_name, $request ) {
        //$colord  = get_post_meta($object['id'], 'color',  false );
        $colord = get_field( 'color', $post->ID );
		/*if( !empty($colord ) && is_array($colord ) ){
			echo $left_img['url'];
		}*/
		if (filter_var($colord, FILTER_VALIDATE_URL) === FALSE)
     {
      $imgurlser = wp_get_attachment_url($imgurl);
     }
        return $imgurlser;
    }
	 public function getPositiondFieldValue( $object, $field_name, $request ) {
        //$layoutd  = get_post_meta($object['id'], 'cposition',  false );
		 $layoutd = get_field( 'cposition', $post->ID  );
		if (filter_var($layoutd, FILTER_VALIDATE_URL) === FALSE)
     {
      $imgurlsersss = wp_get_attachment_url($imgurl);
     }
        return $imgurlsersss;
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
    public function getMentionDataValues( $object, $field_name, $request ) {
        $title = get_the_title( $object['id'] );
        $meta  = get_post_meta( $object['id'] );

        $data = [
            'title'   => ( new PostContent() )->limitStringLength( $title, 30 ),
            'author'  => ( new PostAttributes() )->getPostAuthor( $object['id'], $object['author'] ),
            'date'    => get_the_date( 'm/d/y', $object['id'] ),
            'terms'   => hybrid_get_post_terms( [
                'taxonomy' => 'category',
            ] ),
            'excerpt' => ( new PostContent() )->getMentionsExcerpt( $object['id'], true ),
        ];

        // check for external option
        if ( isset( $meta['external_resource'][0] ) && ! empty( $meta['external_resource'][0] ) ) {
            // build out the external object
            $data['external'] = [
                'url'     => isset( $meta['external_url'][0] ) && ! empty( $meta['external_url'][0] ) ? $meta['external_url'][0] : '',
                'excerpt' => isset( $meta['external_excerpt'][0] ) && ! empty( $meta['external_excerpt'][0] ) ? $meta['external_excerpt'][0] : '',
            ];
        }

        return $data;
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
    public function getImgSrcFieldValue( $object, $field_name, $request ) {
        $options  = ( new ACF() )->getACFOptions();
        $thumb_id = get_post_thumbnail_id( $object['id'] ) ?: $options['default_image'];
        $thumb_sm = wp_get_attachment_image_src( $thumb_id, 'mention-sm' );
        $thumb_md = wp_get_attachment_image_src( $thumb_id, 'mention-md' );

        return [
            'sm' => $thumb_sm[0],
            'md' => $thumb_md[0]
        ];
    }
}