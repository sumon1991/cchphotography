<?php
/**
 * Multiple Category For Post Shortcode.
 *
 * @package Brando
 */
?>
<?php
vc_add_shortcode_param( 'brando_multiple_select_option', 'multiple');
function multiple($settings, $value) {

  $value = explode( ',', $value );
  $value1 = $output = '';
  foreach ($value as $k => $v) {
      $value1 .= $v;
    }
  
  $args = array(
	  'hide_empty' => 0,
	  'orderby' => 'name',
	  'order' => 'ASC'
  );
  $categories = get_categories( $args );

  $output  = '<select multiple="multiple" name="'. $settings['param_name'] .'" class="wpb_vc_param_value icon-select wpb-input wpb-rs-select '. $settings['param_name'] .' '. $settings['type'] .'">';

    if(!empty($value1)):
      $selected_all = ( in_array( '0' , $value ) ) ? ' selected="selected"' : '';
      $output .= '<option value="0" '.$selected_all.'>All Categories</option>';
    else:
      $output .= '<option value="0" selected="selected">All Categories</option>';
    endif;
      
  	foreach ( $categories as $index => $data ) {
    	$selected = ( in_array( $data->slug, $value ) ) ? ' selected="selected"' : '';
    	$output .= '<option value="'. $data->slug .'"'. $selected .'>'.htmlspecialchars( $data->name."- (".$data->slug." - ".$data->term_id.")" ).'</option>';
  	}
  $output .= '</select>' . "\n";
   
  return $output;
}
?>