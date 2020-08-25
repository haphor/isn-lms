<?php 
/**
 * @package  ISN Learning
 */
namespace Inc\Base;

use WP_Widget;
use WP_Query;


class WidgetController extends WP_Widget {

	public $widget_ID;

	public $widget_name;

	public $number;

	public $widget_ops = array();

	public $control_options = array();

	function __construct() {

		$this->widget_ID = 'isn_widget';
		$this->widget_name = 'ISN Widget';
        $this->widget_ops = array(
			'classname' => $this->widget_ID,
			'description' => $this->widget_name,
			'customize_selective_refresh' => true
		);
		$this->control_options = array(
			'width' => 400,
			'height' => 350,
		);

        add_action( 'save_post', array($this, 'flush_widget_cache') );
        add_action( 'deleted_post', array($this, 'flush_widget_cache') );
        add_action( 'switch_theme', array($this, 'flush_widget_cache') );
	}
	
	public function register()
	{
		parent::__construct( $this->widget_ID, $this->widget_name, $this->widget_ops, $this->control_options );

		add_action( 'widgets_init', array( $this, 'widgetsInit' ) );
	}

	public function widgetsInit()
	{
		register_widget( $this );
	}

    public function widget($args, $instance) {
        $cache = wp_cache_get('widget_isn_recent_courses', 'widget');

        if ( !is_array($cache) )
            $cache = array();

        if ( isset($cache[$args['widget_id']]) ) {
            echo $cache[$args['widget_id']];
            return;
        }

        ob_start();
        extract($args);

		$title = apply_filters('widget_title', empty($instance['title']) ? __('ISN Recent Courses') : $instance['title'], $instance, $this->id_base);
		// $number = apply_filters('widget_number', empty($instance['number']) ? '' : $instance['number'], $instance, $this->id_base);
		
		if ( !$number = (int) $instance['number'] )
            $number = 10;
        else if ( $number < 1 )
            $number = 1;
        else if ( $number > 15 )
            $number = 15;

        $r = new \WP_Query(
				array(
					'showposts' => $number, 
					'nopaging' => 0,
            		'post_parent' => 0,
					'post_status' => 'publish', 
					'ignore_sticky_posts' => true, 
					'post_type' => array('post', 'course')));
        if ($r->have_posts()) :
?>
        <?php echo $before_widget; ?>
        <?php if ( $title ) echo $before_title . $title . $after_title; ?>
        <ul>
        <?php  while ($r->have_posts()) : $r->the_post(); ?>
        <li><a href="<?php the_permalink() ?>" title="<?php echo esc_attr(get_the_title() ? get_the_title() : get_the_ID()); ?>"><?php if ( get_the_title() ) the_title(); else the_ID(); ?></a></li>
        <?php endwhile; ?>
        </ul>
        <?php echo $after_widget; ?>
<?php
        // Reset the global $the_post as this query will have stomped on it
        wp_reset_postdata();

        endif;

        $cache[$args['widget_id']] = ob_get_flush();
        wp_cache_set('widget_isn_recent_courses', $cache, 'widget');
    }	

    public function form( $instance ) {
        $title = isset($instance['title']) ? esc_attr($instance['title']) : '';
        if ( !isset($instance['number']) || !$number = (int) $instance['number'] ){            
            $number = 5;
        }
?>
        <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></p>

        <p><label for="<?php echo $this->get_field_id('number'); ?>"><?php _e('Number of Courses to show:'); ?></label>
        <input id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="text" value="<?php echo $number; ?>" size="3" /></p>
<?php
	}
	
    public function update( $new_instance, $old_instance ) {
        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['number'] = (int) $new_instance['number'];
        $this->flush_widget_cache();

        $alloptions = wp_cache_get( 'alloptions', 'options' );
        if ( isset($alloptions['widget_isn_recent_courses']) )
            delete_option('widget_isn_recent_courses');

        return $instance;
    }

   public  function flush_widget_cache() {
        wp_cache_delete('widget_isn_recent_courses', 'widget');
    }


} 