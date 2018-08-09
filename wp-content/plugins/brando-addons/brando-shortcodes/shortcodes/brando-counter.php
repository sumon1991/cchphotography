<?php
/**
 * Shortcode For Counter 
 *
 * @package Brando
 */
?>
<?php
/*-----------------------------------------------------------------------------------*/
/* Brando Counter  */
/*-----------------------------------------------------------------------------------*/
$count = 1;
if ( ! function_exists( 'brando_counter_or_skill_shortcode' ) ) {
    function brando_counter_or_skill_shortcode( $atts, $content = null ) {
        extract( shortcode_atts( array(
            'counter_or_chart' => '',
            'counter_icon' =>'',
            'counter_number' => '',
            'counter_number_style' => '',
            'counter_number_color' => '',
            'brando_seperator' => '',
            'title' => '',
            'title_style' => '',
            'title_color' => '',
            'icon_color' => '',
            'counter_icon_size' => '',
            'counter_animation_duration' => '7000',
            'brando_row_animation_style' => '',
            'brando_show_separator' => '',
            'brando_sep_color' => '',
            'separator_height' => '',
        ), $atts ) );

        $output = '';   

    	global $count;
    	
    	$counter_style_attr = $counter_class_attr = $title_style_attr = $title_class_attr = $sep_style = '';
        $classes_span1 = $classes_span2 = $classes_icon = $style_array = array();
    	$counter_icon = ( $counter_icon ) ? $classes_icon[] = $counter_icon : '' ;
    	$counter_icon_size = ( $counter_icon_size ) ? $classes_icon[] = $counter_icon_size : $classes_icon[] ='medium-icon';
    	$counter_animation_duration = ( $counter_animation_duration ) ? $counter_animation_duration : '7000';
    	$brando_row_animation_style = ( $brando_row_animation_style ) ? $classes_span1[] = 'wow '.$brando_row_animation_style : '';
    	$counter_number = ( $counter_number ) ? $counter_number : '';
    	$icon_color = ($icon_color) ? ' style ="color: '.$icon_color.'"' : '';
    	// For Counter Style
    	if($counter_number_style == 'custom'){
    		$style_array[] = ( $counter_number_color ) ? 'color: '.$counter_number_color.';' : '';
    	}else{
    		$classes_span1[]  = ( $counter_number_style ) ?  $counter_number_style : '';
    	}
    	// For Title Style
    	if($title_style == 'custom'){
    		$title_style_attr = ( $title_color ) ? ' style="color: '.$title_color.'"' : '';
    	}else{
    		 $classes_span2[] =  ( $title_style ) ? $title_style : '';
    	}
        $brando_sep_color = ( $brando_sep_color ) ? 'background:'.$brando_sep_color.' !important; ' : ''; 
        $brando_seperator_height = ( $separator_height ) ? 'height:'.$separator_height.' !important;' : ''; 
        if( $brando_sep_color || $brando_seperator_height){
            $sep_style .= ' style="'.$brando_sep_color.$brando_seperator_height.'"';
        }

        $class_list1 = implode(" ", $classes_span1);
        $counter_class_attr = ( $class_list1 ) ? ' '.$class_list1 : '';

        $class_list2 = implode(" ", $classes_span2);
        $title_class_attr = ( $class_list2 ) ? ' '.$class_list2 : '';

        $class_list3 = implode(" ", $classes_icon);
        $class_icon_attr = ( $class_list3 ) ? ' class="'.$class_list3.'"' : '';

        $style_property_list = implode(" ", $style_array);
        $counter_style_attr = ( $style_property_list ) ? ' style="'.$style_property_list.'"' : '';

        switch ($counter_or_chart) {
            case 'counter-style1':
                $count++;
	                if( $counter_icon ){
		                $output .= '<div class="col-md-4 col-sm-5 col-xs-12 no-padding xs-margin-five-bottom">';
		                    $output .= '<i'.$class_icon_attr.$icon_color.'></i>';
		                $output .= '</div>';
		                $output .= '<div class="col-md-8 col-sm-7 col-xs-12 text-left xs-text-center">';
	            	}
	    			$output .= '<div class="counter-style1">';
	                    if( $counter_number ){
	                       $output .= '<span class="timer counter-number alt-font'.$counter_class_attr.'" data-to="'.$counter_number.'" data-speed="'.$counter_animation_duration.'"'.$counter_style_attr.'>'.$counter_number.'</span>';
                        }
	                    if( $title ){
	                       $output .= '<span class="text-small letter-spacing-2 text-uppercase margin-three-top xs-margin-one-top display-block alt-font'.$title_class_attr.'"'.$title_style_attr.'>'.$title.'</span>';
                        }
	                $output .= '</div>';
		            if( $counter_icon ){
	                	$output .= '</div>';
	            	}
            break;

            case 'counter-style2':
                $count++;
                $counter_id = '#counter_'.$count;
                $output .= ' <div class="counter-style1 text-center sm-margin-eleven sm-no-margin-lr sm-no-margin-top">';
                    if( $counter_number ){
                        $output .= ' <span class="timer counter-number alt-font'.$counter_class_attr.'" data-to="'.$counter_number.'" data-speed="'.$counter_animation_duration.'"'.$counter_style_attr.'>'.$counter_number.'</span>';
                    }
                    if( $title ){
                        $output .= '<span class="text-small letter-spacing-2 text-uppercase margin-four-tb xs-margin-two-tb display-block alt-font'.$title_class_attr.'"'.$title_style_attr.'>'.$title.'</span>';
                    }
                    if( $counter_icon ){
                        $output .= '<i'.$class_icon_attr.$icon_color.'></i>';
                    }
               $output .= '</div>';   
            break;

            case 'counter-style3':
                $count++;
                $counter_id = '#counter_'.$count;
                $output .= ' <div class="col-md-2 col-sm-3 no-padding xs-display-none">';
                    if( $brando_show_separator == 1 ){
                        $output .= '<div class="separator-line-medium-thick bg-black position-relative top9"'.$sep_style.'></div>';
                    }
                $output .= '</div>';
                $output .= '<div class="col-md-10 col-sm-9 no-padding counter-style1 xs-text-center">';
                    if( $counter_number ){
                        $output.= '<span class="timer counter-number alt-font title-medium font-weight-700'.$counter_class_attr.'" data-to="'.$counter_number.'" data-speed="'.$counter_animation_duration.'"'.$counter_style_attr.'>'.$counter_number.'</span>';
                    }
                    if( $title ){
                        $output.= '<span class="text-small text-uppercase display-block alt-font margin-two-all no-margin-lr letter-spacing-2'.$title_class_attr.'"'.$title_style_attr.'>'.$title.'</span>';
                    }
                $output.= '</div>';
            break;
        }
        return $output;        
    }
}
add_shortcode( 'brando_counter_or_skill', 'brando_counter_or_skill_shortcode' );
?>