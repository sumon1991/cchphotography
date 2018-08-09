<?php
/**
 * Shortcode For Popup
 *
 * @package Brando
 */
?>
<?php
/*-----------------------------------------------------------------------------------*/
/* Popup */
/*-----------------------------------------------------------------------------------*/

if ( ! function_exists( 'brando_popup_shortcode' ) ) {
    function brando_popup_shortcode( $atts, $content = null ) {
        extract( shortcode_atts( array(
            	'popup_type' => '',
            	'popup_button_config' => '',
                'popup_button_config_youtube' => '',
                'popup_form_id' => '',
                'contact_forms_shortcode' => '',
            ), $atts ) );
        $output = $popup_form_class = '';
        $first_button_parse_args = vc_parse_multi_attribute($popup_button_config);
        $first_button_link = ( isset($first_button_parse_args['url']) ) ? $first_button_parse_args['url'] : '#';
        $first_button_title = ( isset($first_button_parse_args['title']) ) ? $first_button_parse_args['title'] : 'sample button';
        $first_button_target = ( isset($first_button_parse_args['target']) ) ? trim($first_button_parse_args['target']) : '_self';
        $youtube_button = vc_parse_multi_attribute($popup_button_config_youtube);
        $youtube_button_link = ( isset($youtube_button['url']) ) ? $youtube_button['url'] : '#';
        $youtube_button_title = ( isset($youtube_button['title']) ) ? $youtube_button['title'] : 'sample button';
        $youtube_button_target = ( isset($youtube_button['target']) ) ? trim($youtube_button['target']) : '_self';
        
        switch ($popup_type){
            case 'popup-form-1':
                $contact_form = do_shortcode('[contact-form-7 id='.$contact_forms_shortcode.']');
                $output .='<div class="slider-text-middle2 text-center">';
                    if($content){
                        $output.= do_shortcode( brando_remove_wpautop($content) );
                    }
                    if($first_button_title){
                        $output .= '<a class="btn button-reveal button-reveal-black button popup-with-form no-margin" href="#popup-form-'.$popup_form_id.'" target="'.$first_button_target.'"><i class="fa fa-plus"></i><span class>'.$first_button_title.'</span></a>';
                    }
                    $output .= '<div id="popup-form-'.$popup_form_id.'" class="mfp-hide">';
                        $output .= '<div class="col-lg-3 col-md-5 col-sm-7 center-col text-center">';
                            if($content){
                                $output.= do_shortcode( brando_remove_wpautop($content) );
                            }
                            $output .= $contact_form;
                        $output .= '</div>';
                    $output .= '</div>';
                $output .= '</div>';
            break;
            
            case 'simple-ajax-popup-align-top':
                if( $content ){
                    $output.= do_shortcode( brando_remove_wpautop($content) );
                }
                if($first_button_title){
                    $output .= '<a class="highlight-button-dark btn btn-medium margin-four-top '.$popup_type.'" href="'.$first_button_link.'" target="'.$first_button_target.'">'.$first_button_title.'</a>';
                }
            break;

            case 'youtube-video-1':
                if($content){
                    $output.= do_shortcode( brando_remove_wpautop($content) );
                }
                if($youtube_button_title){
                    $output .='<a class="highlight-button btn btn-small button popup-youtube no-margin-right" href="'.$youtube_button_link.'" target="'.$youtube_button_target.'">'.$youtube_button_title.'</a>';
                }
            break;
            
            case 'vimeo-video-1':
                if($content){
                    $output.= do_shortcode( brando_remove_wpautop($content) );
                }
                if($first_button_title){
                    $output .='<a class="highlight-button btn btn-small no-margin-right popup-vimeo no-margin-bottom" href="'.$first_button_link.'" target="'.$first_button_target.'">'.$first_button_title.'</a>';
                }
            break;
            
            case 'google-map-1':
                if($content){
                    $output.= do_shortcode( brando_remove_wpautop($content) );
                }
                if($first_button_title){
                    $output .='<a class="highlight-button btn btn-small button popup-googlemap no-margin-right" href="'.$first_button_link.'" target="'.$first_button_target.'">'.$first_button_title.'</a>';
                }
            break;
        }
       
        return $output;
    }
}
add_shortcode( 'brando_popup', 'brando_popup_shortcode' );
?>