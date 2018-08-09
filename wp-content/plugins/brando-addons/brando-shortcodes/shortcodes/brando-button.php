<?php
/**
 * Shortcode For Button
 *
 * @package Brando
 */
?>
<?php
/*-----------------------------------------------------------------------------------*/
/* Button */
/*-----------------------------------------------------------------------------------*/

if ( ! function_exists( 'brando_button_shortcode' ) ) {
    function brando_button_shortcode( $atts, $content = null ) {
        extract( shortcode_atts( array(
            'button_style' =>'',
            'button_type' => '',
            'button_version_type' => '',
            'button_icon' => '',
            'button_text' => '',
            'button_sub_text' => '',
            'padding_setting' => '',
            'desktop_padding' => '',
            'custom_desktop_padding' => '',
            'ipad_padding' => '',
            'mobile_padding' => '',
            'margin_setting' => '',
            'desktop_margin' => '',
            'custom_desktop_margin' => '',
            'ipad_margin' => '',
            'mobile_margin' => '',
            'brando_column_animation_style' => '',
            'class' => '',
            'id' => '',
                ), $atts ) );
        $output =  $style_attr = $style = '';
        $classes = $style_array = array();
        $main_class = ($class) ? $classes[] = $class : '';
        $id = ($id) ? 'id="'.$id.'"' : '';
        $first_button_parse_args = vc_parse_multi_attribute($button_text);
        $first_button_link = ( isset($first_button_parse_args['url']) ) ? $first_button_parse_args['url'] : '#';
        $first_button_title = ( isset($first_button_parse_args['title']) ) ? $first_button_parse_args['title'] : 'sample button';
        $first_button_target = ( isset($first_button_parse_args['target']) ) ? trim($first_button_parse_args['target']) : '_self';
        $brando_column_animation_style = ( $brando_column_animation_style ) ? $classes[] ='wow '.$brando_column_animation_style : '';
        $class= $icon='';
        // Column Padding settings
    	$padding_setting = ( $padding_setting ) ? $padding_setting : '';
    	$desktop_padding = ( $desktop_padding ) ?  $desktop_padding : '';
    	$ipad_padding = ( $ipad_padding ) ? $classes[] = $ipad_padding : '';
    	$mobile_padding = ( $mobile_padding ) ? $classes[] = $mobile_padding : '';
    	$custom_desktop_padding = ( $custom_desktop_padding ) ? $custom_desktop_padding : '';
    	if($desktop_padding == 'custom-desktop-padding' && $custom_desktop_padding){
    		$style_array[] .= "padding: ".$custom_desktop_padding.";";
    	}else{
            if( $desktop_padding ){
    		  $classes[] = $desktop_padding;
            }
    	}
    	
    	// Column Margin settings
    	$margin_setting = ( $margin_setting ) ? $margin_setting : '';
    	$desktop_margin = ( $desktop_margin ) ? $desktop_margin : '';
    	$ipad_margin = ( $ipad_margin ) ? $classes[] = $ipad_margin : '';
    	$mobile_margin = ( $mobile_margin ) ? $classes[] = $mobile_margin : '';
    	$custom_desktop_margin = ( $custom_desktop_margin ) ? $custom_desktop_margin : '';
    	if($desktop_margin == 'custom-desktop-margin' && $custom_desktop_margin){
    		$style_array[] = "margin: ".$custom_desktop_margin.";";
    	}else{
            if( $desktop_margin ){
    		  $classes[] = $desktop_margin;
            }
    	}
    	
        $style_property_list = implode(" ", $style_array);
        $style_attr = ( $style_property_list ) ? ' style="'.$style_property_list.'"' : '';
        
        // For Button Style
        switch ($button_style) {
            case 'style1':
            	$icon = $first_button_title;
                $classes[] = "highlight-button";
            break;

            case 'style2':
            	$icon = $first_button_title;
                $classes[]= "highlight-button-dark";
            break;

            case 'style3':
            	$icon = $first_button_title;
                $classes[] = "btn-small-white-background";
            break;

            case 'style4':
            	$icon = $first_button_title;
                $classes[] = "highlight-button btn-round";
            break;

            case 'style5':
            	$icon = $first_button_title;
                $classes[] = "highlight-button-dark btn-round";
            break;

            case 'style6':
            	$icon = $first_button_title;
                $classes[] = "btn-small-white-background btn-round";
            break;

            case 'style7':
            	$icon = $first_button_title;
                $classes[] = "highlight-button-black-border";
            break;

            case 'style8':
            	$icon = $first_button_title;
                $classes[] = "btn-small-white";
            break;

            case 'style9':
            	$icon = $first_button_title;
                $classes[] = "btn-small-white-dark";
            break;

            case 'style10':
            	$icon = $first_button_title;
                $classes[] = "btn-small-white btn-round";
            break;

            case 'style11':
            	$icon = $first_button_title;
                $classes[] = "btn-small-white-dark btn-round";
            break;

            case 'style12':
            	$icon = $first_button_title;
                $classes[] = "btn-small-black-border-light";
            break;

            case 'style13':
            	$icon = $first_button_title;
                $classes[] = "btn-small-black-border-light btn-round";
            break;

            case 'style14':
            	$icon = $first_button_title;
                $classes[] = "btn-very-small-white";
            break;

            case 'style15':
            	$icon = $first_button_title;
                $classes[] = "btn-very-small-white btn-round";
            break;

            case 'style16':
            	$icon = '<i class="'.$button_icon.'"></i>'.$first_button_title;
                $classes[] = "highlight-button";
            break;

            case 'style17':
            	$icon = '<i class="'.$button_icon.'"></i>'.$first_button_title;
                $classes[] = "highlight-button-dark";
            break;

            case 'style18':
            	$icon = '<i class="'.$button_icon.'"></i>'.$first_button_title;
                $classes[] = "btn-small-white-background";
            break;

            case 'style19':
                     $icon = $first_button_title;
            break;

            case 'style20':
            	$icon = '<i class="'.$button_icon.' btn-round"></i>';
                $classes[] = "social-icon";
            break;

            case 'style21':
            	$icon = '<i class="'.$button_icon.'"></i>';
                $classes[] = "social-icon social-icon-large button";            
            break;

            case 'style22':
            	$icon = $first_button_title.'<span>'.$button_sub_text.'</span>';
                $classes[] = "button-3d btn-large button-desc";
            break;

            case 'style23':
            	$icon = $first_button_title;
                $classes[] = "button-3d btn-round";
            break;
            
        }
        // For Button Type
        switch ($button_type) {
            case 'large':
                $classes[] = "btn-large";
            break;

            case 'medium':
                $classes[] = "btn-medium ";
            break;

            case 'small':
                $classes[] = "btn-small ";
            break;

            case 'vsmall':
                $classes[] = "btn-very-small ";
            break;
        }
        // For Button Version
        switch ($button_version_type) {
            case 'primary':
                $classes[] = "btn-primary btn-round ";
                
            break;

            case 'success':
                $classes[] = "btn-success btn-round ";
            break;

            case 'info':
                $classes[] = "btn-info btn-round ";
            break;

            case 'warning':
                $classes[] = "btn-warning btn-round ";
            break;
            
            case 'danger':
                $classes[] = "btn-danger btn-round ";
            break;
        }

        $class_list = implode(" ", $classes);
        $btn_class = ( $class_list ) ? ' '.$class_list : '';

        $output .= '<a '.$id.' href="'.esc_url($first_button_link).'" target="'.esc_attr($first_button_target).'" class="inner-link'.$btn_class.' button btn alt-font"'.$style_attr.'>'.$icon.'</a>';
        
        return $output;
    }
}
add_shortcode( 'brando_button', 'brando_button_shortcode' );
?>