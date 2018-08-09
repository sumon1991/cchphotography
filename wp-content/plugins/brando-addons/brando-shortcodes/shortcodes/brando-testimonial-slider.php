<?php
/**
 * Shortcode For Slider
 *
 * @package Brando
 */
?>
<?php 
/*-----------------------------------------------------------------------------------*/
/* Slider */
/*-----------------------------------------------------------------------------------*/

$brando_slider_parent_type = '';
function brando_testimonial_slider_shortcode( $atts, $content = null ) {
    extract( shortcode_atts( array(
                'show_pagination' => '',
                'show_pagination_style' => '',
                'show_navigation' => '',
                'show_navigation_style' => '',
                'show_cursor_color_style' => '',
                'transition_style' => '',
                'show_pagination_color_style' => '',
                'autoplay' => '',
                'stoponhover' => '',
                'slidespeed' => '',
                'brando_slider_id' => '',
                'brando_slider_class' => '',
            ), $atts ) );

    $output  = $slider_config = $slider_class ='';
    $transition_style = ( $transition_style ) ? $transition_style : '';
    $pagination = ($show_pagination_style) ? brando_owl_pagination_slider_classes($show_pagination_style) : brando_owl_pagination_slider_classes('default');
	$pagination_style = ($show_pagination_color_style) ? brando_owl_pagination_color_classes($show_pagination_color_style) : brando_owl_pagination_color_classes('default');
    $navigation = ( $show_navigation_style ) ? brando_owl_navigation_slider_classes( $show_navigation_style) : brando_owl_navigation_slider_classes('default') ;
    $show_cursor_color_style = ( $show_cursor_color_style ) ? ' '.$show_cursor_color_style : ' cursor-black';

    // Check if slider id and class
    $brando_slider_id = ( $brando_slider_id ) ? $brando_slider_id : 'testimonial-slider';
    $brando_slider_class = ( $brando_slider_class ) ? $slider_class = ' '.$brando_slider_class : $slider_class = '';

	$output .= '<div id="'.$brando_slider_id.'" class="owl-carousel owl-theme bottom-pagination '.$brando_slider_id.$slider_class.$pagination.$pagination_style.$navigation.$show_cursor_color_style.$brando_slider_class.'">';
    	$output .= do_shortcode($content);
    $output .= '</div>';
        
    /* Add custom script Start*/
    $slidespeed = ( $slidespeed ) ? $slidespeed : '3000';
    ( $show_navigation == 1 ) ? $slider_config .= 'navigation: true,' : $slider_config .= 'navigation: false,';
	( $show_pagination == 1 ) ? $slider_config .= 'pagination: true,' : $slider_config .= 'pagination: false,';
	( $transition_style && $transition_style != 'slide') ? $slider_config .= 'transitionStyle: "'.$transition_style .'",' : '';
	( $autoplay == 1 ) ? $slider_config .= 'autoPlay: '.$slidespeed.',' : $slider_config .= 'autoPlay: false,';
	( $stoponhover == 1) ? $slider_config .= 'stopOnHover: true, ' : $slider_config .= 'stopOnHover: false, ';
	$slider_config .= 'singleItem: true,';
	$slider_config .= 'paginationSpeed: 400,';
	$slider_config .= 'navigationText: ["<i class=\'fa fa-angle-left\'></i>", "<i class=\'fa fa-angle-right\'></i>"]';
	ob_start();?>
    <script type="text/javascript">jQuery(document).ready(function () { jQuery("<?php echo '.'.$brando_slider_id;?>").owlCarousel({ <?php echo $slider_config;?> }); });</script>
	<?php 
	$script = ob_get_contents();
	ob_end_clean();

	$output .= $script;
	/* Add custom script End*/
    return $output;
}
add_shortcode( 'brando_testimonial_slider', 'brando_testimonial_slider_shortcode' );
 
function brando_testimonial_slider_content_shortcode( $atts, $content = null) {
	global $brando_slider_parent_type;
    extract( shortcode_atts( array(
                'brando_image' => '',
                'brando_title' => '',
                'brando_title_color' => '',
                'show_separator' => '',
                'separator_color' => '',
                'separator_height' => '',
                'show_stars' => '',
                'no_of_stars' => '',
                'star_color' => '',
                'brando_icon_size' => '',
            ), $atts ) );
    $output = $sep_style = $stars = '';
    $style_array = array();
    $brando_title = ( $brando_title ) ? $brando_title : '';
    /* Image Alt, Title, Caption */
    $img_alt = brando_option_image_alt($brando_image);
    $img_title = brando_option_image_title($brando_image);
    $image_alt = ( isset($img_alt['alt']) && !empty($img_alt['alt']) ) ? ' alt="'.$img_alt['alt'].'"' : ' alt=""' ; 
    $image_title = ( isset($img_title['title']) && !empty($img_title['title']) ) ? ' title="'.$img_title['title'].'"' : '';
    
    $thumb = wp_get_attachment_image_src($brando_image, 'full');
    $brando_icon_size = ( $brando_icon_size ) ? ' '.$brando_icon_size : '';
    $separator_color = ( $separator_color ) ? $style_array[] = 'background:'.$separator_color.' !important;': '';
    $separator_height = ( $separator_height ) ? $style_array[] = 'height:'.$separator_height.' !important;': '';
    $style_property_list = implode(" ", $style_array);
    $sep_style = ( $style_property_list ) ? ' style="'.$style_property_list.'"' : '';
    $brando_title_color = ( $brando_title_color ) ? ' style="color:'.$brando_title_color.' !important;"' : '';
    $star_color = ( $star_color ) ? ' style="color:'.$star_color.' !important;"' : '';
    
    $output .= '<div class="item">';
        $output .= '<div class="col-lg-9 col-md-11 col-sm-9 col-xs-10 center-col margin-lr-auto testimonial-style2">';
            if( $thumb[0] ){
                $output .= '<div class="col-md-5 col-sm-12 col-xs-12 testimonial-style2-img sm-text-center sm-margin-three-bottom">';
                    $output .= '<img src="'.$thumb[0].'"'.$image_alt.$image_title.'/>';
                $output .= '</div>';
            }
            $output .= '<div class="col-md-7 col-sm-12 col-xs-12 sm-text-center xs-no-padding-lr">';
                if($show_stars == 1)
                {
                    for($i=1; $i <= $no_of_stars; $i++)
                    {
                        $stars.='<i class="fa fa-star'.$brando_icon_size.'"'.$star_color.'></i>';
                    }
                    if($stars):
                        $output .= '<div>';
                            $output .= $stars;
                        $output .='</div>';
                    endif;
                }
                if( $brando_title ){
                    $output .= '<span class="margin-four-tb name alt-font"'.$brando_title_color.'>'.$brando_title.'</span>';
                }
                if( $content ){
                    $output .= do_shortcode( brando_remove_wpautop($content) );
                }
                if( $show_separator == 1 ){
                    $output .= '<div class="separator-line-thick bg-deep-yellow no-margin-lr sm-margin-lr-auto"'.$sep_style.'></div>';
                }
            $output .= '</div>';
        $output .= '</div>';
    $output .= '</div>';

    return $output;
}
add_shortcode( 'brando_testimonial_slider_content', 'brando_testimonial_slider_content_shortcode' );
?>