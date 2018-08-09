<?php
/**
 * @package Brando
 */
?>
<?php

/*******************************************************************************/
/* Start Recent Comment With Author And Date */
/*******************************************************************************/

if (!class_exists('brando_recent_comment_widget')) {
	class brando_recent_comment_widget extends WP_Widget {

		function __construct() {
			parent::__construct(
			'brando_recent_comment_widget',
			esc_html__('Brando - Recent Comments', 'brando-addons'),
			array( 'description' => esc_html__( 'Your site most recent comments.', 'brando-addons' ), ) // Args
			);
		}
		public function widget( $args, $instance ) {
			$brando_title = apply_filters( 'widget_title', $instance['title'] );
			$brando_postperpage =  $instance['postperpage'] ;
			echo $args['before_widget'];
			$brando_no_comments = $brando_postperpage; 
			$brando_comment_len = 80;
			if ( ! empty( $brando_title ) )
			echo  '<div class="widget">';
			echo $args['before_title'] . esc_attr($brando_title) . $args['after_title'];
					
				$comment_output = '';
				$comment_output .= '<div class="widget-body">';
					$comment_output .='<ul class="widget-posts">';
						$brando_comments_query = new WP_Comment_Query();
						$brando_comments = $brando_comments_query->query( array( 'number' => $brando_no_comments,'post_type' => 'post', ) );
						if ( $brando_comments ) : foreach ( $brando_comments as $comment ) :
							$comment_output .= '<li class="clearfix"><a class="author alt-font" href="' . esc_url(get_permalink( $comment->comment_post_ID )) . '#comment-' . $comment->comment_ID . '">';
								$comment_output .= get_the_title($comment->comment_post_ID). '</a> ';
								$comment_output .= get_comment_date( 'l - F d, Y h:i a', $comment->comment_ID ) ;
							$comment_output .= '</li>';
						endforeach;
						else :
							$comment_output .= '<li>No comments.</li>';
						endif;
						wp_reset_postdata();
					$comment_output .='</ul>';
				$comment_output .='</div>';
			$comment_output .='</div>';
			echo sprintf("%s",$comment_output);

			echo $args['after_widget'];
		}
			
		// Widget Backend 
		public function form( $instance ) {
			
			$brando_title = (isset($instance[ 'title' ])) ? $instance[ 'title' ] : '';
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
		public function update( $new_instance, $old_instance ) {
			$instance = array();
			$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
			$instance['postperpage'] = ( ! empty( $new_instance['postperpage'] ) ) ? strip_tags( $new_instance['postperpage'] ) : '';
			return $instance;
		}
	}
}
/*******************************************************************************/
/* End Recent Comment With Author And Date */
/*******************************************************************************/

// Register and load Brando custom widget
if ( ! function_exists( 'brando_load_widget' ) ) :
	function brando_load_widget() {
		register_widget( 'brando_recent_comment_widget' );
	}
endif;
add_action( 'widgets_init', 'brando_load_widget' ); ?>