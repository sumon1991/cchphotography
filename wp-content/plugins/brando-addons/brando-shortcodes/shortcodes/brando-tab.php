<?php
/**
 * Shortcode For Tabs
 *
 * @package Brando
 */
?>
<?php
/*-----------------------------------------------------------------------------------*/
/* Tabs */
/*-----------------------------------------------------------------------------------*/

$brando_tabs_style='';
if ( ! function_exists( 'brando_tabs' ) ) {
  function brando_tabs( $atts, $content = null ) {
    extract( shortcode_atts( array(
                'id'        => '',
                'class'     => '',
                'tabs_style' => '',
                'active_tab' => '',
                'tabs_alignment' => '',
                
            ), $atts ) );
    $output = '';

    global $brando_tabs_style , $brando_global_tabs;
    $brando_global_tabs = array();
    $brando_tabs_style = $tabs_style;
    $pre_define_tab_style = '';     
    do_shortcode( $content );
    if( empty( $brando_global_tabs ) ) { return; }
    $id = ( $id ) ? ' id="'.$id.'"' : '';
    $class = ( $class ) ? ' '.$class : '';
    $active_tab = ( $active_tab ) ? $active_tab : '1';
    $pre_define_tab_style = ( $tabs_style ) ? $tabs_style : '';
    $tabs_alignment = ( $tabs_alignment ) ? ' '.$tabs_alignment : '';

    /* For uniqtab id */
    $tabuniqtab = time().'-'.mt_rand();

    switch ($pre_define_tab_style) {
        case 'tab-style1':
          $tabs_style = 'tab-style5';
        break;
        case 'tab-style2':
          $tabs_style = 'tab-style6';
        break;
        case 'tab-style3':
          $tabs_style = 'tab-style7';
        break;
        case 'tab-style4':
          $tabs_style = 'tab-style8';
        break;
        case 'tab-style5':
          $tabs_style = 'tab-style9';
        break;
        case 'tab-style6':
          $tabs_style = 'tab-style-1';
        break;
        case 'tab-style7':
          $tabs_style = 'tab-style-3';
        break;
        case 'tab-style8':
          $tabs_style = 'tab-style-2';
        break;
        case 'tab-style9':
          $tabs_style = 'tab-style-4';
        break;
    }

    switch ($tabs_style) {
      case 'tab-style-1':
        $i = $j= 1;
        $output .= '<div'.$id.' class="col-md-4 col-sm-12 col-xs-12'.$class.'">';
          $output .= '<ul class="nav nav-tabs '.$tabs_style.' no-border alt-font text-large'.$tabs_alignment.'" role="tablist">';
            foreach( $brando_global_tabs as $key => $tab) {
              $title =  $tab['atts']['title'];
              $tab_icon  =  ( (isset($tab['atts']['show_icon']) == 1) && ( !empty($tab['atts']['tab_icon']) ) ) ? ' class="'.$tab['atts']['tab_icon'].'"' : '';
              $active = ( ( $key + 1 ) == $active_tab ) ? 'active' : '';
              $output .= '<li role="presentation" class="sm-no-margin '.$active.'">';
                $output .= '<a href="#brando-'.$tabuniqtab.'-'.$key.'" role="tab" data-toggle="tab">';
                  if($tab_icon)
                  {
                    $output .= '<i'.$tab_icon.'></i>';
                  }
                  if(($title) && (isset($tab['atts']['show_title']) == 1)):
                    $output .= esc_html($title);
                  endif;
                $output .= '</a>';
              $output .= '</li>';
              $j++;
            } 
          $output .= '</ul>';
        $output .= '</div>';
        $output .= '<div class="col-md-7 col-sm-12 col-xs-12 col-md-offset-1 sm-margin-six-top">';
          $output .= '<div class="tab-content">';
            foreach ($brando_global_tabs as $key => $tab) {
              $active_content = ( ( $key + 1 ) == $active_tab ) ? 'in active' : '';
              $output .= '<div role="tabpanel" class="tab-pane fade '.$active_content.'" id="brando-'.$tabuniqtab.'-'.$key.'">';
                 $output .=  do_shortcode($tab['content']);
              $output .= '</div>';
              $i++;
            }   
          $output .= '</div>';
        $output .= '</div>';
      break;

      case 'tab-style-2':
        $i = $j = 1;
        $output .= '<div'.$id.' class="tab-content clearfix'.$class.'">';
            foreach ($brando_global_tabs as $key => $tab) {
              $active_content = ( ( $key + 1 ) == $active_tab ) ? 'in active' : '';
              $output .= '<div role="tabpanel" class="tab-pane fade '.$active_content.'" id="brando-'.$tabuniqtab.'-'.$key.'">';
                 $output .=  do_shortcode($tab['content']);
              $output .= '</div>';
              $i++;
            }   
        $output .= '</div>';
        
        $output .= '<ul class="'.$tabs_style.' nav nav-tabs alt-font text-uppercase letter-spacing-1 no-border text-center margin-seven-top xs-margin-eighteen-top" role="tablist">';
          foreach( $brando_global_tabs as $key => $tab) {
            $title =  $tab['atts']['title'];
            $tab_icon  =  ( (isset($tab['atts']['show_icon']) == 1) && ( !empty($tab['atts']['tab_icon']) ) ) ? ' class="'.$tab['atts']['tab_icon'].'"' : '';
            $active = ( ( $key + 1 ) == $active_tab ) ? 'active' : '';
            $output .= '<li role="presentation" class="'.$active.' xs-display-block xs-no-margin">';
              $output .= '<a href="#brando-'.$tabuniqtab.'-'.$key.'" class="xs-display-inline-block" role="tab" data-toggle="tab">';
                if($tab_icon)
                {
                  $output .= '<i'.$tab_icon.'></i>';
                }
                if(($title) && (isset($tab['atts']['show_title']) == 1)):
                  $output .= esc_html($title);
                endif;  
              $output .= '</a>';
        
            $output .= '</li>';
            $j++;
          } 
        $output .= '</ul>';
      break;

      case 'tab-style-3':
        $i = $j= 1;
        $output .= '<div'.$id.' class="architecture-section no-padding-lr md-margin-three-lr xs-no-padding-top xs-no-margin-lr '.$tabs_style.$class.'">';
            $output .= '<ul class="nav nav-tabs alt-font text-uppercase letter-spacing-1 no-border font-weight-600'.$tabs_alignment.'" role="tablist">';
              foreach( $brando_global_tabs as $key => $tab) {
                $title =  $tab['atts']['title'];
                $tab_icon  =  ( (isset($tab['atts']['show_icon']) == 1) && ( !empty($tab['atts']['tab_icon']) ) ) ? ' class="'.$tab['atts']['tab_icon'].'"' : '';
                $active = ( ( $key + 1 ) == $active_tab ) ? 'active' : '';
                $output .= '<li role="presentation" class="xs-display-block xs-margin-five-bottom '.$active.'">';
                  $output .= '<a href="#brando-'.$tabuniqtab.'-'.$key.'" class="xs-display-inline" role="tab" data-toggle="tab">';
                    if($tab_icon)
                    {
                      $output .= '<i'.$tab_icon.'></i>';
                    }
                    if(($title) && (isset($tab['atts']['show_title']) == 1)):
                      $output .= esc_html($title);
                    endif;
                  $output .= '</a>';
                $output .= '</li>';
                $j++;
              } 
            $output .= '</ul>';
        $output .= '<div class="tab-content clearfix margin-ten-top sm-margin-five-top">';
            foreach ($brando_global_tabs as $key => $tab) {
              $active_content = ( ( $key + 1 ) == $active_tab ) ? 'in active' : '';
              $output .= '<div role="tabpanel" class="tab-pane fade '.$active_content.'" id="brando-'.$tabuniqtab.'-'.$key.'">';
                 $output .=  do_shortcode($tab['content']);
              $output .= '</div>';
              $i++;
            }   
        $output .= '</div>';
      $output .= '</div>';
      break;

      case 'tab-style-4':
        $output .= '<div'.$id.' class="'.$tabs_style.$class.'">';
          $output .= '<ul class="nav nav-tabs alt-font display-inline-block text-uppercase letter-spacing-1 font-weight-600 xs-width-100 xs-no-border margin-five-bottom '.$tabs_style.$class.$tabs_alignment.'" role="tablist">';
            foreach( $brando_global_tabs as $key => $tab) {
                    $title      =  $tab['atts']['title'];
                    $tab_icon  =  ( (isset($tab['atts']['show_icon']) == 1) && ( !empty($tab['atts']['tab_icon']) ) ) ? ' class="'.$tab['atts']['tab_icon'].'"' : '';
                    $active = ( ( $key + 1 ) == $active_tab ) ? 'active' : '';
                    $output .= '<li class="xs-display-block xs-no-border '.$active.'">';
                      $output .= '<a href="#brando-'.$tabuniqtab.'-'.$key.'" data-toggle="tab" class="xs-display-block">';
                      if($tab_icon)
                      {
                        $output .= '<i'.$tab_icon.'></i>';
                      }
                      if(($title) && (isset($tab['atts']['show_title']) == 1)):
                        $output .= esc_html($title);
                      endif;
                      $output .= '</a>';
                    $output .= '</li>';
            }
          $output .= '</ul>';
          $output .= '<div class="tab-content clearfix">';
            foreach ($brando_global_tabs as $key => $tab) {
              $active_content = ( ( $key + 1 ) == $active_tab ) ? ' in active' : '';
              $title  = $tab['atts']['title'];
              $output .= '<div class="tab-pane fade'.$active_content.'" id="brando-'.$tabuniqtab.'-'.$key.'">';
                $output .=  do_shortcode($tab['content']);
              $output .=  '</div>';
            }
          $output .= '</div>';
        $output .= '</div>';
      break;

      case 'tab-style9':
        $output .= '<div'.$id.' class="'.$tabs_style.$class.'">';
          $output .= '<ul class="nav nav-tabs margin-ten-bottom xs-margin-six-bottom'.$tabs_alignment.'">';
            foreach( $brando_global_tabs as $key => $tab) {
              $title      =  $tab['atts']['title'];
              $tab_icon  =  ( (isset($tab['atts']['show_icon']) == 1) && ( !empty($tab['atts']['tab_icon']) ) ) ? ' class="'.$tab['atts']['tab_icon'].'"' : '';
              $active = ( ( $key + 1 ) == $active_tab ) ? ' active' : '';
              $output .= '<li class="nav'.$active.'">';
              $output .= '<a href="#brando-'.$tabuniqtab.'-'.$key.'" data-toggle="tab">';
                if($tab_icon)
                {
                  $output .= '<span><i'.$tab_icon.'></i></span>';
                }
              $output .= '</a>';
              if(($title) && (isset($tab['atts']['show_title']) == 1)):
                $output .= '<br><span class="text-small text-uppercase letter-spacing-3 margin-five font-weight-600 xs-letter-spacing-none xs-display-none">'.esc_html($title).'</span>';
              endif;
              $output .= '</li>';
            }
          $output .= '</ul>';
          $output .= '<div class="tab-content">';
            foreach ($brando_global_tabs as $key => $tab) {
              $active_content = ( ( $key + 1 ) == $active_tab ) ? ' in active' : '';
              $title  = $tab['atts']['title'];
              $output .= '<div class="col-md-12 col-sm-12 text-center center-col tab-pane fade'.$active_content.'" id="brando-'.$tabuniqtab.'-'.$key.'">';
                $output .=  do_shortcode($tab['content']);
              $output .=  '</div>';
            }
            $output .= '</div>';
        $output .= '</div>';
      break;

      case 'tab-style7':
      $output .= '<div class="'.$tabs_style.$class.'"'.$id.'>';
          $output .= '<div class="row">';
            $output .= '<div class="col-md-12 col-sm-12 col-xs-12">';
              $output .= '<ul class="nav nav-tabs nav-tabs-light text-uppercase'.$tabs_alignment.'">';
                foreach( $brando_global_tabs as $key => $tab) {
                  $title      =  $tab['atts']['title'];
                  $tab_icon  =  ( (isset($tab['atts']['show_icon']) == 1) && ( !empty($tab['atts']['tab_icon']) ) ) ? ' class="'.$tab['atts']['tab_icon'].'"' : '';
                  $active = ( ( $key + 1 ) == $active_tab ) ? ' active' : '';
                  // $output .= '<li class="nav'.$active.'">';
                  $output .= '<li class="no-margin xs-width-100 '.$active.'">';
                    $output .= '<a href="#brando-'.$tabuniqtab.'-'.$key.'" data-toggle="tab">';
                      if($tab_icon)
                      {
                        $output .= '<i'.$tab_icon.'></i>';
                      }
                      if(($title) && (isset($tab['atts']['show_title']) == 1)){
                        $output .= esc_html($title);
                      }
                    $output .= '</a>';
                  $output .= '</li>';
                }
              $output .= '</ul>';
            $output .= '</div>';
          $output .= '</div>';
        $output .= '<div class="tab-content">';
          foreach ($brando_global_tabs as $key => $tab) {
            $active_content = ( ( $key + 1 ) == $active_tab ) ? ' in active' : '';
            $title  = $tab['atts']['title'];
            $output .= '<div class="tab-pane fade'.$active_content.'" id="brando-'.$tabuniqtab.'-'.$key.'">';
              $output .=  do_shortcode($tab['content']);
            $output .=  '</div>';
          }
        $output .= '</div>';
      $output .= '</div>';
      break;

      case 'tab-style8':
        $output .= '<div class="'.$tabs_style.$class.'"'.$id.'>';
          $output .= '<div class="row">';
            $output .= '<div class="tabs-left col-md-12 col-sm-12 col-xs-12">';
              $output .= '<ul class="nav nav-tabs nav-tabs-light'.$tabs_alignment.'">';
                foreach( $brando_global_tabs as $key => $tab) {
                  $title      =  $tab['atts']['title'];
                  $tab_icon  =  ( (isset($tab['atts']['show_icon']) == 1) && ( !empty($tab['atts']['tab_icon']) ) ) ? ' class="'.$tab['atts']['tab_icon'].'"' : '';
                  $active = ( ( $key + 1 ) == $active_tab ) ? ' class="active"' : '';
                  $output .= '<li '.$active.'>';
                    $output .= '<a href="#brando-'.$tabuniqtab.'-'.$key.'" data-toggle="tab">';
                      if($tab_icon)
                      {
                        $output .= '<i'.$tab_icon.'></i>';
                      }
                      if(($title) && (isset($tab['atts']['show_title']) == 1)){
                        $output .= esc_html($title);
                      }
                    $output .= '</a>';
                  $output .= '</li>';
                }
              $output .= '</ul>';
              $output .= '<div class="tab-content position-relative overflow-hidden">';
                foreach ($brando_global_tabs as $key => $tab) {
                  $active_content = ( ( $key + 1 ) == $active_tab ) ? ' in active' : '';
                  $title  = $tab['atts']['title'];
                  $output .= '<div class="tab-pane fade'.$active_content.'" id="brando-'.$tabuniqtab.'-'.$key.'">';
                    $output .=  do_shortcode($tab['content']);
                  $output .=  '</div>';
                }
              $output .= '</div>';
            $output .= '</div>';
          $output .= '</div>';
        $output .= '</div>';
      break;

      default:
        $output .= '<div class="'.$tabs_style.$class.'"'.$id.'>';
          $output .= '<div class="row">';
            $output .= '<div class="col-md-12 col-sm-12 col-xs-12 xs-margin-five-bottom">';
              $output .= '<ul class="nav nav-tabs nav-tabs-light text-uppercase'.$tabs_alignment.'">';
                foreach( $brando_global_tabs as $key => $tab) {
                  $title      =  $tab['atts']['title'];
                  $tab_icon  =  ( (isset($tab['atts']['show_icon']) == 1) && ( !empty($tab['atts']['tab_icon']) ) ) ? ' class="'.$tab['atts']['tab_icon'].'"' : '';
                  $active = ( ( $key + 1 ) == $active_tab ) ? ' class="active"' : '';
                  $output .= '<li '.$active.'  >';
                    $output .= '<a href="#brando-'.$tabuniqtab.'-'.$key.'" data-toggle="tab">';
                    if($tab_icon)
                    {
                      $output .= '<i'.$tab_icon.'></i>';
                    }
                    if(($title) && (isset($tab['atts']['show_title']) == 1)){
                      $output .= esc_html($title);
                    }
                    $output .= '</a>';
                  $output .= '</li>';
                }
              $output .= '</ul>';
            $output .= '</div>';
          $output .= '</div>';
          $output .= '<div class="tab-content">';
            foreach ($brando_global_tabs as $key => $tab) {
              $active_content = ( ( $key + 1 ) == $active_tab ) ? ' in active' : '';
              $title  = $tab['atts']['title'];
              $output .= '<div class="tab-pane fade'.$active_content.'" id="brando-'.$tabuniqtab.'-'.$key.'">';
                $output .=  do_shortcode($tab['content']);
              $output .=  '</div>';
            }
          $output .= '</div>';
        $output .= '</div>';
      break;
    }
    return $output;
  }
}
add_shortcode( 'vc_tabs', 'brando_tabs' );

if ( ! function_exists( 'brando_tab' ) ) {
  function brando_tab( $atts, $content = null) {
    global $brando_global_tabs;
    $brando_global_tabs[]  = array( 'atts' => $atts, 'content' => $content );
    return;
  }
}
add_shortcode( 'vc_tab', 'brando_tab' );
?>