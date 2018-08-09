<?php
/**
 * Shortcode For Text Block
 *
 * @package Brando
 */
?>
<?php
/*-----------------------------------------------------------------------------------*/
/* Text Block */
/*-----------------------------------------------------------------------------------*/

if ( ! function_exists( 'vc_column_text' ) ) {
    function vc_column_text( $atts, $content = null ) {
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
        ), $atts ) );
        
        $output = $padding = $margin = $padding_style = $margin_style = $style_attr = $style = $class_attr = $cl_attr = '';
        $classes = $style_array = array();
        $id = ($id) ? ' id='.$id : '';
        $class = ($class) ? $classes[] = $class : ''; 

        // Column Padding settings
        $padding_setting = ( $padding_setting ) ? $padding_setting : '';
        $desktop_padding = ( $desktop_padding ) ? $desktop_padding : '';
        $ipad_padding = ( $ipad_padding ) ? $classes[] = $ipad_padding : '';
        $mobile_padding = ( $mobile_padding ) ? $classes[] = $mobile_padding : '';
        $custom_desktop_padding = ( $custom_desktop_padding ) ? $custom_desktop_padding : '';
        if($desktop_padding == 'custom-desktop-padding' && $custom_desktop_padding)
        {
            $style_array[] = "padding: ".$custom_desktop_padding.";";
        }else {
            if( $desktop_padding ) {
                $classes[] = $desktop_padding;
            }
        }
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
            if( $desktop_margin ) {
                $classes[] = $desktop_margin;
            }
        }

        if(!empty($classes)){
            $class_attr = implode(" ", $classes);
        }
        $style_property_list = implode(" ", $style_array);
        $style = ( $style_property_list ) ? ' style="'.$style_property_list.'"' : '';
        if(!empty($class_attr)){
            $cl_attr = ' class="'.$class_attr.'"';
        }
        if( $id || $cl_attr || $style){    
            $output .='<div'.$id.$cl_attr.$style.'>';  
        }
        $output.= do_shortcode( brando_remove_wpautop($content) );
            
        if( $id || $cl_attr || $style){
            $output .='</div>';
        }
        return $output;
    }
}
add_shortcode( 'vc_column_text', 'vc_column_text' );
?>