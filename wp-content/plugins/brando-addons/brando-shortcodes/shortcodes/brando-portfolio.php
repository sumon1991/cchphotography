<?php
/**
 * Shortcode For Portfolio
 *
 * @package Brando
 */
?>
<?php
/*-----------------------------------------------------------------------------------*/
/* Portfolio */
/*-----------------------------------------------------------------------------------*/

if ( ! function_exists( 'brando_portfolio_shortcode' ) ) {
    function brando_portfolio_shortcode( $atts, $content = null ) {
        extract( shortcode_atts( array(
            'id' => '',
            'class' => '',
            'brando_portfolio_style' => '',
            'brando_portfolio_columns' =>'',
            'brando_post_per_page' => '15',
            'orderby' => 'date',
            'order' => 'ASC',
            'brando_categories_list' => '',
            'brando_enable_lightbox' => '',
            'brando_show_separator' => '',
            'brando_sep_color' => '',
            'separator_height' => '',
            'brando_animation_style' => '',
            'padding_setting' => '',
            'desktop_padding' => '',
            'custom_desktop_padding' => '',
            'desktop_mini_padding' => '',
            'ipad_padding' => '',
            'mobile_padding' => '',
            'margin_setting' => '',
            'desktop_margin' => '',
            'custom_desktop_margin' => '',
            'desktop_mini_margin' => '',
            'ipad_margin' => '',
            'mobile_margin' => '',
            'brando_show_button' => '',
            'button_text' => '',
            'brando_title_color' => '',
            'brando_subtitle_color' => '',
            'brando_border_color' => '',
            'brando_show_title' => '',
            'brando_show_subtitle' => '',
            'brando_portfolio_type' => '',
        ), $atts ) );
        $icon = $output = $container_class = $no_padding = $style_attr = $style = $classes = $separator = $portfolio_columns = $filter_style = $portfolio_classes ='';
        $classes = $style_array = array();
        $id = ( $id ) ? ' id="'.$id.'"' : '';
        $class = ( $class ) ? ' '.$class : '';
        $brando_post_per_page = ($brando_post_per_page) ? $brando_post_per_page : '-1';
        $orderby = ($orderby) ? $orderby : '"date"';
        $order = ($order) ? $order : 'ASC';
        $enable_lightbox = ($brando_enable_lightbox == 1) ? 'lightbox-gallery' : '';
        $brando_animation_style = ( $brando_animation_style ) ? $classes[] = 'wow '.$brando_animation_style : '';
        $button_text = ($button_text) ? $button_text : '';
        $brando_portfolio_columns = ($brando_portfolio_columns) ? $brando_portfolio_columns : '';
        $brando_title_color = ($brando_title_color) ? ' style="color:'.$brando_title_color.' !important;"' : '';
        $brando_subtitle_color = ($brando_subtitle_color) ? ' style="color:'.$brando_subtitle_color.' !important;"' : '';
        $brando_border_color = ($brando_border_color) ? ' style="border-color:'.$brando_border_color.' !important;"' : '';
        $brando_show_title = ( $brando_show_title ) ? $brando_show_title : '';
        $brando_show_subtitle = ( $brando_show_subtitle ) ? $brando_show_subtitle : '';
        // no image
        $brando_options = get_option( 'brando_theme_setting' );
        $brando_no_image = (isset($brando_options['brando_no_image']) && !empty($brando_options['brando_no_image'])) ? $brando_options['brando_no_image'] : '';

        $filter_class = $filter_class_style = '';

        $brando_sep_color = ( $brando_sep_color ) ? 'background:'.$brando_sep_color.' !important;': '';
        $separator_height = ( $separator_height ) ? 'height:'.$separator_height.' !important;': '';
        if($brando_sep_color || $separator_height){
            $separator = ' style="'.$brando_sep_color.$separator_height.'"';
        }

        $brando_portfolio_type = ( $brando_portfolio_type ) ? $classes[] = $brando_portfolio_type : '';

        // Column Padding settings
        $padding_setting = ( $padding_setting ) ? $padding_setting : '';
        $desktop_padding = ( $desktop_padding ) ?  $desktop_padding : '';
        $desktop_mini_padding = ( $desktop_mini_padding ) ? $classes[] = $desktop_mini_padding : '';
        $ipad_padding = ( $ipad_padding ) ? $classes[] = $ipad_padding : '';
        $mobile_padding = ( $mobile_padding ) ? $classes[] = $mobile_padding : '';
        $custom_desktop_padding = ( $custom_desktop_padding ) ? $custom_desktop_padding : '';
        if($desktop_padding == ' custom-desktop-padding' && $custom_desktop_padding){
            $style_array[] = "padding: ".$custom_desktop_padding.";";
        }else{
            $classes[] = $desktop_padding;
        }
        
        // Column Margin settings
        $margin_setting = ( $margin_setting ) ? $margin_setting : '';
        $desktop_margin = ( $desktop_margin ) ? $desktop_margin : '';
        $desktop_mini_margin = ( $desktop_mini_margin ) ? $classes[] = $desktop_mini_margin : '';
        $ipad_margin = ( $ipad_margin ) ? $classes[] = $ipad_margin : '';
        $mobile_margin = ( $mobile_margin ) ? $classes[] = $mobile_margin : '';
        $custom_desktop_margin = ( $custom_desktop_margin ) ? $custom_desktop_margin : '';
        if($desktop_margin == ' custom-desktop-margin' && $custom_desktop_margin){
            $style_array[] = "margin: ".$custom_desktop_margin.";";
        }else{
            $classes[] = $desktop_margin;
        }
        

        // Class List
        $class_list = implode(" ", $classes);
        $column_class = ( $class_list ) ? ' class="'.$class_list.'"' : '';

        // Style Property List
        $style_property_list = implode(" ", $style_array);
        
        $categories_to_display_ids = explode(",",$brando_categories_list);
        if ( is_array( $categories_to_display_ids ) && $categories_to_display_ids[0] == '0' ) {
            unset( $categories_to_display_ids[0] );
            $categories_to_display_ids = array_values( $categories_to_display_ids );
        }
        // If no categories are chosen or "All categories", we need to load all available categories
        if ( ! is_array( $categories_to_display_ids ) || count( $categories_to_display_ids ) == 0 ) {
            $terms = get_terms( 'portfolio-category' );
            
            if ( ! is_array( $categories_to_display_ids ) ) {
                $categories_to_display_ids = array();
            }
            foreach ( $terms as $term ) {
                $categories_to_display_ids[] = $term->slug;
            }
        }
        switch ($brando_portfolio_style) {
            case 'portfolio-style-2':
                $portfolio_classes .= ' work-with-title gutter transparent-figcaption';
            break;
        }
        $portfolio_columns = ( $brando_portfolio_columns ) ? 'work-'.$brando_portfolio_columns.'col' : '';
        if($brando_portfolio_columns || $id || $class):
            $output .='<div '.$id.' class="'.$portfolio_columns.$portfolio_classes.$class.'">';
        endif;
        
        $args = array(
            'post_type' => 'portfolio',
            'posts_per_page' => $brando_post_per_page,
            'tax_query' => array(
                array(
                    'taxonomy' => 'portfolio-category',
                    'field' => 'slug',
                    'terms' => $categories_to_display_ids
               ),
            ),
            'orderby' => $orderby,
            'order' => $order,
        );
        $portfolio_posts = new WP_Query( $args );

        switch ($brando_portfolio_style) {
            case 'portfolio-style-1':
                $output .='<div class="grid-gallery grid-style1 overflow-hidden '.$class_list.'"'.$style_property_list.'>';
                    $output .='<div class="tab-content">';
                        $output .='<ul class="masonry-items grid '.$enable_lightbox.'">';
                            
                            while ( $portfolio_posts->have_posts() ) : $portfolio_posts->the_post();
                            /* Image Alt, Title, Caption */
                            $img_alt = brando_option_image_alt(get_post_thumbnail_id());
                            $img_title = brando_option_image_title(get_post_thumbnail_id());
                            $image_alt = ( isset($img_alt['alt']) && !empty($img_alt['alt']) ) ? ' alt="'.$img_alt['alt'].'"' : ' alt=""' ; 
                            $image_title = ( isset($img_title['title']) && !empty($img_title['title']) ) ? ' title="'.$img_title['title'].'"' : '';

                                $cat_slug = '';
                                $cat = get_the_terms( get_the_ID(), 'portfolio-category' );
                                foreach ($cat as $key => $c) {
                                    $cat_slug .= 'portfolio-filter-'.$c->term_id." ";
                                }
                                $output .='<li class="'.$cat_slug.'">';
                                    $output .='<figure>';
                                        $portfolio_subtitle = brando_post_meta('brando_subtitle');
                                        $ajax_popup_class = '';
                                        $link_type = brando_post_meta('brando_enable_ajax_popup');
                                        if( $link_type == 1 ){
                                            $ajax_popup_class .= ' class="simple-ajax-popup-align-top"';
                                        }
                                        $thumb = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'full' );
                                        $url = $thumb['0'];
                                        if($url):
                                            $output .= '<div class="gallery-img">';
                                                if($enable_lightbox == 'lightbox-gallery'):
                                                    $output .= '<a href="'.$url.'" title="'.get_the_title().'" class="lightboxgalleryitem" data-group="general">';
                                                else:
                                                    $output .= '<a href="'.get_permalink().'"'.$ajax_popup_class.'>';
                                                endif;
                                                    $output .= '<img src="'.$url.'" width="'.$thumb[1].'" height="'.$thumb[2].'"'.$image_alt.$image_title.'>';
                                                $output .= '</a>';
                                            $output .= '</div>';
                                        else : 
                                            if( isset($brando_no_image['url']) && !empty($brando_no_image['url']) ){
                                                $output .= '<div class="gallery-img">';
                                                    if($enable_lightbox == 'lightbox-gallery'):
                                                        $output .= '<a href="' . $brando_no_image['url'] . '" width="'.$brando_no_image['width'] .'" height="'.$brando_no_image['height'].'" class="lightboxgalleryitem" data-group="general">';
                                                    else:
                                                        $output .= '<a href="'.get_permalink().'"'.$ajax_popup_class.'>';
                                                    endif;
                                                        $output .= '<img src="' . $brando_no_image['url'] . '" width="'.$brando_no_image['width'] .'" height="'.$brando_no_image['height'].'" alt=""/>';
                                                    $output .= '</a>';
                                                $output .= '</div>';
                                            }
                                        endif;

                                        $output .='<figcaption>';
                                        if($brando_show_title == 1):
                                            $output .='<h3 class="alt-font text-uppercase letter-spacing-2 xs-no-padding-lr"'.$brando_title_color.'>'.get_the_title().'</h3>';
                                        endif;
                                            $output .='<div class="grid-style1-border"'.$brando_border_color.'></div>';
                                        if( $brando_show_subtitle == 1 ):
                                            $output .= '<p'.$brando_subtitle_color.'>'.$portfolio_subtitle.'</p>';
                                        endif;
                                        $output .='</figcaption>';
                                                
                                    $output .='</figure>';
                                $output .='</li>';
                            endwhile;
                            wp_reset_postdata();
                        $output .='</ul>';
                    $output .='</div>';
                $output .='</div>';
            break;

            case 'portfolio-style-2':
                $output .='<div class="grid-gallery grid-style3 overflow-hidden '.$class_list.'"'.$style_property_list.'>';
                    $output .='<div class="tab-content">';
                        $output .='<ul class="masonry-items grid '.$enable_lightbox.'">';
                            
                            while ( $portfolio_posts->have_posts() ) : $portfolio_posts->the_post();
                            /* Image Alt, Title, Caption */
                            $img_alt = brando_option_image_alt(get_post_thumbnail_id());
                            $img_title = brando_option_image_title(get_post_thumbnail_id());
                            $image_alt = ( isset($img_alt['alt']) && !empty($img_alt['alt']) ) ? ' alt="'.$img_alt['alt'].'"' : ' alt=""' ; 
                            $image_title = ( isset($img_title['title']) && !empty($img_title['title']) ) ? ' title="'.$img_title['title'].'"' : '';
                                $cat_slug = '';
                                $cat = get_the_terms( get_the_ID(), 'portfolio-category' );
                                foreach ($cat as $key => $c) {
                                    $cat_slug .= 'portfolio-filter-'.$c->term_id." ";
                                }
                                $output .='<li class="'.$cat_slug.'">';
                                    $output .='<figure>';
                                        $portfolio_subtitle = brando_post_meta('brando_subtitle');
                                        $ajax_popup_class = '';
                                        $link_type = brando_post_meta('brando_enable_ajax_popup');
                                        if( $link_type == 1 ){
                                            $ajax_popup_class .= ' class="simple-ajax-popup-align-top"';
                                        }
                                        $thumb = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'full' );
                                        $url = $thumb['0'];
                                        if($url):
                                            $output .= '<div class="gallery-img">';
                                                if($enable_lightbox == 'lightbox-gallery'):
                                                    $output .= '<a href="'.$url.'" title="'.get_the_title().'" class="lightboxgalleryitem" data-group="general">';
                                                else:
                                                    $output .= '<a href="'.get_permalink().'"'.$ajax_popup_class.'>';
                                                endif;
                                                    $output .= '<img src="'.$url.'" width="'.$thumb[1].'" height="'.$thumb[2].'"'.$image_alt.$image_title.'>';
                                                $output .= '</a>';
                                            $output .= '</div>';
                                        else : 
                                            if( isset($brando_no_image['url']) && !empty($brando_no_image['url']) ){
                                                $output .= '<div class="gallery-img">';
                                                    if($enable_lightbox == 'lightbox-gallery'):
                                                        $output .= '<a href="' . $brando_no_image['url'] . '" width="'.$brando_no_image['width'] .'" height="'.$brando_no_image['height'].'" class="lightboxgalleryitem" data-group="general">';
                                                    else:
                                                        $output .= '<a href="'.get_permalink().'"'.$ajax_popup_class.'>';
                                                    endif;
                                                        $output .= '<img src="' . $brando_no_image['url'] . '" width="'.$brando_no_image['width'] .'" height="'.$brando_no_image['height'].'" alt=""/>';
                                                    $output .= '</a>';
                                                $output .= '</div>';
                                            }
                                        endif;

                                        $output .='<figcaption>';
                                            if( $brando_show_title == 1 ):
                                                $output .='<h3 class="text-large alt-font text-uppercase letter-spacing-2"'.$brando_title_color.'>'.get_the_title().'</h3>';
                                            endif;
                                            if( $brando_show_subtitle == 1 ):
                                                $output .='<span class="text-small alt-font text-uppercase letter-spacing-2 font-weight-100 display-block light-gray-text"'.$brando_subtitle_color.'>'.$portfolio_subtitle.'</span>';
                                            endif;
                                            if($brando_show_button == 1):
                                                $output .= '<div class="explore-now bg-deep-orange text-uppercase alt-font"><a href="'.get_permalink().'" '.$ajax_popup_class.'>'.$button_text.'</a></div>';
                                            endif;
                                        $output .='</figcaption>';
                                    $output .='</figure>';
                                $output .='</li>';
                            endwhile;
                            wp_reset_postdata();
                        $output .='</ul>';
                    $output .='</div>';
                $output .='</div>';
            break;

            case 'portfolio-style-3':
                $output .='<div class="grid-gallery grid-style2 overflow-hidden '.$class_list.'"'.$style_property_list.'>';
                    $output .='<div class="tab-content">';
                        $output .='<ul class="masonry-items grid '.$enable_lightbox.'">';
                            
                            while ( $portfolio_posts->have_posts() ) : $portfolio_posts->the_post();
                                /* Image Alt, Title, Caption */
                                $img_alt = brando_option_image_alt(get_post_thumbnail_id());
                                $img_title = brando_option_image_title(get_post_thumbnail_id());
                                $image_alt = ( isset($img_alt['alt']) && !empty($img_alt['alt']) ) ? ' alt="'.$img_alt['alt'].'"' : ' alt=""' ; 
                                $image_title = ( isset($img_title['title']) && !empty($img_title['title']) ) ? ' title="'.$img_title['title'].'"' : '';

                                $cat_slug = '';
                                $cat = get_the_terms( get_the_ID(), 'portfolio-category' );
                                foreach ($cat as $key => $c) {
                                    $cat_slug .= 'portfolio-filter-'.$c->term_id." ";
                                }
                                $output .='<li class="'.$cat_slug.'">';
                                    $output .='<figure>';
                                        $portfolio_subtitle = brando_post_meta('brando_subtitle');
                                        $ajax_popup_class = '';
                                        $link_type = brando_post_meta('brando_enable_ajax_popup');
                                        if( $link_type == 1 ){
                                            $ajax_popup_class .= ' class="simple-ajax-popup-align-top"';
                                        }
                                        $thumb = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'full' );
                                        $url = $thumb['0'];
                                        if($url):
                                            $output .= '<div class="gallery-img">';
                                                if($enable_lightbox == 'lightbox-gallery'):
                                                    $output .= '<a href="'.$url.'" title="'.get_the_title().'" class="lightboxgalleryitem" data-group="general">';
                                                else:
                                                    $output .= '<a href="'.get_permalink().'"'.$ajax_popup_class.'>';
                                                endif;
                                                    $output .= '<img src="'.$url.'" width="'.$thumb[1].'" height="'.$thumb[2].'"'.$image_alt.$image_title.'>';
                                                $output .= '</a>';
                                            $output .= '</div>';
                                        else : 
                                            if( isset($brando_no_image['url']) && !empty($brando_no_image['url']) ){
                                                $output .= '<div class="gallery-img">';
                                                    if($enable_lightbox == 'lightbox-gallery'):
                                                        $output .= '<a href="' . $brando_no_image['url'] . '" width="'.$brando_no_image['width'] .'" height="'.$brando_no_image['height'].'" class="lightboxgalleryitem" data-group="general">';
                                                    else:
                                                        $output .= '<a href="'.get_permalink().'"'.$ajax_popup_class.'>';
                                                    endif;
                                                        $output .= '<img src="' . $brando_no_image['url'] . '" width="'.$brando_no_image['width'] .'" height="'.$brando_no_image['height'].'" alt=""/>';
                                                    $output .= '</a>';
                                                $output .= '</div>';
                                            }
                                        endif;

                                        $output .='<figcaption>';
                                            if( $brando_show_title == 1 ):
                                                $output .='<h3 class="text-large alt-font text-uppercase letter-spacing-2"'.$brando_title_color.'>'.get_the_title().'</h3>';
                                            endif;
                                            if( $brando_show_subtitle == 1 ):
                                                $output .='<span class="text-small alt-font text-uppercase letter-spacing-2 font-weight-100"'.$brando_subtitle_color.'>'.$portfolio_subtitle.'</span>';
                                            endif;
                                        $output .='</figcaption>';
                                    $output .='</figure>';
                                $output .='</li>';
                            endwhile;
                            wp_reset_postdata();
                        $output .='</ul>';
                    $output .='</div>';
                $output .='</div>';
            break;

            case 'portfolio-style-4':
                $output .='<div class="grid-gallery grid-style4 overflow-hidden '.$class_list.'"'.$style_property_list.'>';
                    $output .='<div class="tab-content">';
                        $output .='<ul class="masonry-items grid '.$enable_lightbox.'">';
                            
                            while ( $portfolio_posts->have_posts() ) : $portfolio_posts->the_post();
                                /* Image Alt, Title, Caption */
                                $img_alt = brando_option_image_alt(get_post_thumbnail_id());
                                $img_title = brando_option_image_title(get_post_thumbnail_id());
                                $image_alt = ( isset($img_alt['alt']) && !empty($img_alt['alt']) ) ? ' alt="'.$img_alt['alt'].'"' : ' alt=""' ; 
                                $image_title = ( isset($img_title['title']) && !empty($img_title['title']) ) ? ' title="'.$img_title['title'].'"' : '';

                                $cat_slug = '';
                                $cat = get_the_terms( get_the_ID(), 'portfolio-category' );
                                foreach ($cat as $key => $c) {
                                    $cat_slug .= 'portfolio-filter-'.$c->term_id." ";
                                }
                                $output .='<li class="'.$cat_slug.'">';
                                    $output .='<figure class="overflow-hidden">';
                                        $portfolio_subtitle = brando_post_meta('brando_subtitle');
                                        $ajax_popup_class = '';
                                        $link_type = brando_post_meta('brando_enable_ajax_popup');
                                        if( $link_type == 1 ){
                                            $ajax_popup_class .= ' class="simple-ajax-popup-align-top"';
                                        }
                                        $thumb = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'full' );
                                        $url = $thumb['0'];
                                        if($url):
                                            $output .= '<div class="gallery-img bg-fast-blue-green-gradiant">';
                                                if($enable_lightbox == 'lightbox-gallery'):
                                                    $output .= '<a href="'.$url.'" title="'.get_the_title().'" class="lightboxgalleryitem" data-group="general">';
                                                else:
                                                    $output .= '<a href="'.get_permalink().'"'.$ajax_popup_class.'>';
                                                endif;
                                                    $output .= '<img src="'.$url.'" width="'.$thumb[1].'" height="'.$thumb[2].'"'.$image_alt.$image_title.'>';
                                                $output .= '</a>';
                                            $output .= '</div>';
                                        else : 
                                            if( isset($brando_no_image['url']) && !empty($brando_no_image['url']) ){
                                                $output .= '<div class="gallery-img">';
                                                    if($enable_lightbox == 'lightbox-gallery'):
                                                        $output .= '<a href="' . $brando_no_image['url'] . '" width="'.$brando_no_image['width'] .'" height="'.$brando_no_image['height'].'" class="lightboxgalleryitem" data-group="general">';
                                                    else:
                                                        $output .= '<a href="'.get_permalink().'"'.$ajax_popup_class.'>';
                                                    endif;
                                                        $output .= '<img src="' . $brando_no_image['url'] . '" width="'.$brando_no_image['width'] .'" height="'.$brando_no_image['height'].'" alt=""/>';
                                                    $output .= '</a>';
                                                $output .= '</div>';
                                            }
                                        endif;

                                         $output .='<figcaption>';
                                            if( $brando_show_title == 1 ):
                                                $output .='<h3 class="alt-font text-uppercase letter-spacing-2"'.$brando_title_color.'>'.get_the_title().'</h3>';
                                            endif;
                                            if( $brando_show_subtitle == 1 ):
                                                $output .='<p'.$brando_subtitle_color.'>'.$portfolio_subtitle.'</p>';
                                            endif;
                                        $output .='</figcaption>';      
                                    $output .='</figure>';
                                $output .='</li>';
                            endwhile;
                            wp_reset_postdata();
                        $output .='</ul>';
                    $output .='</div>';
                $output .='</div>';
            break;

            case 'portfolio-style-5':
                $output .='<div class="'.$class_list.'"'.$style_property_list.'>';
                    $output .='<div class="grid-gallery grid-style1 overflow-hidden">';
                        $output .='<div class="tab-content">';
                            $output .='<ul class="masonry-items grid '.$enable_lightbox.'">';
                                
                                while ( $portfolio_posts->have_posts() ) : $portfolio_posts->the_post();
                                    /* Image Alt, Title, Caption */
                                    $img_alt = brando_option_image_alt(get_post_thumbnail_id());
                                    $img_title = brando_option_image_title(get_post_thumbnail_id());
                                    $image_alt = ( isset($img_alt['alt']) && !empty($img_alt['alt']) ) ? ' alt="'.$img_alt['alt'].'"' : ' alt=""'; 
                                    $image_title = ( isset($img_title['title']) && !empty($img_title['title']) ) ? ' title="'.$img_title['title'].'"' : '';

                                    $cat_slug = '';
                                    $cat = get_the_terms( get_the_ID(), 'portfolio-category' );
                                    foreach ($cat as $key => $c) {
                                        $cat_slug .= 'portfolio-filter-'.$c->term_id." ";
                                    }
                                    $output .='<li class="'.$cat_slug.'">';
                                        $output .='<figure>';
                                            $portfolio_subtitle = brando_post_meta('brando_subtitle');
                                            $ajax_popup_class = '';
                                            $link_type = brando_post_meta('brando_enable_ajax_popup');
                                            if( $link_type == 1 ){
                                                $ajax_popup_class .= ' class="simple-ajax-popup-align-top"';
                                            }
                                            $thumb = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'full' );
                                            $url = $thumb['0'];
                                            if($url):
                                                $output .= '<div class="gallery-img">';
                                                    if($enable_lightbox == 'lightbox-gallery'):
                                                        $output .= '<a href="'.$url.'" title="'.get_the_title().'" class="lightboxgalleryitem" data-group="general">';
                                                    else:
                                                        $output .= '<a href="'.get_permalink().'"'.$ajax_popup_class.'>';
                                                    endif;
                                                        $output .= '<img src="'.$url.'" width="'.$thumb[1].'" height="'.$thumb[2].'"'.$image_alt.$image_title.'>';
                                                    $output .= '</a>';
                                                $output .= '</div>';
                                            else : 
                                                if( isset($brando_no_image['url']) && !empty($brando_no_image['url']) ){
                                                    $output .= '<div class="gallery-img">';
                                                        if($enable_lightbox == 'lightbox-gallery'):
                                                            $output .= '<a href="' . $brando_no_image['url'] . '" width="'.$brando_no_image['width'] .'" height="'.$brando_no_image['height'].'" class="lightboxgalleryitem" data-group="general">';
                                                        else:
                                                            $output .= '<a href="'.get_permalink().'"'.$ajax_popup_class.'>';
                                                        endif;
                                                            $output .= '<img src="' . $brando_no_image['url'] . '" width="'.$brando_no_image['width'] .'" height="'.$brando_no_image['height'].'" alt=""/>';
                                                        $output .= '</a>';
                                                    $output .= '</div>';
                                                }
                                            endif;

                                            $output .='<figcaption>';
                                                if( $brando_show_title == 1 || $brando_show_subtitle == 1):
                                                    $output .= '<h3 class="text-large alt-font xs-margin-two xs-no-margin-lr text-uppercase letter-spacing-2 md-no-padding sm-no-padding"'.$brando_title_color.'>'.get_the_title().'';
                                                    if( $brando_show_subtitle == 1 ):
                                                        $output .= '<span class="text-small gray-text alt-font text-uppercase letter-spacing-2 display-block"'.$brando_subtitle_color.'>'.$portfolio_subtitle.'</span>';
                                                    endif;
                                                $output .= '</h3>';
                                                endif;
                                            $output .='</figcaption>'; 
                                        $output .='</figure>';
                                    $output .='</li>';
                                endwhile;
                                wp_reset_postdata();
                            $output .='</ul>';
                        $output .='</div>';
                    $output .='</div>';
                $output .='</div>';
            break;

            case 'portfolio-style-6':
                $output .='<div class="grid-gallery grid-style5 overflow-hidden '.$class_list.'"'.$style_property_list.'>';
                    $output .='<div class="tab-content">';
                        $output .='<ul class="masonry-items grid '.$enable_lightbox.'">';
                            
                            while ( $portfolio_posts->have_posts() ) : $portfolio_posts->the_post();
                                /* Image Alt, Title, Caption */
                                $img_alt = brando_option_image_alt(get_post_thumbnail_id());
                                $img_title = brando_option_image_title(get_post_thumbnail_id());
                                $image_alt = ( isset($img_alt['alt']) && !empty($img_alt['alt']) ) ? ' alt="'.$img_alt['alt'].'"' : ' alt=""' ; 
                                $image_title = ( isset($img_title['title']) && !empty($img_title['title']) ) ? ' title="'.$img_title['title'].'"' : '';

                                $cat_slug = '';
                                $cat = get_the_terms( get_the_ID(), 'portfolio-category' );
                                foreach ($cat as $key => $c) {
                                    $cat_slug .= 'portfolio-filter-'.$c->term_id." ";
                                }
                                $output .='<li class="'.$cat_slug.'">';
                                    $output .='<figure>';
                                        $portfolio_subtitle = brando_post_meta('brando_subtitle');
                                        $ajax_popup_class = '';
                                        $link_type = brando_post_meta('brando_enable_ajax_popup');
                                        if( $link_type == 1 ){
                                            $ajax_popup_class .= ' class="simple-ajax-popup-align-top"';
                                        }
                                        $thumb = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'full' );
                                        $url = $thumb['0'];
                                        if($url):
                                            $output .= '<div class="gallery-img">';
                                                if($enable_lightbox == 'lightbox-gallery'):
                                                    $output .= '<a href="'.$url.'" title="'.get_the_title().'" class="lightboxgalleryitem" data-group="general">';
                                                else:
                                                    $output .= '<a href="'.get_permalink().'"'.$ajax_popup_class.'>';
                                                endif;
                                                    $output .= '<img src="'.$url.'" width="'.$thumb[1].'" height="'.$thumb[2].'"'.$image_alt.$image_title.'>';
                                                $output .= '</a>';
                                            $output .= '</div>';
                                        else : 
                                            if( isset($brando_no_image['url']) && !empty($brando_no_image['url']) ){
                                                $output .= '<div class="gallery-img">';
                                                    if($enable_lightbox == 'lightbox-gallery'):
                                                        $output .= '<a href="' . $brando_no_image['url'] . '" width="'.$brando_no_image['width'] .'" height="'.$brando_no_image['height'].'" class="lightboxgalleryitem" data-group="general">';
                                                    else:
                                                        $output .= '<a href="'.get_permalink().'"'.$ajax_popup_class.'>';
                                                    endif;
                                                        $output .= '<img src="' . $brando_no_image['url'] . '" width="'.$brando_no_image['width'] .'" height="'.$brando_no_image['height'].'" alt=""/>';
                                                    $output .= '</a>';
                                                $output .= '</div>';
                                            }
                                        endif;

                                        $output .='<figcaption>';
                                            if( $brando_show_separator == 1 ){
                                                $output .='<div class="separator-line-thick margin-lr-auto bg-crimson-red no-margin-bottom"'.$separator.'></div>';
                                            }
                                            if( $brando_show_title == 1 ){
                                                $output .='<h3 class="alt-font text-uppercase letter-spacing-2 white-text"'.$brando_title_color.'>'.get_the_title().'</h3>';
                                            }
                                            if( $brando_show_subtitle == 1 ){
                                                $output .='<span class="text-small alt-font text-uppercase light-gray-text"'.$brando_subtitle_color.'>'.$portfolio_subtitle.'</span>';
                                            }
                                        $output .='</figcaption>';
                                    $output .='</figure>';
                                $output .='</li>';
                            endwhile;
                            wp_reset_postdata();
                        $output .='</ul>';
                    $output .='</div>';
                $output .='</div>';
            break;

            case 'portfolio-style-7':
                $output .='<div class="grid-gallery grid-style6 overflow-hidden '.$class_list.'"'.$style_property_list.'>';
                    $output .='<div class="tab-content">';
                        $output .='<ul class="masonry-items grid '.$enable_lightbox.'">';
                            
                            while ( $portfolio_posts->have_posts() ) : $portfolio_posts->the_post();
                                /* Image Alt, Title, Caption */
                                $img_alt = brando_option_image_alt(get_post_thumbnail_id());
                                $img_title = brando_option_image_title(get_post_thumbnail_id());
                                $image_alt = ( isset($img_alt['alt']) && !empty($img_alt['alt']) ) ? ' alt="'.$img_alt['alt'].'"' : ' alt=""' ;
                                $image_title = ( isset($img_title['title']) && !empty($img_title['title']) ) ? ' title="'.$img_title['title'].'"' : '';
                                $cat_slug = '';
                                $cat = get_the_terms( get_the_ID(), 'portfolio-category' );
                                foreach ($cat as $key => $c) {
                                    $cat_slug .= 'portfolio-filter-'.$c->term_id." ";
                                }
                                $output .='<li class="'.$cat_slug.'">';
                                    $output .='<figure class="overflow-hidden">';
                                        $portfolio_subtitle = brando_post_meta('brando_subtitle');
                                        $ajax_popup_class = '';
                                        $link_type = brando_post_meta('brando_enable_ajax_popup');
                                        if( $link_type == 1 ){
                                            $ajax_popup_class .= ' class="simple-ajax-popup-align-top"';
                                        }
                                        $thumb = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'full' );
                                        $url = $thumb['0'];
                                        if($url):
                                            $output .= '<div class="gallery-img bg-dark-gray">';
                                                if($enable_lightbox == 'lightbox-gallery'):
                                                    $output .= '<a href="'.$url.'" title="'.get_the_title().'" class="lightboxgalleryitem" data-group="general">';
                                                else:
                                                    $output .= '<a href="'.get_permalink().'"'.$ajax_popup_class.'>';
                                                endif;
                                                    $output .= '<img src="'.$url.'" width="'.$thumb[1].'" height="'.$thumb[2].'"'.$image_alt.$image_title.'>';
                                                $output .= '</a>';
                                            $output .= '</div>';
                                        else : 
                                            if( isset($brando_no_image['url']) && !empty($brando_no_image['url']) ){
                                                $output .= '<div class="gallery-img bg-dark-gray">';
                                                    if($enable_lightbox == 'lightbox-gallery'):
                                                        $output .= '<a href="' . $brando_no_image['url'] . '" width="'.$brando_no_image['width'] .'" height="'.$brando_no_image['height'].'" class="lightboxgalleryitem" data-group="general">';
                                                    else:
                                                        $output .= '<a href="'.get_permalink().'"'.$ajax_popup_class.'>';
                                                    endif;
                                                        $output .= '<img src="' . $brando_no_image['url'] . '" width="'.$brando_no_image['width'] .'" height="'.$brando_no_image['height'].'" alt=""/>';
                                                    $output .= '</a>';
                                                $output .= '</div>';
                                            }
                                        endif;

                                        $output .='<figcaption>';
                                            if( $brando_show_title == 1 ){
                                                $output .='<h3 class="alt-font text-uppercase letter-spacing-2 width-80 margin-lr-auto"'.$brando_title_color.'>'.get_the_title().'</h3>';
                                            }
                                        $output .='</figcaption>';
                                    $output .='</figure>';
                                $output .='</li>';
                            endwhile;
                            wp_reset_postdata();
                        $output .='</ul>';
                    $output .='</div>';
                $output .='</div>';
            break;
        }
        if($brando_portfolio_columns || $id || $class):
            $output .='</div>';
        endif;
                                
        return $output;
    }
}
add_shortcode( 'brando_portfolio', 'brando_portfolio_shortcode' );
?>