<?php
/**
 * Shortcode For Progressbar
 *
 * @package Brando
 */
?>
<?php
/*-----------------------------------------------------------------------------------*/
/* Progressbar */
/*-----------------------------------------------------------------------------------*/
$global_inside_title = null;
if ( ! function_exists( 'brando_progress_shortcode' ) ) 
{
    function brando_progress_shortcode( $atts, $content = null )
    {
       extract( shortcode_atts( array(
                    'progress_show_width' => '',
                    'progress_show_inside_title' => ''
                ), $atts ) );
        global $global_inside_title;
        $global_inside_title = $progress_show_inside_title;
        $classes = array();

        $show_width = ($progress_show_width=='1') ? $classes[] = 'progress-bar-style3 white-text' : '';
        $inside_title = ($progress_show_inside_title=='1') ? $classes[] = 'progress-bar-style2 ' : '';
        $class_list = implode(" ", $classes);
        $cl_list = ( $class_list ) ? ' '.$class_list : ''; 
        $output ='<div class="progress-bar-main '.$cl_list.'">';
           $output .= do_shortcode($content);
        $output .='</div>';
        return $output;
    }
}
add_shortcode( 'brando_progress', 'brando_progress_shortcode' );

if ( ! function_exists( 'brando_progress_content_shortcode' ) ) 
{
    function brando_progress_content_shortcode( $atts, $content = null ) 
    {
        extract( shortcode_atts( array(
                    'progress_title' => '',
                    'progress_subtitle' => '',
                    'progress_height' => '',
                    'progress_width' => '',
                    'progress_color' => '',
                    'progress_show_gradient' => '',
                ), $atts ) );

        global $global_inside_title;
        $progress_style = '';
        $progress_subtitle = ($progress_subtitle) ? $progress_subtitle : '';
        $inside_title = ($global_inside_title == '1') ? '' : '<div class="progress-name"><strong>'.$progress_title.'</strong>'.$progress_subtitle.'</div>';
        if(empty($inside_title)){
            $in_title=$progress_title;
        }else{
            $in_title='';
        }

        $show_gradient = ($progress_show_gradient == '1') ? ' progress-bar-striped' : '';
        $height = (!empty($progress_height)) ? ' style="height:'.$progress_height.'px"' : '';
        $progress_width = ( $progress_width ) ? $progress_width : '';
        //$progress_width_style = ( $progress_width ) ? 'width: '.$progress_width.'%;' : '';
        $progress_color_style = ( $progress_color ) ? 'background-color:'.$progress_color.';' : '';
        if( $progress_color || $progress_width ){
            $progress_style = ' style="'.$progress_color_style.'"';
        }

        $output='<div class="progress-bar-sub">';
            $output .='<div class="progress"'.$height.'>';
                $output .='<div class="progress-bar'.$show_gradient.'" role="progressbar" aria-valuenow="'.$progress_width.'" aria-valuemin="0" aria-valuemax="100"'.$progress_style.'>'.$in_title;
                    if($progress_width){
                        $output .='<span>'.$progress_width.'%</span>';
                    }
                $output .='</div>';
            $output .='</div>';
            $output .= $inside_title;
        $output .='</div>';
        return $output;
    }
}
add_shortcode( 'brando_progress_content', 'brando_progress_content_shortcode' );
?>