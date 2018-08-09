<?php
/**
 * This file use for define custom function
 * Also include required files.
 *
 * @package Brando
 */

/*
 *	Brando Theme namespace.
 */

define('BRANDO_THEME', 'Brando');
define('BRANDO_THEME_SLUG', 'brando');
define('BRANDO_THEME_VERSION', '1.3.1');

/*
 *	Brando Theme Folders
 */


define('BRANDO_THEME_DIR',         				get_template_directory());
define('BRANDO_THEME_LANGUAGES',   				BRANDO_THEME_DIR . '/languages');
define('BRANDO_THEME_ASSETS',      				BRANDO_THEME_DIR . '/assets');
define('BRANDO_THEME_JS',         				BRANDO_THEME_ASSETS . '/js');
define('BRANDO_THEME_CSS',        				BRANDO_THEME_ASSETS . '/css');
define('BRANDO_THEME_IMAGES',      				BRANDO_THEME_ASSETS . '/images');
define('BRANDO_THEME_LIB',         				BRANDO_THEME_DIR . '/lib');
define('BRANDO_THEME_ADMIN',       				BRANDO_THEME_LIB . '/admin');
define('BRANDO_THEME_TGM',         			    BRANDO_THEME_LIB . '/tgm' );




/*
 *  Brando Theme Folder URI
 */


define('BRANDO_THEME_URI',             				get_template_directory_uri());
define('BRANDO_THEME_LANGUAGES_URI',   				BRANDO_THEME_URI . '/languages');
define('BRANDO_THEME_ASSETS_URI',      				BRANDO_THEME_URI     . '/assets');
define('BRANDO_THEME_JS_URI',          				BRANDO_THEME_ASSETS_URI . '/js');
define('BRANDO_THEME_CSS_URI',         				BRANDO_THEME_ASSETS_URI . '/css');
define('BRANDO_THEME_IMAGES_URI',      				BRANDO_THEME_ASSETS_URI . '/images');
define('BRANDO_THEME_LIB_URI',         				BRANDO_THEME_URI . '/lib');

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
if ( ! function_exists( 'brando_theme_setup' ) ) :
	function brando_theme_setup() {
		/*
		 *   Text Domain
		 */

		load_theme_textdomain( 'brando', get_template_directory() . '/languages' );

		/*
		 * To add default posts and comments RSS feed links to theme head.
		 */

		add_theme_support( 'automatic-feed-links' );

		// Set Custom Header
		add_theme_support( 'custom-header' );

		// Set Custom Body Background
		add_theme_support( 'custom-background' );
	    
	    /*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/* This theme styles the visual editor with editor-style.css to match the theme style. */
		add_editor_style( array( 'assets/css/editor-style.css' ) );

		/**
		 * Custom image sizes for posts, pages, port, portfolio, gallery, slider.
		 */
		add_theme_support( 'post-thumbnails' );
		set_post_thumbnail_size( 1200, 700 );

		// Register menu for Brando theme.
		register_nav_menus( array(
			'brandomenu' => esc_html__( 'Brando Menu', 'brando' ),
		) );


		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form', 'comment-form', 'comment-list',
		) );

		/*
		 * Enable support for Post Formats.
		 * See http://codex.wordpress.org/Post_Formats
		 */
		 
		add_theme_support( 'post-formats', array(
			 'image', 'video', 'gallery', 'quote',
		) );

	}
endif;
add_action( 'after_setup_theme', 'brando_theme_setup' );


/*
 *  Content Width (Set the content width based on the theme's design and stylesheet.)
 */
if ( ! function_exists( 'brando_content_width' ) ) :
	function brando_content_width() {
		$GLOBALS['content_width'] = apply_filters( 'brando_content_width', 1200 );
	}
endif;
add_action( 'after_setup_theme', 'brando_content_width', 0 );

/**
 * Register Brando theme required widget area.
 *
 * @link https://codex.wordpress.org/Function_Reference/register_sidebar
 *
 */
if ( ! function_exists( 'brando_widgets_init' ) ) :
	function brando_widgets_init() {
		register_sidebar( array(
			'name'          => esc_html__( 'Sidebar', 'brando' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here to appear in your sidebar.', 'brando' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<span class="alt-font text-uppercase dark-gray-text font-weight-600 text-large widget-title">',
			'after_title'   => '</span><div class="bg-fast-yellow separator-line-thick no-margin-lr"></div>',
		) );

		register_sidebar( array(
			'name'          => esc_html__( 'Content Bottom 1', 'brando' ),
			'id'            => 'sidebar-2',
			'description'   => esc_html__( 'Appears at the bottom of the content on posts and pages.', 'brando' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		) );

		register_sidebar( array(
			'name'          => esc_html__( 'Content Bottom 2', 'brando' ),
			'id'            => 'sidebar-3',
			'description'   => esc_html__( 'Appears at the bottom of the content on posts and pages.', 'brando' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		) );

		register_sidebar( array(
			'name'          => esc_html__( 'Elements', 'brando' ),
			'id'            => 'sidebar-4',
			'description'   => esc_html__( 'Appears at the bottom of the content on posts and pages.', 'brando' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s ">',
			'after_widget'  => '</div>',
			'before_title'  => '<span class="alt-font text-uppercase dark-gray-text font-weight-600 text-large widget-title">',
			'after_title'   => '</span><div class="bg-fast-yellow separator-line-thick no-margin-lr md-margin-eleven md-no-margin-lr"></div>',
		) );
	}
endif;
add_action( 'widgets_init', 'brando_widgets_init' );

if (file_exists( BRANDO_THEME_LIB . '/brando-require-files.php' )) 
{
	require_once( BRANDO_THEME_LIB . '/brando-require-files.php');
}