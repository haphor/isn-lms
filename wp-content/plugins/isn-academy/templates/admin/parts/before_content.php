<?php
namespace Inc\Quiz;

$post = isset( $post ) && is_object( $post ) ? $post : NULL;

if( !empty( $post ) ) : ?>
    <input type="hidden" name="ID" value="<?php echo $post->ID ?>"/>
    <input type="hidden" name="as_<?php echo $post->ID ?>_post_parent" value="<?php echo $post->post_parent ?>"/>
    <p>
        <label for="as_<?php echo $post->ID ?>_post_title">Title</label>
        <input type="text" class="widefat" name="as_<?php echo $post->ID ?>_post_title" size="30" value="<?php echo esc_attr( $post->post_title ) ?>" id="as_<?php echo $post->ID ?>_post_title" spellcheck="true" autocomplete="off" data-cip-id="title">
    </p>
<?php endif; ?>