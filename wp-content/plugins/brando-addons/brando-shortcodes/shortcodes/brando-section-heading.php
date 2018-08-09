<?php
/**
 * Shortcode For Section Heading
 *
 * @package Brando
 */
?>
<?php
/*-----------------------------------------------------------------------------------*/
/* Section Heading */
/*-----------------------------------------------------------------------------------*/

if ( ! function_exists( 'brando_section_heading' ) ) {
	function brando_section_heading( $atts, $content = null ) 
	{
		extract( shortcode_atts( array(
	            'brando_heading_type' => '',
	        	'brando_heading' => '',
	        	'brando_text_color' => '',
	        	'brando_heading_tag' => '',
	        	'brando_heading_text_color' => '',
	        	'margin_setting' => '',
		        'desktop_margin' => '',
		        'custom_desktop_margin' => '',
		        'ipad_margin' => '',
		        'mobile_margin' => '',
		        'padding_setting' => '',
	        	'desktop_padding' => '',
	        	'ipad_padding' => '',
	        	'mobile_padding' => '',
	        	'custom_desktop_padding' => '',
	        	'font_size' => '',
	        	'line_height' => '',
	        	'font_weight' => '',
	        	'text_transform' => '',
	        	'brando_enable_seperator' => '',
	        	'brando_sep_color' => '',
	        	'separator_height' => '',
		        'id' => '',
		        'class' => '',
	        ), $atts ) );
		$output = $style = $sep_style = '';
		$classes = $style_array = array();
		switch ($brando_text_color) {
			case 'black-text':
					$classes[] = ' black-text';
				break;

			case 'white-text':
					$classes[] = ' white-text';
				break;

			case 'custom':
	                $classes[] = '';
					$style_array[] = 'color:'.$brando_heading_text_color.' !important;';
				break;
			
			default:
				break;
		}

		$id = ( $id ) ? ' id="'.$id.'"' : '';
		$class = ( $class ) ? $classes[] = $class : '';
		$brando_heading_tag = ( $brando_heading_tag ) ? $brando_heading_tag : 'h1';
		
		$font_weight = ($font_weight) ? $style_array[] = 'font-weight:'.$font_weight.' !important;;' : '';
		$font_size = ($font_size) ? $style_array[] = 'font-size:'.$font_size.' !important;' : '';
		$line_height = ($line_height) ? $style_array[] = 'line-height:'.$line_height.' !important;' : '';
		$line_height = ($text_transform) ? $style_array[] = 'text-transform:'.$text_transform.' !important;' : '';
		$brando_heading_type = ( $brando_heading_type ) ? $classes[] = $brando_heading_type : '';

	    $brando_sep_color = ( $brando_sep_color ) ? 'background:'.$brando_sep_color.' !important; ' : ''; 
        $brando_seperator_height = ( $separator_height ) ? 'height:'.$separator_height.' !important;' : ''; 
        if( $brando_sep_color || $brando_seperator_height){
            $sep_style .= ' style="'.$brando_sep_color.$brando_seperator_height.'"';
        }
	        
	    /* Replace || to br in title */
	    $brando_heading = ( $brando_heading ) ? str_replace('||', '<br />',$brando_heading) : '';

		// Column Margin settings
		$margin_setting = ( $margin_setting ) ? $margin_setting : '';
		$desktop_margin = ( $desktop_margin ) ? $desktop_margin : '';
		$ipad_margin = ( $ipad_margin ) ? $classes[] = $ipad_margin : '';
		$mobile_margin = ( $mobile_margin ) ? $classes[] = $mobile_margin : '';
		$custom_desktop_margin = ( $custom_desktop_margin ) ? $custom_desktop_margin : '';
		if($desktop_margin == 'custom-desktop-margin' && $custom_desktop_margin)
		{
			$style_array[] = "margin: ".$custom_desktop_margin.";";

		}else{
	            if( $desktop_margin )
	            {
					$classes[] = $desktop_margin;
	            }
		}
		
		// Column Padding settings
		$padding_setting = ( $padding_setting ) ? $padding_setting : '';
		$desktop_padding = ( $desktop_padding ) ? $desktop_padding : '';
		$ipad_padding = ( $ipad_padding ) ? $classes[] = $ipad_padding : '';
		$mobile_padding = ( $mobile_padding ) ? $classes[] = $mobile_padding : '';
		$custom_desktop_padding = ( $custom_desktop_padding ) ? $custom_desktop_padding : '';
		if($desktop_padding == 'custom-desktop-padding' && $custom_desktop_padding)
		{
			$style_array[] = "padding: ".$custom_desktop_padding.";";

		}else{

            if ( $desktop_padding )
            {
				$classes[] = $desktop_padding;
            }
		}

		$style_property_list = implode(" ", $style_array);
        $style = ( $style_property_list ) ? ' style="'.$style_property_list.'"' : '';
		$class_attr = implode(" ", $classes);
		$cl_list = ( $class_attr ) ? ' '.$class_attr : '';
       	
		switch ($brando_heading_type) 
		{
			case 'heading-style1':
		        $output .='<div class="margin-ten no-margin-lr clearfix">';
					$output .='<'.$brando_heading_tag.$id.' class="alt-font'.$cl_list.'"'.$style.'>';
						$output .= $brando_heading;
		            $output .='</'.$brando_heading_tag.'>';
	            $output .= '</div>';
	        break;

			case 'heading-style2':
		        $output .='<span '.$id.' class="alt-font text-uppercase element-title'.$cl_list.'"'.$style.'>'.$brando_heading.'</span>';
	            if($brando_enable_seperator == 1){
	            	$output .='<div class="bg-fast-yellow separator-line-thick center-col no-margin-top"'.$sep_style.'></div>';
	            }
            break;

            case 'heading-style3':
            case 'heading-style5':
            case 'heading-style6':
            case 'heading-style9':
            case 'heading-style10':
            case 'heading-style11':
            case 'heading-style13':
				$output .='<'.$brando_heading_tag.$id.' class="alt-font'.$cl_list.'"'.$style.'>';
					$output .= $brando_heading;
	            $output .='</'.$brando_heading_tag.'>';
			break;

			case 'heading-style4':
				$output .='<'.$brando_heading_tag.$id.' class="alt-font font-weight-600 title-thick-underline border-color-fast-yellow display-inline-block letter-spacing-2'.$cl_list.'"'.$style.'>';
					$output .= $brando_heading;
	            $output .='</'.$brando_heading_tag.'>';
			break;

			case 'heading-style7':
				$output .='<'.$brando_heading_tag.$id.' class="alt-font'.$cl_list.'"'.$style.'>';
					$output .= '<span class="crimson-red-text">/</span> '.$brando_heading;
	            $output .='</'.$brando_heading_tag.'>';
			break;

			case 'heading-style8':
				$output .='<span '.$id.' class="title-medium deep-pink-dark-text text-uppercase alt-font title-dividers font-weight-600 position-relative'.$cl_list.'"'.$style.'>'.$brando_heading.'</span>';
			break;

			case 'heading-style12':
				$output .='<'.$brando_heading_tag.$id.' class="alt-font'.$cl_list.'"'.$style.'>';
					if($brando_enable_seperator == 1){
						$output .= '<span class="bg-deep-green event-title-separator"'.$sep_style.'></span>';
					}
					$output .= $brando_heading;
	            $output .='</'.$brando_heading_tag.'>';
			break;
		}

	  return $output;
	}
}
add_shortcode("brando_section_heading","brando_section_heading");
?>