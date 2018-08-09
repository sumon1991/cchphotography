<?php
/**
 * displaying video for blog
 *
 * @package Brando
 */
?>
<?php
$brando_video_type = brando_post_meta('brando_video_type');
$brando_video = brando_post_meta('brando_video');
if($brando_video_type == 'self'){
    $brando_video_mp4 = brando_post_meta('brando_video_mp4');
    $brando_video_ogg = brando_post_meta('brando_video_ogg');
    $brando_video_webm = brando_post_meta('brando_video_webm');
    $brando_mute = brando_post_meta('brando_enable_mute');
    $brando_enable_mute = ($brando_mute == 1) ? 'muted ' : '';
    if($brando_video_mp4 || $brando_video_ogg || $brando_video_webm){
        echo '<div class="blog-image">';
            echo '<video autoplay '.esc_attr($brando_enable_mute).'loop controls>';
                if(!empty($brando_video_mp4)){
                    echo '<source src="'.esc_url($brando_video_mp4).'" type="video/mp4">';
                }
                if(!empty($brando_video_ogg)){
                    echo '<source src="'.esc_url($brando_video_ogg).'" type="video/ogg">';
                }
                if(!empty($brando_video_webm)){
                    echo '<source src="'.esc_url($brando_video_webm).'" type="video/webm">';
                }
            echo '</video>';
        echo '</div>';
    }
}else{
    $brando_video_url = brando_post_meta('brando_video');
    if($brando_video_url){
        echo '<div class="blog-image fit-videos">';
            echo '<embed src="'.esc_url($brando_video_url).'" width="640" height="360"></embed>';
        echo '</div>';
    }
}
?>