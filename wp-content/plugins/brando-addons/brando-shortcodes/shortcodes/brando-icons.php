<?php
/**
 * Shortcode For Icon
 *
 * @package Brando
 */
?>
<?php
/*-----------------------------------------------------------------------------------*/
/* Icons */
/*-----------------------------------------------------------------------------------*/
add_shortcode('brando_font_icons','brando_font_icons_shortcode');
if ( ! function_exists( 'brando_font_icons_shortcode' ) ) {
    function brando_font_icons_shortcode( $atts, $content = null ) {
    	extract( shortcode_atts( array(
            	'id' => '',
            	'class' => '',
            	'brando_font_icon_type' => '',
                'brando_et_icon_premade_style' => '',
                'brando_font_icon_premade_style' => '',
            	'brando_font_awesome_icon_list' => '',
            	'brando_et_line_icon_list' => '',
            	'brando_font_icon_size' => '',
            	'show_border' => '',
            	'show_border_rounded' => '',
            	'brando_icon_box_size' => '',
            	'brando_icon_box_decoration' => '',
            	'brando_icon_box_background_color' => '',
            	// et icons
            	'brando_et_icon_box_size' => '',
            	'et_show_border' => '',
            	'show_et_border_rounded' => '',
            	'et_plain' => '',
            	'circled' => '',
            	'brando_et_icon_box_decoration' => '',
            	'brando_et_icon_box_background_color' => '',
            ), $atts ) );
    	$output = $icon_common_class = '';
        $classes = $style_array = array();
        $id = ( $id ) ? ' id="'.$id.'"' : '';
        $class = ( $class ) ? $classes[] = $class : '';
      
        $brando_font_icon_type = ( $brando_font_icon_type ) ? $brando_font_icon_type : '';
    	$brando_font_awesome_icon_list = ( $brando_font_awesome_icon_list ) ?  $classes[] = $brando_font_awesome_icon_list : '';
    	$brando_font_icon_size = ( $brando_font_icon_size ) ? $classes[] = $brando_font_icon_size : '';
        $et_line = ($brando_et_icon_premade_style) ? 'icon-box' : '';
    	$show_border = ( $show_border ) ? $classes[] = 'i-bordered' : '';
    	$show_border_rounded = ( $show_border_rounded ) ? $classes[] = 'i-rounded' : '';
    	$brando_icon_box_size = ( $brando_icon_box_size ) ? $classes[] = $brando_icon_box_size : '';
    	$brando_icon_box_decoration = ( $brando_icon_box_decoration ) ? $classes[] = $brando_icon_box_decoration : '';
    	$brando_icon_box_background = ( $brando_icon_box_background_color ) ?  $classes[] = $brando_icon_box_background_color : '';
    	// Et Line icons
    	$brando_et_line_icon_list = ( $brando_et_line_icon_list ) ? $classes[] = $brando_et_line_icon_list : '';
    	$brando_et_icon_box_size = ( $brando_et_icon_box_size ) ? $classes[] = $brando_et_icon_box_size : '';
    	$et_show_border = ( $et_show_border ) ? $classes[] = 'i-bordered' : '';
    	$show_et_border_rounded = ( $show_et_border_rounded ) ? $classes[] ='i-rounded' : '';
    	$et_plain = ( $et_plain ) ? $classes[] = 'i-plain' : '';
    	$circled = ( $circled ) ? $classes[] = 'i-circled' : '';
    	$brando_et_icon_box_decoration = ( $brando_et_icon_box_decoration ) ? $classes[] = $brando_et_icon_box_decoration : '';
    	$brando_et_icon_box_background_color = ( $brando_et_icon_box_background_color ) ? $classes[] = $brando_et_icon_box_background_color : '';
        // ET-Line
        switch ($brando_et_icon_premade_style){
          
            case 'et-line-icons-1':
            case 'et-line-icons-2':
            case 'et-line-icons-3':
            case 'et-line-icons-4':
            case 'et-line-icons-5':
                $classes[]  = '';
            break;
            case 'et-line-icons-6':
                $classes[]  = 'i-background-box ';
            break;
            case 'et-line-icons-7':
            case 'et-line-icons-8':
            case 'et-line-icons-9':
            case 'et-line-icons-10':
            case 'et-line-icons-11':
                $classes[] = '';
            break;
            case 'et-line-icons-12':
                $classes[] = 'i-background-box ';
            break;
        }
        // Font-Awesome
        switch ($brando_font_icon_premade_style){
            case 'font-awesome-icons-1':
            case 'font-awesome-icons-2':
            case 'font-awesome-icons-3':
            case 'font-awesome-icons-4':
                $classes[] = '';
            break;
            case 'font-awesome-icons-5':
                $classes[] = 'i-background-box ';
            break;
        }
        // Check For Font Type
        $class_li = implode(" ", $classes);
        $class_list = ( $class_li ) ? ' class="'.$class_li.'"' : '';
        

    	switch ($brando_font_icon_type) 
        {
    		case 'brando_font_awesome_icons':
                if( $class_list ){
                    $output .= '<i'.$id.$class_list.'></i>';
                }
    		break;
    		case 'brando_et_line_icons':
                if( $class_list ){
                    $output .= '<i'.$id.$class_list.'></i>';
                }
    		break;
    	}
        return $output;
    }
}
?>