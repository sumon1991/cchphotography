<?php
/**
 * Brando Post List For Shortcode In VC.
 *
 * @package Brando
 */
?>
<?php
vc_add_shortcode_param( 'brando_posts_list', 'posts_list');
function posts_list($settings, $value) {

  $value = explode( ',', $value );

  $args = array(
    'posts_per_page'   => -1,
    'post_type'        => 'post',
    'post_status'      => 'publish',
  );
  $posts_array = get_posts( $args );
  $output  = '<select name="'. $settings['param_name'] .'" class="wpb_vc_param_value icon-select wpb-input wpb-rs-select '. $settings['param_name'] .' '. $settings['type'] .'">';
  $output .= '<option value="">Select Blog</option>';
  foreach ( $posts_array as $post ) : setup_postdata( $post );
      $selected = ( in_array( $post->post_name, $value ) ) ? ' selected="selected"' : '';
      $output .= '<option value="'. $post->post_name .'"'. $selected .'>'.htmlspecialchars( $post->post_title." - (".$post->post_name.")" ).'</option>';
  endforeach; 
  $output .= '</select>' . "\n";
  wp_reset_postdata();
  
  return $output;
}
?>