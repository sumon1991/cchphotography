<?php
/**
 * Shortcode For Award Box
 *
 * @package Brando
 */
?>
<?php 
/*-----------------------------------------------------------------------------------*/
/* Award Box */
/*-----------------------------------------------------------------------------------*/

function brando_award_box_shortcode( $atts, $content = null ) {
    extract( shortcode_atts( array(
               'brando_year' => '',
               'brando_year_color' => '',
            ), $atts ) );

    $output  = '';
    $classes = array();
    
    $brando_year = ( $brando_year ) ? $brando_year : '';
    $brando_year_color = ( $brando_year_color ) ? ' style="color:'.$brando_year_color.' !important;"': '';

    $class_list = implode(" ", $classes);

    $output  .= '<span class="alt-font title-small letter-spacing-1 text-right display-block awards-year margin-ten-bottom"'.$brando_year_color.'>'.esc_html__('/ ').$brando_year.'</span>';
    $output  .= '<div class="col-md-12 col-sm-12 col-xs-12 no-padding">';
        $output .= do_shortcode($content);
    $output  .= '</div>';

    return $output;
}
add_shortcode( 'brando_award_box', 'brando_award_box_shortcode' );
 
function brando_award_box_content_shortcode( $atts, $content = null) {
	global $brando_slider_parent_type;
    extract( shortcode_atts( array(
                'brando_image' => '',
                'brando_title' => '',
                'brando_title_color' => '',
                'show_separator' => '',
                'separator_color' => '',
                'separator_height' => '',
            ), $atts ) );
    $output = $sep_style = '';
    $style_array = array();
    $thumb = wp_get_attachment_image_src($brando_image, 'full');
    $brando_title = ( $brando_title ) ? $brando_title : '';
    $brando_title_color = ( $brando_title_color ) ? ' style="color:'.$brando_title_color.' !important;"' : '';

    $separator_color = ( $separator_color ) ? $style_array[] = 'background:'.$separator_color.' !important;': '';
    $separator_height = ( $separator_height ) ? $style_array[] = 'height:'.$separator_height.' !important;': '';

    $style_property_list = implode(" ", $style_array);
    $sep_style = ( $style_property_list ) ? ' style="'.$style_property_list.'"' : '';
    
    /* Image Alt, Title, Caption */
    $img_alt = brando_option_image_alt($brando_image);
    $img_title = brando_option_image_title($brando_image);
    $image_alt = ( isset($img_alt['alt']) && !empty($img_alt['alt']) ) ? ' alt="'.$img_alt['alt'].'"' : ' alt=""' ; 
    $image_title = ( isset($img_title['title']) && !empty($img_title['title']) ) ? ' title="'.$img_title['title'].'"' : '';

    $output .= '<div class="col-md-6 col-sm-12 col-xs-12 clearfix margin-five-bottom">';
        $output .= '<div class="col-md-4 col-sm-3 col-xs-4 no-padding-left">';
        if( $thumb[0] ){
            $output .= '<img src="'.$thumb[0].'"'.$image_alt.$image_title.'/>';
        }
        $output .= '</div>';
        $output .= '<div class="col-md-8 col-sm-9 col-xs-8 position-relative top-minus4 no-padding">';
            if( $brando_title ){
                $output .= '<span class="text-uppercase alt-font display-block"'.$brando_title_color.'>'.$brando_title.'</span>';
            }
            $output .= do_shortcode( brando_remove_wpautop($content) );
            if( $show_separator == 1 ){
                $output .= '<div class="separator-line bg-mid-gray2 no-margin-left sm-no-margin-bottom sm-margin-four-all sm-no-margin-lr"'.$sep_style.'></div>';
            }
        $output .= '</div>';
    $output .= '</div>';

    return $output;
}
add_shortcode( 'brando_award_box_content', 'brando_award_box_content_shortcode' );
?>