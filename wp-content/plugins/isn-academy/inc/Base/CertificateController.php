<?php
/**
 * @package  ISN Learning
 */
namespace Inc\Base;


use \Inc\Base\BaseController;


/**
 *
 */

class CertificateController extends BaseController
{
    private $level;
    private $counter;


    public function register() {
        add_shortcode('course-navigation',  [ $this, 'gotoNextModule'] );
        add_shortcode('progress-bar',  [ $this, 'ProgressModule'] );
        add_shortcode('eCertificate',  [ $this, 'generateCertificate'] );
        add_action( 'wp_ajax_custom_update_post', [ $this, 'customUpdatePost' ] );
    }

    public function gotoNextorPrevModule( $id ){
        $parent_id = wp_get_post_parent_id( $id );
        if($parent_id === 0){
            $parent_id = $id;
        }

        $siblingList = get_children(
            [
                'order' => 'asc',
                'post_parent' => $parent_id,
                'post_type'=> 'course'
            ]
        );

        if ( !empty( $siblingList ) && $parent_id !== 0) {
            $postsChild = [];
            foreach ($siblingList as $sibling ) {
                $postsChild[] = $sibling->ID;
            }

            $current = array_search( $id, $postsChild, true );
            $prevID = $postsChild[ $current-1 ] ?? false ;
            $nextID = $postsChild[ $current+1 ] ?? false;

            return $this->displayPrevNext($prevID, $nextID);

        } elseif (!empty($siblingList) && $parent_id = $id) {
            $postschild = array();
            foreach ($siblingList as $sibling ) {
                $postschild[] = $sibling->ID;
            }

            $current = array_search( $id, $postschild, true );
            $firstID = $postschild[0];
            $prevID = $postschild[ $current - 1 ] ?? false;
            $nextID = $postschild[ $current + 1 ] ?? false;
            $html = '<div class="navigation">';

            if( !empty($nextID) ){
                $the_id = get_the_ID();
                $user_id = get_current_user_id();
                $post = get_post($the_id);

                if ($post->post_parent !== 0)	{
                    $ancestors=get_post_ancestors($post->ID);
                    $root=count($ancestors)-1;
                    $parent_id = $ancestors[$root];
                } else {
                    $parent_id = $post->ID;
                }

                $html .= '<div class="alignright">';
                $html .= '<form method="POST">';
                $html .= '<input type="hidden" name="user_id" value="'.$user_id.'"/>';
                $html .= '<input type="hidden" name="parent_id" value="'.$parent_id.'"/>';
                $html .= '<input type="hidden" name="next_link" class="nxt-link" value="'.get_permalink($firstID).'"/>';
                $html .= '<input type="submit" name="submit" class="nxt-course"  id="'.$the_id.'" value="Next"/>';
                $html .= '</form></div>';
            }

            $html .= '</div>';

            echo $html;

        }elseif (empty($siblingList) && $parent_id === 0) {
            return $this->generateCertificate();
        }

        return '';
    }

    public function displayPrevNext( $prevID=false, $nextID=false ){

        global $post;

        if( empty($prevID) && empty($nextID) ){
            return $this->generateCertificate();

        }
        $html = '<div class="navigation">';

        if( empty($nextID) && !empty($prevID) ) {

            if( !empty($prevID) ){
                $html .= '<div class="alignleft">';
                $html .= '<a href="'.get_permalink($prevID).'">Previous</a>';
                $html .= '</div>';
            }

            $html .= '</div><!-- .navigation -->';

            echo $html;
            Assessment::assessmentLink();
            return '';
        }

        if( !empty($prevID) ) {
            $html .= '<div class="alignleft">';
            $html .= '<a href="'.get_permalink($prevID).'">Previous</a>';
            $html .= '</div>';
        }

        if( !empty($nextID) ){
            $nonce = wp_create_nonce( 'ajax_post_validation' );
            $the_id = get_the_ID();
            $user_id = get_current_user_id();

            if ($post->post_parent !== 0) {
                $ancestors=get_post_ancestors($post->ID);
                $root=count($ancestors)-1;
                $parent_id = $ancestors[$root];
            } else {
                $parent_id = $post->ID;
            }

            $html .= '<div class="alignright">';
            $html .= '<form method="POST">';
            $html .= '<input type="hidden" name="user_id" value="'.$user_id.'"/>';
            $html .= '<input type="hidden" name="parent_id" value="'.$parent_id.'"/>';
            $html .= '<input type="hidden" name="next_link" class="nxt-link" value="'.get_permalink($nextID).'"/>';
            $html .= '<input type="submit" name="submit" class="nxt-course"  id="'.$the_id.'" value="Next"/>';
            $html .= '</form></div>';
        }

        $html .= '</div><!-- navigation -->';

        echo $html;

        return '';
    }


    public function customUpdatePost()
    {
        global $post;

        $post_id = $_POST['post_id'];
        $post = get_post( $post_id );
        $parentID = 0;

        if ($post->post_parent !== 0)	{
            $ancestors= get_post_ancestors( $post->ID );
            $root= count($ancestors)-1;
            $parentID = $ancestors[$root];
        } else {
            $parentID = $post->ID;
        }

        $sibling_list = get_children(
            array(
                'order' =>'asc',
                'post_parent' => $parentID,
                'post_type'=> 'course'
            ));

        $next_link = '';
        if (!empty($sibling_list) && $parentID !== 0) {
            $postschild = [];

            foreach ($sibling_list as $sibling ) {
                $postschild[] = $sibling->ID;

            }
            $current = array_search( $post->ID, $postschild, true );
            $prevID = $postschild[ $current - 1 ] ?? false;
            $nextID = $postschild[ $current + 1 ] ?? false;
            $prev_link = get_permalink($prevID);
            $next_link = get_permalink($nextID);

        }


        $userID = get_current_user_id();
        if( isset( $_POST ) ) {
            $member = SingleCourse::isMember( $post->ID, $userID );
            if( $member ) {
                (new SingleCourse())->update( $post->ID, $userID );
            } else {
                (new SingleCourse())->add( $parentID, $post->ID, $userID );
            }

            echo json_encode( $next_link );
            exit;
        }
    }

    function alreadyRed()
    {

        global $post, $wpdb, $level;
        $user_table_name = $wpdb->prefix . 'isn_academy_user';

        $post_id = get_the_ID();
        $post = get_post($post_id);
        $user_id = get_current_user_id();

        if ($post->post_parent !== 0)	{

            $ancestors=get_post_ancestors($post->ID);
            $root=count($ancestors)-1;
            $parent = $ancestors[$root];
        } else {

            $parent = $post->ID;

        }

        $childArgs = [
            'post_type' => 'course',
            'post_status' => 'published',
            'post_per_page' => -1,
            'post_parent' => $parent
        ];
        $children_posts = get_children($childArgs);

        $parent_post = get_post($parent);

        $alluserposts = $wpdb->get_results(
            "SELECT * FROM ".$user_table_name." 
                WHERE user_id = ".$user_id." 
                AND parent_id = ".$parent.""
        );
        if (empty($alluserposts)){
            $counter = 0;
        }else {
            $counter = count($alluserposts);
        }

        $numberOfModules = count( $children_posts ) + 1;
        $percentagePerComplete = 100 / ($numberOfModules);
        $currentProgress = $percentagePerComplete * ($counter + 1);
        $this->level = $currentProgress;

    }

    public function generateCertificate()
    {

        global $post;

        $name = '';

        $output_url = '';

        $currentUser = wp_get_current_user();

        $the_id = get_the_ID();

        $parents = get_post_ancestors( $post->ID );

        $parent_post_id = ($parents) ? $parents[count($parents)-1]: $post->ID;

        $fullName = esc_html( $currentUser->user_firstname ) .' '. esc_html( $currentUser->user_lastname );

        $courseName = get_the_title ( $parent_post_id );



        $name = strtoupper($fullName);
        $name_len = strlen($fullName);
        $occupation = strtoupper($courseName);

        if ( $name !== '' || $occupation !== '' ) {

            if ($occupation) {
                $font_size_occupation = 10;
            }

            //designed certificate picture
            $image = dirname(__FILE__). '/certi.png';

            $createimage = imagecreatefrompng($image);

            //then we make use of the imagecolorallocate inbuilt php function which i used to set color to the text we are displaying on the image in RGB format
            $white = imagecolorallocate($createimage, 205, 245, 255);
            $black = imagecolorallocate($createimage, 0, 0, 0);

            //Then we make use of the angle since we will also make use of it when calling the imagettftext function below
            $rotation = 0;

            //we then set the x and y axis to fix the position of our text name
            $origin_x = 200;
            $origin_y=260;

            //we then set the x and y axis to fix the position of our text occupation
            $origin1_x = 120;
            $origin1_y=90;

            //we then set the different size range based on the length of the text which we have declared when we called values from the form
            if($name_len<=7){
                $font_size = 25;
                $origin_x = 190;
            }
            elseif($name_len<=12){
                $font_size = 30;
            }
            elseif($name_len<=15){
                $font_size = 26;
            }
            elseif($name_len<=20){
                $font_size = 18;
            }
            elseif($name_len<=22){
                $font_size = 15;
            }
            elseif($name_len<=33){
                $font_size=11;
            }
            else {
                $font_size =10;
            }

            $certificate_text = $name;

            //font directory for name
            $drFont = dirname(__FILE__). '/developer.ttf';

            // font directory for occupation name
            $drFont1 = dirname(__FILE__). '/Gotham-black.otf';

            //function to display name on certificate picture
            $text1 = imagettftext($createimage, $font_size, $rotation, $origin_x, $origin_y, $black, $drFont, $certificate_text);

            //function to display occupation name on certificate picture
            $text2 = imagettftext($createimage, $font_size_occupation, $rotation, $origin1_x+2, $origin1_y, $black, $drFont1, $occupation);

            //this is going to be created once the generate button is clicked dirname( __FILE__, 3 ).'/assets/'
            $output =  $this->plugin_path.'certificates/'.strtolower($currentUser->user_firstname). 'certificate.png';

            imagepng($createimage, $output , -1);

            $troublesome_path = $this->plugin_path;

            $resolving_url = $this->plugin_url;

            $output_path = $this->plugin_path.'certificates/'.strtolower($currentUser->user_firstname). 'certificate.png';

            $output_url = str_replace( $troublesome_path, $resolving_url, $output );



            echo '<a href="#" class="btn btn-primary nxt-course getCertificate" id="'.$the_id.'">Get Certificates</a>';
            // <form method="post" action=""></form>

            echo  '<div class="certificate-modal" id="certifiedModal">
                        <div class="certificate-content">
                        
                      <a class="certificate-modal-close" id="certificateModalClose">&times;</a>
                      <div class="alert alert-success col-sm-6" role="alert">
                          Congratulations! '. $name .' on your excellent success.
                      </div>
                      <img src="'.$output_url.'" class="certificate-img">';
            echo  '<a href="'.$output_url.'" class="btn btn-success" target="_blank">Download Certificate</a></div></div>';

        }
    }


    public function gotoNextModule() {

        if ( is_singular( 'course' ) ) {
            $postId = get_the_ID();
            $post = get_post( $postId );

            if ( $post ) {
                $parents = get_post_ancestors( $post->ID );
                if (!empty($parents)) {
                    return $this->gotoNextorPrevModule( $postId );
                }

                $children = get_children( $post->ID );
                if (empty($parents) && empty($children) ){
                    return $this->generateCertificate();
                }

                if (empty($parents) && !empty($children) ) {
                    return $this->gotoNextorPrevModule( $postId );
                }
            }
        }
    }

    public function ProgressModule() {

        if ( is_singular( 'course' ) ) {

            $this->alreadyRed();

            $countlevel = $this->level;

            $allChildren = array();

            $post_id = get_the_ID();

            $post = get_post( $post_id );  // find post with given ID


            if ( $post ) {  // if that post exists

                $parents = get_post_ancestors( $post->ID );

                if ( !empty($parents)){

                    $allChildren[] = $post->ID;  // add its ID to the children

                    $parent_post_id = ($parents) ? $parents[count($parents)-1]: $post->ID;

                    $children = get_children( $parent_post_id );

                    $allChildren[] = array_merge( $allChildren, array_keys( $children ) );  // add children ids to the children array

                } else {

                    $children = get_children( $post->ID );

                    $allChildren[] = $children;

                }

                asort($children);

                $numberOfChildren = count( $allChildren );

                $percentagePerComplete = 100 / $numberOfChildren;

                $key = array_search( $post_id, array_column( $children, 'ID' ), true );

                echo '<div class="isn-progress"><span class="isn-percent" style="width:'.$countlevel.'%"></span></div><strong>'.$countlevel.'%</strong>';

            }

        }
    }
}


