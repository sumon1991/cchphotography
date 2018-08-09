<?php
/**
 * displaying right sidebar for posts
 *
 * @package Brando
 */
?>
<?php
$brando_layout_left_sidebar = $output = $brando_layout_right_sidebar = $brando_layout_settings = '';
$brando_layout_settings_inner = brando_option_post('brando_layout_settings');
$brando_layout_settings = $brando_layout_settings_inner;
$brando_layout_left_sidebar = brando_option_post('brando_layout_left_sidebar');
$brando_layout_right_sidebar = brando_option_post('brando_layout_right_sidebar');
switch ($brando_layout_settings) 
{
	case 'brando_layout_left_sidebar':

		echo '</div>';
            echo '<div class="col-md-3 col-sm-4 col-xs-12 sidebar pull-left">';
				dynamic_sidebar($brando_layout_left_sidebar);
			echo '</div>';

	break;

	case 'brando_layout_right_sidebar':

		echo '</div>';
       		echo '<div class="col-md-3 col-sm-4 col-xs-12 col-md-offset-1 xs-margin-seven-top sidebar pull-right">';
        		dynamic_sidebar($brando_layout_right_sidebar);
			echo '</div>';

	break;

	case 'brando_layout_both_sidebar':

		echo '</div>';
		
	break;
        
    case 'brando_layout_full_screen':
        
    break;
}
?>