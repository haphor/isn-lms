<?php
global $current_screen;

use Inc\Quiz\PostType;

$post = $post ?? get_post();
$_id = ! empty( $post ) ? $post->ID : time();


if( $current_screen->post_type === PostType::ASSESSMENT ) : ?>
    <style>#postdivrich { display: none; } </style>
<?php endif; ?>

<div id="as_<?php echo $_id ?>" class="postbox <?php echo wp_doing_ajax() || $current_screen->post_type === PostType::ASSESSMENT ? '' : 'closed' ?>" data-id="<?php echo $_id ?>">
    <?php do_action( 'as_admin_heading', $post, $_id ); ?>

    <div class="tabs">
        <div class="inside">
            <?php do_action( 'as_admin_before_content', $post, $_id ); ?>

            <div id="ec<?php echo $_id ?>-content" class="ec-textdiv">
                <ul id="as_text-<?php echo $_id ?>-tabs" class="as_text-tabs content-tabs">

                </ul>
                <div id="as_-<?php echo $_id ?>" class="tabs-panel">
                    <?php do_action( 'as_admin_type_content', $post, $_id ); ?>
                </div>

                <?php do_action( 'as_admin_after_content', $post, $_id ); ?>
            </div>
        </div>
    </div>
</div>