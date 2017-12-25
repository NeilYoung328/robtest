<?php

namespace Magid\App;

use Magid\App\Interfaces\WordPressHooks;

/**
 * Class Taxonomy
 *
 * @package Magid\App
 */
class Taxonomy implements WordPressHooks {

    protected $args = [];

    public function __construct() {
        // set default args
        $this->args = [
            'hierarchical'      => true,
            'show_ui'           => true,
            'show_admin_column' => true,
            'query_var'         => true,
            'show_in_rest'      => true
        ];
    }

    /**
     * Add class hooks.
     */
    public function addHooks() {
        add_action( 'init', [ $this, 'registerSkills' ] );
    }

    /*
     * Register Members
     */
    public function registerSkills() {
        $labels = [
            'name'              => __( 'Skills', 'magid' ),
            'singular_name'     => __( 'Skill', 'magid' ),
            'search_items'      => __( 'Search Skills', 'magid' ),
            'all_items'         => __( 'All Skills', 'magid' ),
            'parent_item'       => __( 'Parent Skill', 'magid' ),
            'parent_item_colon' => __( 'Parent Skill:', 'magid' ),
            'edit_item'         => __( 'Edit Skill', 'magid' ),
            'update_item'       => __( 'Update Skill', 'magid' ),
            'add_new_item'      => __( 'Add New Skill', 'magid' ),
            'new_item_name'     => __( 'New Skill Name', 'magid' ),
            'menu_name'         => __( 'Skills', 'magid' ),
        ];

        $args           = $this->args;
        $args['labels'] = $labels;
        
        $args['rewrite'] = array( 'slug' => 'our-experts' );

        register_taxonomy( 'skill', 'member', $args );
    }
}