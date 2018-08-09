<?php
/**
 * Displaying menu section
 *
 * @package Brando
 */
?>
<?php
global $brando_theme_settings;
$brando_old_page_header_meta = '';
$brando_old_page_header_meta = get_post_meta( get_the_ID(), 'brando_enable_header_single', true);
if( $brando_old_page_header_meta != '' && strlen($brando_old_page_header_meta) > 0 ){
    $brando_enable_header = brando_option('brando_enable_header');
}else{
    $brando_enable_header = 2;  
}
if($brando_enable_header == 1 || $brando_enable_header == '2'){
    switch ($brando_enable_header) {
        case '1':
            $brando_header_layout = brando_option('brando_header_layout');
        break;
        case '2':            
            $brando_header_layout = ( isset($brando_theme_settings['brando_header_layout'] )) ? $brando_theme_settings['brando_header_layout'] : '';
        break;
    }
    
    // Header Layout Type
    switch ($brando_header_layout) {
        case 'headertype1':
            get_template_part('templates/header/header','1');
        break;
        case 'headertype2':
            get_template_part('templates/header/header','2');
        break;
        case 'headertype3':
            get_template_part('templates/header/header','3');
        break;
        case 'headertype4':
            get_template_part('templates/header/header','4');
        break;
        case 'headertype5':
            get_template_part('templates/header/header','5');
        break;
        case 'headertype6':
            get_template_part('templates/header/header','6');
        break;
        case 'headertype7':
            get_template_part('templates/header/header','7');
        break;
    }
?>
<?php } ?>