<?php 
if ( ! defined( 'ABSPATH' ) ) exit;
add_shortcode('xyz_em_subscription_html_code','display_content');


function display_content(){
	if(is_numeric(ini_get('output_buffering'))){
		
		ob_start();
		include(dirname( __FILE__ ).'/shortcodes/htmlcode.php');
		$xyz_em_content = xyz_remove_extra_newlines(ob_get_contents());
		ob_clean();
		ob_end_flush();
		        
		return $xyz_em_content;
	}else{
		include(dirname( __FILE__ ).'/shortcodes/htmlcode.php');
	}

}




add_shortcode('xyz_em_thanks','display_thanks');


function display_thanks(){
	if(is_numeric(ini_get('output_buffering'))){
		
		
		ob_start();
		include(dirname( __FILE__ ).'/shortcodes/thanks.php');
		$xyz_em_thanks = xyz_remove_extra_newlines(ob_get_contents());
		ob_clean();
		ob_end_flush();
		        
		return $xyz_em_thanks;
	}else{
		include(dirname( __FILE__ ).'/shortcodes/thanks.php');
	}
}

add_shortcode('xyz_em_confirm','display_confirm');


function display_confirm(){
	if(is_numeric(ini_get('output_buffering'))){
		
		ob_start();
		include(dirname( __FILE__ ).'/shortcodes/confirm.php');
		$xyz_em_confirm = xyz_remove_extra_newlines(ob_get_contents());
		ob_clean();
		ob_end_flush();
		
		return $xyz_em_confirm;
	}else{
		include(dirname( __FILE__ ).'/shortcodes/confirm.php');
	}
}

add_shortcode('xyz_em_unsubscribe','display_unsubscribe');


function display_unsubscribe(){
	if(is_numeric(ini_get('output_buffering'))){
		
		ob_start();
		include(dirname( __FILE__ ).'/shortcodes/unsubscribe.php');
		$xyz_em_unsubscribe = xyz_remove_extra_newlines(ob_get_contents());
		ob_clean();
		ob_end_flush();
		
		     
		return $xyz_em_unsubscribe;
	}else{
		include(dirname( __FILE__ ).'/shortcodes/unsubscribe.php');
	}
}

?>
