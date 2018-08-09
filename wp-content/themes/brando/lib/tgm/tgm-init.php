<?php
/**
 * TGM Init Class
 *
 * @package Brando
 */
?>
<?php
require_once BRANDO_THEME_TGM . '/class-tgm-plugin-activation.php';

if ( ! function_exists( 'brando_plugin_activation' ) ) {
    function brando_plugin_activation() {

    	$brando_plugin_list = array(	
    		array(
                'name'				 => esc_html__('Brando Addons','brando'),                               // The plugin name
                'slug'				 => 'brando-addons',                                // The plugin slug (typically the folder name)
                'source'			 =>  BRANDO_THEME_DIR . '/plugins/brando-addons.zip', // The plugin source
                'required'			 => true,                                          // If false, the plugin is only 'recommended' instead of required
                'version'			 => BRANDO_THEME_VERSION,                                            // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
                'force_activation'	 => false,                                          // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
                'force_deactivation' => false,                                         // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
                'external_url'		 => '',                                            // If set, overrides default API URL and points to an external URL
            ),
            array(
                'name'               => esc_html__('WPBakery Visual Composer','brando'),                    // The plugin name
                'slug'               => 'js_composer',                                 // The plugin slug (typically the folder name)
                'source'             =>  BRANDO_THEME_DIR . '/plugins/js_composer.zip', // The plugin source
                'required'           => true,                                          // If false, the plugin is only 'recommended' instead of required
                'version'            => '4.12.1',                                            // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
                'force_activation'   => false,                                          // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
                'force_deactivation' => false,                                         // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
                'external_url'       => '',                                            // If set, overrides default API URL and points to an external URL
            ),
    		array(
                'name'               => esc_html__('Contact Form 7','brando'),                              // The plugin name.
                'slug'               => 'contact-form-7',                              // The plugin slug (typically the folder name).
                'required'           => false,                                         // If false, the plugin is only 'recommended' instead of required.
            ),
            array(
                'name'               => esc_html__('Newsletter Manager','brando'),                          // The plugin name.
                'slug'               => 'newsletter-manager',                          // The plugin slug (typically the folder name).
                'required'           => false,                                         // If false, the plugin is only 'recommended' instead of required.
            ),
    	);

    	$brando_mainconfig = array(
                'id'           => 'brando_tgmpa',                // Unique ID for hashing notices for multiple instances of TGMPA.
                'default_path' => '',                           // Default absolute path to bundled plugins.
                'menu'         => 'install-required-plugins',   // Menu slug.
                'parent_slug'  => 'themes.php',                 // Parent menu slug.
                'capability'   => 'edit_theme_options',         // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
                'has_notices'  => true,                         // Show admin notices or not.
                'dismissable'  => true,                         // If false, a user cannot dismiss the nag message.
                'dismiss_msg'  => '',                           // If 'dismissable' is false, this message will be output at top of nag.
                'is_automatic' => false,                        // Automatically activate plugins after installation or not.
                'message'      => '',                           // Message to output right before the plugins table.
    	);

    	tgmpa( $brando_plugin_list, $brando_mainconfig );

    }
}

add_action( 'tgmpa_register', 'brando_plugin_activation' );