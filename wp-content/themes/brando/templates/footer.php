<?php
/**
 * Displaying footer section
 *
 * @package Brando
 */
?>
<?php
$brando_old_page_header_meta = '';
$brando_old_page_header_meta = get_post_meta( get_the_ID(), 'brando_enable_page_footer_single', true);
if( $brando_old_page_header_meta != '' && strlen($brando_old_page_header_meta) > 0 ){
    $brando_enable_footer = brando_option('brando_enable_page_footer');
}else{
    $brando_enable_footer = 2;  
}
if($brando_enable_footer == 1 || $brando_enable_footer == '2'){
    $brando_options = get_option( 'brando_theme_setting' );
    switch ($brando_enable_footer) {
        case '1':
            $brando_footer_type = brando_option('brando_footer_type');
        break;
        case '2':
            $brando_footer_type = isset($brando_options['brando_footer_type']) ? $brando_options['brando_footer_type'] : '';
        break;
    }
    switch ($brando_footer_type) {
        case 'footer-type-1':
            get_template_part('templates/footer/footer','1');
            break;

        case 'footer-type-2':
            get_template_part('templates/footer/footer','2');
            break;

        case 'footer-type-3':
            get_template_part('templates/footer/footer','3');
            break;

        case 'footer-type-4':
            get_template_part('templates/footer/footer','4');
            break;

        case 'footer-type-5':
            get_template_part('templates/footer/footer','5');
            break;
    }
}
?>