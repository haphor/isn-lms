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

    public function init() : void
    {
        add_action( 'wp_ajax_as_add_child', [ $this, 'addChild' ] );
        add_action( 'wp_ajax_as_update', [ $this, 'updatePost' ] );
    }

    public function addChild() : void
    {
        $args = $_REQUEST;
        unset( $args[ 'action' ] );

        $args[ 'ID' ] = $this->insertPost( $args );

        if( is_wp_error( $args[ 'ID' ] ) ) {
            $this->ajaxResult( 400, 'Could not add new Assessment Content: ' . $args[ 'ID' ]->get_error_message() );
        }

        echo $args[ 'ID' ];
        exit;

    }
    
    public function updatePost()
    {
        $do = $_REQUEST[ 'do' ] ?? '';
        if( isset( $_REQUEST[ 'do' ] ) ) {
            unset( $_REQUEST[ 'do' ] );
        }

        $args = Admin::parseUpdateArgs();
        if( ! empty( $do ) ) {
            $args[ 'post_status' ] = $do;
        }
        $result = $do === 'delete' ? $this->delete( $args[ 'ID' ] ) : $this->update( $args );
        $post = get_post( $args[ 'ID' ] );
        if( ! empty( $post->post_parent ) ) {
            clean_post_cache( $post->post_parent );
        }

        if( wp_doing_ajax() ) {
            if( ! is_wp_error( $result ) ) {
                $message = '';
                if( isset( $_REQUEST[ 'successmsg' ] ) ) {
                    $message = '<section class="alert alert-success"><i class="fa fa-check"></i>'
                        . ( isset( $_REQUEST[ 'successtitle' ] ) ? '<h4>' . strip_tags( $_REQUEST[ 'successtitle' ] ) . '</h4>' : '' )
                        . strip_tags( $_REQUEST[ 'successmsg' ] )
                        . '</section>';
                }
                $this->ajaxResult( 200, apply_filters( 'as_update_ajax_result_html', $message ) );
            }
            $this->ajaxResult( 400, $result->get_error_message() );
        }

        return $result;
    }
    

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

    public function insertPost( array $args )
    {
        $defaults = [
            'ID' => 0,
            'post_content' => '',
            'post_parent' => 0,
            'tax_input' => [],
            'post_type' => PostType::ASSESSMENT,
        ];

        $args = wp_parse_args( $args, $defaults );
        if( empty( $args[ 'ID' ] ) ) {
            unset( $args[ 'ID' ] );
        }


        return wp_insert_post( $args );
    }

    private function delete( int $post_id, bool $force_delete = false )
    {
        return wp_delete_post( $post_id, $force_delete );
    }

    private function update( array $args )
    {
        $args = apply_filters( 'isn_as_before_update', $args );

        if( ! isset( $args[ 'ID' ] ) ) {
            return false;
        }

        return ! empty( $args )
            ? wp_update_post( $args, true )
            : 0;
    }


    private function ajaxResult( int $code, $message = null, $type = null )
    {
        if( ( $type ?? '' ) === 'json' ) {
            header( 'Content-Type: application/json' );
        }

        http_response_code( $code );
        if( ! empty( $message ) ) {
            echo $message;
        }
        exit();
    }


}