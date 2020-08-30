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

        add_action( 'add_meta_boxes', [ $this, 'addUploadContent' ] );
        add_action( 'admin_print_scripts', [ $this, 'adminScripts' ] );
        add_action( 'save_post', [ $this, 'saveMediaMeta' ], 1, 2 );
    }

    
    public function addUploadContent() : void
    {
        add_meta_box('academy_content',
            'Media Upload',
            [ $this, 'isnMediaUpload' ],
            'course',
            'normal',
            'default'
        );
    }

    public function saveMediaMeta( $postID, $post )
    {
        if ( $_POST && !wp_verify_nonce( $_POST['course_media'], plugin_basename( __FILE__ ) ) ) {
            return $post->ID;
        }
        if ( !current_user_can( 'edit_post', $post->ID ) ) {
            return $post->ID;
        }

        if (isset($_POST['isn_media_file'])) {
            $media_meta['isn_media_file'] = $_POST['isn_media_file'];

            foreach( $media_meta as $key => $value ) {
                if( $post->post_type === 'revision' ) {
                    return;
                }
                $value = implode( ',', (array) $value );
                if( get_post_meta( $post->ID, $key, false ) ) {
                    update_post_meta( $post-> ID, $key, $value );
                } else {
                    add_post_meta( $post->ID, $key, $value );
                }
                if (!$value) {
                    delete_post_meta($post -> ID, $key);
                }
            }
        }
    }

    public function adminScripts()
    {
        wp_enqueue_script( 'media-upload' );
        wp_enqueue_script( 'thickbox' );
        wp_enqueue_style( 'thickbox' );
    }


    public function isnMediaUpload()
    {
        global $post, $wpdb;
        echo '<input type="hidden" name="course_media" id="course_media" value="'.
            wp_create_nonce( plugin_basename( __FILE__ ) ).
            '" />';
        $strFile = get_post_meta( $post -> ID, $key = 'isn_media_file', true );
        $media_file = get_post_meta( $post -> ID, $key = '_wp_attached_file', true );

        if (!empty($media_file)) {
            $strFile = $media_file;
        } ?>
        <script>
            var file_frame;
            jQuery('#upload_image_button').live('click', function( media ) {
                media.preventDefault();
                if (file_frame) {
                    file_frame.open();
                    return;
                }
                file_frame = wp.media.frames.file_frame = wp.media({
                    title: jQuery(this).data('uploader_title'),
                    button: {
                        text: jQuery(this).data('uploader_button_text'),
                    },
                    multiple: false // Set to true to allow multiple files to be selected
                });
                file_frame.on('select', function(){
                    attachment = file_frame.state().get('selection').first().toJSON();
                    var url = attachment.url;
                    var field = document.getElementById("isn_media_file");
                    field.value = url;
                })
            })
        </script>
        <div>
            <table>
                <tr>
                    <td>
                        <input value = "<?php echo $strFile; ?>" type ="text" name="isn_media_file" id="isn_media_file" size = "70" />
                        <input id = "upload_image_button" type = "button"  value = "Upload">
                    </td>
                </tr>
            </table>
            <input type = "hidden" name= "img_txt_id"  id= "img_txt_id"  value= "" />
        </div>
    <?php
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


    public function show_youtube_video_ID()
    {
        global $post;
        $meta = get_post_meta( $post->ID, 'youtube_fields', true );
        $args = [
            'post_type' => 'assessment',
            'post_parent' => 0,
            'post_status' => 'publish',
        ];
        $assessment = new \WP_Query( $args );
    ?>
            <input type="hidden" name="your_meta_box_nonce" value="<?php echo wp_create_nonce( basename(__FILE__) ); ?>">

            <p>
                <label for="your_fields[text]">Youtube Video ID</label>
                <br>
                <input type="text" name="youtube_fields[text]" id="youtube_fields[text]" class="regular-text" value="<?php if (is_array($meta) && isset($meta['text'])) {	echo $meta['text']; } ?>"  rows="1" cols="100" >
            </p>
            <p>
                <label for="your_fields[type]">Course Type</label>
                <br>
                <select name="youtube_fields[type]" id="youtube_fields[type]">
                    <option value="">Select an option</option>
                    <option <?=  ( $meta && isset($meta['type']) === 'video' ) ? 'selected' : ''?> value="video">Video</option>
                    <option <?=  ( $meta && isset($meta['type']) === 'pdf' ) ? 'selected' : ''?> value="pdf">PDF</option>
                    <option <?=  ( $meta && isset($meta['type']) === 'pptx' ) ? 'selected' : ''?> value="pptx">PPTX</option>
                </select>
            </p>

            <?php if( $post->post_parent === 0 )  { ?>
                <p>
                    <label for="youtube_fields[assessment]">Assessment</label>
                    <br>
                    <select name="youtube_fields[assessment]" id="youtube_fields[assessment]">
                        <option value="">Select an option</option>
                        <?php while ( $assessment->have_posts() ) : $assessment->the_post(); ?>
                            <?php $assessmentId = ($meta && isset($meta['assessment'] ) ? $meta['assessment'] : '' ) ?>
                        <option <?=  ( (int) $assessmentId === get_the_ID() ) ? 'selected' : ''?>
                                value="<?php echo get_the_ID() ?>"><?php the_title(); ?>
                        </option>
                        <?php endwhile; ?>
                    </select>
                </p>
            <?php } ?>
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
                    <option <?=  ( $meta && isset($meta['certificate']) === '1' ) ? 'selected' : ''?> value="1">Yes</option>
                    <option <?=  ( $meta && isset($meta['certificate']) === '0' ) ? 'selected' : ''?> value="0">No</option>
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

