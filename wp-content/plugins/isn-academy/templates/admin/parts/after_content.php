<?php
namespace Inc\Quiz;
/**
 * @var \WP_Post $post
 */
$post = isset( $post ) && is_object( $post ) ? $post : null;
?>
<div class="as_action_buttons">
    <button class="button as_publish" type="button" data-action="publish"><?php echo $post->post_status === 'publish' ? __( 'Update', 'isn' ) : __( 'Publish', 'isn' ) ?></button>
    <button class="button as_save_draft" type="button" data-action="draft"><?php echo $post->post_status === 'draft' ? __( 'Save', 'isn' ) : __( 'Save as Draft', 'isn' ) ?></button>
    <button class="button danger" type="button" data-action="delete"><?php _e( 'Delete', 'isn' ) ?></button>
</div>
