<?php
namespace Inc\Quiz;

class PostType
{
    public const ASSESSMENT = 'assessment';

    private static $args;

    /**
     * Loads WP Post Type arguments.
     */
    private static function setArgs() : void
    {
        self::$args = [
            self::ASSESSMENT => [
                'labels' => [
                    'name' => _x( 'Assessment', 'post type general name', 'isn' ),
                    'singular_name' => _x( 'Assessment post', 'post type singular name', 'isn' ),
                    'menu_name' => _x( 'Assessment', 'admin menu', 'isn' ),
                    'name_admin_bar' => _x( 'Assessment post', 'add new on admin bar', 'isn' ),
                    'add_new' => _x( 'Add new', 'Add a new post object', 'isn' ),
                    'add_new_item' => __( 'Add new', 'isn' ),
                    'new_item' => __( 'New post', 'isn' ),
                    'edit_item' => __( 'Edit', 'isn' ),
                    'view_item' => __( 'View', 'isn' ),
                    'all_items' => __( 'All items', 'isn' ),
                    'search_items' => __( 'Search', 'isn' ),
                    'parent_item_colon' => __( 'Parent assessment:', 'isn' ),
                    'not_found' => __( 'No assessment posts found.', 'isn' ),
                    'not_found_in_trash' => __( 'No assessment posts found in trash.', 'isn' ),
                ],
                'description' => __( 'Assessment', 'isn' ),
                //'capability_type' => self::ASSESSMENT,
                'menu_icon' => 'dashicons-schedule',
                'supports' => [
                    'title',
                    'editor',
                    'page-attributes',
                    'revisions',
                    'thumbnail',
                ],
                'hierarchical' => true,
                'rewrite' => false,
                'has_archive' => false,
                'public' => true,
            ]
        ];
    }

    /**
     * @param string $postType
     *
     * @return array|null
     */
    public static function getArgs( string $postType = '' )
    {
        if( ! isset( self::$args ) ) {
            self::setArgs();
        }

        return self::$args[ $postType ] ?? null;
    }
}