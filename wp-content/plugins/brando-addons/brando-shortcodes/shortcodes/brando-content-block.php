<?php
/**
 * Shortcode For Content Block
 *
 * @package Brando
 */
?>
<?php

/*-----------------------------------------------------------------------------------*/
/* Special Content Block */
/*-----------------------------------------------------------------------------------*/

function brando_content_block_shortcode( $atts, $content = null ) {
    extract( shortcode_atts( array(
                'brando_block_premade_style' => '',
                'brando_image' => '',
                'brando_title' => '',
                'brando_subtitle' => '',
                'brando_font_awesome' => '',
                'enable_separator' => '',
                'content_position' => '',
                'icon_size' => '',
                'brando_title_color' => '',
                'brando_subtitle_color' => '',
                'brando_icon_color' => '',
                'brando_phno' => '',
                'brando_phno_icon' => '',
                'brando_email' => '',
                'brando_email_icon' => '',
                'brando_number1' => '',
                'brando_text1' => '',
                'brando_number2' => '',
                'brando_text2' => '',
                'brando_number3' => '',
                'brando_text3' => '',
                'brando_number4' => '',
                'brando_text4' => '',
                'brando_number_color' => '',
                'brando_text_color' => '',
                'brando_dis_text' => '',
                'brando_link' => '',
                'brando_icon' => '',
                'brando_sep_image' => '',
                'brando_scroll_to_section' => '',
                'brando_section_id' => '',
                'brando_border_color' => '',
                'brando_enable_border' => '',
                'image_position' => '',
                'contact_forms_shortcode' => '',
                'button_config' => '',
                'second_button_config' => '',
                'brando_sep_color' => '',
                'brando_seperator_height' => '2px',
                'brando_detailbox_color' => '',
                'brando_subtitle_bg_color' => '',
                'brando_number' => '',
                'brando_year_text' => '',
                'brando_small_title' => '',
                'brando_discount_text_bg_color' => '',
                'brando_discount_text_color' => '',
            ), $atts ) );
    
    $output = $style = $sep_style = $subtitle_style = $discount_style = '';
    $classes = $style_array = array();
    $brando_title = ( $brando_title ) ? str_replace('||', '<br />',$brando_title) : '';
    $brando_font_awesome = ( $brando_font_awesome ) ? $brando_font_awesome : '';
    $brando_dis_text = ( $brando_dis_text ) ? $brando_dis_text : '';
    $brando_year_text = ( $brando_year_text ) ? $brando_year_text : '';
    $brando_link = ( $brando_link ) ? $brando_link : '';
    $brando_title_color = ( $brando_title_color ) ? ' style="color:'.$brando_title_color.' !important;"' : '';
    $brando_subtitle_attr_color = ( $brando_subtitle_color ) ? 'color:'.$brando_subtitle_color.' !important;' : '';
    $icon_size = ( $icon_size ) ? ' '.$icon_size : ' icon-medium';
    $brando_icon_color = ( $brando_icon_color ) ? ' style="color:'.$brando_icon_color.' !important;"' : '';
    $border_color = ( $brando_enable_border == 1 ) ? ' style="border: 7px solid '.$brando_border_color.' !important;"' : '';
    $brando_border_color = ( $brando_border_color ) ? ' style="border-color:'.$brando_border_color.' !important;"' : '';
    $brando_discount_text_bg_color = ( $brando_discount_text_bg_color ) ? 'background:'.$brando_discount_text_bg_color.' !important;' : '';
    $brando_discount_text_color = ( $brando_discount_text_color ) ? 'color:'.$brando_discount_text_color.' !important;' : '';
    if( $brando_discount_text_bg_color || $brando_discount_text_color ){
        $discount_style .= ' style="'.$brando_discount_text_bg_color.$brando_discount_text_color.'"';
    }
    /* Image Alt, Title, Caption */
    $img_alt = brando_option_image_alt($brando_image);
    $img_title = brando_option_image_title($brando_image);
    $image_alt = ( isset($img_alt['alt']) && !empty($img_alt['alt']) ) ? ' alt="'.$img_alt['alt'].'"' : ' alt=""' ; 
    $image_title = ( isset($img_title['title']) && !empty($img_title['title']) ) ? ' title="'.$img_title['title'].'"' : '';

    $img_alt_sep = brando_option_image_alt($brando_sep_image);
    $img_title_sep = brando_option_image_title($brando_sep_image);
    $image_alt_sep = ( isset($img_alt_sep['alt']) && !empty($img_alt_sep['alt']) ) ? ' alt="'.$img_alt_sep['alt'].'"' : ' alt=""' ; 
    $image_title_sep = ( isset($img_title_sep['title']) && !empty($img_title_sep['title']) ) ? ' title="'.$img_title_sep['title'].'"' : '';

    $brando_image = ( $brando_image ) ? wp_get_attachment_image_src($brando_image, 'full') : '';
    $brando_sep_image = ( $brando_sep_image ) ? wp_get_attachment_image_src($brando_sep_image, 'full') : '';
    $content_position = ( $content_position == 1 ) ? 'overflow-hidden adventure-details-main-bottom' : 'overflow-hidden adventure-details-main'; 
    $brando_icon = ( $brando_icon ) ? $brando_icon : '';
    $brando_number = ( $brando_number ) ? $brando_number : ''; 
    $brando_section_id = ( $brando_section_id ) ? $brando_section_id : '';
    $image_position = ( $image_position == 1 ) ? 'pull-left' : 'pull-right';
    $brando_sep_color = ( $brando_sep_color ) ? 'background:'.$brando_sep_color.' !important; ' : ''; 
    $brando_seperator_height = ( $brando_seperator_height ) ? 'height:'.$brando_seperator_height.' !important;' : ''; 
    if( $brando_sep_color || $brando_seperator_height){
        $sep_style .= ' style="'.$brando_sep_color.$brando_seperator_height.'"';
    }
    $brando_detailbox_color = ( $brando_detailbox_color ) ? ' style="background:'.$brando_detailbox_color.' !important;"' : '';
    $brando_subtitle_bg_color = ( $brando_subtitle_bg_color ) ? 'background:'.$brando_subtitle_bg_color.' !important;' : '';
    if( $brando_subtitle_bg_color || $brando_subtitle_attr_color ){
        $subtitle_style .= ' style="'.$brando_subtitle_bg_color.$brando_subtitle_attr_color.'"';
    }
    $brando_small_title = ( $brando_small_title ) ? $brando_small_title : '';

    $class_list = implode(" ", $classes);
    $style_property_list = implode(" ", $style_array);
    $style_property = ( $style_property_list ) ? ' style="'.$style_property_list.'"' : '';

    if ( (function_exists('vc_parse_multi_attribute') && $button_config)) {
        //First button
        $button_parse_args = vc_parse_multi_attribute($button_config);
        $button_link     = ( isset($button_parse_args['url']) ) ? $button_parse_args['url'] : '#';
        $button_title    = ( isset($button_parse_args['title']) ) ? $button_parse_args['title'] : 'sample button';
        $button_target   = ( isset($button_parse_args['target']) ) ? trim($button_parse_args['target']) : '_self';
    }

    if ( (function_exists('vc_parse_multi_attribute') && $second_button_config)) {
        //First button
        $second_button_parse_args = vc_parse_multi_attribute($second_button_config);
        $second_button_link     = ( isset($second_button_parse_args['url']) ) ? $second_button_parse_args['url'] : '#';
        $second_button_title    = ( isset($second_button_parse_args['title']) ) ? $second_button_parse_args['title'] : 'sample button';
        $second_button_target   = ( isset($second_button_parse_args['target']) ) ? trim($second_button_parse_args['target']) : '_self';
    }

    $brando_text1 = ( $brando_text1 ) ? $brando_text1 : '';
    $brando_text2 = ( $brando_text2 ) ? $brando_text2 : '';
    $brando_text3 = ( $brando_text3 ) ? $brando_text3 : '';
    $brando_text4 = ( $brando_text4 ) ? $brando_text4 : '';

    $brando_number1 = ( $brando_number1 ) ? $brando_number1 : '';
    $brando_number2 = ( $brando_number2 ) ? $brando_number2 : '';
    $brando_number3 = ( $brando_number3 ) ? $brando_number3 : '';
    $brando_number4 = ( $brando_number4 ) ? $brando_number4 : '';

    $brando_number_color = ( $brando_number_color ) ? ' style="color:'.$brando_number_color.' !important;"' : '';
    $brando_text_color = ( $brando_text_color ) ? ' style="color:'.$brando_text_color.' !important;"' : '';

    $style = ' style="color:'.$brando_title_color.';"';

    switch ($brando_block_premade_style) {
        case 'block-1':
            if( $brando_title ){
                $output .= '<span class="text-extra-large margin-six-bottom display-inline-block alt-font black-text"'.$brando_title_color.'>'.$brando_title.'</span>';
            }
            if( $content ){
                $output .= do_shortcode( brando_remove_wpautop($content) );
            }
        break;

        case 'block-2':
            $output .= '<a href="'.$brando_link.'" target="_blank"><i class="fa '.$brando_font_awesome.$icon_size.' fast-yellow-text"'.$brando_icon_color.'></i></a>';
            $output .= '<a href="'.$brando_link.'" target="_blank"><span class="text-uppercase text-small display-block letter-spacing-2 black-text margin-seven-top xs-margin-two-top"'.$brando_title_color.'>'.$brando_title.'</span></a>';
        break;

        case 'block-3':
            $output .= '<span class="title-small letter-spacing-1 black-text alt-font display-block xs-text-center call-us">';
                if( $brando_phno || $brando_phno_icon ){
                    $output .= '<i class="'.$brando_phno_icon.' icon-small vertical-align-top xs-vertical-align-middle"></i> '.$brando_phno.'';
                }
                if( $brando_email || $brando_email_icon ){
                    $output .= '<span class="margin-two-lr xs-display-none"> | </span>';
                    $output .= '<a href="mailto:'.$brando_email.'" class="black-text xs-display-inline-block xs-margin-five-all">';
                        $output .= '<i class="'.$brando_email_icon.' icon-small vertical-align-top"></i> '.$brando_email.'';
                    $output .= '</a>';
                }
            $output .= '</span>';
        break;

        case 'block-4':
                $output .= '<div class="'.$content_position.'">';
                if( isset( $brando_image[0] ) ){
                    $output .= '<img src="'.$brando_image[0].'"'.$image_alt.$image_title.'/>';
                }
                    $output .= '<div class="adventure-details"'.$brando_detailbox_color.'>';
                        $output .= '<div class="adventure-details-sub padding-sixteen-all md-padding-thirteen-all sm-padding-fifteen-all xs-padding-ten-all">';
                        if( $brando_title ){
                            $output .= '<span class="text-large text-uppercase display-block alt-font light-gray-text margin-eight-bottom xs-text-medium"'.$brando_title_color.'>'.$brando_title.'</span>';
                        }
                        if( $content ){
                            $output .= do_shortcode( brando_remove_wpautop($content) );
                        }
                        if( $enable_separator == 1 ){
                            $output .= '<div class="bg-deep-orange separator-line-thick no-margin-lr margin-thirteen-all md-margin-eight-all md-no-margin-lr no-margin-bottom xs-display-none"'.$sep_style.'></div>';
                        }
                        $output .= '</div>';
                        if( $brando_subtitle ){ 
                            $output .= '<div class="adventure-details-destinations bg-deep-orange text-center alt-font text-small white-text letter-spacing-2 text-uppercase xs-text-extra-small"'.$subtitle_style.'>'.$brando_subtitle.'</div>';
                        }
                    $output .= '</div>';
                $output .= '</div>';
        break;

        case 'block-5':
            $output .= '<div class="travel-how-to-work xs-text-center">';
                if( $brando_text1 || $brando_number1 ){
                    $output .= '<div class="col-md-12 col-sm-12 padding-twelve-tb no-padding-lr border-bottom-transperent-white xs-padding-five-tb">';
                    if( $brando_number1 ){
                        $output .= '<div class="col-md-3 col-sm-3"><span class="title-extra-large deep-orange-text alt-font margin-eleven-top xs-margin-five-all display-block"'.$brando_number_color.'>'.$brando_number1.'</span></div>';
                    }
                    if( $brando_text1 ){
                        $output .= '<div class="col-md-9 col-sm-9">';
                            $output .= '<span class="text-large alt-font light-gray-text text-uppercase"'.$brando_text_color.'>'.$brando_text1.'</span>';
                        $output .= '</div>';
                    }
                    $output .= '</div>';
                }
                if( $brando_text2 || $brando_number2 ){
                    $output .= '<div class="col-md-12 col-sm-12 padding-twelve-tb no-padding-lr border-bottom-transperent-white xs-padding-five-tb">';
                    if( $brando_number2 ){
                        $output .= '<div class="col-md-3 col-sm-3"><span class="title-extra-large deep-orange-text alt-font display-block margin-eleven-top xs-margin-five-all"'.$brando_number_color.'>'.$brando_number2.'</span></div>';
                    }
                    if( $brando_text2 ){
                        $output .= '<div class="col-md-9 col-sm-9">';
                            $output .= '<span class="text-large alt-font light-gray-text text-uppercase"'.$brando_text_color.'>'.$brando_text2.'</span>';
                        $output .= '</div>';
                    }
                    $output .= '</div>';
                }
                if( $brando_text3 || $brando_number3 ){
                    $output .= '<div class="col-md-12 col-sm-12 padding-twelve-tb no-padding-lr border-bottom-transperent-white xs-padding-five-tb">';
                    if( $brando_number3 ){
                        $output .= '<div class="col-md-3 col-sm-3"><span class="title-extra-large deep-orange-text alt-font display-block margin-eleven-top xs-margin-five-all"'.$brando_number_color.'>'.$brando_number3.'</span></div>';
                    }
                    if( $brando_text3 ){
                        $output .= '<div class="col-md-9 col-sm-9">';
                            $output .= '<span class="text-large alt-font light-gray-text text-uppercase"'.$brando_text_color.'>'.$brando_text3.'</span>';
                        $output .= '</div>';
                    }
                    $output .= '</div>';
                }
                if( $brando_text4 || $brando_number4 ){
                    $output .= '<div class="col-md-12 col-sm-12 padding-twelve-tb no-padding-lr xs-padding-five-tb">';
                    if( $brando_number4 ){
                        $output .= '<div class="col-md-3 col-sm-3"><span class="title-extra-large deep-orange-text alt-font display-block margin-eleven-top xs-margin-five-all"'.$brando_number_color.'>'.$brando_number4.'</span></div>';
                    }
                    if( $brando_text4 ){
                        $output .= '<div class="col-md-9 col-sm-9">';
                            $output .= '<span class="text-large alt-font light-gray-text text-uppercase"'.$brando_text_color.'>'.$brando_text4.'</span>';
                        $output .= '</div>';
                    }
                    $output .= '</div>';
                }
            $output .= '</div>';
        break;

        case 'block-6':
            $output .= '<div class="blog-post-style2">';
                $output .= '<article class="col-md-12 col-sm-12 col-xs-12 no-padding bg-white">';
                    if( isset( $brando_image[0] ) ){
                        $output .= '<div class="col-md-6 col-sm-6 col-xs-6 no-padding post-thumbnail overflow-hidden">';
                            $output .= '<a href="'.$brando_link.'"><img src="'.$brando_image[0].'"'.$image_alt.$image_title.'/></a>';
                        $output .= '</div>';
                    }
                    $output .= '<div class="col-md-6 col-sm-6 col-xs-6 no-padding post-details-arrow">';
                        $output .= '<div class="post-details">';
                            if( $brando_title ){
                                $output .= '<span class="text-extra-large text-uppercase display-block alt-font margin-six-tb sm-text-small xs-text-small"><a href="'.$brando_link.'"'.$brando_title_color.'>'.$brando_title.'</a></span>';
                            }
                            if( $brando_subtitle ){
                                $output .= '<span class="text-medium text-uppercase letter-spacing-2 alt-font light-gray-text sm-text-extra-small"'.$subtitle_style.'>'.$brando_subtitle.'</span>';
                            }
                            if( $enable_separator == 1 ){
                                $output .= '<div class="separator-line-thick bg-dark-blue margin-eight-top"'.$sep_style.'></div>';
                            }
                            if( $brando_dis_text ){
                                $output .= '<div class="travel-special-off bg-deep-orange position-absolute alt-font white-text sm-text-extra-small"'.$discount_style.'>'.$brando_dis_text.'</div>';
                            }
                        $output .= '</div>';
                    $output .= '</div>';
                $output .= '</article>';
            $output .= '</div>';
        break;

        case 'block-7':
            $output .= '<div class="'.$class_list.' text-center">';
                if( $brando_icon ){
                    $output .= '<i class="'.$brando_icon.$icon_size.' medium-gray-text"'.$brando_icon_color.'></i>';
                }
                if( $brando_title ){
                    $output .= '<span class="text-uppercase display-block alt-font medium-gray-text line-height-normal"'.$brando_title_color.'>'.$brando_title.'</span>';
                }
                if( $content ){
                    $output .= do_shortcode( brando_remove_wpautop($content) );
                }
            $output .= '</div>';
        break;

        case 'block-8':
            $output .= '<div class="full-screen position-relative">';
                $output .= '<div class="slider-typography text-center">';
                    $output .= '<div class="slider-text-middle-main">';
                        $output .= '<div class="slider-text-middle">';
                            $output .= '<div class="restaurant-dishes bg-white '.$image_position.' position-relative sm-margin-lr-auto sm-float-none position-relative padding-seven-all xs-padding-fifteen-all">';
                            if( isset( $brando_image[0] ) ){
                                $output .= '<div class="margin-four-tb sm-margin-eight-tb xs-display-none">';
                                    $output .= '<img src="'.$brando_image[0].'"'.$image_alt.$image_title.'/>';
                                $output .= '</div>';
                            }
                            if( $brando_title ){
                                $output .= '<span class="title-large alt-font text-uppercase letter-spacing-2 brown-text display-block"'.$brando_title_color.'>'.$brando_title.'</span>';
                            }
                            if( $brando_subtitle ){
                                $output .= '<span class="text-small letter-spacing-1 text-uppercase"'.$subtitle_style.'>'.$brando_subtitle.'</span>';
                            }
                            if( isset( $brando_sep_image[0] ) ){
                                $output .= '<div class="margin-eight-tb"><img src="'.$brando_sep_image[0].'"'.$image_alt_sep.$image_title_sep.'/></div>';
                            }
                            if( $content ){
                                $output .= do_shortcode( brando_remove_wpautop($content) );
                            }
                            if( $brando_scroll_to_section == 1){
                                $output .= '<div class="margin-nine-tb">';
                                    $output .= '<a class="inner-link" href="'.$brando_section_id.'"><img src="'.get_template_directory_uri().'/assets/images/arrow-down.png" alt=""/></a>';
                                $output .= '</div>';
                            }
                            if( $brando_enable_border == 1 ){
                                $output .= '<div class="img-border border-deep-yellow z-index-minus2"'.$brando_border_color.'></div>';
                            }
                            $output .= '</div>';
                        $output .= '</div>';
                    $output .= '</div>';
                $output .= '</div>';
            $output .= '</div>';
        break;

        case 'block-9':
            if( $brando_subtitle ){
                $output .= '<span class="text-large text-uppercase display-block letter-spacing-1 margin-three-tb alt-font"'.$subtitle_style.'>'.$brando_subtitle.'</span>';
            }
            if( $brando_title ){
                $output .= '<span class="title-extra-large text-uppercase alt-font font-weight-600 light-gray-text display-block xs-title-medium"'.$brando_title_color.'>'.$brando_title.'</span>';
            }
            if( $enable_separator == 1 ){
                $output .= '<div class="separator-line-thick bg-deep-yellow no-margin-lr sm-margin-four-tb sm-margin-lr-auto"'.$sep_style.'></div>';
            }
            if( $content ){
                $output .= do_shortcode( brando_remove_wpautop($content) );
            }
        break;

        case 'block-10':
            if( $brando_number ){
                    $output .= '<div class="col-md-3 col-lg-2 col-sm-1 col-xs-12 no-padding">';
                        $output .= '<span class="black-text sm-white-text font-weight-600 alt-font title-extra-large-2"'.$brando_number_color.'>'.$brando_number.'</span>';
                    $output .= '</div>';
                }
                if( $content ){
                    $output .= '<div class="col-md-9 col-lg-10 col-sm-11 col-xs-12 no-padding counter-style1">';
                            $output .= do_shortcode( brando_remove_wpautop($content) );
                    $output .= '</div>';
                }
        break;

        case 'block-11':
            $output .= '<div class="attending-main">';
                $output .= '<div class="z-index-2">';
                    if( $brando_title ){
                        $output .= '<span class="alt-font title-medium xs-title-small text-uppercase display-block center-col width-100 font-weight-600 "'.$brando_title_color.'>'.$brando_title.'</span>';
                    }
                    if( $contact_forms_shortcode ){
                        $output .='<div class="padding-twenty no-padding-bottom sm-padding-twenty-three sm-no-padding-bottom">';
                            $output .= do_shortcode('[contact-form-7 id='.$contact_forms_shortcode.']');
                        $output .= '</div>';
                    }
                $output .= '</div>';
            $output .= '</div>';
        break;

        case 'block-12':
            $output .= '<div class="hover-box">';
                if( isset( $brando_image[0] ) ){
                    $output .= '<img src="'.$brando_image[0].'"'.$image_alt.$image_title.'/>';
                    $output .= '<div class="opacity-light bg-dark-gray"></div>';
                }
                if( $brando_title ){
                    $output .= '<div class="col-md-5 pull-right position-absolute hover-box-text bg-white z-index-1">';
                        $output .= '<span class="text-uppercase title-medium alt-font font-weight-600 md-text-extra-large sm-text-large xs-text-extra-large"'.$brando_title_color.'>'.$brando_title.'</span>';
                    $output .= '</div>';
                }
                if( $button_title ){
                    $output .= '<div class="hover-box-more bg-fast-pink position-absolute z-index-1">';
                        $output .= '<a href="'.$button_link.'" target="'.$button_target.'" class="white-text alt-font text-uppercase inner-link">'.$button_title.'</a>';
                    $output .= '</div>';
                }
            $output .= '</div>';
        break;

        case 'block-13':
            $output .= '<div class="hover-box-image">';
                $output .= '<figure>';
                if( isset( $brando_image[0] ) ){
                    $output .= '<img src="'.$brando_image[0].'"'.$image_alt.$image_title.'/>';
                }
                    $output .= '<figcaption>';
                        if( $brando_title ){
                            $output .= '<h3 class="alt-font text-uppercase letter-spacing-2 vertical-middle white-text z-index-1 md-title-medium sm-title-extra-large xs-title-large no-margin"'.$brando_title_color.'>'.$brando_title.'</h3>';
                        }
                        if( $button_title ){
                            $output .= '<div class="hover-box-image-link position-absolute z-index-1">';
                                $output .= '<a href="'.$button_link.'" target="'.$button_target.'" class="line-link alt-font text-uppercase black-text position-relative inner-link">'.$button_title.'</a>';
                            $output .= '</div>';
                        }
                        $output .= '<div class="grid-style1-border border-transperent-white"></div>';
                    $output .= '</figcaption>';
                $output .= '</figure>';
            $output .= '</div>';
        break;

        case 'block-14':
                if( $brando_icon ){
                    $output .= '<div class="col-md-2 col-sm-1">';
                                    $output .= '<i class="'.$brando_icon.$icon_size.' margin-one-half sm-icon-small no-margin-lr"'.$brando_icon_color.'></i>';
                    $output .= '</div>';
                }
                $output .= '<div class="col-md-10 col-sm-10">';
                    if( $brando_title ){
                        $output .= '<span class="text-uppercase alt-font black-text text-large font-weight-600"'.$brando_title_color.'>'.$brando_title.'</span>';
                    }
                    if( $content ){
                        $output .= do_shortcode( brando_remove_wpautop($content) );
                    }
                $output .= '</div>';
        break;

        case 'block-15':
                if( $brando_number ){
                    $output .= '<div class="col-lg-2 col-md-2 col-sm-1 col-xs-2 no-padding">';
                        $output .= '<span class="alt-font title-large light-gray-text"'.$brando_number_color.'>'.$brando_number.'</span>';
                    $output .= '</div>';
                }
                $output .= '<div class="col-md-9 col-lg-9 col-sm-10 col-xs-10 no-padding-right padding-three-left counter-style1">';
                    if( $brando_title ){
                        $output .= '<span class="alt-font display-block text-uppercase black-text letter-spacing-1 margin-three-bottom"'.$brando_title_color.'>'.$brando_title.'</span>';
                    }
                    if( $content ){
                        $output .= do_shortcode( brando_remove_wpautop($content) );
                    }
                $output .= '</div>';
        break;

        case 'block-16':
            if( $brando_title ){
                $output .= '<span class="alt-font black-text text-uppercase display-block"'.$brando_title_color.'>'.$brando_title.'</span>';
            }
            if( $brando_subtitle ){
                $output .= '<span class="alt-font text-uppercase medium-gray-text position-relative top-minus5 display-block"'.$subtitle_style.'>'.$brando_subtitle.'</span>';
            }
            if( $brando_year_text ){
                $output .= '<span class="employment-year white-text bg-black text-uppercase alt-font">'.$brando_year_text.'</span>';
            }
            $output .= do_shortcode( brando_remove_wpautop($content) );
        break;

        case 'block-17':
            $output .= '<div class="xs-margin-ten-bottom">';
                if( $brando_title ){
                    $output .= '<span class="text-uppercase text-large letter-spacing-1 alt-font font-weight-600 black-text display-block margin-two-bottom"'.$brando_title_color.'>'.$brando_title.'</span>';
                }
                if( $content ){
                    $output .= do_shortcode( brando_remove_wpautop($content) );
                }
                if( $enable_separator == 1 ){
                    $output .= '<div class="separator-line-thick margin-eight-all no-margin-lr xs-margin-ten-all xs-no-margin-bottom xs-margin-lr-auto"'.$sep_style.'></div>';
                }
            $output .= '</div>';
        break;

        case 'block-18':
            $output .= '<div class="tattoo-art-box padding-eleven-all md-padding-seven-all xs-padding-five-all">';
                $output .= '<div class="padding-six-all xs-margin-seven-bottom xs-text-center"'.$border_color.'>';
                    if( $brando_small_title ){
                        $output .= '<span class="text-large alt-font letter-spacing-2 white-text text-uppercase">'.$brando_small_title.'</span>';
                    }
                    if( $brando_title ){
                        $output .= '<span class="title-extra alt-font font-weight-600 letter-spacing-1 white-text text-uppercase display-block margin-two-top"'.$brando_title_color.'>'.$brando_title.'</span>';
                    }
                $output .= '</div>';
                $output .= '<div class="tattoo-art-box padding-ten-all xs-no-padding xs-text-center">';
                    if( $brando_subtitle ){
                        $output .= '<span class="text-extra-large text-uppercase text-extra-large letter-spacing-2 alt-font font-weight-400 white-text display-block margin-eight-bottom xs-margin-five-bottom"'.$subtitle_style.'>'.$brando_subtitle.'</span>';
                    }
                    if( $content ){
                        $output .= do_shortcode( brando_remove_wpautop($content) );
                    }
                    if( $button_title ){
                        $output .= '<a class="highlight-button-green btn button no-margin inner-link text-medium letter-spacing-3" href="'.$button_link.'" target="'.$button_target.'">'.$button_title.'<i class="fa fa-long-arrow-right text-extra-large padding-six-left"></i></a>';
                    }
                $output .= '</div>';
            $output .= '</div>';
        break;

        case 'block-19':
            $output .= '<div class="position-relative our-artist">';
                if( isset( $brando_image[0] ) ){
                    $output .= '<img src="'.$brando_image[0].'"'.$image_alt.$image_title.'/>';
                }
                $output .= '<div class="img-border border-transperent-green">';
                    $output .= '<div class="artist-info xs-padding-five-all">';
                        if( $brando_title ){
                            $output .= '<span class="alt-font text-uppercase title-small black-text font-weight-600 display-block margin-two-bottom"'.$brando_title_color.'>'.$brando_title.'</span>';
                        }
                        if( $brando_subtitle ){
                            $output .= '<span class="alt-font text-small text-uppercase black-text letter-spacing-1 display-block margin-seven-bottom"'.$subtitle_style.'>'.$brando_subtitle.'</span>';
                        }
                        $output .= do_shortcode( brando_remove_wpautop($content) );
                        if( $brando_email ){
                            $output .= '<span class="text-medium alt-font black-text margin-eight-bottom display-block"><i class="black-text fa fa-envelope-o padding-two-right"></i>'.__('Email me: ','brando-addons').'<a href="mailto:'.$brando_email.'" class="black-text">'.$brando_email.'</a></span>';
                        }
                        $output .= '<div class="artist-info-btn">';
                            if( $button_title ){
                                $output .= '<a class="highlight-button-dark btn btn-small button letter-spacing-1 inner-link margin-two-right" target="'.$button_target.'" href="'.$button_link.'">'.$button_title.'</a>';
                            }
                            if( $second_button_title ){
                                $output .= '<a class="highlight-button-dark btn btn-small button letter-spacing-1 inner-link no-margin" target="'.$second_button_target.'" href="'.$second_button_link.'">'.$second_button_title.'</a>';
                            }
                        $output .= '</div>';
                    $output .= '</div>';
                $output .= '</div>';
                $output .= '<div class="artist-title">';
                    $output .= '<a class="alt-font letter-spacing-1 black-text text-extra-large text-uppercase inner-link" href="'.$button_link.'">'.$brando_title.'</a>';
                $output .= '</div>';
            $output .= '</div>';
        break;

        case 'block-20':
            $output .= '<div class="itinerary ajax-popup-content"><p>';
                $output .= '<span>'.$brando_title.'</span>';
                $output .= $brando_subtitle;
            $output .= '</p></div>';
        break;

        case 'block-21':
            if( $brando_number ){
                $output .= '<div class="col-md-3 col-sm-2 col-xs-2 no-padding sm-display-none">';
                    $output .= '<span class="title-extra-large-2 crimson-red-text alt-font"'.$brando_number_color.'>'.$brando_number.'</span>';
                $output .= '</div>';
            }
            $output .= '<div class="col-md-9 col-sm-9 col-xs-12 no-padding text-left">';
                if( $brando_title ){
                    $output .= '<span class="alt-font text-medium alt-font text-uppercase black-text"'.$brando_title_color.'>'.$brando_title.'</span>';
                }
                if( $enable_separator == 1 ){
                    $output .= '<div class="separator-line-thick bg-mid-gray no-margin-lr xs-margin-three-all xs-no-margin-lr"'.$sep_style.'></div>';
                }
                if( $content ){
                    $output .= do_shortcode( brando_remove_wpautop($content) );
                }
            $output .= '</div>';
        break;

        case 'block-22':
                if( isset( $brando_image[0] ) ){
                    $output .= '<div class="col-md-2 col-sm-2 col-xs-3 no-padding-left margin-one-tb">';
                        $output .= '<img src="'.$brando_image[0].'"'.$image_alt.$image_title.'/>';
                    $output .= '</div>';
                }
                $output .= '<div class="col-md-9 col-sm-9 col-xs-9 no-padding-right">';
                    if( $brando_title ){
                        $output .= '<span class="text-medium alt-font text-uppercase margin-three-bottom display-block letter-spacing-1"'.$brando_title_color.'>'.$brando_title.'</span>';
                    }
                    if( $content ){
                        $output .= do_shortcode( brando_remove_wpautop($content) );
                    }
                $output .= '</div>';
        break;
    }
    return $output;
}
add_shortcode( 'brando_content_block', 'brando_content_block_shortcode' );

/*-----------------------------------------------------------------------------------*/
/* Special Content Block */
/*-----------------------------------------------------------------------------------*/
?>
