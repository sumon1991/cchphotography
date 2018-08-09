<?php
/**
 * Brando main file for import data.
 *
 * @package Brando
 */
?>
<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

// Don't resize images for import
if ( ! function_exists( 'brando_no_image_resize' ) ) :
	function brando_no_image_resize( $sizes ) {
		return array();
	}
endif;

/* Defined for sorttag in theme */
if ( !defined('BRANDO_THEME_SHORT_TAG') ) define('BRANDO_THEME_SHORT_TAG', '/^\[(.+?)\]:[ ]*<?(\S+?)>?(?:[ ]+["\'(](.+)["\')])?[ ]*$/' );

// Hook For Import Sample Data And Log.
add_action( 'wp_ajax_brando_import_sample_data', 'brando_import_sample_data' );
add_action( 'wp_ajax_brando_refresh_import_log', 'brando_refresh_import_log' );

if ( ! function_exists( 'brando_import_sample_data' ) ) :
	function brando_import_sample_data() {
		global $wpdb;
		if ( current_user_can( 'manage_options' ) ) {

			// Load WP Importer
			if ( !defined('WP_LOAD_IMPORTERS') ) define('WP_LOAD_IMPORTERS', true); // we are loading importers

			// Check if main importer class doesn't exist
			if ( ! class_exists( 'WP_Importer' ) ) {
				$wp_importer = ABSPATH . 'wp-admin/includes/class-wp-importer.php';
				include $wp_importer;
			}

			// if WP importer doesn't exist
			if ( ! class_exists('WP_Import') ) {
				$wp_import = dirname( __FILE__ ) . '/wordpress-importer.php';
				include $wp_import;
			}
			

			//$widgets_file = BRANDO_THEME_IMPORTER_SAMPLEDATA . '/widget_data.json';
			if ( class_exists( 'WP_Importer' ) && class_exists( 'WP_Import' ) ) { // check for main import class and wp import class.
				brando_log('', false);
				if( !empty( $_POST['import_options'] ) && !empty( $_POST['setup_key'] ) ) {

					$import_options = $_POST['import_options'];
					$setup_key		= $_POST['setup_key'];

					add_filter('intermediate_image_sizes_advanced', 'brando_no_image_resize');
					
					foreach($import_options as $import_option) {

						if( $import_option == 'widgets' ) {

							// Sidebar Widgets Json File.
							$widgets_file = dirname( __FILE__ ) . '/sample-data/' . $setup_key . '/widget_data.json';
							
							if( isset( $widgets_file ) && $widgets_file ) {

								// Dynamic Sidebar Creation
								$brando_theme_settings = get_option("brando_theme_setting");
								$custom_sidebars = isset( $brando_theme_settings['sidebar_creation'] ) ? $brando_theme_settings['sidebar_creation'] : '';
						        if (is_array($custom_sidebars)) {
						            foreach ($custom_sidebars as $sidebar) {

						                if (empty($sidebar)) {
						                    continue;
						                }
						                register_sidebar ( array (
						                    'name' => $sidebar,
						                    'id' => sanitize_title ( $sidebar ),
						                    'before_widget' => '<div id="%1$s" class="custom-widget %2$s">',
						                    'after_widget' => '</div>',
						                    'before_title'  => '<h5 class="sidebar-title">',
						                    'after_title'   => '</h5>',
						                ) );
						            }
						        }
								// Add data to widgets
								brando_log('MESSAGE - Before Import Widget Clear All Widgetarea Start.');
								$sidebars = wp_get_sidebars_widgets();
								//$inactive = isset($sidebars['wp_inactive_widgets']) ? $sidebars['wp_inactive_widgets'] : array();

								unset($sidebars['wp_inactive_widgets']);

								foreach ( $sidebars as $sidebar => $widgets ) {
									//$inactive = array_merge($inactive, $widgets);
									$sidebars[$sidebar] = array();
								}

								$sidebars['wp_inactive_widgets'] = array();
								wp_set_sidebars_widgets( $sidebars );
								brando_log('MESSAGE - Before Import Widget Clear All Widgetarea End.');

								$widgets_json = $widgets_file; // widgets data file
								$widgets_json = file_get_contents( $widgets_json );
								$widget_data = $widgets_json;
								brando_log('MESSAGE - Import Widget Setting Start.');
								$import_widgets = brando_import_widget_sample_data( $widget_data );
							}

						} else if( $import_option == 'options' ) {

							// Theme Option file.
							$theme_options_file = dirname( __FILE__ ) . '/sample-data/' . $setup_key . '/theme_options.json';

							// Import Theme Options
							brando_log('MESSAGE - Import Theme Admin Option Setting Start.');
							$theme_options_txt = $theme_options_file;
							$theme_options_txt = file_get_contents( $theme_options_txt );
							$brando_option = json_decode( $theme_options_txt,true );
							update_option( 'brando_theme_setting', $brando_option );
							brando_log('MESSAGE - Import Theme Admin Option Setting End.');

						} else {

							// Sample Data Zip.
							$sample_data_xml = dirname( __FILE__ ) . '/sample-data/' . $setup_key . '/' . $import_option . '.xml';
							// Import Sample Data XML.
							$importer = new WP_Import();
							// Import Posts, Pages, Portfolio Content, Images
							$importer->fetch_attachments = true;
							ob_start();
							brando_log('MESSAGE - ' . ucfirst($import_option) . '.xml Import Start.');
							$importer->import($sample_data_xml);
							ob_end_clean();
							brando_log('MESSAGE - ' . ucfirst($import_option) . '.xml Import End');

							if( $import_option == 'pages' ) {

								$homepage_title = $setup_key;

								// Set reading options
								brando_log('MESSAGE - Set Static Homepage Start.');
								$homepage = get_page_by_title( $homepage_title );
								if(isset( $homepage ) && $homepage->ID) {
									update_option('show_on_front', 'page');
									update_option('page_on_front', $homepage->ID); // Front Page
									brando_log('MESSAGE - Set Static Homepage End.');
								}else{
									brando_log('NOTICE - Set Static Homepage Couldn\'t Be Set.');
								}

							}
							/* For Add Taxonomy image in option */
							if( $import_option == 'posts' ) {
								$post_cat = get_terms( 'category');
								$term_meta_cat = array();
								foreach ($post_cat as $key => $value) {
									$term_meta_cat['image_url'] = get_template_directory_uri().'/assets/images/1920x1080-ph.jpg';
									update_option( "brando_taxonomy_$value->term_id", $term_meta_cat );
								}
								$post_tag = get_terms( 'post_tag');
								$term_meta_tags = array();
								foreach ($post_tag as $key => $value) {
									$term_meta_tags['image_url'] = get_template_directory_uri().'/assets/images/1920x1080-ph.jpg';
									update_option( "brando_post_tag_$value->term_id", $term_meta_tags );
								}
							}
							if( $import_option == 'portfolio' ) {
								$portfolio_cat = get_terms( 'portfolio-category');
								$term_meta_cat = array();
								foreach ($portfolio_cat as $key => $value) {
									$term_meta_cat['image_url'] = get_template_directory_uri().'/assets/images/1920x1080-ph.jpg';
									update_option( "brando_portfolio_taxonomy_$value->term_id", $term_meta_cat );
								}
								$portfolio_tag = get_terms( 'portfolio-tags');
								$term_meta_tags = array();
								foreach ($portfolio_tag as $key => $value) {
									$term_meta_tags['image_url'] = get_template_directory_uri().'/assets/images/1920x1080-ph.jpg';
									update_option( "brando_portfolio_tag_$value->term_id", $term_meta_tags );
								}
							}
						}
					}
					update_option('brando_theme_import_option', 1);

				}

				exit;
			}else{
				brando_log('ERROR - Importer can\'t load WP_Importer or WP_Import class not exists');
				return false;
			}

		}
	}
endif;

if( ! ( function_exists( 'brando_wp_get_attachment_by_post_name' ) ) ):
    function brando_wp_get_attachment_by_post_name( $post_name ) {
        $args = array(
            'post_per_page' => 1,
            'post_type'     => 'attachment',
            'name'          => trim ( $post_name ),
        );
        $get_posts = new Wp_Query( $args );

        if ( $get_posts->posts[0] )
            return $get_posts->posts[0];
        else
          return false;
    }
endif;

// For More Info Check Widget Import Plugin ( http://wordpress.org/plugins/widget-settings-importexport/ )
if( ! ( function_exists( 'brando_import_widget_sample_data' ) ) ):
	function brando_import_widget_sample_data( $widget_data ) {
		$json_data = $widget_data;
		$json_data = json_decode( $json_data, true );

		$sidebar_data = $json_data[0];
		$widget_data = $json_data[1];

		foreach ( $widget_data as $widget_data_title => $widget_data_value ) {
			$widgets[ $widget_data_title ] = '';
			foreach( $widget_data_value as $widget_data_key => $widget_data_array ) {
				if( is_int( $widget_data_key ) ) {
					$widgets[$widget_data_title][$widget_data_key] = 'on';
				}
			}
		}
		unset($widgets[""]);

		foreach ( $sidebar_data as $title => $sidebar ) {
			$count = count( $sidebar );
			for ( $i = 0; $i < $count; $i++ ) {
				$widget = array( );
				$widget['type'] = trim( substr( $sidebar[$i], 0, strrpos( $sidebar[$i], '-' ) ) );
				$widget['type-index'] = trim( substr( $sidebar[$i], strrpos( $sidebar[$i], '-' ) + 1 ) );
				if ( !isset( $widgets[$widget['type']][$widget['type-index']] ) ) {
					unset( $sidebar_data[$title][$i] );
				}
			}
			$sidebar_data[$title] = array_values( $sidebar_data[$title] );
		}

		foreach ( $widgets as $widget_title => $widget_value ) {
			foreach ( $widget_value as $widget_key => $widget_value ) {
				$widgets[$widget_title][$widget_key] = $widget_data[$widget_title][$widget_key];
			}
		}

		$sidebar_data = array( array_filter( $sidebar_data ), $widgets );

		brando_parse_import_widget_sample_data( $sidebar_data );
	}
endif;

if( ! ( function_exists( 'brando_parse_import_widget_sample_data' ) ) ):
	function brando_parse_import_widget_sample_data( $import_array ) {
		global $wp_registered_sidebars;
		$sidebars_data = $import_array[0];
		$widget_data = $import_array[1];
		$current_sidebars = get_option( 'sidebars_widgets' );
		$new_widgets = array( );

		foreach ( $sidebars_data as $import_sidebar => $import_widgets ) :

			foreach ( $import_widgets as $import_widget ) :
				//if the sidebar exists
				if ( isset( $wp_registered_sidebars[$import_sidebar] ) ) :
					$title = trim( substr( $import_widget, 0, strrpos( $import_widget, '-' ) ) );
					$index = trim( substr( $import_widget, strrpos( $import_widget, '-' ) + 1 ) );
					$current_widget_data = get_option( 'widget_' . $title );
					$new_widget_name = brando_get_new_widget_name( $title, $index );
					$new_index = trim( substr( $new_widget_name, strrpos( $new_widget_name, '-' ) + 1 ) );

					if ( !empty( $new_widgets[ $title ] ) && is_array( $new_widgets[$title] ) ) {
						while ( array_key_exists( $new_index, $new_widgets[$title] ) ) {
							$new_index++;
						}
					}
					$current_sidebars[$import_sidebar][] = $title . '-' . $new_index;
					if ( array_key_exists( $title, $new_widgets ) ) {
						$new_widgets[$title][$new_index] = $widget_data[$title][$index];
						$multiwidget = $new_widgets[$title]['_multiwidget'];
						unset( $new_widgets[$title]['_multiwidget'] );
						$new_widgets[$title]['_multiwidget'] = $multiwidget;
					} else {
						$current_widget_data[$new_index] = $widget_data[$title][$index];
						$current_multiwidget = isset($current_widget_data['_multiwidget']) ? $current_widget_data['_multiwidget'] : false;
						$new_multiwidget = isset($widget_data[$title]['_multiwidget']) ? $widget_data[$title]['_multiwidget'] : false;
						$multiwidget = ($current_multiwidget != $new_multiwidget) ? $current_multiwidget : 1;
						unset( $current_widget_data['_multiwidget'] );
						$current_widget_data['_multiwidget'] = $multiwidget;
						$new_widgets[$title] = $current_widget_data;
					}

				endif;
			endforeach;
		endforeach;

		if ( isset( $new_widgets ) && isset( $current_sidebars ) ) {
			update_option( 'sidebars_widgets', $current_sidebars );

			foreach ( $new_widgets as $title => $content ){
				update_option( 'widget_' . $title, $content );
			}
			brando_log('MESSAGE - Import Widget Setting End.');
			return true;
		}
		brando_log('NOTICE - Import Widget Setting Not Completed.');
		return false;
	}
endif;

if( ! ( function_exists( 'brando_get_new_widget_name' ) ) ):
	function brando_get_new_widget_name( $widget_name, $widget_index ) {
		$current_sidebars = get_option( 'sidebars_widgets' );
		$all_widget_array = array( );
		foreach ( $current_sidebars as $sidebar => $widgets ) {
			if ( !empty( $widgets ) && is_array( $widgets ) && $sidebar != 'wp_inactive_widgets' ) {
				foreach ( $widgets as $widget ) {
					$all_widget_array[] = $widget;
				}
			}
		}
		while ( in_array( $widget_name . '-' . $widget_index, $all_widget_array ) ) {
			$widget_index++;
		}
		$new_widget_name = $widget_name . '-' . $widget_index;
		return $new_widget_name;
	}
endif;

// Function To Add Brando Log.
if( ! ( function_exists( 'brando_log' ) ) ):
	function brando_log($message, $append = true) {
		$upload_dir = wp_upload_dir();
		if (isset($upload_dir['baseurl'])) {
			
			$data = '';
			if (!empty($message)) {
				$data = "<p>".date("Y-m-d H:i:s").' - '.$message."</p>";
			}
			
			if ($append === true) {
				file_put_contents($upload_dir['basedir'].'/importer.log', $data, FILE_APPEND);
			} else {
				file_put_contents($upload_dir['basedir'].'/importer.log', $data);
			}
		}
	}
endif;

// Function To Get Brando Log.
if( ! ( function_exists( 'get_brando_log' ) ) ):
	function get_brando_log() {
		$upload_dir = wp_upload_dir();
		if (isset($upload_dir['baseurl'])) {
			
			if (file_exists($upload_dir['basedir'].'/importer.log')) {
				return file_get_contents($upload_dir['basedir'].'/importer.log');
			}
		}
		return '';
	}
endif;
// Ajax Function To Check Refresh Import Logs.
if( ! ( function_exists( 'brando_refresh_import_log' ) ) ):
	function brando_refresh_import_log() {
		
		$checkbrandolog = get_brando_log();
		//don't add message if ERROR was found, JS script is going to stop refreshing
		if (strpos($checkbrandolog,'ERROR') === false) { 
			brando_log('MESSAGE - Import in progress...');
		}
		echo get_brando_log();
		die();
	}
endif;

if( ! ( function_exists( 'brando_get_zip_import_files' ) ) ):
	function brando_get_zip_import_files( $directory, $filetype ) {
		$phpversion = phpversion();
		$files = array();

		// Check if the php version allows for recursive iterators
		if ( version_compare( $phpversion, '5.2.11', '>' ) ) {
			if ( $filetype != '*' )  {
				$filetype = '/^.*\.' . $filetype . '$/';
			} else {
				$filetype = '/.+\.[^.]+$/';
			}
			$directory_iterator = new RecursiveDirectoryIterator( $directory );
			$recusive_iterator = new RecursiveIteratorIterator( $directory_iterator );
			$regex_iterator = new RegexIterator( $recusive_iterator, $filetype );

			foreach( $regex_iterator as $file ) {
				$files[] = $file->getPathname();
			}
		// Fallback to glob() for older php versions
		} else {
			if ( $filetype != '*' )  {
				$filetype = '*.' . $filetype;
			}

			foreach( glob( $directory . $filetype ) as $filename ) {
				$filename = basename( $filename );
				$files[] = $directory . $filename;
			}
		}

		return $files;
	}
endif;