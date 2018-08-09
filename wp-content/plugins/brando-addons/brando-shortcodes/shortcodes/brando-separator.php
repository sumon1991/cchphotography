<?php
/**
 * Shortcode For Separator
 *
 * @package Brando
 */
?>
<?php
/*-----------------------------------------------------------------------------------*/
/* Separator */
/*-----------------------------------------------------------------------------------*/

if ( ! function_exists( 'brando_separator' ) ) {
    function brando_separator( $atts, $content = null ) {
        extract( shortcode_atts( array(
            'id' => '',
            'class' => '',
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
            'brando_sep_bg_color' => '',
            'brando_height' => '',
        ), $atts ) );
        
        $output = $style = '';
        $classes = $style_array = array();
        $id = ($id) ? ' id='.$id : '';
        $class = ($class) ? $classes[] = $class : ''; 
        $brando_sep_bg_color = ($brando_sep_bg_color) ? $style_array[] = 'background:'.$brando_sep_bg_color.';' : '';
        $brando_height = ($brando_height) ? $style_array[] = 'height:'.$brando_height.';' : '';

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

            $classes[] = $desktop_padding;
        }

        $margin_setting = ( $margin_setting ) ? $margin_setting : '';
        $desktop_margin = ( $desktop_margin ) ? $desktop_margin : '';
        $ipad_margin = ( $ipad_margin ) ? $classes[] = $ipad_margin : '';
        $mobile_margin = ( $mobile_margin ) ? $classes[] = $mobile_margin : '';
        $custom_desktop_margin = ( $custom_desktop_margin ) ? $custom_desktop_margin : '';
        if($desktop_margin == 'custom-desktop-margin' && $custom_desktop_margin)
        {
            $style_array[] = "margin: ".$custom_desktop_margin.";";

        }else{
                $classes[] = $desktop_margin;
        }
        $class_list = implode(" ", $classes);
        $class_attr = ( $class_list ) ? ' class="'.$class_list.'"' : '';

        $style_property_list = implode(" ", $style_array);
        $style = ( $style_property_list ) ? ' style="'.$style_property_list.'"' : '';

        $output .= '<div'.$id.$class_attr.$style.'></div>';
        return $output;
    }
}
add_shortcode( 'brando_separator', 'brando_separator' );
?>