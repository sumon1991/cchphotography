<?php
/**
 * Import / Export Tab For Theme Option.
 *
 * @package Brando
 */
?>
<?php
$brando_message = '';
if( isset($_GET['show-message'])){
	$brando_message = 'class="demo-show-message"';
}else{
	$brando_message = 'class="demo-hide-message"';
}

$brando_all_demo_setup = array(
					array(
						'theme_id' 			=> 'agency',
						'theme_name' 		=> esc_html__('Agency', 'brando'),
						'theme_preview_url' => esc_html__('http://wpdemos.themezaa.com/brando/agency/', 'brando'),
						'theme_screenshot' 	=> get_template_directory_uri() . '/assets/images/agency.jpg',
					),
					array(
						'theme_id' 			=> 'travel',
						'theme_name' 		=> esc_html__('Travel', 'brando'),
						'theme_preview_url' => esc_html__('http://wpdemos.themezaa.com/brando/travel/', 'brando'),
						'theme_screenshot' 	=> get_template_directory_uri() . '/assets/images/travel.jpg',
					),
					array(
						'theme_id' 			=> 'restaurant',
						'theme_name' 		=> esc_html__('Restaurant', 'brando'),
						'theme_preview_url' => esc_html__('http://wpdemos.themezaa.com/brando/restaurant/', 'brando'),
						'theme_screenshot' 	=> get_template_directory_uri() . '/assets/images/restaurant.jpg',
					),
					array(
						'theme_id' 			=> 'architecture',
						'theme_name' 		=> esc_html__('Architecture', 'brando'),
						'theme_preview_url' => esc_html__('http://wpdemos.themezaa.com/brando/architecture/', 'brando'),
						'theme_screenshot' 	=> get_template_directory_uri() . '/assets/images/architecture.jpg',
					),
					array(
						'theme_id' 			=> 'wedding',
						'theme_name' 		=> esc_html__('Wedding', 'brando'),
						'theme_preview_url' => esc_html__('http://wpdemos.themezaa.com/brando/wedding/', 'brando'),
						'theme_screenshot' 	=> get_template_directory_uri() . '/assets/images/wedding.jpg',
					),
					array(
						'theme_id' 			=> 'spa',
						'theme_name' 		=> esc_html__('Spa', 'brando'),
						'theme_preview_url' => esc_html__('http://wpdemos.themezaa.com/brando/spa/', 'brando'),
						'theme_screenshot' 	=> get_template_directory_uri() . '/assets/images/spa.jpg',
					),
					array(
						'theme_id' 			=> 'photography',
						'theme_name' 		=> esc_html__('Photography', 'brando'),
						'theme_preview_url' => esc_html__('http://wpdemos.themezaa.com/brando/photography/', 'brando'),
						'theme_screenshot' 	=> get_template_directory_uri() . '/assets/images/photography.jpg',
					),
					array(
						'theme_id' 			=> 'personal',
						'theme_name' 		=> esc_html__('Personal', 'brando'),
						'theme_preview_url' => esc_html__('http://wpdemos.themezaa.com/brando/personal/', 'brando'),
						'theme_screenshot' 	=> get_template_directory_uri() . '/assets/images/personal.jpg',
					),
					array(
						'theme_id' 			=> 'event',
						'theme_name' 		=> esc_html__('Event', 'brando'),
						'theme_preview_url' => esc_html__('http://wpdemos.themezaa.com/brando/event/', 'brando'),
						'theme_screenshot' 	=> get_template_directory_uri() . '/assets/images/event.jpg',
					),
					array(
						'theme_id' 			=> 'tattoo',
						'theme_name' 		=> esc_html__('Tattoo', 'brando'),
						'theme_preview_url' => esc_html__('http://wpdemos.themezaa.com/brando/tattoo/', 'brando'),
						'theme_screenshot' 	=> get_template_directory_uri() . '/assets/images/tattoo.jpg',
					)
				);

$brando_import_export_content = '';
foreach ( $brando_all_demo_setup as $key => $demo_setup ) {

	$brando_import_export_content .= '<div class="theme">
					                <div class="theme-wrapper">
					                    <div class="theme-screenshot"><img src="' . esc_url($demo_setup['theme_screenshot']) . '"></div>
					                    <h3 class="theme-name">' . esc_attr($demo_setup['theme_name']) . '</h3>
					                    <div class="theme-actions">
					                    	<div class="import-loader-img hidden"><i class="dashicons dashicons-admin-generic fa-spin"></i></div>';
					                    if( class_exists( 'Brando_Addons' ) ) {
					                        $brando_import_export_content .= '<a class="button button-primary brando-import" data-popup-open="brando-popup" data-setup-key="' . esc_attr($demo_setup['theme_id']) . '" id="brando_import_' . esc_attr($demo_setup['theme_id']) . '" href="javascript:void(0)">' . esc_html__('Install', 'brando') . '</a>';
					                    }
					                        $brando_import_export_content .= '<a class="button button-primary brando-preview" id="brando_preview_' . esc_attr($demo_setup['theme_id']) . '" target="_blank" href="' . esc_url($demo_setup['theme_preview_url']) . '">' . esc_html__('Preview', 'brando') . '</a>
					                    </div>
					                </div>
					            </div>';

}
$brando_import_export_notice = '';
if( !class_exists( 'Brando_Addons' ) ) {
	$brando_import_export_notice .= '<strong class="font-16px">'.esc_html__( 'Brando Addons plugin is required to use theme features as well as import demo data. So please make sure to install Brando Addons plugin here: Appearance > Install Plugins or activate it under Plugins menu if it is installed already and then come back to this page to import demo data.', 'brando').'</strong><br/><br/>';
}

$this->sections[] = array(
	'title' => esc_html__('Import/Export', 'brando'),
	'desc' => esc_html__('Import/Export options', 'brando'),
	'icon' => 'fa fa-exchange icon-rotate-90',
	'fields' => array(
		
		array(
			'id'            => 'brando_import_sample_data',
			'type'			=> 'raw',
			'title'         => '',
			'content'		=> '
				'.$brando_import_export_notice.'
				<strong>'.esc_html__('Import Demo Content', 'brando').'</strong>
		 		<p class="description">'.esc_html__('Import demo content data including posts, pages, portfolio, theme options, widgets, images, sliders etc. It should be quick, but please have some patience.', 'brando').'</p><br/>
		 		<strong>'.esc_html__('Warning', 'brando').'</strong>
		 		<p class="description">'.esc_html__('Importing demo content will import sliders, pages, posts, portfolio, theme options, widgets, sidebars and other settings. Your existing setup will be replaced with new demo data and settings from the installed theme version demo content and configurations. So we recommend you take the backup of your existing WordPress setup and database for your safety.', 'brando').'</p></br>
		 		<strong>'.esc_html__('Demo Import Requirements', 'brando').'</strong>
		 		<ul class="import-export-desc">
		 			<li><i class="fa fa-check"></i>'.esc_html__('Memory Limit of 256 MB and max execution time (php time limit) of 180 seconds or more.', 'brando').'</li>
		 			<li><i class="fa fa-check"></i>'.esc_html__('Brando Addon must be activated for Custom post type and Shortcodes to import.', 'brando').'</li>
		 			<li><i class="fa fa-check"></i>'.esc_html__('Visual Composer must be activated for content to import.', 'brando').'</li>
		 			<li><i class="fa fa-check"></i>'.esc_html__('Contact Form 7 must be activated for form data to import.', 'brando').'</li>
		 			<li><i class="fa fa-check"></i>'.esc_html__('Newsletter Manager must be activated for newsletter form data to import.', 'brando').'</li>
		 		</ul>
				<div class="brando-theme-browser">
		            ' . $brando_import_export_content . '
		        	<div class="clear"></div>
		        </div>
		        <div id="run-regenerate-thumbnails" '.$brando_message.'><div class="hcode-importer-notice">
		        	<p><strong>'.esc_html__( 'Demo data successfully imported. Now, please install and run', 'brando').'<a title="' . esc_html__( 'Regenerate Thumbnails', 'brando' ) . '" class="thickbox" href="'.admin_url( 'plugin-install.php?tab=plugin-information&amp;plugin=regenerate-thumbnails&amp;TB_iframe=true&amp;width=830&amp;height=472' ).'">'. esc_html__( 'Regenerate Thumbnails', 'brando' ).'</a> '. esc_html__( 'plugin once.', 'brando' ).'</strong>
                	</p>
		        </div></div>
				<div class="import-ajax-message"></div>
				'
		),
		
		array(
			'id'            => 'opt-import-export',
			'type'          => 'import_export',
			'title'         => esc_html__('Import / Export', 'brando'),
			'subtitle'      => esc_html__('Save and restore your Brando options', 'brando'),
			'full_width'    => false
		)
	),
);
?>