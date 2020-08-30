<?php
namespace Inc\Quiz;

use WP_Post;

class Quiz
{
    /**
     * @var array
     */
    private $questions = [];
    private $messages = [];
    private $errors = [];
    private $results = [];

    public function setProperties() : void
    {

    }

    public static function get( string $param, $post )
    {
        $result = false;

        $post = $post instanceof WP_Post ? $post : get_post( $post );
        if( empty( $post ) ) {
            return $result;
        }
        $result = $post->$param ?? get_post_meta( $post->ID, 'as_' . $param, true );

        return apply_filters( 'isn_as_type_get', $result, $param, $post );
    }
}