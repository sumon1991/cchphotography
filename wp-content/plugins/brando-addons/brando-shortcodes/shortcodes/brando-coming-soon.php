<?php
/**
 * Shortcode For Coming soon
 *
 * @package Brando
 */
?>
<?php
/*-----------------------------------------------------------------------------------*/
/* Coming soon */
/*-----------------------------------------------------------------------------------*/

if ( ! function_exists( 'brando_coming_soon_shortcode' ) ) {
    function brando_coming_soon_shortcode( $atts, $content = null ) {
        extract( shortcode_atts( array(
            'id' => '',
            'class' => '',
            'brando_coming_soon_type' => '',
            'brando_coming_soon_logo' => '',
            'brando_coming_soon_mp4' => '',
            'brando_coming_soon_ogg' => '',
            'brando_coming_soon_webm' => '',
            'brando_coming_soon_title' => '',
            'brando_coming_soon_title_color' => '',
            'brando_coming_soon_date' => '',
            'brando_coming_soon_notify_me_counter_color' => '',
            'brando_coming_soon_notify_me_show_form' => '',
            'brando_coming_soon_notify_placeholder' => '',
            'brando_coming_soon_notify_me_fb' => '',
            'brando_coming_soon_notify_me_fb_url' => '',
            'brando_coming_soon_notify_me_tw' => '',
            'brando_coming_soon_notify_me_tw_url' => '',
            'brando_coming_soon_notify_me_gp' => '',
            'brando_coming_soon_notify_me_gp_url' => '',
            'brando_coming_soon_notify_me_dr' => '',
            'brando_coming_soon_notify_me_dr_url' => '',
            'brando_coming_soon_notify_me_yt' => '',
            'brando_coming_soon_notify_me_yt_url' => '',
            'brando_coming_soon_notify_me_li' => '',
            'brando_coming_soon_notify_me_li_url' => '',
            'brando_coming_soon_notify_me_pi' => '',
            'brando_coming_soon_notify_me_pi_url' => '',
            'brando_coming_soon_notify_me_be' => '',
            'brando_coming_soon_notify_me_be_url' => '',

        ), $atts ) );
        
        $output =  $style = '';
        
        $id = ($id) ? ' id='.$id : '';
        $class = ($class) ? ' '.$class : ''; 
        $brando_coming_soon_logo = ( $brando_coming_soon_logo ) ? $brando_coming_soon_logo : '';
        $brando_coming_soon_mp4 = ( $brando_coming_soon_mp4 ) ? $brando_coming_soon_mp4 : '';
        $brando_coming_soon_ogg = ( $brando_coming_soon_ogg ) ? $brando_coming_soon_ogg : '';
        $brando_coming_soon_webm = ( $brando_coming_soon_webm ) ? $brando_coming_soon_webm : '';
        $brando_coming_soon_title = ( $brando_coming_soon_title ) ? $brando_coming_soon_title : '';
        $brando_coming_soon_date = ( $brando_coming_soon_date ) ? $brando_coming_soon_date : '';
        $brando_coming_soon_notify_me_show_form = ( $brando_coming_soon_notify_me_show_form ) ? $brando_coming_soon_notify_me_show_form : '';
        $brando_coming_soon_notify_placeholder = ( $brando_coming_soon_notify_placeholder ) ? $brando_coming_soon_notify_placeholder : 'ENTER YOUR EMAIL ADDRESS';
        $brando_coming_soon_notify_me_fb_url = ( $brando_coming_soon_notify_me_fb_url ) ? $brando_coming_soon_notify_me_fb_url : '#';
        $brando_coming_soon_notify_me_tw_url = ( $brando_coming_soon_notify_me_tw_url ) ? $brando_coming_soon_notify_me_tw_url : '#';
        $brando_coming_soon_notify_me_gp_url = ( $brando_coming_soon_notify_me_gp_url ) ? $brando_coming_soon_notify_me_gp_url : '#';
        $brando_coming_soon_notify_me_dr_url = ( $brando_coming_soon_notify_me_dr_url ) ? $brando_coming_soon_notify_me_dr_url : '#';
        $brando_coming_soon_notify_me_yt_url = ( $brando_coming_soon_notify_me_yt_url ) ? $brando_coming_soon_notify_me_yt_url : '#';
        $brando_coming_soon_notify_me_li_url = ( $brando_coming_soon_notify_me_li_url ) ? $brando_coming_soon_notify_me_li_url : '#';
        $brando_coming_soon_notify_me_pi_url = ( $brando_coming_soon_notify_me_pi_url ) ? $brando_coming_soon_notify_me_pi_url : '#';
        $brando_coming_soon_notify_me_be_url = ( $brando_coming_soon_notify_me_be_url ) ? $brando_coming_soon_notify_me_be_url : '#';
        $brando_coming_soon_title_color = ( $brando_coming_soon_title_color ) ? ' style="color:'.$brando_coming_soon_title_color.' !important;"' : '';
        $brando_coming_soon_notify_me_counter_color = ( $brando_coming_soon_notify_me_counter_color ) ? ' style="color:'.$brando_coming_soon_notify_me_counter_color.' !important;"' : '';

        $thumb = wp_get_attachment_image_src($brando_coming_soon_logo, 'full');

        /* Image Alt, Title, Caption */
        $img_alt = brando_option_image_alt($brando_coming_soon_logo);
        $img_title = brando_option_image_title($brando_coming_soon_logo);
        $image_alt = ( isset($img_alt['alt']) && !empty($img_alt['alt']) ) ? ' alt="'.$img_alt['alt'].'"' : ' alt=""' ; 
        $image_title = ( isset($img_title['title']) && !empty($img_title['title']) ) ? ' title="'.$img_title['title'].'"' : '';
    
        $output .= '<div'.$id.' class="coming-soon-bg owl-bg-img'.$class.'">';
          $output .= '<div class="position-relative container full-screen">';
            $output .= '<div class="slider-typography">';
                $output .= '<div class="slider-text-middle-main">';
                        $output .= '<div class="slider-text-middle">';
                            if( $thumb[0] ){
                                $output .= '<a class="margin-seven-bottom xs-margin-eight-bottom display-inline-block" href="'.home_url().'"><img src="'.$thumb[0].'" class="img-responsive width-100" width="'.$thumb[1].'" height="'.$thumb[2].'"'.$image_alt.$image_title.'/></a>';
                            }
                            $output .= '<div class="row">';
                                $output .= '<div class="col-md-12 col-sm-12 col-xs-12 text-center margin-seven-bottom xs-margin-eight-bottom">';
                                    if( $brando_coming_soon_title || $brando_coming_soon_title_color ){
                                        $output .= '<span class="title-medium alt-font  text-uppercase font-weight-400 letter-spacing-1 xs-text-extra-large"'.$brando_coming_soon_title_color.'>'.$brando_coming_soon_title.'</span>';                      
                                    }
                                    if( $brando_coming_soon_date ){
                                        $output .= '<div id="counter-event" data-enddate="'.$brando_coming_soon_date.'" class="countdown-timer text-center alt-font center-col margin-six-top"'.$brando_coming_soon_notify_me_counter_color.'>';
                                    }
                                $output .= '</div>';
                            $output .= '</div>';    
                        $output .= '</div>';
                        $output .= '<div class="row">';
                            if(  $brando_coming_soon_notify_me_show_form == 1 || $brando_coming_soon_notify_me_fb == 1 || $brando_coming_soon_notify_me_tw == 1 || $brando_coming_soon_notify_me_gp == 1 || $brando_coming_soon_notify_me_dr == 1 || $brando_coming_soon_notify_me_yt == 1 || $brando_coming_soon_notify_me_li == 1){
                                $output .= '<div class="col-lg-5 col-md-6 center-col col-sm-8 col-xs-12 text-center">';
                                    if( $content  ){
                                        $output.= do_shortcode( brando_remove_wpautop($content) );
                                    }
                                    if( $brando_coming_soon_notify_me_show_form == 1 ){
                                        $output .= '<form id="comingsoonscontactform" class="margin-eight-bottom" name="subscription"  action="'.esc_url( home_url() ).'/index.php?wp_nlm=subscription" method="POST">';
                                        $output .= '<div id="success" class="no-margin-lr"></div>';
                                        $output .= '<input id="email"  type="text" class="form-control xyz_em_email"  name="xyz_em_email" placeholder="'.$brando_coming_soon_notify_placeholder.'">';
                                        $output .= '<button name="submit" id="submit_newsletter" class="submit_newsletter" ><i class="fa fa-envelope-o"></i></button>';
                                        $output .= '</form>';
                                    }
                                    if( $brando_coming_soon_notify_me_fb == 1 || $brando_coming_soon_notify_me_tw == 1 || $brando_coming_soon_notify_me_gp == 1 || $brando_coming_soon_notify_me_dr == 1 || $brando_coming_soon_notify_me_yt == 1 || $brando_coming_soon_notify_me_li == 1 ){
                                        $output .= '<div class="footer-social position-relative top4 ">';
                                            if( $brando_coming_soon_notify_me_fb == 1 ){
                                                $output .='<a href="'.$brando_coming_soon_notify_me_fb_url.'" target="_blank"><i class="fa fa-facebook white-text"></i></a>';
                                            }
                                            if( $brando_coming_soon_notify_me_tw == 1 ){
                                                $output .='<a href="'.$brando_coming_soon_notify_me_tw_url.'" target="_blank"><i class="fa fa-twitter white-text"></i></a>';
                                            }
                                            if( $brando_coming_soon_notify_me_gp == 1 ){
                                                $output .='<a href="'.$brando_coming_soon_notify_me_gp_url.'" target="_blank"><i class="fa fa-google-plus white-text"></i></a>';
                                            }
                                            if( $brando_coming_soon_notify_me_dr == 1 ){
                                                $output .='<a href="'.$brando_coming_soon_notify_me_dr_url.'" target="_blank"><i class="fa fa-dribbble white-text"></i></a>';
                                            }
                                            if( $brando_coming_soon_notify_me_yt == 1 ){
                                                $output .='<a href="'.$brando_coming_soon_notify_me_yt_url.'" target="_blank"><i class="fa fa-youtube white-text"></i></a>';
                                            }
                                            if( $brando_coming_soon_notify_me_li == 1 ){
                                                $output .= '<a href="'.$brando_coming_soon_notify_me_li_url.'" target="_blank"><i class="fa fa-linkedin white-text"></i></a>';
                                            }
                                            if( $brando_coming_soon_notify_me_pi == 1 ){
                                                $output .= '<a href="'.$brando_coming_soon_notify_me_pi_url.'" target="_blank"><i class="fa fa-pinterest white-text"></i></a>';
                                            }
                                            if( $brando_coming_soon_notify_me_be == 1 ){
                                                $output .= '<a href="'.$brando_coming_soon_notify_me_be_url.'" target="_blank"><i class="fa fa-behance white-text"></i></a>';
                                            }
                                        $output .= '</div>';
                                    }   
                                    $output .= '</div>';
                                }
                            $output .= '</div>';
                        $output .= '</div>';
                    $output .= '</div>';
                $output .= '</div>';
            $output .= '</div>';
        $output .= '</div>';
        
        return $output;
    }
}
add_shortcode( 'brando_coming_soon', 'brando_coming_soon_shortcode' );
?>