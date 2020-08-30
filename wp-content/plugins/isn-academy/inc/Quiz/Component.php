<?php

namespace Inc\Quiz;

/**
 * @author  Opeyemi Ibrahim
 */
class Component
{
    /**
     * Supported post types
     *
     * @var array
     */
    public static $supported_post_types = [ 'page' ];

    public function init() : void
    {
        $this->registerCallbacks();
        if( is_admin() ) {
            ( new Template() )->init();

            wp_doing_ajax()
                ? ''
                : ( new Admin() )->init();
        }
    }

    private function registerCallbacks() : void
    {
        add_action( 'init', [ $this, 'actionInit' ], 0 );

        if( ! is_admin() || wp_doing_ajax() ) {
            add_action( 'pre_get_posts', [ $this, 'actionPreGetPosts' ] );
        }

        add_filter( 'post_type_link', [ $this, 'filterPostTypeLink' ], 10, 2 );
    }

    public function actionInit() : void
    {
        $this->registerPostTypes();
    }

    private function registerPostTypes() : void
    {
        register_post_type( PostType::ASSESSMENT, PostType::getArgs( PostType::ASSESSMENT ) );
    }

    /**
     * Modify the global query if we're trying to (pre)view a single Assessment post..
     *
     * @param \WP_Query $wp_query The WP_Query instance (passed by reference).
     *
     * @return void
     */
    public function actionPreGetPosts( \WP_Query $wp_query ) : void
    {
        global $wpdb;
        if( function_exists( 'wp_get_current_user' )
            && isset( $wp_query->query['post_type'] )
            && $wp_query->query['post_type'] === PostType::ASSESSMENT
            && is_super_admin()
            && $wp_query->is_main_query()
        ) {
            $parentID = (int) $wpdb->get_var(
                $wpdb->prepare(
                    "SELECT post_parent FROM " . $wpdb->posts . " WHERE post_type = %s AND post_name = %s LIMIT 1",
                    PostType::ASSESSMENT,
                    $wp_query->query['name']
                )
            );
        }

        if( $parentID ) {
            // Modify query to reflect post_parent query.
            $wp_query->parse_query( [ 'p' => $parentID, 'post_type' => 'any' ] );
        }
    }

    /**
     * Fix Content permalink by returning post_parent permalink
     *
     * @param string   $permalink
     * @param \WP_Post $post
     *
     * @return string
     */
    public function filterPostTypeLink( string $permalink, ?\WP_Post $post ) : string
    {
        if( $post && $post->post_type === PostType::ASSESSMENT && $post->post_parent ) {
            $permalink = get_permalink( $post->post_parent );
        }

        return $permalink;
    }

    /**
    * Register script helper
     *
    */
    public static function registerScripts( ?array $scripts, string $baseUrl = '', bool $enqueue = false ) : void
    {
        if( empty( $scripts ) ) {
            return;
        }

        foreach( $scripts as $script ) {
            if( $enqueue && $script['handle'] === 'enqueue_media' ) {
                continue;
            }

            $defaults = [
                'handle' => false,
                'src' => false,
                'dependencies' => [],
                'version' => false,
                'in_footer' => false,
            ];

            $args = wp_parse_args( $script, $defaults );

            if( ! empty( $args['src'] ) ) {
                if( ! empty( $baseUrl ) ) {
                    $args['src'] = $baseUrl . $args['src'];
                }

                wp_register_script(
                    $args['handle'],
                    $args['src'],
                    $args['dependencies'],
                    $args['version'],
                    $args['in_footer']
                );
            }

            if( $enqueue ) {
                wp_enqueue_script( $args['handle'] );
            }
        }
    }


    /**
     * Register styles helper
     *
     * @param array|null $styles
     * @param string     $base_url
     * @param bool       $enqueue
     */
    public static function registerStyles( ?array $styles, string $base_url = '', bool $enqueue = false ) : void
    {
        if( empty( $styles ) ) {
            return;
        }

        foreach( $styles as $args ) {
            $defaults = [
                'handle' => false,
                'src' => false,
                'dependencies' => [],
                'version' => false,
                'media' => 'all',
            ];

            $args = wp_parse_args( $args, $defaults );

            // register styles when src is present
            if( ! empty( $args['src'] ) ) {

                if( ! empty( $base_url ) ) {
                    $args['src'] = $base_url . $args['src'];
                }

                wp_register_style(
                    $args['handle'],
                    $args['src'],
                    $args['dependencies'],
                    $args['version'],
                    $args['media']
                );
            }

            if( $enqueue ) {
                wp_enqueue_style( $args['handle'] );
            }
        }
    }
}