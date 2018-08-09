<?php
/**
 * Shortcode For Image gallery
 *
 * @package Brando
 */
?>
<?php 
/*-----------------------------------------------------------------------------------*/
/* Image gallery */
/*-----------------------------------------------------------------------------------*/

if ( ! function_exists( 'brando_image_gallery_shortcode' ) ) {
	function brando_image_gallery_shortcode( $atts, $content = null ) { 
		extract( shortcode_atts( array(
	        	'image_gallery_type' => '',
	        	'simple_image_type' => '',
	        	'column' => '',
	        	'image_gallery' => '',
	        	'brando_column_animation_style' => '',
	        	'padding_setting' => '',
		        'desktop_padding' => '',
		        'custom_desktop_padding' => '',
		        'ipad_padding' => '',
		        'mobile_padding' => '',
		        'margin_setting' => '',
		        'desktop_margin' => '',
		        'custom_desktop_margin' => '',
		        'ipad_margin' => '',
		        'mobile_margin' => '',
		        'id' => '',
		        'class' => '',
	    ), $atts ) );

		$explode_image = explode(",",$image_gallery);
		$image_url = wp_get_attachment_image_src($image_gallery, 'full');
		$output = $classes_masonry = $padding = $padding_style = $margin = $margin_style = $style_attr = $style ='';  
		$brando_column_animation_style = ($brando_column_animation_style) ? 'class="wow '.$brando_column_animation_style.'"' : '';
		$popup_id = ( $id ) ? $id : 'default';
		$id = ( $id ) ? 'id="'.$id.'"' : '';
		$class_main = ( $class ) ? ' '.$class : ''; 

		// Column Padding settings
		$padding_setting = ( $padding_setting ) ? $padding_setting : '';
		$desktop_padding = ( $desktop_padding ) ? ' '.$desktop_padding : '';
		$ipad_padding = ( $ipad_padding ) ? ' '.$ipad_padding : '';
		$mobile_padding = ( $mobile_padding ) ? ' '.$mobile_padding : '';
		$custom_desktop_padding = ( $custom_desktop_padding ) ? $custom_desktop_padding : '';
		if($desktop_padding == 'custom-desktop-padding' && $custom_desktop_padding)
		{
			$padding_style .= " padding: ".$custom_desktop_padding.";";
		}else{
			$padding .= $desktop_padding;
		}
		$padding .= $ipad_padding.$mobile_padding;

		// Column Margin settings
		$margin_setting = ( $margin_setting ) ? $margin_setting : '';
		$desktop_margin = ( $desktop_margin ) ? ' '.$desktop_margin : '';
		$ipad_margin = ( $ipad_margin ) ? ' '.$ipad_margin : '';
		$mobile_margin = ( $mobile_margin ) ? ' '.$mobile_margin : '';
		$custom_desktop_margin = ( $custom_desktop_margin ) ? $custom_desktop_margin : '';
		if($desktop_margin == 'custom-desktop-margin' && $custom_desktop_margin)
		{
			$margin_style .= " margin: ".$custom_desktop_margin.";";
		}else{
			$margin .= $desktop_margin;
		}
		$margin .= $ipad_margin.$mobile_margin;

		// Padding and Margin Style Combine
		if($padding_style)
		{
			$style_attr .= $padding_style;
		}
		if($margin_style)
		{
			$style_attr .= $margin_style;
		}
		if($style_attr)
		{
			$style .= ' style="'.$style_attr.'"';
		}

	    $classes_masonry .= ' work-'.$column.'col';

		switch ($image_gallery_type) 
		{
		    case 'lightbox-gallery':

		     	if($explode_image){

					$output .='<div '.$id.' class="gutter grid-gallery'.$classes_masonry.$class_main.' overflow-hidden'.$padding.$margin.'"'.$style.'>';
						$output .='<ul class="grid masonry-item lightbox-gallery">';
							foreach ($explode_image as $key => $value) 
							{
								/* Image Alt, Title, Caption */
								$img_alt = brando_option_image_alt($value);
								$img_title = brando_option_image_title($value);
								$img_lightbox_caption = brando_option_image_caption($value);
								$img_lightbox_title = brando_option_lightbox_image_title($value);
								$image_alt = ( isset($img_alt['alt']) && !empty($img_alt['alt']) ) ? ' alt="'.$img_alt['alt'].'"' : ' alt=""' ; 
								$image_title = ( isset($img_title['title']) && !empty($img_title['title']) ) ? ' title="'.$img_title['title'].'"' : '';
								$image_lightbox_caption = ( isset($img_lightbox_caption['caption']) && !empty($img_lightbox_caption['caption']) ) ? ' lightbox_caption="'.$img_lightbox_caption['caption'].'"' : '' ;
								$image_lightbox_title = ( isset($img_lightbox_title['title']) && !empty($img_lightbox_title['title']) ) ? ' title="'.$img_lightbox_title['title'].'"' : '' ;

								$image_url = wp_get_attachment_image_src($value, 'full');
									$output .='<li '.$brando_column_animation_style.'>';
									   $output .= '<figure class="overflow-hidden">';
					                    $output .='<a class="lightboxgalleryitem" data-group="'.$popup_id.'" href="'.$image_url[0].'"'.$image_lightbox_title.$image_lightbox_caption.'>';
					                    	$output .='<img src="'.$image_url[0].'"'.$image_alt.$image_title.' width="'.$image_url[1].'" height="'.$image_url[2].'" />';
					                    $output .='</a>';
					                   $output .= '</figure>'; 
					                $output .='</li>';
						    }
				        $output .='</ul>';
					$output .='</div>';
					
				}

			break;

            case 'simple-image-lightbox':

                if($explode_image){
					$output .='<div '.$id.' class="gutter grid-gallery'.$classes_masonry.$class_main.' overflow-hidden'.$padding.$margin.'"'.$style.'>';
						$output .='<ul class="grid">';
							foreach ($explode_image as $key => $value) 
							{
								/* Image Alt, Title, Caption */
								$img_alt = brando_option_image_alt($value);
								$img_title = brando_option_image_title($value);
								$img_lightbox_caption = brando_option_image_caption($value);
								$img_lightbox_title = brando_option_lightbox_image_title($value);
								$image_alt = ( isset($img_alt['alt']) && !empty($img_alt['alt']) ) ? ' alt="'.$img_alt['alt'].'"' : ' alt=""' ; 
								$image_title = ( isset($img_title['title']) && !empty($img_title['title']) ) ? ' title="'.$img_title['title'].'"' : '';
								$image_lightbox_caption = ( isset($img_lightbox_caption['caption']) && !empty($img_lightbox_caption['caption']) ) ? ' lightbox_caption="'.$img_lightbox_caption['caption'].'"' : '' ;
								$image_lightbox_title = ( isset($img_lightbox_title['title']) && !empty($img_lightbox_title['title']) ) ? ' title="'.$img_lightbox_title['title'].'"' : '' ;

							    $image_url = wp_get_attachment_image_src($value, 'full');
								$output .='<li '.$brando_column_animation_style.'>';
									$output .= '<figure class="overflow-hidden">';
				                        $output .='<a class="single-image-lightbox" href="'.$image_url[0].'"'.$image_lightbox_title.$image_lightbox_caption.'>';
				                            $output .='<img src="'.$image_url[0].'"'.$image_alt.$image_title.' width="'.$image_url[1].'" height="'.$image_url[2].'" />';
				                        $output .='</a>';
				                    $output .= '</figure>'; 
				                $output .='</li>';
						    }
					    $output .='</ul>';
				    $output .='</div>';

				}

		    break;

		    case 'zoom-gallery':

                if($explode_image){

					$output .='<div '.$id.' class="gutter grid-gallery zoom-gallery'.$classes_masonry.$class_main.' overflow-hidden'.$padding.$margin.'"'.$style.'>';
						$output .='<ul class="grid">';
							foreach ($explode_image as $key => $value) 
							{
								/* Image Alt, Title, Caption */
								$img_alt = brando_option_image_alt($value);
								$img_title = brando_option_image_title($value);
								$img_lightbox_caption = brando_option_image_caption($value);
								$img_lightbox_title = brando_option_lightbox_image_title($value);
								$image_alt = ( isset($img_alt['alt']) && !empty($img_alt['alt']) ) ? ' alt="'.$img_alt['alt'].'"' : ' alt=""' ; 
								$image_title = ( isset($img_title['title']) && !empty($img_title['title']) ) ? ' title="'.$img_title['title'].'"' : '';
								$image_lightbox_caption = ( isset($img_lightbox_caption['caption']) && !empty($img_lightbox_caption['caption']) ) ? ' lightbox_caption="'.$img_lightbox_caption['caption'].'"' : '' ;
								$image_lightbox_title = ( isset($img_lightbox_title['title']) && !empty($img_lightbox_title['title']) ) ? ' title="'.$img_lightbox_title['title'].'"' : '' ;

								$image_url = wp_get_attachment_image_src($value, 'full');
								$output .='<li '.$brando_column_animation_style.'>';
									$output .= '<figure class="overflow-hidden">';
					                    $output .='<a class="lightboxzoomgalleryitem" data-group="'.$popup_id.'" href="'.$image_url[0].'"'.$image_lightbox_title.$image_lightbox_caption.'>';
					                        $output .='<img src="'.$image_url[0].'"'.$image_alt.$image_title.' width="'.$image_url[1].'" height="'.$image_url[2].'" />';
					                    $output .='</a>';
					                $output .= '</figure>'; 
					            $output .='</li>';
						    }
					    $output .='</ul>';
				    $output .='</div>';

				}

		    break;
        } 
		return $output;   
	}
}
add_shortcode( 'brando_image_gallery', 'brando_image_gallery_shortcode' );