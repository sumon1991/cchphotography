<?php
/**
 * Shortcode For Blockquote
 *
 * @package Brando
 */
?>
<?php
/*-----------------------------------------------------------------------------------*/
/* Blockquote */
/*-----------------------------------------------------------------------------------*/

if ( ! function_exists( 'brando_blockquote_shortcode' ) ) {
	function brando_blockquote_shortcode( $atts, $content = null ) {
		extract( shortcode_atts( array(
				'id' => '',
	        	'class' => '',
	        	'brando_blockquote_heading' => '',
	            'blockquote_icon' => '',
				'brando_blockquote_bg_color' => '',
			    'brando_blockquote_color' => '',
			    'desktop_padding' => '',
			    'custom_desktop_padding' => '',
	            'desktop_margin' => '',
	            'custom_desktop_margin' => '',
			    'brando_blockquote_font_size' => '',
			    'brando_blockquote_line_height' => '',
	        ), $atts ) );

		$output = $style_footer_atrr = $style_atrr = '';
		$classes = $style_array = array();
		$id = ( $id ) ? ' id="'.$id.'"' : '';
		$class = ( $class ) ? $classes[] = $class : '';
		$brando_blockquote_heading = ( $brando_blockquote_heading ) ? $brando_blockquote_heading : '';
		$brando_blockquote_bg_color = ( $brando_blockquote_bg_color ) ? $style_array[] = 'background: none repeat scroll 0 0 '.$brando_blockquote_bg_color.';' : '';
		$brando_blockquote_color = ( $brando_blockquote_color ) ? $style_array[] = 'color: '.$brando_blockquote_color.';' : '';
		$desktop_padding = ( $desktop_padding || $desktop_padding != 'custom-desktop-padding') ? $classes[] = $desktop_padding : '';
	    $desktop_margin = ( $desktop_margin || $desktop_margin != 'custom-desktop-margin') ? $classes[] = $desktop_margin : '';
		$custom_desktop_padding = ( $custom_desktop_padding ) ? $style_array[] ='padding:'.$custom_desktop_padding.';' : '';
	    $custom_desktop_margin = ( $custom_desktop_margin ) ? $style_array[] ='margin:'.$custom_desktop_margin.';' : '';
		$brando_blockquote_font_size = ($brando_blockquote_font_size) ? $style_array[] ='font-size:'.$brando_blockquote_font_size.';' : '';
		$brando_blockquote_line_height = ($brando_blockquote_line_height) ? $style_array[] ='line-height:'.$brando_blockquote_line_height.';' : '';
	    $blockquote_icon = ( $blockquote_icon == 1 ) ? $classes[] = 'blog-image' : '';
	        
		$class_list = implode(" ", $classes);
		$class_attr = ( $class_list ) ? ' class="'.$class_list.'"' : '';

		$style_property_list = implode(" ", $style_array);
		$style_atrr = ( $style_property_list ) ? ' style="'.$style_property_list.'"' : '';

		if($brando_blockquote_color){
			$style_footer_atrr = ' style="'.$brando_blockquote_color.'"';
		}
		$output .= '<div'.$id.$class_attr.'>';
	        $output .= '<blockquote class="alt-font"'.$style_atrr.'>';
	            $output.= do_shortcode( brando_remove_wpautop($content) );
	            $output .= '<footer class="text-uppercase black-text"'.$style_footer_atrr.'>'.$brando_blockquote_heading.'</footer>';
	        $output .= '</blockquote>';
	    $output .= '</div>';

       return $output;
	}
}
add_shortcode("brando_blockquote","brando_blockquote_shortcode");
?>