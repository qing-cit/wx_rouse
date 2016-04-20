<?php
add_action('widgets_init', 'converio_social_widget_register');

function converio_social_widget_register() {
	register_widget('Converio_Social_Widget');
}

class Converio_Social_Widget extends WP_Widget {

	function __construct() {
		parent::__construct(
			'social_widget',
			esc_attr__('Converio Social Widget', 'converio'),
			array('description' => esc_attr__('Displays social links', 'converio'))
		);
	}

	public function widget( $args, $instance ) {
		$title = apply_filters('widget_title', $instance['title']); 

	    echo $args['before_widget'];  
	    if (!empty($title)) {
	    	echo $args['before_title'] . esc_attr($title) . $args['after_title'];  
	    }  
	    echo '<div class="social"><ul>';		
		$social_links = converio_get_social_links(); 
		foreach($social_links as $link) {
			echo '<li>';
			echo '<a href="' . esc_url($link->url) . '" class="' . esc_attr($link->class) . '" target="_blank">' . esc_attr($link->name) . '</a>';
			echo '</li>';
		}
		echo '</ul></div>';
	    echo $args['after_widget'];  
	}

	public function form($instance) {
		if (isset($instance['title'])) {
			$title = $instance['title'];
		} else {
			$title = '';
		}
		?>
		<p>
		<label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_attr_e('Title:', 'converio'); ?></label> 
		<input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
		</p>
		<?php
	}

	public function update($new_instance, $old_instance) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		return $instance;
	}
}
?>