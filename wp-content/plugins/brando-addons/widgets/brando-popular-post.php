<?php
/**
 * @package Brando
 */
?>
<?php

/*******************************************************************************/
/* Start Popular Post Widget */
/*******************************************************************************/

if (!class_exists('brando_popular_post_widget')) {
	class brando_popular_post_widget extends WP_Widget {

		function __construct() {
			parent::__construct(
			'brando_popular_post_widget',
			esc_html__('Brando - Popular Post', 'brando-addons'),
			array( 'description' => esc_html__( 'Your site most Popular Posts.', 'brando-addons' ), ) // Args
			);
		}

		public function widget( $args, $instance ) 
		{
		    
	        $brando_postperpage =  $instance['postperpage'] ;
			$brando_title = apply_filters( 'widget_title', $instance['title'] );
			echo $args['before_widget'];
			if ( ! empty( $brando_title ) )
				echo $args['before_title'] . esc_attr($brando_title) . $args['after_title'];
			
			$brando_recent_post = array('post_type' => 'post', 'posts_per_page' => $brando_postperpage);
			$brando_query = new WP_Query( $brando_recent_post );
			$brando_img_url = '';
			echo '<ul class="widget-posts">';
				if ( $brando_query->have_posts() ) 
				{
					while ( $brando_query->have_posts() ) 
					{
						$brando_query->the_post();

						echo '<li>';
							echo '<a class="alt-font" href="'.get_permalink().'">'.wp_trim_words( get_the_title(), 10).'</a>'.get_the_date('l - F d, Y', get_the_ID());
						echo '</li>';
					}
					wp_reset_postdata();
				}
			echo '</ul>';
	        echo $args['after_widget'];
		}
			
		// Widget Backend 
		public function form( $instance ) 
		{
			$brando_title = (isset($instance[ 'title' ])) ? $instance[ 'title' ] : esc_html__('Popular Post','brando-addons');
			$brando_postperpage = (isset($instance[ 'postperpage' ])) ? $instance[ 'postperpage' ] : '';

			// Widget admin form
			?>
			<p>
				<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php esc_html_e( 'Title:', 'brando-addons' ); ?></label> 
				<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $brando_title ); ?>" />
			</p>
			<p>
				<label for="<?php echo $this->get_field_id( 'postperpage' ); ?>"><?php esc_html_e( 'Number of posts to show :', 'brando-addons' ); ?></label> 
				<input class="widefat" id="<?php echo $this->get_field_id( 'postperpage' ); ?>" size="3"  name="<?php echo $this->get_field_name( 'postperpage' ); ?>" type="text" value="<?php echo esc_attr( $brando_postperpage ); ?>" />
			</p>
		<?php 
		}
		
		// Updating widget replacing old instances with new
		public function update( $new_instance, $old_instance ) 
		{
		  $instance = array();
		  $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		  $instance['postperpage'] = ( ! empty( $new_instance['postperpage'] ) ) ? strip_tags( $new_instance['postperpage'] ) : '';
		   return $instance;
		}
	}
}

// Register and load Brando custom widget
if ( ! function_exists( 'brando_load_popular_post_widget' ) ) :
	function brando_load_popular_post_widget() {
		register_widget( 'brando_popular_post_widget' );
	}
endif;
add_action( 'widgets_init', 'brando_load_popular_post_widget' );

/*******************************************************************************/
/* End Popular Post Widget */
/*******************************************************************************/
?>