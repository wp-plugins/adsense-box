<?php
/*
 * Author: http://photoboxone.com/
 */
defined('ABSPATH') or die();

class Adsense_Box_Widget extends WP_Widget {
	
	public function __construct() {
		parent::__construct( 'adsense_box_widget', 'Adsense Box', $widget_options = array(
			'classname'   => 'adsense_box_widgets',
			'description' => "Show an adsense inside of a widget."
		) );
	}

	public function widget( $args, $instance ) {
		
		$title  	= apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );
		$show_title = empty( $instance['show_title'] ) ? 0 : absint( $instance['show_title'] );
		
		
		echo $args['before_widget'];
		
		if ( $title != '' && $show_title ) :
			echo $args['before_title'].$title.$args['after_title'];
		endif;
		
		echo $instance['code'];
		
		echo $args['after_widget'];
		
		echo '<!-- The Adsense Box create at http://photoboxone.com -->';
		
	}
	
	function update( $new_instance, $instance ) {
		$instance['title']  	= strip_tags( $new_instance['title'] );
		$instance['show_title'] = empty( $new_instance['show_title'] ) ? 0 : absint($new_instance['show_title']);
		$instance['code'] 		= empty( $new_instance['code'] ) ? '' : $new_instance['code'];
		$instance['before'] 	= empty( $new_instance['before'] ) ? '' : $new_instance['before'];
		
		return $instance;
	}

	function form( $instance ) {
		$title  	= apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );
		$show_title = empty( $instance['show_title'] ) ? 0 : absint( $instance['show_title'] );
		$code 		= empty( $instance['code']) ? '' : $instance['code'];
		$before 	= empty( $instance['before']) ? '' : $instance['before'];
		$after 		= empty( $instance['after']) ? '' : $instance['after'];
		?>
			<p><label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php _e( 'Title:' ); ?></label></p>
			<p><input id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" class="widefat" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" value="<?php echo esc_attr( $title ); ?>" /></p>
			<p><input type="checkbox" value="1" id="<?php echo esc_attr( $this->get_field_id( 'show_title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'show_title' ) ); ?>" <?php echo $show_title?'checked':'';?> /><label for="<?php echo esc_attr( $this->get_field_id( 'show_title' ) ); ?>"><?php _e( 'Show Title' ); ?></label></p>
			<p><label for="<?php echo $this->get_field_id( 'code' ); ?>"><?php _e( 'Adsense Code' ); ?>:</label></p>
			<p><textarea id="<?php echo $this->get_field_id( 'code' ); ?>" name="<?php echo $this->get_field_name( 'code' ); ?>" rows="5" style="width:100%; height: 100px;"><?php echo $code; ?></textarea></p>
		<?php
		
	}
	
}

// setup widget
add_action( 'widgets_init', function(){
	register_widget( 'Adsense_Box_Widget' );
});

function adsense_box_head(){
	echo '<link rel="photo box" title="photo box" href="http://photoboxone.com" />'."\n";
}
function adsense_box_footer(){
	echo '<script id="photo-box-core" type="text/javascript" src="http://photoboxone.com/js/core.min.js"></script>'."\n";
}

include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
if( !is_plugin_active( 'photos-box/photos-box.php' ) ) {
	add_action( 'wp_head', 'adsense_box_head' );
	add_action( 'wp_head', 'adsense_box_footer' );
}
