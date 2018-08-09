<?php
/**
 * Shortcode For Video & Sound
 *
 * @package Brando
 */
?>
<?php
/*-----------------------------------------------------------------------------------*/
/* Video & Sound */
/*-----------------------------------------------------------------------------------*/
 
if ( ! function_exists( 'brando_video_sound' ) ) {
    function brando_video_sound( $atts, $content = null ) {
        extract( shortcode_atts( array(
        	'brando_video_type' => '',
            'brando_vimeo_id' => '',
            'brando_youtube_url' => '',
            'brando_track_id' =>'',
            'width' => '',
            'height' => '',
        ), $atts ) );
        $output = '';
        $width = ( $width ) ? ' width="'.$width.'"' : '';
        $height = ( $height ) ? ' height="'.$height.'"' : '';
        switch ($brando_video_type) 
        {
        	case 'vimeo':
                if($brando_vimeo_id){
                    $output .= '<div class="fit-videos">';
            		  $output .='<iframe src="https://player.vimeo.com/video/'.$brando_vimeo_id.'?color=bb9b44&amp;title=0&amp;byline=0&amp;portrait=0"'.$width.$height.'></iframe>';
                    $output .= '</div>';
                }
        	break;

        	case 'youtube':
                if($brando_youtube_url){
                    $output .= '<div class="fit-videos">';
            		  $output .='<iframe'.$width.$height.' src="'.$brando_youtube_url.'"></iframe>';
                    $output .= '</div>';
                }
        	break;

        	case 'sound-cloud':
                if($brando_track_id){
        		    $output .='<div class="sound"><iframe'.$width.$height.' src="https://w.soundcloud.com/player/?url=https%3A//api.soundcloud.com/tracks/'.$brando_track_id.'&amp;auto_play=false&amp;hide_related=false&amp;show_comments=true&amp;show_user=true&amp;show_reposts=false"></iframe></div>';
                }
        	break;
        }
        return $output;
    }
}
add_shortcode( 'brando_video_sound', 'brando_video_sound' );
?>