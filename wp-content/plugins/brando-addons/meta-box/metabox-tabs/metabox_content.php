<?php
/**
 * Metabox For Content.
 *
 * @package Brando
 */
?>
<?php 
if($post->post_type == 'post'){
	brando_meta_box_dropdown(	'brando_enable_post_comment_single',
				esc_html__('Enable Comments', 'brando-addons'),
				array('default' => esc_html__('Default', 'brando-addons'),
					  '1' => esc_html__('Yes', 'brando-addons'),
					  '0' => esc_html__('No', 'brando-addons')
					 ),
				esc_html__('Enable / Disable post comments.', 'brando-addons')
			);
}elseif($post->post_type == 'portfolio'){

	brando_meta_box_dropdown(	'brando_enable_portfolio_comment_single',
				esc_html__('Enable Comments', 'brando-addons'),
				array('default' => esc_html__('Default', 'brando-addons'),
					  '1' => esc_html__('Yes', 'brando-addons'),
					  '0' => esc_html__('No', 'brando-addons')
					 ),
				esc_html__('Enable / Disable portfolio comments.', 'brando-addons')
			);
}else{
	brando_meta_box_dropdown(	'brando_enable_page_comment_single',
				esc_html__('Enable Comments', 'brando-addons'),
				array('default' => esc_html__('Default', 'brando-addons'),
					  '1' => esc_html__('Yes', 'brando-addons'),
					  '0' => esc_html__('No', 'brando-addons')
					 ),
				esc_html__('Enable / Disable page comments.', 'brando-addons')
			);
}