<?php
/**
 * Shortcode For Simple Image
 *
 * @package Brando
 */
?>
<?php
/*-----------------------------------------------------------------------------------*/
/* Simple Image */
/*-----------------------------------------------------------------------------------*/

if ( ! function_exists( 'brando_simple_image_shortcode' ) ) {
    function brando_simple_image_shortcode( $atts, $content = null ) {
    	extract( shortcode_atts( array(
            	'id' => '',
            	'class' => '',
            	'brando_image' => '',
                'brando_mobile_full_image' => '',
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
                'brando_url' => '',
                'brando_target_blank' => '',
                'brando_show_image_caption' => '',
                'brando_image_caption_position' => '',
                'brando_image_caption_text_alignment' => '',
            ), $atts ) );

    	$output = $padding = $margin = $padding_style = $margin_style = $style_attr = $style = '';
        $id = ( $id ) ? ' id="'.$id.'"' : '';
        $classes = $style_array = array();
        $class = ( $class ) ? $classes[] = $class : '';
        $brando_mobile_full_image = ($brando_mobile_full_image == 1) ? $classes[] = 'xs-img-full' : '';
        $brando_url = ( $brando_url ) ? $brando_url : '';
        $brando_target_blank = ( $brando_target_blank == 1 ) ? ' target="_blank"': '';

        /* Add image caption */
        $brando_show_image_caption = ( $brando_show_image_caption ) ? $brando_show_image_caption : '';
        $brando_image_caption_position = ( $brando_image_caption_position ) ? $brando_image_caption_position : 'image-caption-bottom';
        $brando_image_caption_text_alignment = ( $brando_image_caption_text_alignment ) ? ' '.$brando_image_caption_text_alignment : ' text-left';
        
        // Column Padding settings
        $padding_setting = ( $padding_setting ) ? $padding_setting : '';
        $desktop_padding = ( $desktop_padding ) ? $desktop_padding : '';
        $ipad_padding = ( $ipad_padding ) ? $classes[] = $ipad_padding : '';
        $mobile_padding = ( $mobile_padding ) ? $classes[] = $mobile_padding : '';
        $custom_desktop_padding = ( $custom_desktop_padding ) ? $custom_desktop_padding : '';
        if($desktop_padding == 'custom-desktop-padding' && $custom_desktop_padding){
                $style_array[] = "padding: ".$custom_desktop_padding.";";
        }else{
               $classes[] = $desktop_padding;
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
                $classes[] = $desktop_margin;
        }
        
        $class_list = implode(" ", $classes);
        $class_attr = ( $class_list ) ? ' class="'.$class_list.'"' : '';

        $style_property_list = implode(" ", $style_array);
        $style_atrr = ( $style_property_list ) ? ' style="'.$style_property_list.'"' : '';
 
        $brando_image = ( $brando_image ) ? $brando_image : '';
        if(is_attachment($brando_image)){
            $attachment = get_post( $brando_image );
            $img_caption = array(
                'caption' => $attachment->post_excerpt,
            );
        }
        $img_caption = ( isset($img_caption['caption']) && !empty($img_caption['caption']) ) ? $img_caption['caption'] : '' ;

        /* Image Alt, Title, Caption */
        $img_alt = brando_option_image_alt($brando_image);
        $img_title = brando_option_image_title($brando_image);
        $image_alt = ( isset($img_alt['alt']) && !empty($img_alt['alt']) ) ? 'alt="'.$img_alt['alt'].'"' : 'alt=""' ; 
        $image_title = ( isset($img_title['title']) && !empty($img_title['title']) ) ? ' title="'.$img_title['title'].'"' : '';
        $thumb = wp_get_attachment_image_src($brando_image, 'full');

        if( $brando_show_image_caption == 1 ) {
            $output .= '<figure class="brando-image-caption" id="attachment_'.$brando_image.'">';
            if( $img_caption && $brando_image_caption_position == 'image-caption-top' ) {
                $output .= '<figcaption class="wp-caption-text'.$brando_image_caption_text_alignment.'">'.$img_caption.'</figcaption>';
            }
        }
        if( $brando_url ){
            $output .= '<a href="'.$brando_url.'"'.$brando_target_blank.'>';
        }
        if ( $thumb[0] ){
            $output .= '<img src="'.$thumb[0].'" width="'.$thumb[1].'" height="'.$thumb[2].'"'.$class_attr.$style_atrr.$id.' '.$image_alt.$image_title.'/>';
        }
        if( $brando_url ){
            $output .= '</a>';
        }
        if( $brando_show_image_caption == 1 ) {
            if( $img_caption && $brando_image_caption_position == 'image-caption-bottom' ) {
                $output .= '<figcaption class="brando-image-caption'.$brando_image_caption_text_alignment.'">'.$img_caption.'</figcaption>';
            }
            $output .= '</figure>';
        }
      
        return $output;
    }
}
add_shortcode('brando_simple_image','brando_simple_image_shortcode');
?>