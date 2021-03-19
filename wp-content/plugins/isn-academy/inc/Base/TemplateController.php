<?php 
/**
 * @package  ISN Learning
 */
namespace Inc\Base;

use Inc\Base\BaseController;

/**
* 
*/
class TemplateController extends BaseController
{
	public $templates;

	public function register()
	{

		add_filter('archive_template', array( $this, 'courseArchive_template' ) );

		add_filter( 'single_template', array( $this, 'courseSingle_template' ), 50, 1 );

		add_filter( 'single_template', array( $this, 'courselogin_template' ) );

	}


	public function courseArchive_template( $template ) {

		global $post;

		if ( is_post_type_archive('course') ) {

			$archive_template = $this->plugin_path . '/templates/ArchiveTemplate.php';
			$theme_files = array('archive-course.php', 'isn-learning/templates/ArchiveTemplate.php');
			$exists_in_theme = locate_template($theme_files, false);

			if ( $exists_in_theme !== '' ) {
				return $exists_in_theme;
			}

            return $archive_template;
        }

		return $template;

	}


	public function courseSingle_template( $template ) {
		global $post;
		
		$parent_template = $this->plugin_path . '/templates/ParentTemplate.php';
        $theme_files = [ 'parent-course.php', 'isn-learning/templates/ParentTemplate.php' ];
        $sub_child_single = [ 'single-course.php', 'isn-learning/templates/SingleTemplate.php' ];
        $exists_in_theme = locate_template($theme_files, false);
        $single_theme = locate_template($sub_child_single, false);

		$single_template = $this->plugin_path . '/templates/SingleTemplate.php';

		if ( is_singular( 'course' ) ) {
			
			if ( $post->post_type === 'course' &&  $post->post_parent == 0) {
			    if ( $exists_in_theme !== '' ) {
                    return $exists_in_theme;
                }
				return $parent_template;
			}

			if( $single_theme !== '' ) {
			    return $single_theme;
            }

            return $single_template;
        }
		return $single_template;
	}

	
	public function courselogin_template( $template ) {

		global $post;
		
		$login_template = $this->plugin_path . '/templates/LoginTemplate.php';
		$register_template = $this->plugin_path . '/templates/RegisterTemplate.php';

		if ( is_page() ) {
			
			if ( 'page' == $post->post_type &&  $post->post_title === 'Register') {

				$post->page_template = $register_template;

				update_post_meta(get_option( $post->ID ), '_wp_page_template', $register_template);

			} elseif ( 'page' == $post->post_type &&  $post->post_title === 'Login') {

				$post->page_template = $login_template;
				
				update_post_meta(get_option( $post->ID ), '_wp_page_template', $login_template);
			}
			
		}
		
	}
	
}