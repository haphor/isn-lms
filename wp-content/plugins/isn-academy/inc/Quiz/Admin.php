<?php
namespace Inc\Quiz;

use Inc\Base\BaseController;

/**
 * Class Admin
 *
 * @author Opeyemi Ibrahim
 */
class Admin extends BaseController
{
    /**
     * @var array
     */
    private $scripts = [
        [
            'handle' => 'as-core',
            'src' => 'core.js',
        ],
    ];

    /**
     * @var array
     */
    private $styles = [
        [
            'handle' => 'as-core',
            'src' => 'core.css',
        ],
    ];

    /**
     * Admin init.
     */
    public function init() : void
    {
        $this->registerCallbacks();
    }

    /**
     * Registers hooks
     */
    private function registerCallbacks() : void
    {
        add_action( 'current_screen', [ $this, 'actionCurrentScreen' ] );
        add_action( 'add_meta_boxes', [ $this, 'actionAddMetaBoxes' ] );
        add_filter( 'wp_insert_post_data', [ $this, 'filterWpInsertPostData' ], 10, 2 );
        add_filter( 'manage_' . PostType::ASSESSMENT . '_posts_columns', [ $this, 'filterManageColumnPost' ] );
    }

    /**
     * Determines if admin scripts & styles need to be loaded
     *
     * @param \WP_Screen $current_screen
     */
    public function actionCurrentScreen( \WP_Screen $current_screen ) : void
    {
        // Bail early?
        if( ! isset( $current_screen->post_type )
            || ( $current_screen->post_type !== PostType::ASSESSMENT
                && ( ! in_array( $current_screen->post_type, Component::$supported_post_types, true ) && $current_screen->action !== 'add' )
            )
        ) {
            return;
        }

        Component::registerScripts(
            apply_filters( 'isn_as_scripts', $this->scripts, $current_screen ),
            $this->plugin_url . 'assets/admin/scripts/',
            true
        );

        Component::registerStyles(
            apply_filters( 'isn_as_scripts', $this->styles, $current_screen ),
            $this->plugin_url . 'assets/admin/styles/',
            true
        );

        do_action( 'as_admin_init_current_screen' );
    }

    public function actionAddMetaBoxes() : void
    {
        $post_types = Component::$supported_post_types;

        foreach( $post_types as $post_type ) {
            add_meta_box(
                'asblock',
                __( 'Assessment content', 'isn' ),
                [ $this, 'renderMetaBoxContent' ],
                $post_type,
                'normal'
            );
        }

        add_meta_box(
            'asblock',
            __( 'Assessment Content', 'isn' ),
            [ $this, 'renderMetaBoxAsContent' ],
            PostType::ASSESSMENT,
            'normal'
        );
    }

    public function renderMetaBoxContent() : void
    {
        global $current_screen;
        if( $current_screen->action === 'add' ) {
            include $this->template_path . '/admin/add.php';
            return;
        }

        include $this->template_path . '/admin/header.php';
        include $this->template_path . '/admin/footer.php';
    }

    /**
     * Renders Round & pledges admin meta boxes
     *
     * @param \WP_Post
     * @param array $callback_args
     */
    public function renderMetaBoxAsContent( $post, $callback_args ) : void
    {
        include $this->template_path . '/admin/meta_box.php';
    }


    public function filterWpInsertPostData( array $data, array $postarr ) : array
    {
        if( wp_doing_ajax()
            || ! isset( $_POST['post_type'] )
            || $_POST['post_type'] !== PostType::ASSESSMENT
            || isset( $data['meta_input'] )
            || empty( $postarr['ID'] )
        ) {
            return $data;
        }

        $parsed = self::parse_update_args();
        if( ! empty( $parsed['meta_input'] ) ) {
            foreach( $parsed['meta_input'] as $field => $value ) {
                update_post_meta( $postarr['ID'], $field, $value );
            }
        }

        unset( $parsed['meta_input'] );
        return array_merge( $data, $parsed );
    }

    public static function parseUpdateArgs() : array
    {
        $args = [
            'ID' => (int) ( $_REQUEST['ID'] ?? $_REQUEST['id'] ),
            'meta_input' => [],
        ];
        if( $args['ID'] === 0 ) {
            return [];
        }
        $post_fields = [
            'post_content', 'post_title',
            'ID', 'post_parent', 'post_excerpt',
            'post_status', 'menu_order',
            'post_type'
        ];

        $prefix = 'as_' . $_REQUEST['ID'] . '_';

        foreach( $_REQUEST as $key => $value ) {
            if( strpos( $key, $prefix ) !== false ) {
                $key = str_replace( $prefix, '', $key );

                if( in_array( $key, $post_fields, true ) ) {

                    // Post field.
                    $args[ $key ] = $value;
                } elseif( $key === 'meta_input' ) {
                    $value = (array) $value;
                    // Is meta.
                    foreach( $value as $valueKey => $valueVal ) {
                        $args['meta_input'][ $valueKey ] = $valueVal;
                    }
                } else {
                    $args['meta_input'][ 'as_' . $key ] = $value;
                }
            }
        }

        return $args;
    }

    public function filterManageColumnPost( $columns ) : array
    {
        $retval = [];
        foreach( $columns as $key => $value ) {
            $retval[ $key ] = $value;
            if( $key === 'title' ) {
                $retval['content_type'] = __( 'Type', 'isn' );
            }
        }

        return $retval;
    }
}