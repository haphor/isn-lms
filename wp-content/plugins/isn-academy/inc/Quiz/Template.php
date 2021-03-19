<?php
namespace Inc\Quiz;

use Inc\Base\BaseController;

class Template extends BaseController
{
    /**
     * Template init.
     */
    public function init() : void
    {
        $this->registerCallbacks();
    }

    /**
     * Register filter & action hooks
     */
    private function registerCallbacks() : void
    {
        $sub_template_actions = [
            'heading',
            'before_inside_content',
            'after_content',
        ];

        add_action( 'as_admin_before_content', [ $this, 'actionTemplateInclude' ] );

        foreach( $sub_template_actions as $hook ) {
            add_action( 'as_admin_' . $hook, [ $this, 'actionTemplateInclude' ], 10, 4 );
        }

        add_action( 'as_admin_type_content', [ $this, 'actionTypeContent' ], 10, 2 );
    }

    public function actionTemplateInclude( $post = null, string $type = '', array $tabs = [], $_id = null ) : void
    {
        $current_action = str_replace( 'as_admin_', '', current_action() );

        $path = $this->template_path . '/admin/parts/' . $current_action . '.php';

        $path = apply_filters( 'as_admin_template_include', $path, $_id );

        include $path;
    }

    public function actionTypeContent( $post = null, $_id = null ) : void
    {
        $path = apply_filters( 'isn_as_type_content_path', $this->template_path . '/quiz/admin.php', $post,  $_id );

        $path = apply_filters( 'as_admin_template_include', $path, $_id );

        include $path;
    }
}