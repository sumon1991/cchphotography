<?php
/**
 * Multiple Category For Portfolio Shortcode.
 *
 * @package Brando
 */
?>
<?php
vc_add_shortcode_param( 'brando_multiple_portfolio_categories', 'portfolio_category');
function portfolio_category($settings, $value) {
  $value = explode( ',', $value );
  $value1 = $output = '';
  foreach ($value as $k => $v) {
      $value1 .= $v;
    }

  $taxonomy = 'portfolio-category';
  $args = array(
    'hide_empty'  => false,
  ); 
  $terms = get_terms($taxonomy,$args);
  $output  .= '<select multiple="multiple" name="'. $settings['param_name'] .'" class="wpb_vc_param_value icon-select wpb-input wpb-rs-select '. $settings['param_name'] .' '. $settings['type'] .'">';
  
  if(!empty($value1)):
    $selected_all = ( in_array( '0' , $value ) ) ? ' selected="selected"' : '';
    $output .= '<option value="0" '.$selected_all.'>All Categories</option>';
  else:
    $output .= '<option value="0" selected="selected">All Categories</option>';
  endif;
      foreach ( $terms as $term ) {  
      	$selected = ( in_array( $term->slug, $value ) ) ? ' selected="selected"' : '';
      	$output .= '<option value="'. $term->slug .'"'. $selected .'>'.htmlspecialchars( $term->name." - (".$term->slug." - ".$term->term_id.")").'</option>';
    	}
  $output .= '</select>' . "\n";
   
  return $output;
}
?>