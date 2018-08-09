<?php
/**
 * Shortcode For Row
 *
 * @package Brando
 */
?>
<?php
/*-----------------------------------------------------------------------------------*/
/* Row */
/*-----------------------------------------------------------------------------------*/

if ( ! function_exists( 'brando_row' ) ) {
	function brando_row($atts, $content = null){
		extract( shortcode_atts( array(
			'equal_height' => '',
			'content_placement' => '',
	        'brando_row_style' => '',
	        'brando_row_bg_color' =>'',
	        'brando_row_bg_image' => '',
	        'show_container_fluid' => '',
	        'column_without_row' => '',
	        'show_full_width' => '',
	        'brando_row_image_type' => '',
	        'brando_bg_image_type' => '',
	        'brando_parallax_image_type' => '',
	        'fullscreen' => '',
	        'show_overlay' => '',
	        'brando_overlay_opacity' => '',
	        'brando_row_overlay_color' => '',
	        'brando_z_index' => '',
	        'show_navigation' => '',
	        'brando_row_border_position' => '',
	        'brando_row_border_color' => '',
	        'brando_border_size' => '',
	        'brando_border_type' => '',
	        'brando_row_padding' => '',
	        'brando_padding_top' => '',
	        'brando_padding_bottom' => '',
	        'padding_setting' => '',
	        'desktop_padding' => '',
	        'custom_desktop_padding' => '',
	        'desktop_mini_padding' => '',
	        'ipad_padding' => '',
	        'mobile_padding' => '',
	        'margin_setting' => '',
	        'desktop_margin' => '',
	        'custom_desktop_margin' => '',
	        'desktop_mini_margin' => '',
	        'ipad_margin' => '',
	        'mobile_margin' => '',
	        'brando_row_animation_style' => '',
	        'brando_row_mobile_padding' => '',
	        'brando_row_ipad_padding' => '',
	        'id' => '',
	        'class' => '',
	        'position_relative' => '',
	        'overflow_hidden' => '',
	        'scroll_to_down' => '',
	        'hide_background' => '',
	        'hide_background_ipad' => '',
	        'brando_min_height' => '',
	        'brando_image_pos_x' => '',
	        'brando_image_pos_y' => '',
	    ), $atts ) );
		$output = $padding = $padding_style = $margin = $margin_style = $style_attr = $overlay_style = '';
		$classes = $style_array = array();

		$id = ( $id ) ? ' id="'.$id.'"' : '';
		$class = ( $class ) ? $classes[] = $class : '';
		$equal_height = ( $equal_height ) ? $classes[] = 'row-equal-height' : '';
		$content_placement = ( $content_placement ) ? $classes[] = 'row-content-' . $content_placement : '';
		$column_without_row = ( $column_without_row ) ? $column_without_row : '';
		$position_relative = ($position_relative == 1) ? $classes[] = 'position-relative' : '';
		$overflow_hidden = ($overflow_hidden == 1) ? $classes[] = 'overflow-hidden' : '';
		$fullscreen = ($fullscreen) ? $classes[] = 'full-screen' : '';
		$show_container_fluid_att = ($show_container_fluid == 1) ? 'container-fluid' : 'container';
		$hide_background = ($hide_background == 1) ? $classes[] = 'xs-no-background' : '';
		$hide_background_ipad = ($hide_background_ipad == 1) ? $classes[] = 'sm-no-background' : '';

		$brando_min_height = ( $brando_min_height ) ? $style_array[] = 'min-height:'.$brando_min_height.';' : '';
		$brando_image_pos_x = ( $brando_image_pos_x ) ? ' '.$brando_image_pos_x : '';
		$brando_image_pos_y = ( $brando_image_pos_y ) ? ' '.$brando_image_pos_y : '';

		// For Border
		$brando_row_border_pos = ($brando_row_border_position) ? $brando_row_border_position.': ' : '';
		if($brando_row_border_pos){
			$brando_row_border_pos .= ($brando_border_size) ? $brando_border_size : '';
			$brando_row_border_pos .= ($brando_border_type) ? ' '.$brando_border_type : '';
			$brando_row_border_pos .= ($brando_row_border_color) ? ' '.$brando_row_border_color : '';
			$brando_row_border_pos .= ';';
		}
		$style_array[] = $brando_row_border_pos;

		// Section Padding Settings
		$padding_setting = ( $padding_setting ) ? $padding_setting : '';
		if( $padding_setting ):
			$desktop_padding = ( $desktop_padding ) ? $desktop_padding : '';
			$custom_desktop_padding = ( $custom_desktop_padding ) ? $custom_desktop_padding : '';
			if($desktop_padding == 'custom-desktop-padding' && $custom_desktop_padding){
				$style_array[] = "padding: ".$custom_desktop_padding.";";
			}else{
				if( $desktop_padding ) :
					$classes[] = $desktop_padding;
				endif;
			}
			$desktop_mini_padding = ( $desktop_mini_padding ) ? $classes[] = $desktop_mini_padding : '';
			$ipad_padding = ( $ipad_padding ) ? $classes[] = $ipad_padding : '';
			$mobile_padding = ( $mobile_padding ) ? $classes[] = $mobile_padding : '';
		endif;

		// Section Margin Settings
		$margin_setting = ( $margin_setting ) ? $margin_setting : '';
		if( $margin_setting ){
			$desktop_margin = ( $desktop_margin ) ? $desktop_margin : '';
			$custom_desktop_margin = ( $custom_desktop_margin ) ? $custom_desktop_margin : '';
			if( $desktop_margin == 'custom-desktop-margin' && $custom_desktop_margin ){
				$style_array[] = "margin: ".$custom_desktop_margin.";";
			}else{
				if( $desktop_margin ) :
					$classes[] .= $desktop_margin;
				endif;
			}
			$desktop_mini_margin = ( $desktop_mini_margin ) ? $classes[] = $desktop_mini_margin : '';
			$ipad_margin = ( $ipad_margin ) ? $classes[] = $ipad_margin : '';
			$mobile_margin = ( $mobile_margin ) ? $classes[] = $mobile_margin : '';
		}

		switch ( $brando_row_style ) {
			case 'color':
				$brando_row_bg = ($brando_row_bg_color) ? $style_array[] = 'background-color:'.$brando_row_bg_color.';' : '';
			break;
			case 'image':
				$image_url = wp_get_attachment_url( $brando_row_bg_image );
				$image_url_att = ($image_url) ? $style_array[] = 'background: url('.$image_url.') no-repeat'.$brando_image_pos_x.$brando_image_pos_y.';' : '';

				$brando_row_image_type_att = ($brando_row_image_type=='parallax') ? $classes[]= 'parallax-fix' : '';
				$brando_bg_image_type_att = ($brando_bg_image_type) ? $classes[] = $brando_bg_image_type : '';
				$brando_parallax_image_type_att = ($brando_parallax_image_type) ? $classes[] = $brando_parallax_image_type : '';
			break;
		}
		/* For Animation*/
		$brando_row_animation_style_att = ($brando_row_animation_style) ? $classes[] = 'wow '.$brando_row_animation_style.'' : '';

	    
		// Class List
		$class_list = implode(" ", $classes);
		$row_class = ( $class_list ) ? ' class="'.$class_list.'"' : '';

		// Style Property List
		$style_property_list = implode("", $style_array);
		$style_property = ( $style_property_list ) ? ' style="'.$style_property_list.'"' : '';
	        
		$brando_row_section_style = $brando_row_section_class  = $brando_row_section_class_att = $brando_row_section_id = '';

		if(empty($brando_row_style)){

			$output .= '<section'.$id.$row_class.$style_property.'>';
				if($show_full_width == '1'){
					$output .=  do_shortcode($content);
				}else{
		        	$output .= '<div class="'.$show_container_fluid_att.'">';
		        		if( $column_without_row != 1 ){
		            		$output .= '<div class="row">';
		        		}
		            		$output .=  do_shortcode($content);
		            	if( $column_without_row != 1 ){
		            		$output .= '</div>';
		            	}
		            $output .= '</div>';
		    	}
		    $output .= '</section>';
		}else{
			switch ($brando_row_style) {
				case 'color':
					$output .= '<section'.$id.$row_class.$style_property.'>';
						if($show_full_width == '1'){
							$output .=  do_shortcode($content);
						}else{
		                	$output .= '<div class="'.$show_container_fluid_att.'">';
		                    	if( $column_without_row != 1 ){
				            		$output .= '<div class="row">';
		                    	}
		                    		$output .=  do_shortcode($content);
		                    	if( $column_without_row != 1 ){
				            		$output .= '</div>';
		                    	}
		                    $output .= '</div>';
	                	}
	                $output .= '</section>';
	            break;
				case 'image':
					$brando_overlay_opacity_att = ($brando_overlay_opacity) ? ' opacity:'.$brando_overlay_opacity.';' : '';
					$brando_row_overlay_color_att = ($brando_row_overlay_color) ? ' background-color:'.$brando_row_overlay_color.';' : '';
					$brando_z_index = ( $brando_z_index || $brando_z_index == '0') ? ' z-index:'.$brando_z_index.';' : '';

					if( $brando_overlay_opacity_att || $brando_row_overlay_color_att || $brando_z_index ){
						$overlay_style = ' style="'.$brando_overlay_opacity_att.$brando_row_overlay_color_att.$brando_z_index.'"';
					}
					
					$output .= '<section '.$id.$row_class.$style_property.'>';

						if($show_overlay=='1'){
							$output .= '<div class="opacity-full"'.$overlay_style.'></div>';
						}
	                	if($show_full_width == '1'){
							$output .=  do_shortcode($content);
						}else{
		                	$output .= '<div class="'.$show_container_fluid_att.'">';
		                    	if( $column_without_row != 1 ){
				            		$output .= '<div class="row">';
		                    	}
		                    		$output .=  do_shortcode($content);
		                    	if( $column_without_row != 1 ){
				            		$output .= '</div>';
		                    	}
		                    $output .= '</div>';
	                	}
	                $output .= '</section>';
			    break;
			}
		}
		return $output;
	}
}
add_shortcode( 'vc_row', 'brando_row' );
add_shortcode( 'vc_section', 'brando_row' );
?>