<?php
/**
 * Shortcode For Alert Message
 *
 * @package Brando
 */
?>
<?php
/*-----------------------------------------------------------------------------------*/
/* Alert Message */
/*-----------------------------------------------------------------------------------*/

if ( ! function_exists( 'brando_alert_massage_shortcode' ) ) {
	function brando_alert_massage_shortcode( $atts, $content = null ) {
		extract( shortcode_atts( array(
	        	'id' => '',
	        	'class' => '',
	        	'brando_alert_massage_premade_style' => '',
	        	'brando_alert_massage_type' => '',
	        	'brando_message_icon' => '',
	        	'brando_highlight_title' => '',
	        	'brando_subtitle' => '',
	        	'show_close_button' => '',
	        ), $atts ) );
		$output = '';

		$id = ($id) ? ' id="'.$id.'"' : '';
		$class = ( $class ) ? ' '.$class : '';
		$brando_alert_massage_premade_style = ( $brando_alert_massage_premade_style ) ? $brando_alert_massage_premade_style : '';
		$brando_alert_massage_type = ( $brando_alert_massage_type ) ? ' alert-'.$brando_alert_massage_type : '';
		$brando_message_icon = ( $brando_message_icon ) ? $brando_message_icon : '';
		$brando_highlight_title = ( $brando_highlight_title ) ? $brando_highlight_title : '';
		$brando_subtitle = ( $brando_subtitle ) ? $brando_subtitle : '';
		$show_close_button = ( $show_close_button ) ? '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>' : '';

		switch ($brando_alert_massage_premade_style) 
		{
			case 'alert-massage-style-1':

			   $output .= ' <div class="alert-style1">';
	                $output .= '<div'.$id.' class="alert'.$brando_alert_massage_type.$class.'" role="alert">';
                        if($brando_message_icon){
                           $output .= '<i class="'.$brando_message_icon.'"></i>';
                        }
                        if($brando_highlight_title || $brando_subtitle){
                 	        $output .= '<span>';
	                 	       	if($brando_highlight_title){
	                           		$output .= '<strong>'.$brando_highlight_title.'</strong> ';
	                       		}
	                           $output .= $brando_subtitle;
                            $output .= '</span>';
                        }        
                    $output .= '</div>';
                $output .= '</div>';
                
            break;

            case 'alert-massage-style-2':

		        $output .= '<div'.$id.' role="alert" class="alert'.$brando_alert_massage_type.$class.' fade in">';
					if($brando_message_icon){
						$output .= '<i class="'.$brando_message_icon.$brando_alert_massage_type.'"></i>';
					}
					if($brando_highlight_title || $brando_subtitle){
		                $output .= ' <span>';
			                $output .= '<strong>'.$brando_highlight_title.'</strong> ';
			                $output .= $brando_subtitle;
		                $output .= '</span>';
	                }
	                $output .= $show_close_button;
	            $output .= '</div>';

            break;

			case 'alert-massage-style-3':

			   $output .= '<div'.$id.' role="alert" class="alert'.$brando_alert_massage_type.$class.' fade in">';
					if($brando_highlight_title || $brando_subtitle){
						$output .= '<span>';
							if($brando_highlight_title){
								$output .= '<strong>'.$brando_highlight_title.'</strong> ';
							}
							$output .= $brando_subtitle;
						$output .= '</span>';
					}
					$output .= $show_close_button;
	            $output .= '</div>';

			break;

            case 'alert-massage-style-4':

				$output .= '<div class="alert-style2">';
					$output .= '<div'.$id.' role="alert" class="alert'.$brando_alert_massage_type.$class.'">';
						if($brando_highlight_title || $brando_subtitle){
							$output .= '<span>';
								if($brando_highlight_title){
									$output .= '<strong>'.$brando_highlight_title.'</strong> ';
								}
								$output .= $brando_subtitle;
							$output .= '</span>';
						}
						$output .= $show_close_button;
		            $output .= '</div>';
		        $output .= '</div>';

		    break;

			case 'alert-massage-style-5':

				$output .= '<div'.$id.' role="alert" class="alert alert-block fade in'.$brando_alert_massage_type.$class.'">';
					$output .= $show_close_button;
					if($brando_highlight_title){
						$output .= '<span class="margin-two no-margin-top no-margin-lr alt-font font-weight-600 text-medum text-uppercase'.$brando_alert_massage_type.'">'.$brando_highlight_title.'</span>';
					}
					if($brando_subtitle){
						$output .= '<p>'.$brando_subtitle.'</p>';
					}
		        $output .= '</div>';

			break;
		}
	    return $output;
	}
}
add_shortcode('brando_alert_massage','brando_alert_massage_shortcode');
?>