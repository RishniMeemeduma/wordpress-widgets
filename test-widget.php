<?php

/*
Plugin Name: Test Widget
Description: Test Widget
Author: Rishni Meemeduma
*/

class TestWidget extends WP_Widget{

	public function __construct(){

		$id = 'test_widget';
		$title = esc_html__('Widget','custom-widget');

		$options = array(
			'classname' => 'test_widget',
			'description' => 'Add clean markup that is not modified',
			
			);
		parent::__construct( $id, $title, $options );
	}

	public function widget( $args, $instance ) {

	  $markup = '';

	  if(isset($instance['markup'])){
	  	echo wp_kses_post($instance['markup']);
	  }
	}

	public function update( $new_instance, $old_instance ) {
	  
	  $instance = array();

	  if(isset($new_instance['markup']) && !empty($new_instance['markup'])){

	  		$instance[ 'markup' ] = $new_instance[ 'markup' ] ;

	  }
	  return $instance;
	}

	public function form( $instance ) {

		$id 	=$this->get_field_id('markup');
		$for 	=$this->get_field_id('markup');
		$name 	=$this->get_field_name('markup');
		$label 	=__('Markup/text:','custom-widget');
		$markup ='<p>'.__('Clean markup.','custom-widget').'</p>';

		if(isset($instance['markup']) && !empty($instance['markup'])){
			$markup = $instance['markup'];
		}
		?>
		<p>
			<label for="<?php echo esc_attr($for)?>" ><?php echo esc_html($label) ?></label>
			<textarea class="widefat" id="<?php echo esc_attr( $id ); ?>" name="<?php echo esc_attr( $name ); ?>"><?php echo esc_textarea( $markup ); ?></textarea>
		</p>

	<?php }


}

function myplugin_register_widgets(){
	
	register_widget('TestWidget');
}
add_action('widgets_init','myplugin_register_widgets');