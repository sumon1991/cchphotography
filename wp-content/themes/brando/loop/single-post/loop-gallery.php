<?php
/**
 * displaying single posts in gallery for blog
 *
 * @package Brando
 */

	$brando_blog_lightbox_gallery = brando_post_meta('brando_lightbox_image');
	$brando_blog_gallery = brando_post_meta('brando_gallery');
	$brando_gallery = explode(",",$brando_blog_gallery);
	$brando_popup_id = 'blog-'.get_the_ID();
	if($brando_blog_lightbox_gallery == 1)
	{
		echo '<div class="blog-image lightbox-gallery clearfix margin-ten no-margin-lr no-margin-top">';
			if(is_array($brando_gallery)):
				foreach ($brando_gallery as $key => $value) 
				{
					$brando_thumb = wp_get_attachment_image_src( $value, 'full' );
					if($brando_thumb[0]):
		                echo '<div class="col-md-4 col-sm-6 col-xs-12 no-padding">';
		                    echo '<a title="'.get_the_title().'" href="'.esc_url($brando_thumb[0]).'" class="lightboxgalleryitem" data-group="'.esc_attr($brando_popup_id).'"><img src="'.esc_url($brando_thumb[0]).'" width="'.$brando_thumb[1].'" height="'.$brando_thumb[2].'" alt=""/></a>';
		                echo '</div>';
		            endif;
				}
			endif;
	    echo '</div>';
	}else{
		echo '<div class="blog-image bg-transparent margin-bottom-30px">';
	        echo '<div id="owl-demo" class="owl-slider-full owl-carousel owl-theme dark-pagination">';
				if(is_array($brando_gallery)):
					foreach ($brando_gallery as $key => $value) {
						$brando_thumb = wp_get_attachment_image_src( $value, 'full' );
						if($brando_thumb[0]):
				            echo '<div class="item"><img src="'.esc_url($brando_thumb[0]).'" width="'.$brando_thumb[1].'" height="'.$brando_thumb[2].'" alt=""/></div>';
				        endif;
					}
				endif;
	        echo '</div>';
	    echo '</div>';
	}

	$brando_blog_image=brando_post_meta("brando_featured_image");
	if($brando_blog_image == 1)
	{
		echo '<div class="blog-image bg-transparent margin-five no-margin-lr">';
	        if ( has_post_thumbnail() ) {
	            the_post_thumbnail( 'full' );
	        }
		echo '</div>';
	}	
	?>