<?php
/**
 * The main template file For Brando Theme Addons.
 *
 * @package Brando
 */
?>
<?php
/**
 * Defind Class 
 */
defined('BRANDO_SHORTCODE_ADDONS_URI') or define('BRANDO_SHORTCODE_ADDONS_URI', BRANDO_ADDONS_ROOT.'/brando-shortcodes');
defined('BRANDO_SHORTCODE_ADDONS_EXTEND_COMPOSER') or define('BRANDO_SHORTCODE_ADDONS_EXTEND_COMPOSER', BRANDO_SHORTCODE_ADDONS_URI.'/extend-composer');
defined('BRANDO_SHORTCODE_ADDONS_SHORTCODE_URI') or define('BRANDO_SHORTCODE_ADDONS_SHORTCODE_URI', BRANDO_SHORTCODE_ADDONS_URI.'/shortcodes');
defined('BRANDO_SHORTCODE_ADDONS_PREVIEW_IMAGE') or define('BRANDO_SHORTCODE_ADDONS_PREVIEW_IMAGE', BRANDO_ADDONS_ROOT_DIR.'/brando-shortcodes/images/preview-image');
if(!class_exists('Brando_Shortcodes_Addons'))
{
  class Brando_Shortcodes_Addons
  {
    // Construct
    public function __construct()
    {
      // Load Required Style For Addons.
      add_action('init', array($this, 'init'));
    }
    public function init(){

      require_once( BRANDO_ADDONS_ROOT.'/brando-shortcodes/brando-shortcode-addons-share.php' );
      require_once( BRANDO_ADDONS_ROOT.'/brando-shortcodes/brando-shortcode-addons-post-like.php' );
      
      // Load Required Style For Addons.
      add_action( 'admin_enqueue_scripts', array($this,'load_custom_wp_admin_style') );
      add_action( 'admin_print_scripts-post.php',   array($this, 'load_custom_wp_admin_style'), 99);
      add_action( 'admin_print_scripts-post-new.php', array($this, 'load_custom_wp_admin_style'), 99);
      if(class_exists('Vc_Manager')){
        //add_action( 'wp_enqueue_scripts', array($this, 'brando_dequeue_vc_style') );
        //add_action( 'wp_head', array($this, 'brando_dequeue_vc_style') );
        // Action For Remove VC Elements.
        add_action('admin_init', array($this, 'vc_remove_elements'), 10);
        // Action For Add Brando Maps And Shortcode In VC.
        add_action('init', array($this,'brando_addons_init'),40);
      }
    }

    public function load_custom_wp_admin_style() {
      // Enqueue Custom JS For WP Admin.*/
      wp_enqueue_script( 'brando-custom-script',   BRANDO_ADDONS_ROOT_DIR . '/brando-shortcodes/js/custom.js' , array('jquery'), '1.0', true );
    }
    
    public function brando_addons_init() {
        // Load Shortcode For Brando Theme.
        $this->brando_addons_vc_load_shortcodes();
        // Init VC For Post Type In Brando Theme.
        $this->brando_addons_init_vc();
        // Load Custom Maps.php For VC.
        $this->brando_addons_vc_integration();
        $s_elemets = array( 'tta_tabs', 'toggle', 'tta_tour', 'tta_accordion', 'tta_pageable', 'raw_html', 'round_chart', 'line_chart', 'icon', 'masonry_media_grid', 'masonry_grid', 'basic_grid', 'media_grid', 'custom_heading', 'empty_space', 'clients', 'widget_sidebar', 'images_carousel', 'carousel', 'tour', 'gallery', 'posts_slider', 'posts_grid', 'teaser_grid', 'separator', 'text_separator', 'message', 'facebook', 'tweetmeme', 'googleplus', 'pinterest', 'single_image', 'btn', 'toogle', 'button2', 'cta_button', 'cta_button2', 'video', 'gmaps', 'flickr', 'progress_bar', 'raw_js', 'pie', 'wp_meta', 'wp_recentcomments', 'wp_text', 'wp_calendar', 'wp_pages', 'wp_custommenu', 'wp_posts', 'wp_links', 'wp_categories', 'wp_archives', 'wp_rss', 'cta', 'wp_search', 'wp_tagcloud', 'button', 'accordion' );
        vc_remove_element('client', 'testimonial');
        // Remove VC elements.
        $this->vc_remove_elements( $s_elemets );
    }

    /* Remove Visual Composer Default style */
    public function brando_dequeue_vc_style(){
          wp_dequeue_style('js_composer_front');
          wp_deregister_style('js_composer_front');
    }

    public function vc_remove_elements( $e = array() ) {
      if ( !empty( $e ) ) {
        foreach ( $e as $key => $r_this ) {
          vc_remove_element( 'vc_'.$r_this );
        }
      }
    }
    

    public function brando_addons_init_vc()
    {
      global $vc_manager;
      $vc_manager->setIsAsTheme();
      $vc_manager->disableUpdater();
      $list = array( 'page', 'post', 'portfolio');
      $vc_manager->setEditorDefaultPostTypes( $list );
      $vc_manager->setEditorPostTypes( $list ); //this is required after VC update (probably from vc 4.5 version)
      $vc_manager->automapper()->setDisabled();
    }

    public function brando_addons_vc_load_shortcodes()
    {
      require_once( BRANDO_SHORTCODE_ADDONS_URI . '/shortcodes.php' );
    }

    public function brando_addons_vc_integration()
    {
      require_once( BRANDO_SHORTCODE_ADDONS_URI . '/maps.php' );
      
    }
  
} // end of class
$Brando_Shortcodes_Addons = new Brando_Shortcodes_Addons();
} // end of class_exists
?>