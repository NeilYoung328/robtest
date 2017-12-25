<?php

namespace Magid\App\Posts;

use Magid\App\Interfaces\WordPressHooks;
use Magid\App\Core\Transients;
use Magid\App\ACF;

/**
 * Class ModuleAttributes
 *
 * @package Magid\App\Posts
 */
class PostAttributes implements WordPressHooks {

    public function addHooks() {
        add_action( 'magid_blog_modules', [ $this, 'getBlogModules' ] );
        add_action( 'magid_social_shares', [ $this, 'getSinglePostShares' ] );
        add_action( 'magid_author_profile', [ $this, 'showPostAuthorProfile' ] );
        add_action( 'template_redirect', [ $this, 'categoryRedirectFilter' ] );
    }

    /**
     * Redirect visits to category archives to the blog template with term query set
     */
    public function categoryRedirectFilter() {
        if ( is_category() ) {
            $cat = get_query_var( 'cat' );
            $url = site_url( '/magid-mentions/?term=' . $cat );

            wp_safe_redirect( $url, 301 );

            exit;
        }

        if ( is_search() ) {
            $search = get_query_var( 's' );
            $url    = site_url( '/magid-mentions/?search=' . $search );

            wp_safe_redirect( $url, 301 );

            exit;
        }

        return;
    }

    /**
     * Set the post patterns for color and layout parameters
     */
    public static function getBlogPostParams() {
        return [
            [
                'bg'     => '#4a4a4a',
                'meta'   => '#e87722',
                'layout' => 'top'
            ],
            [
                'bg'     => '#e87722',
                'meta'   => '#4a4a4a',
                'layout' => 'left'
            ],
            [
                'bg'     => '#21aeef',
                'meta'   => '#4a4a4a',
                'layout' => 'left'
            ],
            [
                'bg'     => '#97d700',
                'meta'   => '#4a4a4a',
                'layout' => 'none'
            ],
            [
                'bg'     => '#e87722',
                'meta'   => '#4a4a4a',
                'layout' => 'none'
            ],
            [
                'bg'     => '#e2468f',
                'meta'   => '#4a4a4a',
                'layout' => 'none'
            ],
            [
                'bg'     => '#4a4a4a',
                'meta'   => '#e87722',
                'layout' => 'top'
            ]
        ];
    }

    /**
     * Custom WP_Query to get blog template post object
     *
     * @param bool $id
     *
     * @return \WP_Query
     */
    public function blogModuleQuery( $id = false ) {
        $args = [
            'post_type'      => 'page',
            'posts_per_page' => 1,
            'meta_key'       => '_wp_page_template',
            'meta_value'     => 'templates/template-blog.php'
        ];
        if ( $id ) {
            $args['fields'] = 'ids';
        }

        return new \WP_Query( $args );
    }

    /**
     * Grab blog modules on archive and single post pages
     */
    public function getBlogModules() {
        $transient_key = 'blog_template_modules';
        $output        = get_transient( $transient_key ) ?: false;

        if ( false === $output ) {
            global $wp_query;
            $wp_query = $this->blogModuleQuery();

            if ( $wp_query->have_posts() ) {
                ob_start();
                while ( $wp_query->have_posts() ) {
                    the_post();
                    get_template_part( 'components/append', 'modules' );
                }
                $output = ob_get_contents();
                ob_end_clean();
            }

            wp_reset_query();

            // cache our returned output in a transient to reduce page queries
            ( new Transients() )->registerTransients( $transient_key );
            set_transient( $transient_key, $output );
        }

        echo $output;
    }

    /**
     * print out social share options on single post pages
     *
     * @param string $position
     */
    public function getSinglePostShares( $position = 'bottom' ) {
        $socials = [ 'facebook', 'twitter', 'linkedin' ];

        ?>

        <div class="site__socials site__socials--<?php echo $position; ?>">
            <?php foreach ( $socials as $social ) : ?>
                <div class="site__social site__social--post site__social--<?php echo $social; ?> st-custom-button"
                     data-network="<?php echo $social; ?>">
                    <svg class="icon icon-<?php echo $social; ?>">
                        <use xlink:href="#icon-<?php echo $social; ?>"></use>
                    </svg>
                </div>
            <?php endforeach; ?>
        </div>
        <?php
    }

    /**
     * get and return the whitepaper url for this post
     *
     * @param $post_id
     *
     * @return bool
     */
    public function getPostWhitePaper( $post_id ) {
        $enabled = get_field( 'whitepaper', $post_id );
        if ( ! $enabled ) {
            return false;
        }

        return true;
    }

    /**
     * Check for featured author selected or return post author
     *
     * @param $post_id
     * @param $author_id
     *
     * @return string
     */
    public function getPostAuthor( $post_id, $author_id ) {
        $post_author     = get_the_author_meta( 'display_name', $author_id );
        $featured_author = get_field( 'featured_author', $post_id );

        return $featured_author ? get_the_title( $featured_author ) : $post_author;
    }

    /**
     * Get post author meta for featured author card
     *
     * @param $post_id
     *
     * @return bool
     */
    public function showPostAuthorProfile( $post_id ) {
        $featured_author = get_field( 'featured_author', $post_id );
        if ( ! $featured_author ) {
            return false;
        }

        $author_name    = get_the_title( $featured_author );
        $author_meta    = get_post_meta( $featured_author );
        $author_socials = [];
        if ( isset( $author_meta['linkedin_url'][0] ) && ! empty( $author_meta['linkedin_url'][0] ) ) {
            $author_socials['linkedin'] = esc_url( $author_meta['linkedin_url'][0] );
        }
        if ( isset( $author_meta['twitter_url'][0] ) && ! empty( $author_meta['twitter_url'][0] ) ) {
            $author_socials['twitter'] = esc_url( $author_meta['twitter_url'][0] );
        }
        ?>
        <div class="post__author author">
            <?php
            $options  = ( new ACF() )->getACFOptions();
            $thumb_id = get_post_thumbnail_id( $featured_author ) ?: $options['default_avatar'];
            $avatar   = wp_get_attachment_image_src( $thumb_id, 'featured-member' );
            ?>
            <div class="author__thumb">
                <img data-src="<?php echo $avatar[0]; ?>" alt="<?php echo $author_name; ?>"/>
            </div>
            <div class="author__content">
                <span class="author__name">
                    <?php echo $author_name; ?>
                </span>
                <?php if ( isset( $author_meta['email_address'][0] ) && ! empty( $author_meta['email_address'][0] ) ): ?>
                    <a class="author__email" href="mailto:<?php echo $author_meta['email_address'][0]; ?>"
                       target="_blank">
                        <?php echo $author_meta['email_address'][0]; ?>
                    </a>
                <?php endif; ?>
                <?php if ( ! empty( $author_socials ) ) : ?>
                    <div class="author__socials">
                        <?php foreach ( $author_socials as $label => $social ) : ?>
                            <a class="author__social author__social--<?php echo $label; ?>"
                               href="<?php echo esc_url( $social ); ?>" target="_blank">
                                <svg class="icon icon-<?php echo $label; ?>">
                                    <use xlink:href="#icon-<?php echo $label; ?>"></use>
                                </svg>
                            </a>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        <?php
    }
}