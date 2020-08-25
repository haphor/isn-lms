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
    

    public function register() {
       

        add_shortcode('course-navigation',  array( $this, 'gotoNextModule'), 100 );

        add_shortcode('progress-bar',  array( $this, 'ProgressModule'), 100 );


    }

     public function gotoNextorPrevModule(){

          $post_id = get_the_ID();
          $parent_id = wp_get_post_parent_id($post_id);
          $post_type = get_post_type($post_id);

          $sibling_list = get_children(
            array(
              'order' =>'asc',
              'post_parent' =>$parent_id,
              'post_type'=> $post_type
          ));
          
          if (!empty($sibling_list) && $parent_id !== 0){
            $posts = array();
            foreach ($sibling_list as $sibling ) {
                $posts[] = $sibling->ID;
                
            }
            
            $current = array_search($post_id, $posts);
            $prevID = isset($posts[$current-1]) ? $posts[$current-1] : false;
            $nextID = isset($posts[$current+1]) ? $posts[$current+1] : false;

            return $this->displayPrevNext($prevID, $nextID);
        } elseif (empty($sibling_list) && $parent_id == 0) {

          return $this->generateCertificate();

        }
    }

    public function displayPrevNext($prevID=false, $nextID=false){

      if( empty($prevID) && empty($nextID) ){

          return false;

      } elseif (empty($nextID) && !empty($prevID) ) {
          
          $html = '<div class="navigation">';
          
          if( !empty($prevID) ){
              $html .= '<div class="alignleft">';
              $html .= '<a href="'.get_permalink($prevID).'">Previous</a>';
              $html .= '</div>';
          }

          $html .= '</div><!-- .navigation -->';
          
          echo $html;

          return $this->generateCertificate();
          

      } else{
          
          $html = '<div class="navigation">';
          
          if( !empty($prevID) ){
              $html .= '<div class="alignleft">';
              $html .= '<a href="'.get_permalink($prevID).'">Previous</a>';
              $html .= '</div>';
          }

          if( !empty($nextID) ){
              $html .= '<div class="alignright">';
              $html .= '<a href="'.get_permalink($nextID).'">Next</a>';
              $html .= '</div>';
          }

          $html .= '</div><!-- .navigation -->';

          echo $html;
          
      }
    }

    
    public function generateCertificate() {

        global $post;

        $name = "";

        $output_url = "";

        $currentUser = wp_get_current_user();

        
        $parents = get_post_ancestors( $post->ID );

        $parent_post_id = ($parents) ? $parents[count($parents)-1]: $post->ID;

        
        $fullName = esc_html( $currentUser->user_firstname ) ." ". esc_html( $currentUser->user_lastname );

        $courseName = get_the_title ( $parent_post_id );



            $name = strtoupper($fullName);
            $name_len = strlen($fullName);
            $occupation = strtoupper($courseName);

            if ($name !== "" || $occupation !== "") {

                if ($occupation) {
                  $font_size_occupation = 10;
                }

                //designed certificate picture
                $image = dirname(__FILE__). "/certi.png";

                $createimage = imagecreatefrompng($image);
                
                //this is going to be created once the generate button is clicked dirname(__FILE__).
                // $output = $this->plugin_url."assets/".strtolower($currentUser->user_firstname)."certificate.png";

                //this is going to be created once the generate button is clicked
                // $output = dirname(__FILE__)."/certificate.png";

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

                //we then set the differnet size range based on the lenght of the text which we have declared when we called values from the form
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
                  
                // if (isset($_POST['generate'])) { 

                  $certificate_text = $name;

                  //font directory for name
                  $drFont = dirname(__FILE__)."/developer.ttf";

                  // font directory for occupation name
                  $drFont1 = dirname(__FILE__)."/Gotham-black.otf";
                    
                  //function to display name on certificate picture
                  $text1 = imagettftext($createimage, $font_size, $rotation, $origin_x, $origin_y, $black, $drFont, $certificate_text);

                  //function to display occupation name on certificate picture
                  $text2 = imagettftext($createimage, $font_size_occupation, $rotation, $origin1_x+2, $origin1_y, $black, $drFont1, $occupation);
                  
                  //this is going to be created once the generate button is clicked dirname( __FILE__, 3 ).'/assets/'
                  $output =  $this->plugin_path.'certificates/'.strtolower($currentUser->user_firstname)."certificate.png";

                  imagepng($createimage, $output , -1);

                  $troublesome_path = $this->plugin_path;

                  $resolving_url = $this->plugin_url;

                  $output_path = $this->plugin_path.'certificates/'.strtolower($currentUser->user_firstname)."certificate.png";
                  
                  $output_url = str_replace( $troublesome_path, $resolving_url, $output );

                // }
              
              
                echo '<a name="" href="#" class="btn btn-primary" id="getCertificate">Get Certificate</a>';
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

            $allChildren = array();

            $post_title = get_the_title();
            
            $post_id = get_the_ID();

            $post = get_post( $post_id );  // find post with given ID
            
            
            if ( $post ) {  // if that post exists
                
                $parents = get_post_ancestors( $post->ID );

                if (!empty($parents)) {

                  $allChildren[] = $post->ID;  // add its ID to the children

                  $parent_post_id = ($parents) ? $parents[count($parents)-1]: $post->ID;
                
                  $children = get_children( $parent_post_id );

                  $allChildren[] = array_merge( $allChildren, array_keys( $children ) );  // add children ids to the children array

                  asort($allChildren);
                  
                  $numberOfChildren = count( $allChildren );

                  foreach ( $allChildren as $key => $value) {

                      return $this->gotoNextorPrevModule();

                      for($i=0; $i=$numberOfChildren; $i++){

                          
                          return $this->gotoNextorPrevModule(); 
                          return $this->generateCertificate();                   
                          
                      } 

                  }

                } 

                $children = get_children( $post->ID );

                if (empty($parents) && empty($children) ){

                    return $this->generateCertificate();  

                }                

                if (empty($parents) && !empty($children) ){  

                  $allChildren[] = array_merge( $allChildren, array_keys( $children ) );  // add children ids to the children array

                  asort($allChildren);
                  
                  $numberOfChildren = count( $allChildren );

                  foreach ( $allChildren as $key => $value) {

                      return $this->gotoNextorPrevModule();

                      for($i=0; $i=0; $i++){
                          
                          return $this->gotoNextorPrevModule(); 

                          return $this->generateCertificate();                   
                          
                      } 

                  }

                      return $this->gotoNextorPrevModule();

                }

            }
            
        }
    }    
    
    public function ProgressModule() {

        if ( is_singular( 'course' ) ) {

            $allChildren = array();

            $post_title = get_the_title();
            
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

                  $key = array_search($post_id, array_column($children, 'ID'));
                  
                  $level = $percentagePerComplete * ($key + 1); 

                  echo '<div class="isn-progress"><span class="isn-percent" style="width:'.$level.'%"></span></div><strong>'.$level.'%</strong>';

                  // var_dump($key);                 

            }
            
        }
    }
}

