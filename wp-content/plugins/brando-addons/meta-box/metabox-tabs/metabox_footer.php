<?php
/**
 * Metabox For Footer.
 *
 * @package Brando
 */
?>
<?php 
brando_meta_box_dropdown('brando_enable_page_footer_single',
				esc_html__('Enable Footer?', 'brando-addons'),
				array('default' => esc_html__('Default', 'brando-addons'),
					  '1' => esc_html__('Yes', 'brando-addons'),
					  '0' => esc_html__('No', 'brando-addons')
					 )
			);
brando_meta_box_upload(	'brando_footer_bg_image_single', 
				esc_html__('Footer Background Image', 'brando-addons'),
				esc_html__('Upload background image that will be displayed in the footer', 'brando-addons')
			);
brando_meta_box_dropdown('brando_footer_type_single',
				esc_html__('Footer Type', 'brando-addons'),
				array('default' => esc_html__('Default', 'brando-addons'),
					  'footer-type-1' => esc_html__('Footer Type 1', 'brando-addons'),
					  'footer-type-2' => esc_html__('Footer Type 2', 'brando-addons'),
					  'footer-type-3' => esc_html__('Footer Type 3', 'brando-addons'),
					  'footer-type-4' => esc_html__('Footer Type 4', 'brando-addons'),
					  'footer-type-5' => esc_html__('Footer Type 5', 'brando-addons')
					 )
			);
brando_meta_box_text('brando_footer_text_single',
				esc_html__('Footer Text', 'brando-addons')
			);
brando_meta_box_dropdown('brando_enable_footer_logo_single',
				esc_html__('Enable Footer Logo', 'brando-addons'),
				array('default' => esc_html__('Default', 'brando-addons'),
					  '1' => esc_html__('Yes', 'brando-addons'),
					  '0' => esc_html__('No', 'brando-addons')
					 )
			);
brando_meta_box_upload(	'brando_footer_logo_single', 
				esc_html__('Logo', 'brando-addons'),
				esc_html__('Upload the logo that will be displayed in the header', 'brando-addons')
			);
$brando_sidebar_array = brando_registered_sidebars_array();
brando_meta_box_dropdown_sidebar(	'brando_footer_sidebar_single',
				esc_html__('Footer Sidebar', 'brando-addons'),
				$brando_sidebar_array,
				esc_html__('Select sidebar to display in footer', 'brando-addons')
			);
brando_meta_box_dropdown('brando_enable_footer_copyright_single',
				esc_html__('Enable Footer Copyright', 'brando-addons'),
				array('default' => esc_html__('Default', 'brando-addons'),
					  '1' => esc_html__('Yes', 'brando-addons'),
					  '0' => esc_html__('No', 'brando-addons')
					 )
			);