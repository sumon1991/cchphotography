<?php
/**
 * Brando Custom Icon (font awesome and et line) List For VC.
 *
 * @package Brando
 */
?>
<?php 
/* icons shortcode settings */
vc_add_shortcode_param('brando_icon', 'brando_icon_shortcode', BRANDO_ADDONS_ROOT_DIR . '/brando-shortcodes/js/custom.js');
if ( ! function_exists( 'brando_icon_shortcode' ) ) :
  function brando_icon_shortcode($settings, $value) {
      $brando_icons = brando_icons();
      $brando_fa_icon = brando_get_font_awesome_icon_add();
    
      $output = '';

      $output .= "<div class='brando_icon_container_main'>";
          foreach ($brando_icons as $ikey => $ivalue) {
              $selected_icon = "";
              if($ivalue == $value) {
                $selected_icon = " active_icon";
              }
          $output .= '<span class="brando_icon_preview'.$selected_icon.'"><i class="'.$ivalue.'" data-name="'.$ivalue.'"></i></span>';
          }
          
          foreach ($brando_fa_icon as $ikey => $ivalue) {
              $selected_icon = "";
              if('fa '.$ivalue == $value) {
                 $selected_icon = " active_icon";
              }
          $output .= '<span class="brando_icon_preview'.$selected_icon.'"><i class="fa '.$ivalue.'" data-name="fa '.$ivalue.'"></i></span>';
          }
    
          $output .= '<input name="' . esc_attr( $settings['param_name'] ) . '" class="wpb_vc_param_value brando_icon_field wpb-textinput ' .
               esc_attr( $settings['param_name'] ) . ' ' .
               esc_attr( $settings['type'] ) . '_field" type="hidden" value="' . esc_attr( $value ) . '" />';
      $output .= '</div>'; 

  return $output;
  }
endif;

if( !function_exists('brando_icons')) {
  function brando_icons() {
    $icons = array('icon-mobile','icon-laptop','icon-desktop','icon-tablet','icon-phone','icon-document','icon-documents','icon-search','icon-clipboard','icon-newspaper','icon-notebook','icon-book-open','icon-browser','icon-calendar','icon-presentation','icon-picture','icon-pictures','icon-video','icon-camera','icon-printer','icon-toolbox','icon-briefcase','icon-wallet','icon-gift','icon-bargraph','icon-grid','icon-expand','icon-focus','icon-edit','icon-adjustments','icon-ribbon','icon-hourglass','icon-lock','icon-megaphone','icon-shield','icon-trophy','icon-flag','icon-map','icon-puzzle','icon-basket','icon-envelope','icon-streetsign','icon-telescope','icon-gears','icon-key','icon-paperclip','icon-attachment','icon-pricetags','icon-lightbulb','icon-layers','icon-pencil','icon-tools','icon-tools-2','icon-scissors','icon-paintbrush','icon-magnifying-glass','icon-circle-compass','icon-linegraph','icon-mic','icon-strategy','icon-beaker','icon-caution','icon-recycle','icon-anchor','icon-profile-male','icon-profile-female','icon-bike','icon-wine','icon-hotairballoon','icon-globe','icon-genius','icon-map-pin','icon-dial','icon-chat','icon-heart','icon-cloud','icon-upload','icon-download','icon-target','icon-hazardous','icon-piechart','icon-speedometer','icon-global','icon-compass','icon-lifesaver','icon-clock','icon-aperture','icon-quote','icon-scope','icon-alarmclock','icon-refresh','icon-happy','icon-sad','icon-facebook','icon-twitter','icon-googleplus','icon-rss','icon-tumblr','icon-linkedin','icon-dribbble');
    return $icons;
  }
}

vc_add_shortcode_param('brando_fontawesome_icon', 'brando_font_awesome_icon_shortcode', BRANDO_ADDONS_ROOT_DIR . '/brando-shortcodes/js/custom.js');
if ( ! function_exists( 'brando_font_awesome_icon_shortcode' ) ) :
function brando_font_awesome_icon_shortcode($settings, $value) {
    $brando_fa_icon = brando_get_font_awesome_icon_add();
    
    //$value = explode( ',', $value );
    $output = '';

    $output .= "<div class='brando_icon_container_main'>";
               
        foreach ($brando_fa_icon as $ikey => $ivalue) {
            $selected_icon = "";
            if('fa '.$ivalue == $value) {
               $selected_icon = " active_icon";
            }
        $output .= '<span class="brando_icon_preview'.$selected_icon.'"><i class="fa '.$ivalue.'" data-name="fa '.$ivalue.'"></i></span>';
        }
  
        $output .= '<input name="' . esc_attr( $settings['param_name'] ) . '" class="wpb_vc_param_value brando_icon_field wpb-textinput ' .
             esc_attr( $settings['param_name'] ) . ' ' .
             esc_attr( $settings['type'] ) . '_field" type="hidden" value="' . esc_attr( $value ) . '" />';
    $output .= '</div>'; 

return $output;
}
endif;

vc_add_shortcode_param('brando_etline_icon', 'brando_et_line_icon_shortcode', BRANDO_ADDONS_ROOT_DIR . '/brando-shortcodes/js/custom.js');
if ( ! function_exists( 'brando_et_line_icon_shortcode' ) ) :
  function brando_et_line_icon_shortcode($settings, $value) {
      $brando_icons = brando_icons();
      $output = '';
      $output .= "<div class='brando_icon_container_main'>";
          foreach ($brando_icons as $ikey => $ivalue) {
              $selected_icon = "";
              if($ivalue == $value) {
                $selected_icon = " active_icon";
              }
          $output .= '<span class="brando_icon_preview'.$selected_icon.'"><i class="'.$ivalue.'" data-name="'.$ivalue.'"></i></span>';
          }
          
          $output .= '<input name="' . esc_attr( $settings['param_name'] ) . '" class="wpb_vc_param_value brando_icon_field wpb-textinput ' .
               esc_attr( $settings['param_name'] ) . ' ' .
               esc_attr( $settings['type'] ) . '_field" type="hidden" value="' . esc_attr( $value ) . '" />';
      $output .= '</div>'; 

  return $output;
  }
endif;
?>