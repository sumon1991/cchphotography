<?php
/**
 * Metabox For Single Post Layout.
 *
 * @package Brando
 */
?>
<?php 
if($post->post_type == 'post'){
	
	brando_meta_box_dropdown('brando_enable_meta_tags_single',
				esc_html__('Enable Post Meta Tags', 'brando-addons'),
				array('default' => esc_html__('Default', 'brando-addons'),
					'1' => esc_html__('Yes', 'brando-addons'),
					'0' => esc_html__('No', 'brando-addons')
					),
				esc_html__('Enable post meta tags', 'brando-addons')
			);
	brando_meta_box_dropdown('brando_enable_post_author_single',
				esc_html__('Enable Post Author', 'brando-addons'),
				array('default' => esc_html__('Default', 'brando-addons'),
					  '1' => esc_html__('Yes', 'brando-addons'),
					  '0' => esc_html__('No', 'brando-addons')
					 ),
				esc_html__('Enable post author', 'brando-addons')
			);
	brando_meta_box_dropdown('brando_social_icons_single',
				esc_html__('Enable Social Icons', 'brando-addons'),
				array('default' => esc_html__('Default', 'brando-addons'),
					  '1' => esc_html__('Yes', 'brando-addons'),
					  '0' => esc_html__('No', 'brando-addons')
					 ),
				esc_html__('Enable social icons', 'brando-addons')
			);
}else{

	
	brando_meta_box_dropdown('brando_enable_meta_tags_portfolio_single',
				esc_html__('Enable Portfolio Meta Tags', 'brando-addons'),
				array('default' => esc_html__('Default', 'brando-addons'),
						'1' => esc_html__('Yes', 'brando-addons'),
					  	'0' => esc_html__('No', 'brando-addons')
					 ),
				esc_html__('Enable portfolio meta tags', 'brando-addons')
			);
	brando_meta_box_dropdown('brando_enable_post_author_portfolio_single',
				esc_html__('Enable Portfolio Author', 'brando-addons'),
				array('default' => esc_html__('Default', 'brando-addons'),
					   '1' => esc_html__('Yes', 'brando-addons'),
					   '0' => esc_html__('No', 'brando-addons')
					 ),
				esc_html__('Enable portfolio author', 'brando-addons')
			);
	brando_meta_box_dropdown('brando_social_icons_portfolio_single',
				esc_html__('Enable Social Icons', 'brando-addons'),
				array('default' => esc_html__('Default', 'brando-addons'),
					    '1' => esc_html__('Yes', 'brando-addons'),
					    '0' => esc_html__('No', 'brando-addons')
					 ),
				esc_html__('Enable social icons', 'brando-addons')
			);
}