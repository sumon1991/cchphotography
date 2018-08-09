<?php
/**
 * @package Brando
 */
?>
<?php

/*******************************************************************************/
/* Start About Me Widget */
/*******************************************************************************/

if (!class_exists('brando_about_widget')) {

	class brando_about_widget extends WP_Widget {

		function __construct() {
			parent::__construct(
			'brando_about_widget',
			esc_html__('Brando - About Me', 'brando-addons'),
			array( 'description' => esc_html__( 'Your site Author.', 'brando-addons' ), ) // Args
			);
		}

		public function widget( $args, $instance ) 
		{
			
			$brando_title = apply_filters( 'widget_title', $instance['title'] );

			// Before widget.
	        echo $args['before_widget'];

	        	// Display the widget title if one was input (before and after defined by themes).
	        
	        	echo $args['before_title'] . esc_attr( $brando_title ) . $args['after_title'];
	            $brando_img_url = (isset($instance['author_image_link'])) ? $instance['author_image_link'] : '';
	            $brando_author_name = (isset($instance['author_name'])) ? $instance['author_name'] : '';
	            $brando_discription = (isset($instance['short_description'])) ? $instance['short_description'] : '';
		    	// Content
		    	
		        echo '<div class="margin-eight-bottom sm-margin-six-bottom">';
			        echo '<img src="' . esc_url( $brando_img_url ) . '" alt="about-me" />';
			    echo '</div>';
		        echo '<span class="alt-font text-uppercase dark-gray-text font-weight-600 display-block">'.esc_html($brando_author_name).'</span>';
	            echo '<p>'.esc_html($brando_discription).'</p>';

	        // After widget
	        echo $args['after_widget'];

		}
			
		// Widget Backend 
		public function form( $instance ) 
		{ 
	           $defaults = array(
	          	'title'   				=> esc_html__( 'About Me', 'brando-addons' ),
	          	'author_image_link' 	=> '',
	          	'author_name' 	  		=> '',
	          	'short_description' 	=> '',
	          	);
	        $instance = wp_parse_args( (array) $instance, $defaults );
	        
			?>

			<p>
				<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php esc_html_e( 'Title:', 'brando-addons' ); ?></label> 
				<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr($instance['title'] ); ?>" />
			</p>
			
			<p>
				<label for="<?php echo $this->get_field_id( 'author_image_link' ); ?>"><?php esc_html_e( 'Author Image Url:', 'brando-addons' ); ?></label> 
				<input class="widefat" id="<?php echo $this->get_field_id( 'author_image_link' ); ?>" name="<?php echo $this->get_field_name( 'author_image_link' ); ?>" type="url" value="<?php echo esc_attr( $instance['author_image_link']); ?>" />
			</p>
			<p>
				<label for="<?php echo $this->get_field_id( 'author_name' ); ?>"><?php esc_html_e( 'Author Name:', 'brando-addons' ); ?></label> 
				<input class="widefat" id="<?php echo $this->get_field_id( 'author_name' ); ?>" name="<?php echo $this->get_field_name( 'author_name' ); ?>" type="text" value="<?php echo esc_attr($instance['author_name']); ?>" />
			</p>
			
	        <p>
	            <label for="<?php echo esc_attr( $this->get_field_id( 'short_description' ) ); ?>"><?php esc_html_e( 'Short Description:', 'brando-addons' ); ?></label>
	            <textarea name="<?php echo esc_attr( $this->get_field_name( 'short_description' ) ); ?>"  class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'short_description' ) ); ?>" ><?php echo esc_attr($instance['short_description']); ?></textarea>
	        </p>
	   <?php
		}
		
		// Updating widget replacing old instances with new
		public function update( $new_instance, $old_instance ) 
		{
			$instance = array();
			$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
			$instance['author_image_link'] = ( ! empty( $new_instance['author_image_link'] ) ) ? strip_tags( $new_instance['author_image_link'] ) : '';
			$instance['author_name'] = ( ! empty( $new_instance['author_name'] ) ) ? $new_instance['author_name'] : '';
			$instance['short_description'] = ( ! empty( $new_instance['short_description'] ) ) ? $new_instance['short_description'] : '';
		    return $instance;
		}
	}
}

// Register and load the widget
if ( ! function_exists( 'brando_load_about_widget' ) ) :
	function brando_load_about_widget() {
		
		register_widget( 'brando_about_widget' );
	}
endif;
add_action( 'widgets_init', 'brando_load_about_widget' );

/*******************************************************************************/
/* End Instagram Widget */
/*******************************************************************************/
?>