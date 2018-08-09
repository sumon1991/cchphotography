<?php
/**
 * displaying left sidebar for portfolio
 *
 * @package Brando
 */
?>
<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
$brando_layout_left_sidebar = $output = $brando_layout_right_sidebar = $brando_layout_settings = '';

$brando_layout_settings_inner = brando_option_portfolio('brando_layout_settings');

$brando_layout_settings = $brando_layout_settings_inner;
$brando_layout_left_sidebar = brando_option_portfolio('brando_layout_left_sidebar');
$brando_layout_right_sidebar = brando_option_portfolio('brando_layout_right_sidebar');

switch ($brando_layout_settings) 
{
	case 'brando_layout_left_sidebar':
        echo '<div class="col-md-8 col-sm-8 col-md-offset-1 xs-margin-seven-bottom pull-right xs-pull-none">';
    break;

	case 'brando_layout_right_sidebar':
        echo '<div class="col-md-8 col-sm-8 col-xs-12">';
    break;

	case 'brando_layout_both_sidebar':
		echo '<div class="col-md-3 col-sm-6 sidebar pull-left">';
			dynamic_sidebar($brando_layout_left_sidebar);
		echo '</div>';
        echo '<div class="col-md-3 col-sm-6 sidebar pull-right xs-margin-seven-top">';
			dynamic_sidebar($brando_layout_right_sidebar);
		echo '</div>';
        
            echo '<div class="col-md-6 col-sm-12 col-xs-12 pull-left sm-margin-seven-top">';
    break;

	case 'brando_layout_full_screen':
    break;
}
?>