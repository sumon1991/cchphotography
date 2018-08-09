<?php
/**
 * Metabox For Title Wrapper.
 *
 * @package Brando
 */
?>
<?php
brando_meta_box_dropdown('brando_enable_title_wrapper_single',
				esc_html__('Enable Title', 'brando-addons'),
				array('default' => esc_html__('Default', 'brando-addons'),
					  '1' => esc_html__('Yes', 'brando-addons'),
					  '0' => esc_html__('No', 'brando-addons')
					 ),
				esc_html__('If on, a title will display in page', 'brando-addons')
			);
if($post->post_type == 'page'){
	brando_meta_box_text('brando_header_subtitle_single',
				esc_html__('Subtitle', 'brando-addons')
			);
}
brando_meta_box_upload(	'brando_title_background_single', 
				esc_html__('Title Background Image', 'brando-addons'),
				esc_html__('Recommended image size (1920px X 700px) for better result.', 'brando-addons')
			);
brando_meta_box_dropdown( 'brando_title_parallax_effect_single',
				esc_html__('Parallax effect', 'brando-addons'),
				array('default' => esc_html__('Default', 'brando-addons'),
					  'no-effect' => esc_html__('No Effect', 'brando-addons'),
					  'parallax1' => esc_html__('parallax-effect-1', 'brando-addons'),
					  'parallax2' => esc_html__('parallax-effect-2', 'brando-addons'),
					  'parallax3' => esc_html__('parallax-effect-3', 'brando-addons'),
					  'parallax4' => esc_html__('parallax-effect-4', 'brando-addons'),
					  'parallax5' => esc_html__('parallax-effect-5', 'brando-addons'),
					  'parallax6' => esc_html__('parallax-effect-6', 'brando-addons'),
					  'parallax7' => esc_html__('parallax-effect-7', 'brando-addons'),
					  'parallax8' => esc_html__('parallax-effect-8', 'brando-addons'),
					  'parallax9' => esc_html__('parallax-effect-9', 'brando-addons'),
					  'parallax10' => esc_html__('parallax-effect-10', 'brando-addons'),
					  'parallax11' => esc_html__('parallax-effect-11', 'brando-addons'),
					  'parallax12' => esc_html__('parallax-effect-12', 'brando-addons')
					 ),
				esc_html__('Choose parallax effect', 'brando-addons')
			);