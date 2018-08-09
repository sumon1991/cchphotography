<?php
/*
Plugin Name: Brando Addons
Plugin URI: http://www.themezaa.com
Description: A part of Brando theme
Version: 1.3.1
Author: Themezaa Team
Author URI: http://www.themezaa.com
Text Domain: brando-addons
*/
?>
<?php
/**
 * Defind Class 
 */

defined('BRANDO_ADDONS_ROOT') or define('BRANDO_ADDONS_ROOT', dirname(__FILE__));
defined('BRANDO_ADDONS_CUSTOM_POST_TYPE') or define('BRANDO_ADDONS_CUSTOM_POST_TYPE', dirname(__FILE__).'/custom-post-type');
defined('BRANDO_ADDONS_IMPORT') or define('BRANDO_ADDONS_IMPORT', dirname(__FILE__).'/importer');
defined('BRANDO_ADDONS_ROOT_DIR') or define('BRANDO_ADDONS_ROOT_DIR', plugins_url().'/brando-addons');

if( !class_exists('Brando_Addons') ) {
  class Brando_Addons {
    // Construct
    public function __construct() {
      add_action('setup_theme', array($this,'brando_addons_register_custom_post_type') );
      add_action('setup_theme', array($this,'brando_addons_import') ); 
      require_once( BRANDO_ADDONS_ROOT.'/brando-shortcodes/brando-shortcode-addons.php' );
      /* For meta box */
      require_once( BRANDO_ADDONS_ROOT.'/meta-box/meta-box.php' );
      require_once( BRANDO_ADDONS_ROOT.'/widgets/brando-about-me.php' );
      require_once( BRANDO_ADDONS_ROOT.'/widgets/brando-popular-post.php' );
      require_once( BRANDO_ADDONS_ROOT.'/widgets/brando-recent-comment.php' );
      require_once( BRANDO_ADDONS_ROOT.'/widgets/brando-subpages.php' );
      require_once( BRANDO_ADDONS_ROOT.'/extend-options/extend-options.php' );
    }

    /**
     * Load custom post types
     */
    public function brando_addons_register_custom_post_type()
    {
      require_once( BRANDO_ADDONS_CUSTOM_POST_TYPE .'/brando-theme-portfolio.php'); 
    }

    /**
     * Load import function
     */
    public function brando_addons_import() {
      require_once( BRANDO_ADDONS_IMPORT .'/importer.php'); 
    }
  
} // end of class
$Brando_Addons = new Brando_Addons();
} // end of class_exists