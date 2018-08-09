<?php
/**
 * Shortcode For Column
 *
 * @package Brando
 */
?>
<?php
/*-----------------------------------------------------------------------------------*/
/* Column */
/*-----------------------------------------------------------------------------------*/
function vc_column( $atts, $content = '', $id = '' ) {
	extract( shortcode_atts( array(
		'column_style' => '',
		'column_bg_color' => '',
		'column_bg_image' => '',
		'column_image_border' => '',
		'column_image_border_color' => '',
		'column_image_type' => '',
		'column_bg_image_type' => '',
		'column_parallax_image_type' => '',
		'column_full' => '',
    	'centralized_div' => '',
    	'min_height' => '',
        'alignment_setting' => '',
        'border_setting' => '',
        'desktop_show_border' => '',
        'desktop_border_type' => '',
        'column_border_color' => '',
        'column_border_size' => '',
        'column_border_type' => '',
        'ipad_border' => '',
        'mobile_border' => '',
        'desktop_alignment' => '',
        'desktop_mini_alignment' => '',
        'ipad_alignment' => '',
        'mobile_alignment' => '',
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
        'display_setting' => '',
        'desktop_display' => '',
        'ipad_display' => '',
        'mobile_display' => '',
        'enable_clear_both' => '',
        'desktop_clear_both' => '',
        'desktop_mini_clear_both' => '',
        'ipad_clear_both' => '',
        'mobile_clear_both' => '',
        'pull_right' => '',
        'width' => '',
        'offset' => '',
        'brando_column_animation_style' => '',
        'brando_column_animation_duration' => '',
        'fullscreen' => '',
        'id' => '',
		'class' => '',
		'position_relative' => '',
		'overflow_hidden' => '',
		'show_overlay' => '',
		'brando_overlay_opacity' => '',
		'brando_column_overlay_color' => '',
	), $atts ) );
	// Define Empty Variables.
	$output = $class_list = $style_property = $column_border_pos = $style_attr = $min_height_class = '';
	$classes = $style_array = array();
	// Specify Column default class
	$classes[] = 'wpb_column vc_column_container';
	$position_relative = ( $position_relative == 1 ) ? $classes[] = 'position-relative' : '';
	$overflow_hidden = ( $overflow_hidden == 1 ) ? $classes[] = 'overflow-hidden' : '';
	$fullscreen = ( $fullscreen == 1 ) ? $classes[] = 'full-screen' : '';
	// Column Offset and sm width
	if($width != ''){
		$width = explode('/', $width);
    	$width = ( $width[0] != '1' ) ? $classes[] = 'col-sm-'.$width[0] * floor(12 / $width[1]) : $classes[] = 'col-sm-'.floor(12 / $width[1]);
	}
	$offset = ( $offset ) ? str_replace( 'vc_', '', $offset ) : '';
	if(strchr($offset,'col-xs')){
		$classes[] = $offset;
	}else{
		$classes[] = $offset." col-xs-mobile-fullwidth";
	}

	// Column Id And Class.
	$id = ( $id ) ? ' id="'.$id.'"' : '';
	$class = ( $class ) ? $classes[] = $class : '';

	if( $enable_clear_both == 1 ){
		$desktop_clear_both = ( $desktop_clear_both ) ? $classes[] = $desktop_clear_both : '';
		$desktop_mini_clear_both = ( $desktop_mini_clear_both ) ? $classes[] = $desktop_mini_clear_both : '';
		$ipad_clear_both = ( $ipad_clear_both ) ? $classes[] = $ipad_clear_both : '';
		$mobile_clear_both = ( $mobile_clear_both ) ? $classes[] = $mobile_clear_both : '';
	}
	$centralized_div = ( $centralized_div == 1 ) ? $classes[] = 'center-col' : '';
	$pull_right = ( $pull_right ) ? $classes[] = 'pull-right': ''; 
	// Column without container
	$column_full = ( $column_full ) ? $column_full : '';

	// Column Animation 
	$brando_column_animation_style = ( $brando_column_animation_style ) ? $classes[] =' wow '.$brando_column_animation_style : '';
	$brando_column_animation_duration = ( $brando_column_animation_duration ) ? ' data-wow-duration= '.$brando_column_animation_duration.'ms' : '';

	// Column Allignment settings
	$alignment_setting = ( $alignment_setting ) ? $alignment_setting : '';
	if( $alignment_setting ){
		$desktop_alignment = ( $desktop_alignment ) ? $classes[] = $desktop_alignment : '';
		$desktop_mini_alignment = ( $desktop_mini_alignment ) ? $classes[] = $desktop_mini_alignment : '';
		$ipad_alignment = ( $ipad_alignment ) ? $classes[] = $ipad_alignment : '';
		$mobile_alignment = ( $mobile_alignment ) ? $classes[] = $mobile_alignment : '';
	}

	// Set min-height
		$min_height = ( $min_height ) ? $min_height : '';
		if( $min_height ){
			$style_array[] = 'min-height:'.$min_height.';';
			$min_height_class .= ' column-min-height';
		}

	// Column Border Settings

	$border_setting = ( $border_setting ) ? $border_setting : '';
	if( $border_setting == 1 ){
	    $desktop_show_border = ( $desktop_show_border ) ? $desktop_show_border : '';
	    $desktop_border_type = ( $desktop_border_type ) ? $desktop_border_type : '';
	    if( $desktop_show_border && $desktop_border_type && $desktop_border_type != 'no-border' ){
		    $column_border_pos .= $desktop_border_type.': ';
			if( $desktop_border_type ){
			    $column_border_size = ( $column_border_size ) ? $column_border_pos .= $column_border_size : $column_border_pos .= '1px';
			    $column_border_type = ( $column_border_type ) ? $column_border_pos .= ' '.$column_border_type : $column_border_pos .= ' solid';
			    $column_border_color = ( $column_border_color ) ? $column_border_pos .= ' '.$column_border_color.';' : $column_border_pos .= ' #e5e5e5;';
			}
			$style_array[] = $column_border_pos;
		}else{
			if( $desktop_border_type ){
				$classes[] = $desktop_border_type;
			}
		}
	    $ipad_border = ( $ipad_border != 1 ) ? $classes[] = 'sm-no-border': '';
	    $mobile_border = ( $mobile_border != 1 ) ? $classes[] = 'xs-no-border' : '';
	}

	// Section Padding Settings
	$padding_setting = ( $padding_setting ) ? $padding_setting : '';
	if( $padding_setting ){
		$desktop_padding = ( $desktop_padding ) ? $desktop_padding : '';
		$custom_desktop_padding = ( $custom_desktop_padding ) ? $custom_desktop_padding : '';
		if($desktop_padding == 'custom-desktop-padding' && $custom_desktop_padding){
			$style_array[] = "padding: ".$custom_desktop_padding.";";
		}else{
			if( $desktop_padding ) {
				$classes[] = $desktop_padding;
			}
		}
		$desktop_mini_padding = ( $desktop_mini_padding ) ? $classes[] = $desktop_mini_padding : '';
		$ipad_padding = ( $ipad_padding ) ? $classes[] = $ipad_padding : '';
		$mobile_padding = ( $mobile_padding ) ? $classes[] = $mobile_padding : '';
	}

	// Section Margin Settings
	$margin_setting = ( $margin_setting ) ? $margin_setting : '';
	if( $margin_setting ){
		$desktop_margin = ( $desktop_margin ) ? $desktop_margin : '';
		$custom_desktop_margin = ( $custom_desktop_margin ) ? $custom_desktop_margin : '';
		if( $desktop_margin == 'custom-desktop-margin' && $custom_desktop_margin ){
			$style_array[] = "margin: ".$custom_desktop_margin.";";
		}else{
			if( $desktop_margin ) {
				$classes[] .= $desktop_margin;
			}
		}
		$desktop_mini_margin = ( $desktop_mini_margin ) ? $classes[] = $desktop_mini_margin : '';
		$ipad_margin = ( $ipad_margin ) ? $classes[] = $ipad_margin : '';
		$mobile_margin = ( $mobile_margin ) ? $classes[] = $mobile_margin : '';
	}

	// Column Display setting
	$display_setting = ($display_setting) ? $display_setting : '';
	if( $display_setting ){
	    $desktop_display = ($desktop_display) ? $classes[] = $desktop_display : '';
	    $ipad_display = ($ipad_display) ? $classes[] = $ipad_display : '';
	    $mobile_display = ($mobile_display) ? $classes[] = $mobile_display : '';
	}

	// Check Column Type .
	$column_style = ( $column_style ) ? $column_style : '';

	switch ( $column_style ) {
		case 'color':
			$column_bg_color = ( $column_bg_color ) ? $style_array[] = 'background-color:'.$column_bg_color.';' : '';
		break;
		case 'image':
			$image_url = wp_get_attachment_url( $column_bg_image );
			$brando_overlay_opacity_att = ($brando_overlay_opacity) ? ' opacity:'.$brando_overlay_opacity.';' : '';
			$brando_column_overlay_color_att = ($brando_column_overlay_color) ? ' background-color:'.$brando_column_overlay_color.';' : '';
			$column_bg_image_property = ($image_url) ? $style_array[] = 'background: url('.$image_url.');' : '';
			$column_image_type = ( $column_image_type == 'parallax' ) ? $classes[] = 'parallax-fix' : '';
			$column_parallax_image_type = ( $column_parallax_image_type ) ? $classes[] = $column_parallax_image_type : '';
			$column_bg_image_type = ( $column_bg_image_type ) ? $classes[] = $column_bg_image_type : '';
		break;
	}

	// Class List
	$class_list = implode(" ", $classes);
	$column_class = ( $class_list ) ? ' class="'.$class_list.'"' : '';

	// Style Property List
	$style_property_list = implode(" ", $style_array);
	$style_property = ( $style_property_list ) ? ' style="'.$style_property_list.'"' : '';

	if( $column_full ){
		$output .= do_shortcode( $content );
	}else{
		// Baground Image Border
		$column_image_border_color = ( $column_image_border_color ) ? ' style="border-color:'.$column_image_border_color.' !important"' : '';
		$column_border = ( $column_image_border == 1 ) ? '<div class="img-border img-border-medium border-color-white z-index-0"'.$column_image_border_color.'></div>' : '';

		$output .= '<div'.$id.$column_class.$style_property.$brando_column_animation_duration.'>';
			if($show_overlay=='1'){
				$output .= '<div class="opacity-full" style="'.$brando_overlay_opacity_att.$brando_column_overlay_color_att.'"></div>';
			}
			$output .= $column_border;
			$output .= '<div class="vc-column-innner-wrapper">';
				$output .= '<div class="wpd-innner-wrapper">';
					$output .= do_shortcode( $content );
				$output .= '</div>';
			$output .= '</div>';
		$output .= '</div>';
	}

	return $output;
}
add_shortcode( 'vc_column', 'vc_column' );
add_shortcode( 'vc_column_inner', 'vc_column' );
?>