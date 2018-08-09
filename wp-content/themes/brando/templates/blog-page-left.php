<?php
/**
 * displaying left sidebar for archive pages
 *
 * @package Brando
 */
?>
<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
$brando_layout_left_sidebar = $output = $brando_layout_right_sidebar = $brando_layout_settings = '';

$brando_layout_settings_inner = brando_option('brando_blog_page_settings');

$brando_layout_settings = $brando_layout_settings_inner;
$brando_layout_left_sidebar = brando_option('brando_blog_page_left_sidebar');
$brando_layout_right_sidebar = brando_option('brando_blog_page_right_sidebar');
switch ($brando_layout_settings) {
	case 'brando_blog_page_left_sidebar':
        
            echo '<div class="col-md-8 col-sm-8 col-xs-12 col-md-offset-1 xs-margin-ten-bottom pull-right xs-pull-none">';
        
	break;

	case 'brando_blog_page_right_sidebar':
        
		    echo '<div class="col-md-8 col-sm-8 col-xs-12">';
        
		
	break;

	case 'brando_blog_page_both_sidebar':
		echo '<div class="col-md-3 col-sm-6 col-xs-12 sidebar pull-left">';
			dynamic_sidebar($brando_layout_left_sidebar);
		echo '</div>';
        echo '<div class="col-md-3 col-sm-6 col-xs-12 sidebar pull-right xs-margin-seven-top">';
			dynamic_sidebar($brando_layout_right_sidebar);
		echo '</div>';
        
            echo '<div class="col-md-6 col-sm-12 col-xs-12 pull-left sm-margin-seven-top post-center">';

	break;

	case 'brando_blog_page_full_screen':
    break;
}
?>