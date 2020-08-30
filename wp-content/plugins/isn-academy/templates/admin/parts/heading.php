<?php
namespace Inc\Quiz;

$post = isset( $post ) && is_object( $post ) ? $post : null;
$title = empty( $post ) ? '- New -' : $post->post_title;

if( ! empty( $post ) ) :
?>
    <button type="button" class="handlediv button-link" aria-expanded="<?php echo wp_doing_ajax() ? 'true' : 'false' ?>">
        <span class="screen-reader-text">Toggle panel: Content: <?php echo esc_html( $title ) ?></span><span class="toggle-indicator" aria-hidden="true"></span>
    </button>
    <h2 class="hndle">
        <span><?php echo $title ?>
            <?php if( ! empty( $post ) && $post->post_status !== 'publish' ) : ?>&nbsp;&nbsp;<sup><?php echo $post->post_status ?></sup><?php endif; ?>
        </span>
        <button type="button" class="button danger" title="delete" data-id="<?php echo ! empty( $post ) ? $post->ID : 0 ?>">&times;</button>
        <span class="as-display-action">- default -()</span>
    </h2>

<?php endif; ?>
