<?php

namespace Magid\App\Posts;

/**
 * Class PostContent
 *
 * @package Magid\App\Posts
 */
class PostContent {

    /**
     * Add class hooks.
     *
     * @param null $post
     * @param bool $return
     *
     * @return mixed|string
     */
    public function getMentionsExcerpt( $post = null, $return = false ) {
        add_filter( 'excerpt_length', [ $this, 'mentionsExcerptLength' ] );
        add_filter( 'excerpt_more', [ $this, 'mentionsExcerptMore' ] );

        if ( $return ) {
            return $this->wpExcerpt( $post, $return );
        }

        $this->wpExcerpt( $post, $return );
    }

    public function mentionsExcerptLength() {
        return 25;
    }

    public function mentionsExcerptMore() {
        return '&hellip;';
    }

    /**
     * @param null $post
     * @param bool $return
     *
     * @return mixed|string
     */
    public function wpExcerpt( $post = null, $return = false ) {
        $output = get_the_excerpt( $post );
        $output = apply_filters( 'wptexturize', $output );
        $output = apply_filters( 'convert_chars', $output );
        $output = '<p>' . $output . '</p>';

        if ( $return ) {
            return $output;
        }

        echo $output;
    }

    public function getMentionsTitle( $layout ) {
        $title = get_the_title();
        if ( 'top' === $layout ) {
            $title = $this->limitStringLength( $title, 50 );
        }else if('none' === $layout ){
            $title = $this->limitStringLength( $title, 50 );
        }

        echo $title;
    }
    public function getBlogTitle( $layout) {
        $title = get_the_title();
        if ( 'left' === $layout ) {
            $title = $this->limitStringLength( $title, 45 );
        }else if('none' === $layout ){
            $title = $this->limitStringLength( $title, 45 );
        }else if ( 'top' === $layout ) {
             $title = $this->limitStringLength( $title, 47 );
        }

        echo $title;
    }

     public function getBlogContent( $layout) {
        $title = get_the_excerpt();
        if ( 'top' === $layout ) {
             $title = '';
        }else if('left' === $layout ){
            $title = $this->limitStringLengthBlog( $title, 150 );
        }else if( 'none' === $layout ){
            $title = $this->limitStringLengthBlog( $title, 150 );
        }

        echo $title;
    }

    public function limitStringLength( $text, $maxchar, $end = '...' ) {
        if ( strlen( $text ) > $maxchar || $text == '' ) {
            $words  = preg_split( '/\s/', $text );
            $output = '';
            $i      = 0;
            while ( 1 ) {
                $length = strlen( $output ) + strlen( $words[ $i ] );
                if ( $length > $maxchar ) {
                    break;
                } else {
                    $output .= " " . $words[ $i ];
                    ++ $i;
                }
            }
            $output .= $end;
        } else {
            $output = $text;
        }

        return $output;
    }
    public function limitStringLengthBlog( $text, $maxchar, $end = '...' ) {
        if ( strlen( $text ) > $maxchar || $text == '' ) {
            $words  = preg_split( '/\s/', $text );
            $output = '';
            $i      = 0;
            while ( 1 ) {
                $length = strlen( $output ) + strlen( $words[ $i ] );
                if ( $length > $maxchar ) {
                    break;
                } else {
                    $output .= " " . $words[ $i ];
                    ++ $i;
                }
            }
            $output .= $end;
        } else {
            $output = $text;
        }

        return $output;
    }
}