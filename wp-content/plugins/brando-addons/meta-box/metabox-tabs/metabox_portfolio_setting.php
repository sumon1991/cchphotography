<?php
/**
 * Metabox For Portfolio Setting.
 *
 * @package Brando
 */
?>
<?php 
brando_meta_box_text('brando_subtitle_single',
				esc_html__('Title on Hover', 'brando-addons'),
				esc_html__('This title will be displayed on hover of the portfolio image', 'brando-addons')
			);
brando_meta_box_dropdown('brando_enable_ajax_popup_single',
				esc_html__('Enable Ajax Popup', 'brando-addons'),
				array('0' => esc_html__('No', 'brando-addons'),
					  '1' => esc_html__('Yes', 'brando-addons'),
					 )
			);
brando_meta_box_dropdown('brando_featured_image_single',
				esc_html__('Featured Image in Portfolio Page', 'brando-addons'),
				array('0' => esc_html__('No', 'brando-addons'),
					  '1' => esc_html__('Yes', 'brando-addons'),
					 ),
				esc_html__('Select No if you do not want to show featured image in the portfolio detail page.', 'brando-addons')
			);