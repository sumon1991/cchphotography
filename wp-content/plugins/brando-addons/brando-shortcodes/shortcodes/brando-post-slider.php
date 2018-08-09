<?php
/**
 * Shortcode For Blog Post Slider
 *
 * @package Brando
 */
?>
<?php
/*-----------------------------------------------------------------------------------*/
/* Blog Post Slider */
/*-----------------------------------------------------------------------------------*/

if ( ! function_exists( 'brando_post_slider' ) ) {
    function brando_post_slider( $atts, $content = null ) {
        extract( shortcode_atts( array(
            'brando_post_slider_style' => '',
            'brando_post_slider_id' => '',
            'brando_post_slider_class' => '',
            'brando_categories_list' => '',
            'brando_show_post_number' => '',
            'brando_show_post_title' => '',
            'brando_show_post_meta' => '',
            'brando_show_excerpt' => '',
            'brando_excerpt_length' => '15',
            'brando_show_post_date' => '',
            'brando_date_format' => 'd m Y',
            'brando_post_per_page' => '3',
            'brando_post_per_page_desktop' => '',
            'brando_post_per_page_desktop_mini' => '',
            'brando_post_per_page_ipad' => '',
            'brando_post_per_page_mobile' => '',
            'show_pagination' => '',
            'show_pagination_style' => '',
            'show_pagination_color_style' => '',
            'show_navigation' => '',
            'show_navigation_style' => '',
            'show_cursor_color_style' => '',
            'autoplay' => '3000',
            'stoponhover' => '',
            'slidespeed' => '',
            'orderby' => '',
            'order' => '',
            'brando_show_separator' => '',
            'brando_sep_color' => '',
            'brando_seperator_height' => '2px',
        ), $atts ) );

        $output = $slider_config = '';
        $style_array = array();
        $orderby = ( $orderby ) ? $orderby : 'date';
        $order = ( $order ) ? $order : 'DESC';
        $brando_date_format = ( $brando_date_format ) ? $brando_date_format : 'd m Y';
        $brando_sep_color = ( $brando_sep_color ) ? $style_array[] = 'background:'.$brando_sep_color.' !important;' : '';
        $brando_seperator_height = ( $brando_seperator_height ) ? $style_array[] = 'height:'.$brando_seperator_height.' !important;' : '';
        $brando_categories_list = ( $brando_categories_list ) ? $brando_categories_list : '';
        $pagination = ($show_pagination_style) ? brando_owl_pagination_slider_classes($show_pagination_style) : brando_owl_pagination_slider_classes('default');
        $pagination_style = ($show_pagination_color_style) ? brando_owl_pagination_color_classes($show_pagination_color_style) : brando_owl_pagination_color_classes('default');
        $navigation = ( $show_navigation_style ) ? brando_owl_navigation_slider_classes( $show_navigation_style) : brando_owl_navigation_slider_classes('default') ;
        $show_cursor_color_style = ( $show_cursor_color_style ) ? ' '.$show_cursor_color_style : ' cursor-black';
        $autoplay = ( $autoplay ) ? $autoplay : '';
        $brando_post_per_page = ( $brando_post_per_page ) ? $brando_post_per_page : '-1';
        $brando_post_per_page_desktop = ( $brando_post_per_page_desktop ) ? $brando_post_per_page_desktop : '3';
        $brando_post_per_page_desktop_mini = ( $brando_post_per_page_desktop_mini ) ? $brando_post_per_page_desktop_mini : '3';
        $brando_post_per_page_ipad = ( $brando_post_per_page_ipad ) ? $brando_post_per_page_ipad : '2';
        $brando_post_per_page_mobile = ( $brando_post_per_page_mobile ) ? $brando_post_per_page_mobile : '1';
        $post_author = get_post_field( 'post_author', get_the_ID() );
        $brando_post_slider_id = ( $brando_post_slider_id ) ? $brando_post_slider_id : $brando_post_slider_style;
        $brando_post_slider_class = ( $brando_post_slider_class ) ? ' '.$brando_post_slider_class : '';

        $style_property_list = implode(" ", $style_array);
        $sep_style = ( $style_property_list ) ? ' style="'.$style_property_list.'"' : '';

        $args = array('post_type' => 'post',
                   'posts_per_page' => $brando_post_per_page,
                   'category_name' => $brando_categories_list,
                   'orderby' => $orderby,
                   'order' => $order,
                   );
        $brando_post_slider = new WP_Query( $args );
        $i = 1;
        $output .='<div id="'.$brando_post_slider_id.'" class="blog-post-style3 blog-slider owl-carousel bottom-pagination owl-theme '.$brando_post_slider_id.$brando_post_slider_class.$navigation.$pagination.$pagination_style.$show_cursor_color_style.'">';
            while ( $brando_post_slider->have_posts() ) : $brando_post_slider->the_post();

                $popup_id = 'blog-'.get_the_ID();
                /* Image Alt, Title, Caption */
                $img_alt = brando_option_image_alt(get_post_thumbnail_id());
                $img_title = brando_option_image_title(get_post_thumbnail_id());
                $image_alt = ( isset($img_alt['alt']) ) ? $img_alt['alt'] : '' ; 
                $image_title = ( isset($img_title['title']) ) ? $img_title['title'] : '';

                $img_attr = array(
                    'title' => $image_title,
                    'alt' => $image_alt,
                );
                $post_format = get_post_format( get_the_ID() );
                switch ( $brando_post_slider_style ) {
                    case 'post-slider-1':
                        if($i < 10){
                            $i = '0'.$i.'.';
                        }else{
                            $i = $i.'.';
                        }
                        $show_excerpt = ( $brando_show_excerpt == 1 ) ? wpautop(brando_get_the_excerpt_theme($brando_excerpt_length)) : wpautop(brando_get_the_excerpt_theme(15));
                        $output .='<article class="item col-md-12 no-padding">';
                            $output .='<div class="col-md-12 col-sm-12">';
                                $output .='<div class="post-thumbnail overflow-hidden position-relative bg-dark-blue">';
                                    if($post_format == 'image'){
                                        ob_start();
                                            $output .= get_template_part('loop/loop','image');
                                            $output .= ob_get_contents();  
                                        ob_end_clean();  
                                    }elseif($post_format == 'gallery'){
                                        ob_start();
                                            $output .= get_template_part('loop/loop','gallery');
                                            $output .= ob_get_contents();  
                                        ob_end_clean();  
                                    }elseif($post_format == 'video'){
                                        ob_start();
                                            $output .= get_template_part('loop/loop','video');
                                            $output .= ob_get_contents();  
                                        ob_end_clean();  
                                    }elseif($post_format == 'quote'){
                                        ob_start();
                                            $output .= get_template_part('loop/loop','quote');
                                            $output .= ob_get_contents();  
                                        ob_end_clean();  
                                    }else{
                                        $output .=  '<div class="blog-image"><a href="'.get_permalink().'">';
                                            if ( has_post_thumbnail() ) {
                                                $output .= get_the_post_thumbnail( get_the_ID(), 'full',$img_attr );
                                            }
                                        $output .=  '</a></div>';
                                    }
                                    if( $brando_show_post_date == 1 ){
                                        $output .='<span class="post-date text-small text-uppercase letter-spacing-2 alt-font light-gray-text position-absolute bg-dark-blue">'.get_the_date($brando_date_format).'</span>';
                                    }
                                $output .='</div>';
                                $output .='<div class="post-details display-inline-block text-left">';
                                    if( $brando_show_post_number == 1 ){
                                        $output .='<div class="col-md-2 col-sm-2 no-padding">';
                                            $output .='<span class="title-extra-large deep-orange-text md-title-large alt-font display-block sm-display-none">'.$i.'</span>';
                                        $output .='</div>';
                                    }
                                    $output .='<div class="col-md-10 col-sm-12 no-padding">';
                                        if( $brando_show_post_title == 1 ){
                                            $output .='<span class="text-large text-uppercase md-text-medium display-block alt-font"><a href="'.get_permalink().'" class="light-gray-text">'.get_the_title().'</a></span>';
                                        }
                                        if( $brando_show_post_meta == 1 ){
                                            $output .='<span class="text-extra-small text-uppercase display-block alt-font medium-gray-text margin-one-top">'.__('Posted by ','brando-addons').'<a href="'.esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ).'" class="medium-gray-text">'.get_the_author_meta( 'user_nicename', $post_author).'</a></span>';
                                        }
                                        if( $brando_show_excerpt == 1 ){
                                            $output .='<div class="text-medium display-block no-margin-lr margin-five width-80">'.$show_excerpt.'</div>';
                                        }
                                    $output .='</div>';
                                $output .='</div>';
                            $output .='</div>';
                        $output .='</article>';
                    break;
                    case 'post-slider-2':
                        if($i < 10){
                            $i = '0'.$i;
                        }
                        $show_excerpt = ( $brando_show_excerpt == 1 ) ? wpautop(brando_get_the_excerpt_theme($brando_excerpt_length)) : wpautop(brando_get_the_excerpt_theme(15));
                        $output .='<article class="item col-md-12 no-padding">';
                            $output .='<div class="col-md-12 col-sm-12">';
                                $output .='<div class="post-thumbnail overflow-hidden position-relative bg-dark-blue">';
                                    if($post_format == 'image'){
                                        ob_start();
                                            $output .= get_template_part('loop/loop','image');
                                            $output .= ob_get_contents();  
                                        ob_end_clean();  
                                    }elseif($post_format == 'gallery'){
                                        ob_start();
                                            $output .= get_template_part('loop/loop','gallery');
                                            $output .= ob_get_contents();  
                                        ob_end_clean();  
                                    }elseif($post_format == 'video'){
                                        ob_start();
                                            $output .= get_template_part('loop/loop','video');
                                            $output .= ob_get_contents();  
                                        ob_end_clean();  
                                    }elseif($post_format == 'quote'){
                                        ob_start();
                                            $output .= get_template_part('loop/loop','quote');
                                            $output .= ob_get_contents();  
                                        ob_end_clean();  
                                    }else{
                                        $output .=  '<div class="blog-image"><a href="'.get_permalink().'">';
                                            if ( has_post_thumbnail() ) {
                                                $output .= get_the_post_thumbnail( get_the_ID(), 'full',$img_attr );
                                            }
                                        $output .=  '</a></div>';
                                    }
                                    if( $brando_show_post_date == 1 ){
                                        $output .='<span class="post-date text-mediaum text-uppercase letter-spacing-1 alt-font font-weight-600 position-absolute bg-light-gray">'.get_the_date($brando_date_format).'</span>';
                                    }
                                $output .='</div>';
                                $output .='<div class="post-details display-inline-block text-left">';
                                    if( $brando_show_post_number == 1 ){
                                        $output .='<div class="col-md-2 col-sm-2 no-padding">';
                                            $output .='<span class="title-extra-large deep-orange-text alt-font deep-pink-dark-text display-block sm-display-none font-weight-600">'.$i.'</span>';
                                        $output .='</div>';
                                    }
                                    $output .='<div class="col-md-10 col-sm-12 no-padding">';
                                        if( $brando_show_post_title == 1 ){
                                            $output .='<span class="text-large font-weight-600 text-uppercase display-block alt-font">'.get_the_title().'</span>';
                                        }
                                        if( $brando_show_post_meta == 1 ){
                                            $output .='<span class="text-extra-small text-uppercase display-block alt-font medium-gray-text margin-one-half no-margin-lr no-margin-bottom">'.__('Posted by ','brando-addons').'<a href="'.esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ).'" class="medium-gray-text">'.get_the_author_meta( 'user_nicename', $post_author).'</a></span>';
                                        }
                                        if( $brando_show_excerpt == 1 ){
                                            $output .='<div class="text-medium display-block margin-three-tb width-80">'.$show_excerpt.'</div>';
                                        }
                                        if( $brando_show_separator == 1 ){
                                            $output .= '<div class="separator-line-thick bg-turquoise-blue no-margin-lr no-margin-bottom"'.$sep_style.'></div>';
                                        }
                                    $output .='</div>';
                                $output .='</div>';
                            $output .='</div>';
                        $output .='</article>';
                    break;
                }
            $i++;    
            endwhile;
            wp_reset_postdata();
        $output .='</div>';

        /* Add custom script Start*/
        $slidespeed = ( $slidespeed ) ? $slidespeed : '3000';
        ( $show_navigation == 1 ) ? $slider_config .= 'navigation: true,' : $slider_config .= 'navigation: false,';
        ( $show_pagination == 1 ) ? $slider_config .= 'pagination: true,' : $slider_config .= 'pagination: false,';
        ( $autoplay == 1 ) ? $slider_config .= 'autoPlay: '.$slidespeed.',' : $slider_config .= 'autoPlay: false,';
        ( $stoponhover == 1) ? $slider_config .= 'stopOnHover: true, ' : $slider_config .= 'stopOnHover: false, ';
        $slider_config .= 'items: '.$brando_post_per_page_desktop.',';
        $slider_config .= 'itemsDesktop: [1200, '.$brando_post_per_page_desktop.'],';
        $slider_config .= 'itemsDesktopSmall: [1199, '.$brando_post_per_page_desktop_mini.'],';
        $slider_config .= 'itemsTablet: [800, '.$brando_post_per_page_ipad.'],';
        $slider_config .= 'itemsMobile: [700, '.$brando_post_per_page_mobile.'],';
        $slider_config .= 'navigationText: ["<i class=\'fa fa-angle-left\'></i>", "<i class=\'fa fa-angle-right\'></i>"]';
        ob_start();?>
            <script type="text/javascript">jQuery(document).ready(function () { jQuery("<?php echo '.'.$brando_post_slider_id;?>").owlCarousel({ <?php echo $slider_config;?> }); }); </script>

        <?php 
        $script = ob_get_contents();
        ob_end_clean();
        $output .= $script;
        /* Add custom script End*/
        return $output;
    }
}
add_shortcode( 'brando_post_slider', 'brando_post_slider' );
?>