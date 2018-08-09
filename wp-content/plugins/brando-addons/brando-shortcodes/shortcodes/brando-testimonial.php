<?php
/**
 * Shortcode For Testimonial
 *
 * @package Brando
 */
?>
<?php
/*-----------------------------------------------------------------------------------*/
/* Testimonial */
/*-----------------------------------------------------------------------------------*/

if ( ! function_exists( 'brando_testimonial' ) ) {
    function brando_testimonial( $atts, $content = null ) {
        extract( shortcode_atts( array(
            'id' => '',
            'class' => '',
            'brando_testimonial_premade_style' => '',
            'brando_author_name' => '',
            'brando_author_des' => '',
            'author_name_color' => '',
            'author_designation_color' => '',
            'brando_testimonial_quotes' => '',
            'brando_image' => '',
            'brando_testimonial_title' => '',
            'brando_facebook_url' => '',
            'brando_twitter_url' => '',
            'brando_gplus_url' => '',
            'brando_dribble_url' => '',
            'testimonial_title_color' => '',
            'button_config' => '',
            'padding_setting' => '',
            'desktop_padding' => '',
            'desktop_mini_padding' => '',
            'custom_desktop_padding' => '',
            'ipad_padding' => '',
            'mobile_padding' => '',
            'margin_setting' => '',
            'desktop_margin' => '',
            'custom_desktop_margin' => '',
            'desktop_mini_margin' => '',
            'ipad_margin' => '',
            'mobile_margin' => '',
        ), $atts ) );
        
        $output = '';
        $id = ( $id ) ? ' id="'.$id.'"' : '';
        $classes = $style_array = array();
        $class = ($class) ? $classes[] = $class : ''; 
        $brando_author_name = ( $brando_author_name ) ? $brando_author_name : '';
        $brando_author_des = ( $brando_author_des ) ? $brando_author_des : '';
        $brando_testimonial_quotes = ( $brando_testimonial_quotes ) ? $brando_testimonial_quotes : '';
        $author_name_color = ( $author_name_color ) ? ' style="color:'.$author_name_color.' !important;"': '';
        $author_designation_color = ( $author_designation_color ) ? ' style="color:'.$author_designation_color.' !important;"': '';
        $testimonial_title_color = ( $testimonial_title_color ) ? ' style="color:'.$testimonial_title_color.' !important;"': '';
        $brando_testimonial_title = ( $brando_testimonial_title ) ? $brando_testimonial_title : '';
        /* Image Alt, Title, Caption */
        $img_alt = brando_option_image_alt($brando_image);
        $img_title = brando_option_image_title($brando_image);
        $image_alt = ( isset($img_alt['alt']) && !empty($img_alt['alt']) ) ? ' alt="'.$img_alt['alt'].'"' : ' alt=""' ; 
        $image_title = ( isset($img_title['title']) && !empty($img_title['title']) ) ? ' title="'.$img_title['title'].'"' : '';

        // Section Padding Settings
        $padding_setting = ( $padding_setting ) ? $padding_setting : '';
        if( $padding_setting ){
            $desktop_padding = ( $desktop_padding ) ? $desktop_padding : '';
            $custom_desktop_padding = ( $custom_desktop_padding ) ? $custom_desktop_padding : '';
            if($desktop_padding == 'custom-desktop-padding' && $custom_desktop_padding){
                $style_array[] = "padding: ".$custom_desktop_padding.";";
            }else{
                $classes[] = $desktop_padding;
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
                $classes[] .= $desktop_margin;
            }
            $desktop_mini_margin = ( $desktop_mini_margin ) ? $classes[] = $desktop_mini_margin : '';
            $ipad_margin = ( $ipad_margin ) ? $classes[] = $ipad_margin : '';
            $mobile_margin = ( $mobile_margin ) ? $classes[] = $mobile_margin : '';
        }

        $style_property_list = implode(" ", $style_array);
        $style_property = ( $style_property_list ) ? ' style="'.$style_property_list.'"' : '';
        
        $brando_image = ( $brando_image ) ? $brando_image : '';
        $thumb = wp_get_attachment_image_src($brando_image, 'full');
        $class_list = implode(" ", $classes);
        $class_attr = ( $class_list ) ? ' '.$class_list : '';

        if ( (function_exists('vc_parse_multi_attribute') && $button_config)) 
        {
            $button_parse_args = vc_parse_multi_attribute($button_config);
            $button_link  = ( isset($button_parse_args['url']) ) ? $button_parse_args['url'] : '#';
            $button_title = ( isset($button_parse_args['title']) ) ? $button_parse_args['title'] : 'sample button';
            $button_target = ( isset($button_parse_args['target']) ) ? trim($button_parse_args['target']) : '_self';
        }

        switch ( $brando_testimonial_premade_style ) 
        {
            case 'testimonial-1':
                $output .='<div '.$id.' class="architecture-section'.$class_attr.'"'.$style_property.'>';
                    if( $content ){
                        $output .= '<div class="alt-font quote-style2 position-relative title-small white-text">';
                            $output .= do_shortcode( brando_remove_wpautop($content) );
                        $output .= '</div>';
                    }
                    if( $brando_author_name ){
                        $output .='<span class="text-uppercase white-text margin-nine-top display-block alt-font"'.$author_name_color.'>'.$brando_author_name.'</span>';
                    }
                    if( $brando_author_des ){
                        $output .='<span class="text-small text-uppercase black-text alt-font"'.$author_designation_color.'>'.$brando_author_des.'</span>';
                    }
                $output .='</div>';
            break;

            case 'testimonial-2':
                $output .='<div '.$id.' class="col-md-12 col-sm-12 col-xs-12 clearfix'.$class_attr.'"'.$style_property.'>';
                    if( $thumb[0] ){
                        $output .='<div class="col-md-3 col-sm-2 col-xs-2 no-padding">';
                            $output .='<img src="'.$thumb[0].'" width="'.$thumb[1].'" height="'.$thumb[2].'"'.$image_alt.$image_title.' class="position-relative top10 "/>';
                        $output .='</div>';
                    }
                    $output .='<div class="col-md-9 col-sm-9 col-xs-10 no-padding-right padding-eleven-left sm-padding-six-left">';
                        if( $brando_testimonial_quotes ){
                            $output .='<span class="title-big alt-font crimson-red-text line-height-none display-inherit">'.$brando_testimonial_quotes.'</span>';
                        }
                        if( $content ){
                            $output .= do_shortcode( brando_remove_wpautop($content) );
                        }
                        if( $brando_author_name ){
                            $output .='<span class="alt-font text-uppercase black-text display-block"'.$author_name_color.'>'.$brando_author_name.'</span>';
                        }
                        if( $brando_author_des ){
                            $output .='<span class="text-uppercase alt-font light-gray-text text-small"'.$author_designation_color.'>'.$brando_author_des.'</span>';
                        }
                    $output .='</div>';
                $output .='</div>';
            break;

            case 'testimonial-3':
                $output = '<div '.$id.' class="'.$class_attr.'"'.$style_property.'>';
                    $output .= '<div class="col-md-6 col-sm-5 col-xs-12">';
                        if($thumb[0]){
                            $output .='<div class="position-relative">';
                                $output .='<img src="'.$thumb[0].'" width="'.$thumb[1].'" height="'.$thumb[2].'"'.$image_alt.$image_title.'/>';
                                $output .='<div class="img-border-small border-transperent-white"></div>';
                            $output .='</div>';
                        }
                        $output .='<div class="wedding-social text-center margin-ten-top">';
                            if($brando_facebook_url){
                                $output .='<a href="'.$brando_facebook_url.'" target="_blank">';
                                    $output .='<i class="fa fa-facebook dark-gray-text"></i>';
                                $output .='</a>';
                            }
                            if($brando_twitter_url){
                                $output .='<a href="'.$brando_twitter_url.'" target="_blank">';
                                    $output .='<i class="fa fa-twitter dark-gray-text"></i>';
                                $output .='</a>';
                            }
                            if($brando_gplus_url){
                                $output .='<a href="'.$brando_gplus_url.'" target="_blank">';
                                    $output .='<i class="fa fa-google-plus dark-gray-text"></i>';
                                $output .='</a>';
                            }
                            if($brando_dribble_url){
                                $output .='<a href="'.$brando_dribble_url.'" target="_blank">';
                                    $output .='<i class="fa fa-dribbble dark-gray-text"></i>';
                                $output .='</a>';
                            }
                        $output .='</div>';
                    $output .='</div>';
                    $output .='<div class="col-md-6 col-sm-7 col-xs-12">';
                        if( $brando_testimonial_title ){
                            $output .='<span class="text-extra-large alt-font text-uppercase font-weight-600 couple-quotes width-90 display-block"'.$testimonial_title_color.'>'.$brando_testimonial_title.'</span>';
                        }
                        if( $brando_author_name ){
                            $output .='<span class="alt-font font-weight-600 text-uppercase margin-eight-top display-block"'.$author_name_color.'>'.$brando_author_name.'</span>';
                        }
                        if( $content ){
                            $output.= do_shortcode( brando_remove_wpautop($content) );
                        }
                    $output .='</div>';
                $output .='</div>';
            break;

            case 'testimonial-4':
                $output = '<div '.$id.' class="'.$class_attr.'"'.$style_property.'>';
                    if( $brando_testimonial_title ){
                        $output .='<span class="alt-font title-medium text-uppercase photography-quotes xs-title-small display-inline-block width-50 sm-width-70"'.$testimonial_title_color.'>'.$brando_testimonial_title.'</span>';
                    }
                    if( $content ){
                        $output .= do_shortcode( brando_remove_wpautop($content) );
                    }
                    if( $button_title ){
                        $output .='<a href="'.$button_link.'" target="'.$button_target.'" class="arrow-link alt-font text-uppercase position-relative inner-link">'.$button_title.'</a>';
                    }
                $output .='</div>';
            break;
        }
        
        return $output;
    }
}
add_shortcode( 'brando_testimonial', 'brando_testimonial' );
?>