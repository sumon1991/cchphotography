<?php
/**
 * Shortcode For Tab Content
 *
 * @package Brando
 */
?>
<?php
/*-----------------------------------------------------------------------------------*/
/* Tab Content */
/*-----------------------------------------------------------------------------------*/

if ( ! function_exists( 'brando_tab_content_shortcode' ) ) {
    function brando_tab_content_shortcode( $atts, $content = null ) {
    	extract( shortcode_atts( array(
            	'brando_tab_content_premade_style' => '',
            	'brando_tab_content_left_title' => '',
                'brando_feature_image' =>'',
            	'brando_tab_content_left_title_show_separator' => '',
            	'brando_tab_content_left_content' => '',
            	'brando_tab_content_right_title' => '',
            	'brando_tab_content_left_title_show_separator_line' => '',
                'brando_tab_sub_title' =>'',
                'brando_tab_location'=>'',
                'brando_stars' => '',
                'brando_button_text' =>'',
            	'brando_tab_content_bottom_title' => '',
                'brando_left_image' => '',
                'brando_right_image' => '',
                'brando_number' => '',
                'brando_sep_color' => '',
                'separator_height' => '',
            ), $atts ) );
    	$output = $button_color = $button_class = $sep_style = '';
    	$brando_tab_content_premade_style = ( $brando_tab_content_premade_style ) ? $brando_tab_content_premade_style : '';
        $brando_tab_sub_title = ( $brando_tab_sub_title ) ? $brando_tab_sub_title : '';
        $brando_tab_location = ( $brando_tab_location ) ? $brando_tab_location : '';
        $brando_stars = ( $brando_stars ) ? $brando_stars : '';
    	$brando_tab_content_left_title = ( $brando_tab_content_left_title ) ? $brando_tab_content_left_title : '';
    	$brando_tab_content_left_title_show_separator = ($brando_tab_content_left_title_show_separator) ? $brando_tab_content_left_title_show_separator : '';
    	$brando_tab_content_left_content = ( $brando_tab_content_left_content ) ? $brando_tab_content_left_content : '';
    	$brando_tab_content_right_title = ( $brando_tab_content_right_title ) ? $brando_tab_content_right_title : '';
    	$brando_tab_content_left_title_show_separator_line = ( $brando_tab_content_left_title_show_separator_line ) ? $brando_tab_content_left_title_show_separator_line : '';
    	$brando_tab_content_bottom_title = ( $brando_tab_content_bottom_title ) ? $brando_tab_content_bottom_title : '';
        $brando_button_text = ( $brando_button_text ) ? $brando_button_text : '';
        $first_button_parse_args = vc_parse_multi_attribute($brando_button_text);
        $first_button_link = (isset($first_button_parse_args['url'])) ? $first_button_parse_args['url'] : '#';
        $first_button_title = (isset($first_button_parse_args['title'])) ? $first_button_parse_args['title'] : '';

        $brando_sep_color = ( $brando_sep_color ) ? 'background:'.$brando_sep_color.';' : '';
        $brando_seperator_height = ( $separator_height ) ? 'height:'.$separator_height.';' : '';

        if( $brando_sep_color || $brando_seperator_height ){
            $sep_style .= ' style="'.$brando_sep_color.$brando_seperator_height.'"';
        }

        /* Image Alt, Title, Caption */
        $img_alt = brando_option_image_alt($brando_feature_image);
        $img_title = brando_option_image_title($brando_feature_image);
        $image_alt = ( isset($img_alt['alt']) && !empty($img_alt['alt']) ) ? ' alt="'.$img_alt['alt'].'"' : ' alt=""' ; 
        $image_title = ( isset($img_title['title']) && !empty($img_title['title']) ) ? ' title="'.$img_title['title'].'"' : '';

        /* Image Alt, Title, Caption  For Left Image */
        $img_alt_left = brando_option_image_alt($brando_left_image);
        $img_title_left = brando_option_image_title($brando_left_image);
        $image_alt_left = ( isset($img_alt_left['alt']) && !empty($img_alt_left['alt']) ) ? ' alt="'.$img_alt_left['alt'].'"' : ' alt=""' ; 
        $image_title_left = ( isset($img_title_left['title']) && !empty($img_title_left['title']) ) ? ' title="'.$img_title_left['title'].'"' : '';

        /* Image Alt, Title, Caption For Right Image */
        $img_alt_right = brando_option_image_alt($brando_right_image);
        $img_title_right = brando_option_image_title($brando_right_image);
        $image_alt_right = ( isset($img_alt_right['alt']) && !empty($img_alt_right['alt']) ) ? ' alt="'.$img_alt_right['alt'].'"' : ' alt=""' ; 
        $image_title_right = ( isset($img_title_right['title']) && !empty($img_title_right['title']) ) ? ' title="'.$img_title_right['title'].'"' : '';

        $thumb = wp_get_attachment_image_src($brando_feature_image, 'full');
        $thumb_left = wp_get_attachment_image_src($brando_left_image, 'full');
        $thumb_right = wp_get_attachment_image_src($brando_right_image, 'full');
    	  
    	switch ($brando_tab_content_premade_style) 
        {
    		case 'tab-content1':

                $output .= '<div class="row">';
    				if( $brando_tab_content_left_title || $brando_tab_content_left_title_show_separator || $brando_tab_content_left_content ){
    	                $output .= '<div class="col-md-6 col-sm-12 text-left gray-text xs-no-padding-lr">';
    	                	if( $brando_tab_content_left_title ){
    	                    	$output .= '<span class="text-medium text-uppercase black-text">'.$brando_tab_content_left_title.'</span>';
                            }
    	                    if( $brando_tab_content_left_title_show_separator ){
    	                    	$output .= '<div class="separator-line bg-yellow no-margin-lr sm-margin-five"'.$sep_style.'></div>';
                            }
    	                    if( $brando_tab_content_left_content ){
    	                    	$output .= '<p class="text-medium text-uppercase">'.$brando_tab_content_left_content.'</p>';
                            }
    	                $output .= '</div>';
    	            }
    	            if( $brando_tab_content_right_title || $content ){
    	                $output .= '<div class="col-md-6 col-sm-12 text-left text-med gray-text xs-no-padding-lr">';
    	                	if( $brando_tab_content_right_title ){
    	                    	$output .= '<p class="margin-fifteen no-margin-lr no-margin-top text-uppercase text-medium">'.$brando_tab_content_right_title.'</p>';
                            }
    	                    if( $content ){
    	                    	$output .= do_shortcode( brando_remove_wpautop( $content ) );
                            }
    	                $output .= '</div>';
    	            }
                $output .= '</div>';
               
                if( $brando_tab_content_left_title_show_separator_line == 1 ){
    	            $output .= '<div class="row"> ';
    	                $output .= '<div class="wide-separator-line"></div>';
    	            $output .= '</div>';
                }
                if( $brando_tab_content_bottom_title ){
    	            $output .= '<div class="row">';
    	                $output .= '<div class="text-extra-large text-uppercase">'.$brando_tab_content_bottom_title.'</div>';
    	            $output .= '</div>';
                }
                if( $brando_tab_content_left_title_show_separator_line == 1 ){
                    $output .= '<div class="row"> ';
                        $output .= '<div class="wide-separator-line"></div>';
                    $output .= '</div>';
                }
                
    		break;

            case 'tab-content2':

                $output .= '<div class="col-md-6 col-sm-6 col-xs-12 xs-text-center no-padding-left position-relative xs-margin-thirteen-bottom xs-no-padding-right">';
                    if($thumb[0]){
                        $output .= '<img src="'.$thumb[0].'"'.$image_alt.$image_title.'>';
                    }
                    if( $brando_stars ){
                        $output .= '<div class="hotel-review position-absolute bg-dark-blue">';
                            for($j=1; $j <= $brando_stars; $j++)
                            {
                                $output.='<i class="fa fa-star deep-yellow-text icon-extra-small"> </i>';
                            }
                        $output .= '</div>';
                    }
                    $output .= '<div>';
                    if( $brando_tab_content_left_title ){
                        $output .= '<span class="text-extra-large alt-font margin-eight-top display-block light-gray-text">'.$brando_tab_content_left_title.'</span>';
                    }
                    if( $brando_tab_location ){
                        $output .= '<span class="text-small alt-font display-block">'.$brando_tab_location.'</span>';
                    }
                    $output .= '</div>';
                $output .= '</div>';
                $output .= '<div class="col-md-6 col-sm-6 col-xs-12 no-padding-right position-relative top-minus7 xs-no-padding-left">';
                    if( $content ){
                        $output .= do_shortcode( brando_remove_wpautop( $content ) );
                    }
                    if( $first_button_title ){
                        $output .= '<a href="'.$first_button_link.'" class="highlight-button-gray-border btn btn-small margin-nine-top inner-link">'.$first_button_title.'</a>';
                    }
                $output .= '</div>';

            break;

            case 'tab-content3':

                $output .= '<div role="tabpanel" class="tab-pane fade in">';
                    $output .= '<div class="col-md-12 col-sm-12 treatments-box position-relative">';
                        if( $thumb_left[0] )
                        {
                            $output .= '<div class="col-md-4 col-sm-6 treatments-box-img text-right xs-display-none">';
                                $output .= '<img src="'.$thumb_left[0].'"'.$image_alt_left.$image_title_left.' class="position-right"/>';
                            $output .= '</div>';
                        }
                        $output .= '<div class="col-md-4 col-sm-6 col-xs-12 treatments-box-text bg-gray ">';
                            $output .= '<div class="treatments-box-text-sub padding-ten-all text-center">';
                                if( $thumb[0] )
                                {
                                    $output .= '<img src="'.$thumb[0].'"'.$image_alt.$image_title.' class="position-relative round-border margin-fifteen-bottom xs-margin-thirteen-bottom"/>';
                                }
                                if( $brando_tab_content_left_title ){
                                    $output .= '<span class="alt-font text-uppercase text-large letter-spacing-1 display-block dark-gray-text margin-seven-bottom"><span class="title-separator-line bg-fast-pink"></span>'.$brando_tab_content_left_title.'</span>';
                                }
                                if( $content ){
                                    $output .= do_shortcode( brando_remove_wpautop( $content ) );
                                }
                                if( $brando_number ){
                                    $output .= '<div class="treatments-box-number alt-font fast-pink-text font-weight-600 position-relative">'.$brando_number.'</div>';
                                }
                            $output .= '</div>';
                        $output .= '</div>';
                        if( $thumb_right[0] )
                        {
                            $output .= '<div class="col-md-4 col-sm-4 treatments-box-img sm-display-none">';
                                $output .= '<img src="'.$thumb_right[0].'"'.$image_alt_right.$image_title_right.' class="position-left"/>';
                            $output .= '</div>';
                        }
                    $output .= '</div>';
                $output .= '</div>';
                
            break;

            case 'tab-content4':
                if( $brando_tab_content_left_title ){
                    $output .= '<span class="text-extra-large text-uppercase alt-font display-block font-weight-600">'.$brando_tab_content_left_title.'</span>';
                }
                if( $brando_tab_sub_title ){
                    $output .= '<span class="text-large text-uppercase alt-font light-gray-text">'.$brando_tab_sub_title.'</span>';
                }
                if( $content ){
                    $output .= '<div class="margin-five-top table">';
                        $output .= do_shortcode( brando_remove_wpautop( $content ) );
                    $output .= '</div>';
                }
            break;
        }
        return $output;
    }
}
add_shortcode('brando_tab_content','brando_tab_content_shortcode');
?>