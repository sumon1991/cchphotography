<?php
/**
 * Metabox For Post Setting.
 *
 * @package Brando
 */
?>
<?php 
brando_meta_box_dropdown('brando_image_single',
				esc_html__('Featured Image in Post Page', 'brando-addons'),
				array('1' => esc_html__('Yes', 'brando-addons'),
					  '0' => esc_html__('No', 'brando-addons'),
					 ),
				esc_html__('Select No if you do not want to show featured image in the post detail page', 'brando-addons')
			);
brando_meta_box_dropdown('brando_featured_image_single',
				esc_html__('Featured Image in Post Page', 'brando-addons'),
				array('0' => esc_html__('No', 'brando-addons'),
					  '1' => esc_html__('Yes', 'brando-addons'),
					 ),
				esc_html__('Select No if you do not want to show featured image in the post detail page.', 'brando-addons')
			);
brando_meta_box_textarea('brando_quote_single',
				esc_html__('Blockquote', 'brando-addons'),
				esc_html__('Add block quote content', 'brando-addons')
			);
brando_meta_box_dropdown('brando_lightbox_image_single',
				esc_html__('List Type', 'brando-addons'),
				array('1' => esc_html__('Lightbox', 'brando-addons'),
					  '0' => esc_html__('Slider', 'brando-addons'),
					 ),
				esc_html__('Select listing type', 'brando-addons')
			);
brando_meta_box_upload_multiple('brando_gallery_single', 
				esc_html__('Images', 'brando-addons'),
				esc_html__('Upload / select multiple images to build a gallery', 'brando-addons')
			);
brando_meta_box_dropdown('brando_link_type_single',
				esc_html__('Link Type', 'brando-addons'),
				array('external' => esc_html__('External Url', 'brando-addons'),
					  'ajax-popup' => esc_html__('Ajax Popup', 'brando-addons'),
					 ),
				esc_html__('Select link type', 'brando-addons')
			);
brando_meta_box_text('brando_link_single',
				esc_html__('External Link', 'brando-addons'),
				esc_html__('Add external link', 'brando-addons')
			);
brando_meta_box_dropdown('brando_video_type_single',
				esc_html__('Video Type', 'brando-addons'),
				array('self' => esc_html__('Self Hosted', 'brando-addons'),
					  'external' => esc_html__('External Url', 'brando-addons'),
					 ),
				esc_html__('Select video type', 'brando-addons')
			);
brando_meta_box_dropdown('brando_enable_mute_single',
				esc_html__('Enable Video Mute', 'brando-addons'),
				array('0' => esc_html__('No', 'brando-addons'),
					  '1' => esc_html__('Yes', 'brando-addons'),
					 ),
				esc_html__('Select yes to mute background video sound.', 'brando-addons')
			);
brando_meta_box_text('brando_video_mp4_single',
				esc_html__('MP4 Video URL', 'brando-addons'),
				esc_html__('Video url is required here if self hosted option is selected', 'brando-addons'),
				esc_html__('', 'brando-addons')
			);
brando_meta_box_text('brando_video_ogg_single',
				esc_html__('OGG Video URL', 'brando-addons'),
				esc_html__('Video url is required here if self hosted option is selected', 'brando-addons'),
				esc_html__('', 'brando-addons')
			);
brando_meta_box_text('brando_video_webm_single',
				esc_html__('WEBM Video URL', 'brando-addons'),
				esc_html__('Video url is required here if self hosted option is selected', 'brando-addons'),
				esc_html__('', 'brando-addons')
			);
brando_meta_box_text('brando_video_single',
				esc_html__('Add Youtube/Vimeo Embed Url', 'brando-addons'),
				'Video url is required here if external url option is selected.',
				esc_html__('Add YOUTUBE VIDEO EMBED URL like https://www.youtube.com/embed/xxxxxxxxxx, you will get this from youtube embed iframe src code. or add VIMEO VIDEO EMBED URL like https://player.vimeo.com/video/xxxxxxxx, you will get this from vimeo embed iframe src code.', 'brando-addons')
			);