<?php
/**
 * displaying in gallery for blog
 *
 * @package Brando
 */
?>
<?php	
$brando_blog_lightbox_gallery = brando_post_meta('brando_lightbox_image');
$brando_blog_gallery = brando_post_meta('brando_gallery');
$brando_gallery = explode(",",$brando_blog_gallery);
$brando_popup_id = 'blog-'.get_the_ID();
if($brando_blog_lightbox_gallery == 1){
	echo '<div class="blog-image lightbox-gallery clearfix margin-ten no-margin-lr no-margin-top">';
	if(is_array($brando_gallery)){
		foreach ($brando_gallery as $key => $value) {
			/* Image Alt, Title, Caption */
			$brando_img_alt = brando_option_image_alt($value);
			$brando_img_title = brando_option_image_title($value);
			$brando_img_lightbox_caption = brando_option_image_caption($value);
			$brando_img_lightbox_title = brando_option_lightbox_image_title($value);
			$brando_image_alt = ( isset($brando_img_alt['alt']) && !empty($brando_img_alt['alt']) ) ? 'alt="'.esc_attr($brando_img_alt['alt']).'"' : 'alt=""' ; 
			$brando_image_title = ( isset($brando_img_title['title']) && !empty($brando_img_title['title']) ) ? ' title="'.esc_attr($brando_img_title['title']).'"' : '';
			$brando_image_lightbox_caption = ( isset($brando_img_lightbox_caption['caption']) && !empty($brando_img_lightbox_caption['caption']) ) ? ' lightbox_caption="'.esc_attr($brando_img_lightbox_caption['caption']).'"' : '' ;
			$brando_image_lightbox_title = ( isset($brando_img_lightbox_title['title']) && !empty($brando_img_lightbox_title['title']) ) ? ' title="'.esc_attr($brando_img_lightbox_title['title']).'"' : '' ; 
			$brando_thumb = wp_get_attachment_image_src( $value, 'full' );
			if($brando_thumb[0]){
                echo '<div class="col-md-4 col-sm-6 col-xs-12 no-padding">';
                    echo '<a class="lightboxgalleryitem" data-group="'.esc_attr($brando_popup_id).'" '.$brando_image_lightbox_title.$brando_image_lightbox_caption.' href="'.$brando_thumb[0].'"><img src="'.esc_url($brando_thumb[0]).'" width="'.$brando_thumb[1].'" height="'.$brando_thumb[2].'" '.$brando_image_alt.$brando_image_title.'/></a>';
                echo '</div>';
            }
		}
	}
    echo '</div>';
}else{
	echo '<div class="blog-image">';
        echo '<div id="owl-demo" class="owl-slider-full owl-carousel owl-theme light-pagination light-navigation">';
			if(is_array($brando_gallery)){
				foreach ($brando_gallery as $key => $value) {
					$brando_thumb = wp_get_attachment_image_src( $value, 'full' );
					/* Image Alt, Title, Caption */
					$brando_img_alt = brando_option_image_alt($value);
					$brando_img_title = brando_option_image_title($value);

					$brando_image_alt = ( isset($brando_img_alt['alt']) && !empty($brando_img_alt['alt']) ) ? 'alt="'.esc_attr($brando_img_alt['alt']).'"' : 'alt=""' ; 
					$brando_image_title = ( isset($img_title['title']) && !empty($brando_img_title['title']) ) ? ' title="'.esc_attr($brando_img_title['title']).'"' : '';
					if($brando_thumb[0]){
			            echo '<div class="item"><img src="'.esc_url($brando_thumb[0]).'" width="'.$brando_thumb[1].'" height="'.$brando_thumb[2].'" '.$brando_image_alt.$brando_image_title.'/></div>';
					}
				}
			}
		echo '</div>';
    echo '</div>';    
}
?>