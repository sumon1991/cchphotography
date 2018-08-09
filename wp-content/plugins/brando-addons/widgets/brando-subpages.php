<?php
/**
 * @package Brando
 */
?>
<?php

/*******************************************************************************/
/* Start Sub Pages Widget */
/*******************************************************************************/

if (!class_exists('brando_subpages_widget')) {

	class brando_subpages_widget extends WP_Widget {

		function __construct() {
			parent::__construct(
			'brando_subpages_widget',
			esc_html__('Brando - SubPages', 'brando-addons'),
			array( 'description' => esc_html__( 'Subpages.', 'brando-addons' ), ) // Args
			);
		}

		public function widget( $args, $instance ) 
		{
			
			$brando_title = apply_filters( 'widget_title', $instance['title'] );

			// Before widget.
			echo '<div class="widget xs-margin-twenty xs-no-margin-lr xs-no-margin-top" data-offset-top="400">';
		        echo $args['before_widget'];

		        // Display the widget title if one was input (before and after defined by themes).
		        
		        echo $args['before_title'] . esc_attr( $brando_title ) . $args['after_title'];
	            $brando_parent_pages = (isset($instance['parent_pages'])) ? $instance['parent_pages'] : '';
	            $brando_exclude_ids = (isset($instance['exclude_ids'])) ? $instance['exclude_ids'] : '';
		    	// Content
		    	$brando_page = get_page_by_path( $brando_parent_pages );
				$brando_parents = $brando_page->ID;
		    	$brando_children=wp_list_pages( 'echo=0&child_of=' . esc_attr($brando_parents) . '&title_li=' );
		    	$brando_args_page = array(
			        'title_li'    => '',
			        'child_of'    => $brando_parents,
			        'exclude'       => $brando_exclude_ids,
			        'sort_column'  => 'menu_order',
			    );
			    add_filter('wp_list_pages', create_function('$brando_args_page', 'return str_replace("<a ", "<a class=\"alt-font\" ", $brando_args_page);'));
		    	if( $brando_children ){
			            echo '<ul class="category-list">';
			            	wp_list_pages( $brando_args_page );
			            echo '</ul>';
	        	}
		        // After widget
		        echo $args['after_widget'];
	        echo '</div>';

		}
			
		// Widget Backend 
		public function form( $instance ) 
		{ 
	           $defaults = array(
	          	'title'   				=> esc_html__( 'Sub Pages', 'brando-addons' ),
	          	'parent_pages' 	=> '',
	          	'exclude_ids' 	  		=> '',
	          	);
	        $instance = wp_parse_args( (array) $instance, $defaults );
	        $brando_exclude_ids = '';
	        if(isset($instance['exclude_ids'])){
				$brando_exclude_ids = $instance['exclude_ids'];
			}
	        
			?>

			<p>
				<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php esc_html_e( 'Title:', 'brando-addons' ); ?></label> 
				<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr($instance['title'] ); ?>" />
			</p>
			
			<p>
				<label for="<?php echo $this->get_field_id( 'parent_pages' ); ?>"><?php esc_html_e( 'Parent Pages:', 'brando-addons' ); ?></label> 
				<select class="widefat" name="<?php echo $this->get_field_name( 'parent_pages' ); ?>" id="<?php echo $this->get_field_name( 'parent_pages' ); ?>">
					<option>-- Select Page --</option>
						<?php
							$brando_parent =   get_pages( array(
											'parent' => '0',
									        'post_type' => 'page',
											'post_status' => 'publish'
									    ) );
							foreach ($brando_parent as $key => $value) {
								if ( $value->post_name == $instance['parent_pages'] ):
									$selected = 'selected="selected"';
								else:
									$selected = '';
								endif;

								echo '<option value="'.esc_attr($value->post_name).'" '.$selected.'>'.esc_attr($value->post_title).'</option>';
							}
						?>
				</select>
			</p>
			<p>
				<label for="<?php echo $this->get_field_id( 'exclude_ids' ); ?>"><?php esc_html_e( 'Exclude Ids:', 'brando-addons' ); ?></label> 
				<input class="widefat" id="<?php echo $this->get_field_id( 'exclude_ids' ); ?>" name="<?php echo $this->get_field_name( 'exclude_ids' ); ?>" type="text" value="<?php echo $brando_exclude_ids; ?>" />
			</p>
			
	   <?php
		}
		
		// Updating widget replacing old instances with new
		public function update( $new_instance, $old_instance ) 
		{
			$instance = array();
			$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
			$instance['parent_pages'] = ( ! empty( $new_instance['parent_pages'] ) ) ? strip_tags( $new_instance['parent_pages'] ) : '';
			$instance['exclude_ids'] = ( ! empty( $new_instance['exclude_ids'] ) ) ? $new_instance['exclude_ids'] : '';
		    return $instance;
		}
	}
}

// Register and load the widget
if ( ! function_exists( 'brando_load_subpages_widget' ) ) :
	function brando_load_subpages_widget() {
		
		register_widget( 'brando_subpages_widget' );
	}
endif;
add_action( 'widgets_init', 'brando_load_subpages_widget' );

/*******************************************************************************/
/* End Sub Pages Widget */
/*******************************************************************************/
?>