<?php
/**
 * Shortcode For Icon List
 *
 * @package Brando
 */
?>
<?php
/*-----------------------------------------------------------------------------------*/
/* Icon List */
/*-----------------------------------------------------------------------------------*/
add_shortcode('brando_font_class_list','brando_font_class_list_shortcode');
if ( ! function_exists( 'brando_font_class_list_shortcode' ) ) {
	function brando_font_class_list_shortcode( $atts, $content = null ) {
		extract( shortcode_atts( array(
	        	'id' => '',
	        	'class' => '',
	        	'brando_font_icon_class_type' => '',
	    ), $atts ) );
		$output = '';

		$id = ( $id ) ? ' id="'.$id.'"' : '';
		$class = ( $class ) ? ' '.$class : '';

		switch ($brando_font_icon_class_type) 
		{
			case 'brando_font_awesome_icons':

				$output .= '<div'.$id.' class="fa-examples'.$class.'">';
					$brando_fa_icon = brando_get_font_awesome_icon_add();
					foreach ($brando_fa_icon as $key => $icon) 
					{
						$output .= '<div class="col-md-4 col-sm-6 col-lg-4">';
				        	$output .= '<i class="fa '.$icon.'"></i>';
				            $output .= $icon;
				        $output .= '</div>';	
					}
			    $output .= '</div>';

			break;

			case 'brando_et_line_icons':
				$output .= '<div'.$id.' class="'.$class.'">';
					$brando_icons = brando_icons();
					foreach ($brando_icons as $key => $icon) 
					{
						$output .= '<div class="glyphs">';
							$output .= '<span class="box1">';
				                $output .= '<span class="'.$icon.'" aria-hidden="true"></span>';
				                $output .= ' '.$icon;
			                $output .= '</span>';
		               $output .= '</div>';
		            }
		        $output .= '</div>';

			break;
		}
	    return $output;
	}
}
?>
