<?php

namespace Magid\App\Posts;

use Magid\App\Interfaces\WordPressHooks;

/**
 * Class PostTypes
 *
 * @package Magid\App\Posts
 */
class PostTypes implements WordPressHooks {

    protected $args = [];

    public function __construct() {
        // set default args
        $this->args = [
            'supports'            => [ 'title', 'thumbnail' ],
            'public'              => false,
            'show_ui'             => true,
            'show_in_menu'        => true,
            'show_in_nav_menus'   => false,
            'publicly_queryable'  => false,
            'exclude_from_search' => true,
            'has_archive'         => false,
            'query_var'           => true,
            'can_export'          => true,
            'menu_position'       => 25,
            'capability_type'     => 'post'
        ];
    }

    /**
     * Add class hooks.
     */
    public function addHooks() {
        add_action( 'init', [ $this, 'registerMembers' ] );
        add_action( 'init', [ $this, 'registerCareers' ] );
        add_action( 'init', [ $this, 'registerCourses' ] );
        add_action( 'init', [ $this, 'registerInstitutes' ] );
        add_action( 'init', [ $this, 'registerConsortiums' ] );
        add_action( 'init', [ $this, 'registerAuthors' ] );
    }

    /*
     * Register Members
     */
    public function registerMembers() {
        $labels = [
            'name'               => __( 'Members', 'magid' ),
            'singular_name'      => __( 'Member', 'magid' ),
            'add_new'            => __( 'Add Member', 'magid' ),
            'add_new_item'       => __( 'Add New Member', 'magid' ),
            'edit_item'          => __( 'Edit Member', 'magid' ),
            'new_item'           => __( 'New Member', 'magid' ),
            'view_item'          => __( 'View Members', 'magid' ),
            'search_items'       => __( 'Search Members', 'magid' ),
            'not_found'          => __( 'No items found', 'magid' ),
            'not_found_in_trash' => __( 'No items found in Trash', 'magid' ),
            'menu_name'          => __( 'Members', 'magid' ),
        ];

        $args                 = $this->args;
        $args['labels']       = $labels;
        $args['show_in_rest'] = true;
        $args['rest_base']    = 'members';
        $args['menu_icon']    = 'dashicons-groups';

        register_post_type( 'member', $args );
    }

    /*
     * Register Careers
     */
    public function registerCareers() {
        $labels = [
            'name'               => __( 'Careers', 'magid' ),
            'singular_name'      => __( 'Career', 'magid' ),
            'add_new'            => __( 'Add Career', 'magid' ),
            'add_new_item'       => __( 'Add New Career', 'magid' ),
            'edit_item'          => __( 'Edit Career', 'magid' ),
            'new_item'           => __( 'New Career', 'magid' ),
            'view_item'          => __( 'View Careers', 'magid' ),
            'search_items'       => __( 'Search Careers', 'magid' ),
            'not_found'          => __( 'No items found', 'magid' ),
            'not_found_in_trash' => __( 'No items found in Trash', 'magid' ),
            'menu_name'          => __( 'Careers', 'magid' ),
        ];

        $args                       = $this->args;
        $args['labels']             = $labels;
        $args['public']             = true;
        $args['publicly_queryable'] = true;
        $args['has_archive']        = true;
        $args['show_in_rest']       = true;
        $args['rest_base']          = 'careers';
        $args['supports']           = [ 'title', 'editor' ];
        $args['menu_icon']          = 'dashicons-info';

        register_post_type( 'career', $args );
    }

    /*
     * Register Courses
     */
    public function registerCourses() {
        $labels = [
            'name'               => __( 'Courses', 'magid' ),
            'singular_name'      => __( 'Course', 'magid' ),
            'add_new'            => __( 'Add Course', 'magid' ),
            'add_new_item'       => __( 'Add New Course', 'magid' ),
            'edit_item'          => __( 'Edit Course', 'magid' ),
            'new_item'           => __( 'New Course', 'magid' ),
            'view_item'          => __( 'View Courses', 'magid' ),
            'search_items'       => __( 'Search Courses', 'magid' ),
            'not_found'          => __( 'No items found', 'magid' ),
            'not_found_in_trash' => __( 'No items found in Trash', 'magid' ),
            'menu_name'          => __( 'Courses', 'magid' ),
        ];

        $args                       = $this->args;
        $args['labels']             = $labels;
        $args['public']             = false;
        $args['publicly_queryable'] = false;
        $args['has_archive']        = false;
        $args['show_in_rest']       = true;
        $args['rest_base']          = 'courses';
        $args['supports']           = [ 'title' ];
        $args['menu_icon']          = 'dashicons-edit';

        register_post_type( 'course', $args );
    }

    /*
     * Register Institutes
     */
    public function registerInstitutes() {
        $labels = [
            'name'               => __( 'Institutes', 'magid' ),
            'singular_name'      => __( 'Institute', 'magid' ),
            'add_new'            => __( 'Add Institute', 'magid' ),
            'add_new_item'       => __( 'Add New Institute', 'magid' ),
            'edit_item'          => __( 'Edit Institute', 'magid' ),
            'new_item'           => __( 'New Institute', 'magid' ),
            'view_item'          => __( 'View Institutes', 'magid' ),
            'search_items'       => __( 'Search Institutes', 'magid' ),
            'not_found'          => __( 'No items found', 'magid' ),
            'not_found_in_trash' => __( 'No items found in Trash', 'magid' ),
            'menu_name'          => __( 'Institutes', 'magid' ),
        ];

        $args                       = $this->args;
        $args['labels']             = $labels;
        $args['public']             = false;
        $args['publicly_queryable'] = false;
        $args['has_archive']        = false;
        $args['show_in_rest']       = true;
        $args['rest_base']          = 'institutes';
        $args['supports']           = [ 'title' ];
        $args['menu_icon']          = 'dashicons-admin-multisite';

        register_post_type( 'institute', $args );
    }

    /*
     * Register Consortiums
     */
    public function registerConsortiums() {
        $labels = [
            'name'               => __( 'Consortiums', 'magid' ),
            'singular_name'      => __( 'Consortium', 'magid' ),
            'add_new'            => __( 'Add Consortium', 'magid' ),
            'add_new_item'       => __( 'Add New Consortium', 'magid' ),
            'edit_item'          => __( 'Edit Consortium', 'magid' ),
            'new_item'           => __( 'New Consortium', 'magid' ),
            'view_item'          => __( 'View Consortiums', 'magid' ),
            'search_items'       => __( 'Search Consortiums', 'magid' ),
            'not_found'          => __( 'No items found', 'magid' ),
            'not_found_in_trash' => __( 'No items found in Trash', 'magid' ),
            'menu_name'          => __( 'Consortiums', 'magid' ),
        ];

        $args                       = $this->args;
        $args['labels']             = $labels;
        $args['public']             = true;
        $args['publicly_queryable'] = true;
        $args['has_archive']        = false;
        $args['show_in_rest']       = true;
        $args['rest_base']          = 'consortiums';
        $args['supports']           = [ 'title', 'editor' ];
        $args['menu_icon']          = 'dashicons-image-filter';

        register_post_type( 'consortium', $args );
    }

    /*
     * Register Authors
     */
    public function registerAuthors() {
        $labels = [
            'name'               => __( 'Authors', 'magid' ),
            'singular_name'      => __( 'Author', 'magid' ),
            'add_new'            => __( 'Add Author', 'magid' ),
            'add_new_item'       => __( 'Add New Author', 'magid' ),
            'edit_item'          => __( 'Edit Author', 'magid' ),
            'new_item'           => __( 'New Author', 'magid' ),
            'view_item'          => __( 'View Authors', 'magid' ),
            'search_items'       => __( 'Search Authors', 'magid' ),
            'not_found'          => __( 'No items found', 'magid' ),
            'not_found_in_trash' => __( 'No items found in Trash', 'magid' ),
            'menu_name'          => __( 'Authors', 'magid' ),
        ];

        $args                       = $this->args;
        $args['labels']             = $labels;
        $args['public']             = true;
        $args['publicly_queryable'] = true;
        $args['has_archive']        = false;
        $args['menu_position']      = 65;
        $args['supports']           = [ 'title', 'thumbnail' ];
        $args['menu_icon']          = 'dashicons-nametag';

        register_post_type( 'author', $args );
    }
}