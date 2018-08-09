<?php
/**
 * Extend Theme Option
 */

if ( ! function_exists( 'brando_option' ) ) :
    function brando_option( $brando_option )
    {
        global $brando_theme_settings, $post;
        $brando_single = false;
        if(is_singular()){
            $brando_value = get_post_meta( $post->ID, $brando_option.'_single', true);
            $brando_single = true;
        }

        if($brando_single == true){
            if (is_string($brando_value) && (strlen($brando_value) > 0 || is_array($brando_value)) && $brando_value != 'default') {
                return $brando_value;
            }
        }
        if(isset($brando_theme_settings[$brando_option]) && $brando_theme_settings[$brando_option] != ''){
            $brando_option_value = $brando_theme_settings[$brando_option];
            return $brando_option_value;
        }
        return false;
    }
endif;

if ( ! function_exists( 'brando_under_construction_theme_option' ) ) :
    function brando_under_construction_theme_option() {
    	$brando_under_construction = array(
            'id'       => 'enable_under_construction',
            'type'     => 'switch',
            'title'    => esc_html__('Enable Under Construction', 'brando-addons' ),
            'default'  => false,
            'desc' => esc_html__('Select on to put the site under construction. Only administrator will be able to see frontend site. Please logout to check under construction mode is enabled or not.', 'brando-addons'),
        );

        return ( $brando_under_construction );
    }
endif;

if ( ! function_exists( 'brando_under_construction_template_start_theme_option' ) ) :
    function brando_under_construction_template_start_theme_option() {
    	$brando_under_construction_template = array(
            'id'        => 'opt-accordion-begin-under-construction',
            'type'      => 'accordion',
            'title'     => esc_html__('Under Construction Page', 'brando-addons'),
            'subtitle'  => esc_html__('Select page to display when site is in under construction mode', 'brando-addons'),
            'position'  => 'start',
        );
        return ( $brando_under_construction_template );
    }
endif;

if ( ! function_exists( 'brando_under_construction_template_page_theme_option' ) ) :
    function brando_under_construction_template_page_theme_option() {
    	$brando_under_construction_template = 
        array(
            'id'=>'under_construction_page',
            'type' => 'select',
            'title' => esc_html__('Under Construction Page', 'brando-addons'),
            'data' => 'pages'
        );
        return ( $brando_under_construction_template );
    }
endif;

if ( ! function_exists( 'brando_under_construction_template_end_theme_option' ) ) :
    function brando_under_construction_template_end_theme_option() {
    	$brando_under_construction_template = array(
            'id'        => 'opt-accordion-end-under-construction',
            'type'      => 'accordion',
            'position'  => 'end'
        );
        return ( $brando_under_construction_template );
    }
endif;

/**
 * Force All Page To Under Construction If "enable-under-construction" is enable
 */
if ( ! function_exists( 'brando_get_address' ) ) {
    function brando_get_address() {
        // return the full address
        return brando_get_protocol().'://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
    } // end function brando_get_address
}

if ( ! function_exists( 'brando_get_protocol' ) ) {
    function brando_get_protocol() {
        // Set the base protocol to http
        $brando_protocol = 'http';
        // check for https
        if ( isset( $_SERVER["HTTPS"] ) && strtolower( $_SERVER["HTTPS"] ) == "on" ) {
            $brando_protocol .= "s";
        }
        
        return $brando_protocol;
    } // end function brando_get_protocol
}
        
add_action( 'init', 'brando_force_under_construction', 1 );
if ( ! function_exists( 'brando_force_under_construction' ) ) {
    function brando_force_under_construction() {

        // this is what the user asked for (strip out home portion, case insensitive)
        $brando_userrequest = str_ireplace(home_url('/'),'',brando_get_address());
        $brando_userrequest = rtrim($brando_userrequest,'');

        if (brando_option('enable_under_construction') == 1 && !current_user_can('level_10') && brando_option('under_construction_page') != '' ) { 
            $brando_do_redirect = '';
            if( get_option('permalink_structure') ){
                $brando_do_redirect = '/'.brando_option( 'under_construction_page' );
            }else{
                $brando_getpost = get_page_by_path( brando_option( 'under_construction_page' ) );
                if ($brando_getpost) {
                    $brando_do_redirect = '/?page_id='.$brando_getpost->ID;
                }
            }

            if ( strpos($brando_userrequest, 'wp-login') !== 0 && strpos($brando_userrequest, 'wp-admin') !== 0 ) {
                // Make sure it gets all the proper decoding and rtrim action
                $brando_userrequest = str_replace('*','(.*)',$brando_userrequest);
                $brando_pattern = '/^' . str_replace( '/', '\/', rtrim( $brando_userrequest, '/' ) ) . '/';
                $brando_do_redirect = str_replace('*','$1',$brando_do_redirect);
                $output = preg_replace($brando_pattern, $brando_do_redirect, $brando_userrequest);
                if ($output !== $brando_userrequest) {
                    // pattern matched, perform redirect
                    $brando_do_redirect = $output;
                }
            }else{
                // simple comparison redirect
                $brando_do_redirect = $brando_userrequest;
            }

            if ($brando_do_redirect !== '' && trim($brando_do_redirect,'/') !== trim($brando_userrequest,'/')) {
                // check if destination needs the domain prepended

                if (strpos($brando_do_redirect,'/') === 0){
                    $brando_do_redirect = home_url('/').$brando_do_redirect;
                }

                header ('Location: ' . $brando_do_redirect);
                exit();
                
            }
        }
    } // end funcion redirect
}

/**
 * To Add Under Construction Notice To Adminbar For All Logged User
 */
if ( ! function_exists( 'brando_admin_bar_under_construction_notice' ) ) {
    function brando_admin_bar_under_construction_notice() {
        global $wp_admin_bar;
        
        if (brando_option('enable_under_construction') == 1) {
            $wp_admin_bar->add_menu( array(
                'id' => 'admin-bar-under-construction-notice',
                'parent' => 'top-secondary',
                'href' => esc_url(home_url('/')).'wp-admin/themes.php?page=brando_theme_settings',
                'title' => '<span style="color: #FF0000;">'.esc_html__( 'Under Construction', 'brando-addons' ).'</span>'
            ) );
        }
    }
}
add_action( 'admin_bar_menu', 'brando_admin_bar_under_construction_notice' );