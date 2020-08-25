<?php 
/**
 * @package  ISN Learning
 */
namespace Inc\Base;


use \Inc\Base\BaseController;


/**
* 
*/

class CourseController extends BaseController
{
    

    public function register() {

		add_filter( 'wp', array( $this, 'guest_redirect'), 0 );

        add_action( 'init', array( $this, 'activate_post_type' ) );

    }

    
	
	function guest_redirect( $content ) {
        
		global $post;
		
		if(
			( is_post_type_archive( 'course' ) || is_singular( 'course' ) ) && !is_user_logged_in() ) {
				
				wp_redirect( $this->website_url.'/login' );

				exit;
			}
			return $content;
	}

    function activate_post_type() { 

            $labels = array(
            'name'                  => _x( 'Courses', 'Post Type General Name', 'text_domain' ),
            'singular_name'         => _x( 'Course', 'Post Type Singular Name', 'text_domain' ),
            'menu_name'             => __( 'Courses', 'text_domain' ),
            'name_admin_bar'        => __( 'Courses', 'text_domain' ),
            'archives'              => __( 'Course Archives', 'text_domain' ),
            'attributes'            => __( 'Course Attributes', 'text_domain' ),
            'parent_item_colon'     => __( 'Parent Course:', 'text_domain' ),
            'all_items'             => __( 'All Courses', 'text_domain' ),
            'add_new_item'          => __( 'Add New Course', 'text_domain' ),
            'add_new'               => __( 'Add New', 'text_domain' ),
            'new_item'              => __( 'New Course', 'text_domain' ),
            'edit_item'             => __( 'Edit Course', 'text_domain' ),
            'update_item'           => __( 'Update Course', 'text_domain' ),
            'view_item'             => __( 'View Course', 'text_domain' ),
            'view_items'            => __( 'View Courses', 'text_domain' ),
            'search_items'          => __( 'Search Course', 'text_domain' ),
            'not_found'             => __( 'Not found', 'text_domain' ),
            'not_found_in_trash'    => __( 'Not found in Trash', 'text_domain' ),
            'featured_image'        => __( 'Featured Image', 'text_domain' ),
            'set_featured_image'    => __( 'Set featured image', 'text_domain' ),
            'remove_featured_image' => __( 'Remove featured image', 'text_domain' ),
            'use_featured_image'    => __( 'Use as featured image', 'text_domain' ),
            'insert_into_item'      => __( 'Insert into Course', 'text_domain' ),
            'uploaded_to_this_item' => __( 'Uploaded to this Course', 'text_domain' ),
            'items_list'            => __( 'Courses list', 'text_domain' ),
            'items_list_navigation' => __( 'Courses list navigation', 'text_domain' ),
            'filter_items_list'     => __( 'Filter Courses list', 'text_domain' ),
        );

        $capabilities = array(
            'edit_post'             => 'edit_post',
            'read_post'             => 'read_post',
            'delete_post'           => 'delete_post',
            'edit_posts'            => 'edit_posts',
            'edit_others_posts'     => 'edit_others_posts',
            'publish_posts'         => 'publish_posts',
            'read_private_posts'    => 'read_private_posts',
        );
        $args = array(
            'label'                 => __( 'Course', 'text_domain' ),
            'description'           => __( 'ISN Learning Courses', 'text_domain' ),
            'labels'                => $labels,
            'supports'              => array( 'title', 'thumbnail', 'post-formats', 'page-attributes', 'excerpt' ),
            'taxonomies'            => array( 'category', 'tags' ),
            'hierarchical'          => true,
            'public'                => true,			
            'show_in_rest'          => true,
            'show_ui'               => true,
            'show_in_menu'          => false,            
		    'rewrite'               => array( 'slug' => 'course' ),
            'menu_position'         => null,
            'menu_icon'             => 'dashicons-video-alt3',
            'show_in_admin_bar'     => true,
            'show_in_nav_menus'     => true,
            'can_export'            => false,
            'has_archive'           => 'course',
            'exclude_from_search'   => false,
            'publicly_queryable'    => true,
            'capability_type'       => 'page'
            // 'capabilities'          => $capabilities,
        );        
        
        register_post_type( 'course', $args );
    }
    

}

