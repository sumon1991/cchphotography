<?php
/**
 * Shortcode For Team Member
 *
 * @package Brando
 */
?>
<?php

/*-----------------------------------------------------------------------------------*/
/* Team Member */
/*-----------------------------------------------------------------------------------*/

function brando_team_member_shortcode( $atts, $content = null ) {
    extract( shortcode_atts( array(
                'brando_team_member_style' => '',
                'team_member_image' => '',
                'brando_member_name' => '',
                'brando_member_subtitle' => '',
                'brando_member_des' => '',
                'brando_facebook_url' => '',
                'brando_twitter_url' => '',
                'brando_gplus_url' => '',
                'brando_linkedin_url' => '',
                'brando_pinterest_url' => '',
                'brando_behance_url' => '',
                'brando_show_separator' => '',
                'brando_sep_color' => '',
                'brando_seperator_height' => '',
                'brando_content_bg_color' => '',
            ), $atts ) );
    
    $output = $style = $sep_style = '';
    $style_array = array();
    /* Image Alt, Title, Caption */
    $img_alt = brando_option_image_alt($team_member_image);
    $img_title = brando_option_image_title($team_member_image);
    $image_alt = ( isset($img_alt['alt']) && !empty($img_alt['alt']) ) ? ' alt="'.$img_alt['alt'].'"' : ' alt=""' ; 
    $image_title = ( isset($img_title['title']) && !empty($img_title['title']) ) ? ' title="'.$img_title['title'].'"' : '';
    
    $image_url = wp_get_attachment_url( $team_member_image );
    $brando_member_name = ( $brando_member_name ) ? $brando_member_name : '';
    $brando_member_subtitle = ( $brando_member_subtitle ) ? $brando_member_subtitle : '';
    $brando_member_des = ( $brando_member_des ) ? $brando_member_des : '';
    $brando_facebook_url = ( $brando_facebook_url ) ? $brando_facebook_url : '';
    $brando_twitter_url = ( $brando_twitter_url ) ? $brando_twitter_url : '';
    $brando_gplus_url = ( $brando_gplus_url ) ? $brando_gplus_url : '';
    $brando_linkedin_url = ( $brando_linkedin_url ) ? $brando_linkedin_url : '';
    $brando_content_bg_color = ( $brando_content_bg_color ) ? ' style="background:'.$brando_content_bg_color.' !important; "' : '';
    $brando_sep_color = ( $brando_sep_color ) ?  $style_array[] = 'background:'.$brando_sep_color.' !important; ' : ''; 
    $brando_seperator_height = ( $brando_seperator_height ) ? $style_array[] = 'height:'.$brando_seperator_height.' !important;' : ''; 
    $style_property_list = implode(" ", $style_array);
    $sep_style = ( $style_property_list ) ? ' style="'.$style_property_list.'"' : '';

    switch ($brando_team_member_style) 
    {
        case 'team-1':
            $output .= '<div class="team-style1">';
                $output .= '<div class="opacity-light bg-gray"></div>';
                if($image_url){
                    $output .= '<img src="'.$image_url.'"'.$image_alt.$image_title.'/>';
                }
                if( $brando_member_subtitle ){
                    $output .= '<div class="team-mood text-center">';
                        $output .= '<span class="text-uppercase alt-font font-weight-400 text-large bg-white letter-spacing-3 md-text-small sm-text-large">'.$brando_member_subtitle.'</span>';
                    $output .= '</div>';
                }
                $output .= '<figure class="text-center padding-fifteen-all">';
                    $output .= '<figcaption>';
                    if( $brando_member_name ){
                        $output .= '<span class="alt-font text-uppercase letter-spacing-2 text-large display-block black-text">'.$brando_member_name.'</span>';
                    }
                    if( $brando_member_des ){
                        $output .= '<span class="alt-font font-weight-100 text-small letter-spacing-2 text-uppercase black-text title-underline display-inline-block padding-seven-bottom margin-nine-bottom">'.$brando_member_des.'</span>';
                    }
                    $output .= '<div class="team-social">';
                        if( $brando_facebook_url ){
                            $output .= '<a href="'.$brando_facebook_url.'" target="_blank"><i class="fa fa-facebook icon-extra-small black-text"></i></a>';
                        }
                        if( $brando_twitter_url ){
                            $output .= '<a href="'.$brando_twitter_url.'" target="_blank"><i class="fa fa-twitter icon-extra-small black-text"></i></a>';
                        }
                        if( $brando_gplus_url ){
                            $output .= '<a href="'.$brando_gplus_url.'" target="_blank"><i class="fa fa-google-plus icon-extra-small black-text"></i></a>';
                        }
                        if( $brando_linkedin_url ){
                            $output .= '<a href="'.$brando_linkedin_url.'" target="_blank"><i class="fa fa-linkedin icon-extra-small black-text"></i></a>';
                        }
                        if( $brando_pinterest_url ){
                            $output .= '<a href="'.$brando_pinterest_url.'" target="_blank"><i class="fa fa-pinterest icon-extra-small black-text"></i></a>';
                        }
                        if( $brando_behance_url ){
                            $output .= '<a href="'.$brando_behance_url.'" target="_blank"><i class="fa fa-behance icon-extra-small black-text"></i></a>';
                        }
                        $output .= '</div>';
                    $output .= '</figcaption>';
                $output .= '</figure>';
            $output .= '</div>';
        break;

        case 'team-2':
            $output .= '<div class="chef-bio">';
                if($image_url){
                    $output .= '<div class="chef-img">';
                        $output .= '<img src="'.$image_url.'"'.$image_alt.$image_title.'/>';
                    $output .= '</div>';
                }
                $output .= '<div class="chef-details padding-nine-tb center-col text-center bg-brown">';
                    if( $brando_show_separator == 1 ){ 
                        $output .= '<div class="separator-line-thick bg-deep-yellow no-margin-top margin-eight-bottom xs-margin-four-bottom"'.$sep_style.'></div>';
                    }
                    if( $brando_member_name ){
                        $output .= '<span class="title-small font-weight-100 letter-spacing-2 alt-font deep-yellow-text text-uppercase display-block">'.$brando_member_name.'</span>';
                    }
                    if( $brando_member_des ){
                        $output .= '<span class="text-small letter-spacing-2 text-uppercase alt-font light-gray-text">'.$brando_member_des.'</span>';
                    }
                    $output.= do_shortcode( brando_remove_wpautop($content) );
                $output .= '</div>';
            $output .= '</div>';
        break;

        case 'team-3':
            $output .= '<div class="architecture-bio">';
                if( $image_url ){
                    $output .= '<div class="architecture-img">';
                        $output .= '<img src="'.$image_url.'"'.$image_alt.$image_title.'/>';
                    $output .= '</div>';
                }
                $output .= '<div class="architecture-details text-left padding-eight-all center-col md-width-100 xs-width-90"'.$brando_content_bg_color.'>';
                    if( $brando_member_name ){
                        $output .= '<span class="text-large font-weight-600 letter-spacing-1 alt-font white-text text-uppercase display-block">'.$brando_member_name.'</span>';
                    }
                    if( $brando_member_des ){
                        $output .= '<span class="text-small letter-spacing-2 text-uppercase alt-font white-text">'.$brando_member_des.'</span>';
                    }
                    if( $content ){
                        $output.= do_shortcode( brando_remove_wpautop($content) );
                    }
                    $output .= '<span class="text-uppercase alt-font text-small black-text team-member-social">';
                        if( $brando_facebook_url ){
                            $output .= '<a href="'.$brando_facebook_url.'" target="_blank" class="black-text display-inline-block">'.__('Facebook','brando-addons').'</a>';
                        }
                        if( $brando_twitter_url ){
                            $output .= '<a href="'.$brando_twitter_url.'" target="_blank" class="black-text display-inline-block">'.__('Twitter','brando-addons').'</a>';
                        }
                        if( $brando_gplus_url ){
                            $output .= '<a href="'.$brando_gplus_url.'" target="_blank" class="black-text display-inline-block">'.__('Google +','brando-addons').'</a>';
                        }
                        if( $brando_linkedin_url ){
                            $output .= '<a href="'.$brando_linkedin_url.'" target="_blank" class="black-text display-inline-block">'.__('Linkedin','brando-addons').'</a>';
                        }
                        if( $brando_pinterest_url ){
                            $output .= '<a href="'.$brando_pinterest_url.'" target="_blank" class="black-text display-inline-block">'.__('Pinterest','brando-addons').'</a>';
                        }
                        if( $brando_behance_url ){
                            $output .= '<a href="'.$brando_behance_url.'" target="_blank" class="black-text display-inline-block">'.__('Behance','brando-addons').'</a>';
                        }
                    $output .= '</span>';
               $output .= '</div>';
            $output .= '</div>';
        break;

        case 'team-4':
            $output .= '<div class="team-style2">';
                if( $image_url ){
                    $output .= '<div class="position-relative margin-ten-bottom team-image">';
                        $output .= '<img src="'.$image_url.'"'.$image_alt.$image_title.'/>';
                        $output .= '<div class="img-border-medium border-transperent-white"></div>';
                    $output .= '</div>';
                }
                $output .= '<div class="team-social">';
                    if( $brando_facebook_url ){
                        $output .= '<a href="'.$brando_facebook_url.'" target="_blank"><i class="fa fa-facebook icon-extra-small black-text"></i></a>';
                    }
                    if( $brando_twitter_url ){
                        $output .= '<a href="'.$brando_twitter_url.'" target="_blank"><i class="fa fa-twitter icon-extra-small black-text"></i></a>';
                    }
                    if( $brando_gplus_url ){
                        $output .= '<a href="'.$brando_gplus_url.'" target="_blank"><i class="fa fa-google-plus icon-extra-small black-text"></i></a>';
                    }
                    if( $brando_linkedin_url ){
                        $output .= '<a href="'.$brando_linkedin_url.'" target="_blank"><i class="fa fa-linkedin icon-extra-small black-text"></i></a>';
                    }
                    if( $brando_pinterest_url ){
                        $output .= '<a href="'.$brando_pinterest_url.'" target="_blank"><i class="fa fa-pinterest icon-extra-small black-text"></i></a>';
                    }
                    if( $brando_behance_url ){
                        $output .= '<a href="'.$brando_behance_url.'" target="_blank"><i class="fa fa-behance icon-extra-small black-text"></i></a>';
                    }
                $output .= '</div>';
                if( $brando_member_name ){ 
                    $output .= '<span class="alt-font text-uppercase black-text display-block margin-six-top">'.$brando_member_name.'</span>';
                }
                if( $brando_member_des ){
                    $output .= '<span class="alt-font text-small text-uppercase">'.$brando_member_des.'</span>';
                }
            $output .= '</div>';
        break;
    }

    return $output;
}
add_shortcode( 'brando_team_member', 'brando_team_member_shortcode' );

/*-----------------------------------------------------------------------------------*/
/* Team Member */
/*-----------------------------------------------------------------------------------*/
?>
