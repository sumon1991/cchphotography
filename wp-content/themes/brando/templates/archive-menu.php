<?php
/**
 * Displaying menu section for archive pages
 *
 * @package Brando
 */
?>
<?php
global $brando_theme_settings;
$brando_options = get_option( 'brando_theme_setting' );
$brando_enable_header = (isset($brando_options['brando_enable_header_general'])) ? $brando_options['brando_enable_header_general'] : '';
if($brando_enable_header == 1){
           
    $brando_header_layout = ( isset($brando_theme_settings['brando_header_layout_general'] )) ? $brando_theme_settings['brando_header_layout_general'] : $brando_theme_settings['brando_header_layout'];
    
    // Header Layout Type
    switch ($brando_header_layout) {
        case 'headertype1':
            get_template_part('templates/archive-header/header','1');
        break;
        case 'headertype2':
            get_template_part('templates/archive-header/header','2');
        break;
        case 'headertype3':
            get_template_part('templates/archive-header/header','3');
        break;
        case 'headertype4':
            get_template_part('templates/archive-header/header','4');
        break;
        case 'headertype5':
            get_template_part('templates/archive-header/header','5');
        break;
        case 'headertype6':
            get_template_part('templates/archive-header/header','6');
        break;
        case 'headertype7':
            get_template_part('templates/archive-header/header','7');
        break;
    }
?>
<?php } ?>