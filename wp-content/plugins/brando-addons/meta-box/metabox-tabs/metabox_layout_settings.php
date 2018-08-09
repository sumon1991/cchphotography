<?php
/**
 * Metabox For Layout Setting.
 *
 * @package Brando
 */
?>
<?php 
brando_meta_box_dropdown('brando_layout_settings_single',
				esc_html__('Sidebar Settings', 'brando-addons'),
				array('default' => esc_html__('Default', 'brando-addons'),
					  'brando_layout_left_sidebar' => esc_html__('Two Columns Left', 'brando-addons'),
					  'brando_layout_right_sidebar' => esc_html__('Two Columns Right', 'brando-addons'),
					  'brando_layout_both_sidebar' => esc_html__('Three Columns', 'brando-addons'),
					  'brando_layout_full_screen' => esc_html__('One Column', 'brando-addons')
					 )
			);

$brando_sidebar_array = brando_registered_sidebars_array();
brando_meta_box_dropdown_sidebar(	'brando_layout_left_sidebar_single',
				esc_html__('Left Sidebar', 'brando-addons'),
				$brando_sidebar_array,
				esc_html__('Select sidebar to display in left column of page', 'brando-addons')
			);
brando_meta_box_dropdown_sidebar(	'brando_layout_right_sidebar_single',
				esc_html__('Right Sidebar', 'brando-addons'),
				$brando_sidebar_array,
				esc_html__('Select sidebar to display in right column of page', 'brando-addons')
			);

brando_meta_box_dropdown('brando_enable_container_fluid_single',
				esc_html__('Enable Container Fluid', 'brando-addons'),
					  array('default' => esc_html__('Default', 'brando-addons'),
					  '0' => esc_html__('No', 'brando-addons'),
					  '1' => esc_html__('Yes', 'brando-addons'),
					 )
			);
brando_meta_box_dropdown('brando_enable_breadcrumb_single',
				esc_html__('Enable Breadcrumb', 'brando-addons'),
					  array('default' => esc_html__('Default', 'brando-addons'),
					  '0' => esc_html__('No', 'brando-addons'),
					  '1' => esc_html__('Yes', 'brando-addons'),
					 )
			);

brando_meta_box_upload(	'brando_background_image_single', 
				esc_html__('Body background image', 'brando-addons'),
				esc_html__('Upload the image that will be displayed in the body background', 'brando-addons')
			);
brando_meta_box_dropdown('brando_bg_image_repeat_single',
				esc_html__('Body Background Image repeat', 'brando-addons'),
					  array('default' => esc_html__('Default', 'brando-addons'),
					  'repeat' => esc_html__('Repeat', 'brando-addons'),
					  'no-repeat' => esc_html__('No Repeat', 'brando-addons'),
					 )
			);
brando_meta_box_text('brando_top_color_single',
				esc_html__('Body Background Color (like #000000)', 'brando-addons')
			);