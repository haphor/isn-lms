<?php 
/**
 * @package  ISN Learning
 */
namespace Inc\Base;


use \Inc\Base\BaseController;


/**
* 
*/

class CustomFieldController extends BaseController
{
    

    public function register() {
        /* Hook meta box to just the 'place' post type. */

        add_action( 'add_meta_boxes', array( $this, 'add_youtube_video_ID') );

        add_action( 'save_post', array( $this, 'save_youtube_video_ID' ) );

    }

    

    public function add_youtube_video_ID() {
        add_meta_box(
                'youtube_video_ID', // $id
                'Youtube Video ID', // $title
                array( $this, 'show_youtube_video_ID'), // $callback
                'course', // $screen
                'normal', // $context
                'high' // $priority
            );
    }


    public function show_youtube_video_ID() {
        global $post;  
        
            $meta = get_post_meta( $post->ID, 'youtube_fields', true ); ?>
            <input type="hidden" name="your_meta_box_nonce" value="<?php echo wp_create_nonce( basename(__FILE__) ); ?>">

            <p>
                <label for="your_fields[text]">Youtube Video ID</label>
                <br>
                <input type="text" name="youtube_fields[text]" id="youtube_fields[text]" class="regular-text" value="<?php if (is_array($meta) && isset($meta['text'])) {	echo $meta['text']; } ?>"  rows="1" cols="100" >
            </p>
            <p>
                <label for="youtube_fields[textarea]">Youtube Video Description</label>
                <br>
                <textarea name="youtube_fields[textarea]" id="youtube_fields[textarea]" rows="10" cols="100" style="width:500px;"><?php if (is_array($meta) && isset($meta['textarea'])) {	echo $meta['textarea']; } ?></textarea>
            </p>

            <p>
                <label for="youtube_fields[length]">Video Length</label>
                <br>
                <input type="text" name="youtube_fields[length]" id="youtube_fields[length]" class="regular-text" value="<?php if (is_array($meta) && isset($meta['length'])) {	echo $meta['length']; } ?>"  >
            </p>

            <p>
                <label for="youtube_fields[certificate]">Certificate</label>
                <br>
                <select name="youtube_fields[certificate]" id="">
                    <option value="">Select an option</option>
                    <option <?=  ( $meta['certificate'] === '1' ) ? 'selected' : ''?> value="1">Yes</option>
                    <option <?=  ( $meta['certificate'] === '0' ) ? 'selected' : ''?> value="0">No</option>
                </select>
            </p>

        <?php 
    }
    public function save_youtube_video_ID( $post_id ) {   
        // verify nonce
        if ( isset($_POST['youtube_meta_box_nonce']) 
                && !wp_verify_nonce( $_POST['youtube_meta_box_nonce'], basename(__FILE__) ) ) {
                return $post_id; 
            }
        // check autosave
        if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
            return $post_id;
        }
        // check permissions
        if (isset($_POST['post_type'])) { //Fix 2
            if ( 'page' === $_POST['post_type'] ) {
                if ( !current_user_can( 'edit_page', $post_id ) ) {
                    return $post_id;
                } elseif ( !current_user_can( 'edit_post', $post_id ) ) {
                    return $post_id;
                }  
            }
        }
        
        $old = get_post_meta( $post_id, 'youtube_fields', true );
            if (isset($_POST['youtube_fields'])) { //Fix 3
                $new = $_POST['youtube_fields'];
                if ( $new && $new !== $old ) {
                    update_post_meta( $post_id, 'youtube_fields', $new );
                } elseif ( '' === $new && $old ) {
                    delete_post_meta( $post_id, 'youtube_fields', $old );
                }
            }
    }

}

