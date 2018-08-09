<?php
/**
 * Metabox Map
 *
 * @package Brando
 */
?>
<?php
function brando_meta_box_text($brando_id, $brando_label, $brando_desc = '', $brando_short_desc = '')
{
	global $post;

	$html = '';
		$html .= '<div class="'.esc_attr($brando_id).'_box description_box">';
		$html .= '<div class="left-part">';
			$html .= $brando_label;
			if($brando_desc) {
				$html .= '<span class="description">' . esc_attr($brando_desc) . '</span>';
			}
		$html .='</div>';
		$html .= '<div class="right-part">';
			$html .= '<input type="text" id="' . esc_attr($brando_id) . '" name="' . esc_attr($brando_id) . '" value="' . get_post_meta($post->ID, $brando_id, true) . '" />';
			if($brando_short_desc) {
				$html .= '<span class="short-description">' . esc_attr($brando_short_desc) . '</span>';
			}
		$html .= '</div>';
		$html .= '</div>';
	echo sprintf("%s",$html);
}

function brando_meta_box_dropdown($brando_id, $brando_label, $brando_options, $brando_desc = '')
{
	global $post;

	$html = $brando_select_class = '';

			$html .= '<div class="'.esc_attr($brando_id).'_box description_box">';
					$html .= '<div class="left-part">';
							$html .= $brando_label;
							if($brando_desc) {
									$html .= '<span class="description">' . esc_attr($brando_desc) . '</span>';
							}
					$html .='</div>';
					$html .= '<div class="right-part">';
							$html .= '<select id="' . esc_attr($brando_id) . '" class="'.$brando_select_class.'" name="' . esc_attr($brando_id) . '">';
							foreach($brando_options as $key => $option) {
									if(get_post_meta($post->ID, $brando_id, true) == (string)$key && get_post_meta($post->ID, $brando_id, true) != '') {
											$brando_selected = 'selected="selected"';
									}else {
													$brando_selected = '';
									}

									$html .= '<option ' . $brando_selected . ' value="' . esc_attr($key) . '">' . esc_attr($option) . '</option>';

							}
							$html .= '</select>';
					$html .='</div>';	
		$html .= '</div>';
	echo sprintf("%s",$html);
}

function brando_meta_box_dropdown_sidebar($brando_id, $brando_label, $brando_options, $brando_desc = '', $brando_child_hidden = '')
{
	global $post;

	$html = $brando_select_class = '';
	$flag = false;
		$brando_child_hidden = ( $brando_child_hidden ) ? ' hide-child '.$brando_child_hidden : '';
		$html .= '<div class="'.esc_attr($brando_id).'_box description_box'.$brando_child_hidden.'">';
			$html .= '<div class="left-part">';
				$html .= $brando_label;
				if($brando_desc) {
					$html .= '<span class="description">' . esc_attr($brando_desc) . '</span>';
				}
			$html .='</div>';
			$html .= '<div class="right-part">';
				$html .= '<select id="' . esc_attr($brando_id) . '" class="'.esc_attr($brando_select_class).'" name="' . esc_attr($brando_id) . '">';
				foreach($brando_options as $key => $option) {
					if(get_post_meta($post->ID, $brando_id, true) == $key && get_post_meta($post->ID, $brando_id, true) != '') {
						$brando_selected = 'selected="selected"';
					}else {
							$brando_selected = '';
					}

					$html .= '<option ' . $brando_selected . ' value="' . esc_attr($key) . '">' . esc_attr($option) . '</option>';

				}
				$html .= '</select>';
			$html .='</div>';	
		$html .= '</div>';
	echo sprintf("%s",$html);
}

/* menu dropdown */

function brando_meta_box_dropdown_menu($brando_id, $brando_label, $brando_options, $brando_desc = '')
{
	global $post;

	$html = $brando_select_class = '';
	$flag = false;

	
		$html .= '<div class="'.esc_attr($brando_id).'_box description_box">';
			$html .= '<div class="left-part">';
				$html .= $brando_label;
				if($brando_desc) {
					$html .= '<span class="description">' . esc_attr($brando_desc) . '</span>';
				}
			$html .='</div>';
			$html .= '<div class="right-part">';
				$html .= '<select id="' . esc_attr($brando_id) . '" class="'.esc_attr($brando_select_class).'" name="' . esc_attr($brando_id) . '">';
				$html .= '<option value="">Default</option>';
				$brando_menus = wp_get_nav_menus();
				$brando_menu_array = array();
				foreach ($brando_menus as $key => $value) {
					if(get_post_meta($post->ID, $brando_id, true) == $value->slug && get_post_meta($post->ID, $brando_id, true) != '') {
						$brando_selected = 'selected="selected"';
					}else {
							$brando_selected = '';
					}

					$html .= '<option ' . $brando_selected . ' value="' . esc_attr($value->slug) . '">' . esc_attr($value->name) . '</option>';
				}
				$html .= '</select>';
			$html .='</div>';	
		$html .= '</div>';
	echo sprintf("%s",$html);
}

function brando_meta_box_textarea($brando_id, $brando_label, $brando_desc = '', $brando_default = '' )
{
	global $post;
	$html = '';
	$html .= '<div class="'.esc_attr($brando_id).'_box description_box">';
	$html .= '<div class="left-part">';
		$html .= $brando_label;
		if($brando_desc) {
			$html .= '<span class="description">' . esc_attr($brando_desc) . '</span>';
		}
	$html .='</div>';
	
	if( get_post_meta($post->ID, $brando_id, true)) {
		$brando_value = get_post_meta($post->ID, $brando_id, true);
	} else {
		$brando_value = '';
	}
	$html .= '<div class="right-part">';
		$html .= '<textarea cols="120" id="' . esc_attr($brando_id) . '" name="' . esc_attr($brando_id) . '">' . esc_attr($brando_value) . '</textarea>';
	$html .='</div>';
	$html .= '</div>';

	echo sprintf("%s",$html);
}

function brando_meta_box_upload($brando_id, $brando_label, $brando_desc = '')
{
	global $post;

	$html = '';
	$html .= '<div class="'.esc_attr($brando_id).'_box description_box">';
	$html .= '<div class="left-part">';
		$html .= $brando_label;
		if($brando_desc) {
			$html .= '<span class="description">' . esc_attr($brando_desc) . '</span>';
		}
	$html .='</div>';
	$html .= '<div class="right-part">';
		$html .= '<input name="' . esc_attr($brando_id) . '" class="upload_field" id="brando_upload" type="text" value="' . get_post_meta($post->ID,  $brando_id, true) . '" />';
		$html .= '<input name="'. $brando_id.'_thumb" class="'. $brando_id.'_thumb" id="'. $brando_id.'_thumb" type="hidden" value="'.get_post_meta($post->ID,  $brando_id, true).'" />';
				$html .= '<img class="upload_image_screenshort" src="'.get_post_meta($post->ID,  $brando_id, true).'" />';
		$html .= '<input class="brando_upload_button" id="brando_upload_button" type="button" value="'.__( 'Browse', 'brando-addons' ).'" />';
		$html .= '<span class="brando_remove_button button">'.__( 'Remove', 'brando-addons' ).'</span>';
				
	$html .='</div>';
	$html .= '</div>';
	echo sprintf("%s",$html);
}

function brando_meta_box_upload_multiple($brando_id, $brando_label, $brando_desc = '')
{
	global $post;

	$html = '';
	$html .= '<div class="'.esc_attr($brando_id).'_box description_box">';
		$html .= '<div class="left-part">';
			$html .= $brando_label;
			if($brando_desc) {
				$html .= '<span class="description">' . esc_attr($brando_desc) . '</span>';
			}
		$html .='</div>';
		$html .= '<div class="right-part">';
		
			$html .= '<input name="' . esc_attr($brando_id) . '" class="upload_field" id="brando_upload" type="hidden" value="'.get_post_meta($post->ID,  $brando_id, true).'" />';
			$html .= '<div class="multiple_images">';
			$brando_val = explode(",",get_post_meta($post->ID,  $brando_id, true));
			
			foreach ($brando_val as $key => $value) {
				if(!empty($value)):
					$brando_image_url = wp_get_attachment_url( $value );
					$html .='<div id='.esc_attr($value).'>';
						$html .= '<img class="upload_image_screenshort_multiple" src="'.$brando_image_url.'" style="width:100px;" />';
						$html .= '<a href="javascript:void(0)" class="remove">'.__( 'Remove', 'brando-addons' ).'</a>';
					$html .= '</div>';
				endif;
			}
			$html .= '</div>';
			$html .= '<input class="brando_upload_button_multiple" id="brando_upload_button_multiple" type="button" value="Browse" />'.__( ' Select Files', 'brando-addons' );
					
		$html .='</div>';
	$html .= '</div>';
	echo sprintf( "%s", $html );
}