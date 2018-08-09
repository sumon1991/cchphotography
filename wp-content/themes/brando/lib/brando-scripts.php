<?php
/**
 * Theme Register Style Js.
 *
 * @package Brando
 */
?>
<?php 
/*
 * Enqueue scripts and styles.
 */

function brando_register_style_js() {

    /*
     * Load our brando theme main and other required stylesheets.
     */

    wp_register_style( 'bootstrap', BRANDO_THEME_CSS_URI . '/bootstrap.min.css',null, '3.3.4');
    wp_register_style( 'brando-style', get_stylesheet_uri(), null, BRANDO_THEME_VERSION);
    wp_register_style( 'animate', BRANDO_THEME_CSS_URI . '/animate.css',null, BRANDO_THEME_VERSION);
    wp_register_style( 'et-line-icons', BRANDO_THEME_CSS_URI . '/et-line-icons.css',null, BRANDO_THEME_VERSION);
    wp_register_style( 'brando-font-awesome', BRANDO_THEME_CSS_URI . '/font-awesome.min.css',null, '4.7.0');
    wp_register_style( 'magnific-popup', BRANDO_THEME_CSS_URI . '/magnific-popup.css',null, BRANDO_THEME_VERSION);
    wp_register_style( 'owl-carousel', BRANDO_THEME_CSS_URI . '/owl.carousel.css',null, '1.3.3');
    wp_register_style( 'owl-transitions', BRANDO_THEME_CSS_URI . '/owl.transitions.css',null, BRANDO_THEME_VERSION);
    wp_register_style( 'pull-menu-sideslide', BRANDO_THEME_CSS_URI . '/pull-menu-sideslide.css',null, BRANDO_THEME_VERSION);
    wp_register_style( 'brando-responsive', BRANDO_THEME_CSS_URI . '/responsive.css',null, BRANDO_THEME_VERSION);

    wp_enqueue_style( 'bootstrap' );
    wp_enqueue_style( 'brando-style' );
    wp_enqueue_style( 'animate' );
    wp_enqueue_style( 'et-line-icons' );
    wp_enqueue_style( 'brando-font-awesome' );
    wp_enqueue_style( 'magnific-popup' );
    wp_enqueue_style( 'owl-carousel' );
    wp_enqueue_style( 'owl-transitions' );
    wp_enqueue_style( 'pull-menu-sideslide' );
    wp_enqueue_style( 'brando-responsive' );
    

    // Load the Internet Explorer specific stylesheet.
    wp_enqueue_style( 'brando-ie9', BRANDO_THEME_CSS_URI.'/style-ie9.css', array( 'brando-style' ), BRANDO_THEME_VERSION );
    wp_style_add_data( 'brando-ie9', 'conditional', 'IE 9' );
    
    
    // Load the html5 shiv.
    wp_register_script( 'brando-html5', BRANDO_THEME_JS_URI.'/html5shiv.js', array(), BRANDO_THEME_VERSION );
    brando_script_add_data( 'brando-html5', 'conditional', 'lt IE 9' );
    wp_enqueue_script( 'brando-html5' );


    /*
     * Load our brando theme main and other required jquery files.
     */
    
    wp_register_script( 'modernizr', BRANDO_THEME_JS_URI.'/modernizr.js',array('jquery'),BRANDO_THEME_VERSION,true);
    wp_register_script( 'bootstrap', BRANDO_THEME_JS_URI.'/bootstrap.min.js',array('jquery'),BRANDO_THEME_VERSION,true);
    wp_register_script( 'jquery-easing', BRANDO_THEME_JS_URI.'/jquery.easing.1.3.js',array('jquery'),BRANDO_THEME_VERSION,true);
    wp_register_script( 'skrollr', BRANDO_THEME_JS_URI.'/skrollr.min.js',array('jquery'),BRANDO_THEME_VERSION,true);
    wp_register_script( 'smooth-scroll', BRANDO_THEME_JS_URI.'/smooth-scroll.js',array('jquery'),BRANDO_THEME_VERSION,true);
    wp_register_script( 'wow', BRANDO_THEME_JS_URI.'/wow.min.js',array('jquery'),BRANDO_THEME_VERSION,true);
    wp_register_script( 'jquery-parallax', BRANDO_THEME_JS_URI.'/jquery.parallax-1.1.3.js',array('jquery'),BRANDO_THEME_VERSION,true);
    wp_register_script( 'owl-carousel', BRANDO_THEME_JS_URI.'/owl.carousel.min.js',array('jquery'),BRANDO_THEME_VERSION,true);
    wp_register_script( 'jquery-magnific-popup', BRANDO_THEME_JS_URI.'/jquery.magnific-popup.min.js',array('jquery'),BRANDO_THEME_VERSION,true);
    wp_register_script( 'counter', BRANDO_THEME_JS_URI.'/counter.js',array('jquery'),BRANDO_THEME_VERSION,true);
    wp_register_script( 'jquery-fitvids', BRANDO_THEME_JS_URI.'/jquery.fitvids.js',array('jquery'),BRANDO_THEME_VERSION,true);
    wp_register_script( 'imagesloaded-pkgd', BRANDO_THEME_JS_URI.'/imagesloaded.pkgd.min.js',array('jquery'),BRANDO_THEME_VERSION,true);
    wp_register_script( 'jquery-appear', BRANDO_THEME_JS_URI.'/jquery.appear.js',array('jquery'),BRANDO_THEME_VERSION,true);
    wp_register_script( 'classie', BRANDO_THEME_JS_URI.'/classie.js',array('jquery'),BRANDO_THEME_VERSION,true);
    wp_register_script( 'isotope-pkgd', BRANDO_THEME_JS_URI.'/isotope.pkgd.min.js',array('jquery'),BRANDO_THEME_VERSION,true);
    wp_register_script( 'jquery-countTo', BRANDO_THEME_JS_URI.'/jquery.countTo.js',array('jquery'),BRANDO_THEME_VERSION,true);
    wp_register_script( 'jquery-nav', BRANDO_THEME_JS_URI.'/jquery.nav.js',array('jquery'),BRANDO_THEME_VERSION,true);
    wp_register_script( 'brandomain', BRANDO_THEME_JS_URI.'/main.js',array('jquery'),BRANDO_THEME_VERSION,true);
    
    wp_enqueue_script( 'modernizr');
    wp_enqueue_script( 'bootstrap');
    wp_enqueue_script( 'jquery-easing');
    wp_enqueue_script( 'skrollr');
    wp_enqueue_script( 'smooth-scroll');
    wp_enqueue_script( 'jquery-appear');
    wp_enqueue_script( 'jquery-nav');
    wp_enqueue_script( 'wow');
    wp_enqueue_script( 'jquery-countTo');
    wp_enqueue_script( 'jquery-parallax');
    wp_enqueue_script( 'jquery-magnific-popup');
    wp_enqueue_script( 'isotope-pkgd');
    wp_enqueue_script( 'imagesloaded-pkgd');
    wp_enqueue_script( 'classie');
    wp_enqueue_script( 'counter');
    wp_enqueue_script( 'jquery-fitvids'); 
    wp_enqueue_script( 'owl-carousel');
    wp_enqueue_script( 'brandomain');
     /*
     * Defind ajaxurl and wp_localize
     */

    wp_localize_script('brandomain', 'brandoajaxurl', 
        array( 'ajaxurl' => admin_url( 'admin-ajax.php' ),
            'themeurl' => get_template_directory_uri()
    ) );

    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }
}
add_action( 'wp_enqueue_scripts', 'brando_register_style_js' );