<?php
/**
 * Metabox For Header.
 *
 * @package Brando
 */
?>
<?php 
brando_meta_box_dropdown('brando_enable_header_single',
				esc_html__('Enable Header', 'brando-addons'),
				array('default' => esc_html__('Default', 'brando-addons'),
					  '1' => esc_html__('Yes', 'brando-addons'),
					  '0' => esc_html__('No', 'brando-addons')
					 )
			);
brando_meta_box_dropdown(	'brando_header_layout_single',
				esc_html__('Select a Header Style', 'brando-addons'),
				array('default' => esc_html__('Default', 'brando-addons'),
					'headertype1' => esc_html__('Header With Call To Action', 'brando-addons'),
                    'headertype2' => esc_html__('Hamburger Menu Header', 'brando-addons'),
                    'headertype3' => esc_html__('Centered Logo Menu Header', 'brando-addons'),
                    'headertype4' => esc_html__('Left Vertical Menu Header', 'brando-addons'),
                    'headertype5' => esc_html__('White Background Header', 'brando-addons'),
                    'headertype6' => esc_html__('Transparent Header', 'brando-addons'),
                    'headertype7' => esc_html__('Without Border Header', 'brando-addons'),
                   )
			);
brando_meta_box_dropdown_menu('brando_header_menu_single',
				esc_html__('Select Menu', 'brando-addons'),
				'',
				esc_html__('You can manage menu using Appearance > Menus', 'brando-addons')
			);
brando_meta_box_dropdown(	'brando_header_text_color_single',
				esc_html__('Header Text Color', 'brando-addons'),
				array('default' => esc_html__('Default', 'brando-addons'),
					  'nav-black' => esc_html__('Black', 'brando-addons'),
					  'nav-white' => esc_html__('White', 'brando-addons'),
					  'nav-default' => esc_html__('None', 'brando-addons'),
					 )
			);
brando_meta_box_upload('brando_header_logo_single', 
				esc_html__('Logo', 'brando-addons'),
				esc_html__('Upload the logo that will be displayed in the header', 'brando-addons')
			);
brando_meta_box_upload('brando_retina_logo_single', 
				esc_html__('Retina Logo', 'brando-addons'),
				esc_html__('Optional retina version displayed in devices with retina display (high resolution display).', 'brando-addons')
			);
brando_meta_box_text('brando_logo_url_single',
				esc_html__('Logo URL', 'brando-addons')
			);
$brando_sidebar_array = brando_registered_sidebars_array();
brando_meta_box_dropdown_sidebar(	'brando_header_sidebar_single',
				esc_html__('Header Sidebar', 'brando-addons'),
				$brando_sidebar_array,
				esc_html__('Select sidebar to display in header', 'brando-addons')
			);