<?php
/**
 * Shortcode For Feature Box
 *
 * @package Brando
 */
?>
<?php
/*-----------------------------------------------------------------------------------*/
/* Feature Box */
/*-----------------------------------------------------------------------------------*/
$breadcrumb_text = NULL;
if ( ! function_exists( 'brando_feature_box_shortcode' ) ) {
    function brando_feature_box_shortcode( $atts, $content = null ) {
        extract( shortcode_atts( array(
            'brando_feature_type' => '',
            'brando_et_line_icon_list' =>'',
            'brando_feature_title' => '',
            'brando_feature_subtitle' => '',
            'brando_price' => '',
            'brando_feature_image' => '',
            'brando_posts_list' => '',
            'brando_number' => '',
            'counter_icon_size' => '',
            'brando_border_transperent' =>'',
            'brando_show_border'=>'',
            'brando_title_color' => '',
            'brando_event_date' => '',
            'brando_event_time' => '',
            'brando_back_hover_color' => '',
            'brando_icon_color' => '',
            'brando_feature_icon' => '',
            'brando_border_color' =>'',
            'padding_setting' => '',
            'desktop_padding' => '',
            'custom_desktop_padding' => '',
            'ipad_padding' => '',
            'mobile_padding' => '',
            'margin_setting' => '',
            'desktop_margin' => '',
            'custom_desktop_margin' => '',
            'ipad_margin' => '',
            'mobile_margin' => '',
            'brando_enable_seperator' =>'',
            'brando_excerpt_length' => '15',
            'brando_team_member_title' => '',
            'brando_team_member_designation' => '',
            'brando_team_member_fb' => '',
            'brando_team_member_fb_url' => '',
            'brando_team_member_tw' => '',
            'brando_team_member_tw_url' => '',
            'brando_team_member_googleplus' => '',
            'brando_team_member_googleplus_url' => '',
            'brando_designation_color' => '',
            'brando_image_pos' => '',
            'brando_price_color' => '',
            'brando_price_bg_color' => '',
            'brando_title_bg_color' => '',
            'brando_button_text' => '',
            'brando_post_date_color' => '',
            'brando_author_color' => '',
            'with_gray_border' => '',
            'brando_sep_color' => '',
            'brando_seperator_height' => '',
        ), $atts ) );

        $output = $btn_class = $padding = $padding_style = $margin = $margin_style = $style_attr = $style = $sep_style = '';
        $classes = array();

        if ( (function_exists('vc_parse_multi_attribute') && $brando_button_text)) {
            //First button
            $button_parse_args = vc_parse_multi_attribute($brando_button_text);
            $button_link     = ( isset($button_parse_args['url']) ) ? $button_parse_args['url'] : '#';
            $button_title    = ( isset($button_parse_args['title']) ) ? $button_parse_args['title'] : 'sample button';
            $button_target   = ( isset($button_parse_args['target']) ) ? trim($button_parse_args['target']) : '_self';
        }
        
        $brando_image_position = ( $brando_image_pos == 1 ) ? 'pull-left' : 'pull-right';
        $content_pos = ( $brando_image_pos == 1 ) ? 'position-right' : 'position-left';
        $icon_size = ( $counter_icon_size ) ? ' '.$counter_icon_size : ' medium-icon';
        $brando_title_color = ( $brando_title_color ) ?  ' style="color:'.$brando_title_color.'!important;"' : '';
        $brando_designation_color = ( $brando_designation_color ) ? ' style="color: '.$brando_designation_color.' !important;"' : '';
        $thumb = wp_get_attachment_image_src($brando_feature_image, 'full');
        /* Image Alt, Title, Caption */
        $img_alt = brando_option_image_alt($brando_feature_image);
        $img_title = brando_option_image_title($brando_feature_image);
        $image_alt = ( isset($img_alt['alt']) && !empty($img_alt['alt']) ) ? 'alt="'.$img_alt['alt'].'"' : 'alt=""' ;
        $image_title = ( isset($img_title['title']) && !empty($img_title['title']) ) ? ' title="'.$img_title['title'].'"' : '';

        
        $brando_icon_color = ( $brando_icon_color ) ? ' style="color:'.$brando_icon_color.';"' : '';
        $brando_price_color = ( $brando_price_color ) ? ' style="color:'.$brando_price_color.' !important;"' : '';
        $brando_price_bg_color = ( $brando_price_bg_color ) ? ' style="background:'.$brando_price_bg_color.' !important;"' : '';
        $brando_title_bg_color = ( $brando_title_bg_color ) ? ' style="background:'.$brando_title_bg_color.' !important;"' : '';

        $brando_post_date_color = ( $brando_post_date_color ) ? ' style="color:'.$brando_post_date_color.' !important;"' : '';
        $brando_author_color = ( $brando_author_color ) ? ' style="color:'.$brando_author_color.' !important;"' : '';

        $brando_sep_color = ( $brando_sep_color ) ? 'background:'.$brando_sep_color.';' : '';
        $brando_seperator_height = ( $brando_seperator_height ) ? 'height:'.$brando_seperator_height.';' : '';

        if( $brando_sep_color || $brando_seperator_height ){
            $sep_style .= ' style="'.$brando_sep_color.$brando_seperator_height.'"';
        }

        $brando_et_line_icon_list = ( $brando_et_line_icon_list ) ? $brando_et_line_icon_list : '';
        $brando_feature_title = ( $brando_feature_title ) ? $brando_feature_title : '';
        $brando_feature_price = ( $brando_feature_title ) ? $brando_feature_title : '';
        $brando_price = ( $brando_price ) ? $brando_price : '';
        $with_gray_border = ( $with_gray_border == 1 ) ? 'features-box-style2-sub': 'service-sub';

        $brando_feature_subtitle = ( $brando_feature_subtitle ) ? $brando_feature_subtitle : '';
        $brando_transperent = ( $brando_border_transperent ) ? $brando_border_transperent : '';
        $brando_excerpt_length = ($brando_excerpt_length) ? $brando_excerpt_length : '15';
        $brando_team_member_title = ( $brando_team_member_title ) ? $brando_team_member_title : '';
        $brando_team_member_designation = ( $brando_team_member_designation ) ? $brando_team_member_designation : '';
        $brando_team_member_fb = ( $brando_team_member_fb ) ? $brando_team_member_fb : '';
        $brando_team_member_fb_url = ( $brando_team_member_fb_url ) ? $brando_team_member_fb_url : '#';
        $brando_team_member_tw = ( $brando_team_member_tw ) ? $brando_team_member_tw : '';
        $brando_team_member_tw_url = ( $brando_team_member_tw_url ) ? $brando_team_member_tw_url : '#';
        $brando_team_member_googleplus = ( $brando_team_member_googleplus ) ? $brando_team_member_googleplus : '';
        $brando_team_member_googleplus_url = ( $brando_team_member_googleplus_url ) ? $brando_team_member_googleplus_url : '#';
        $target = 'target="_BLANK"';
        /* Event date and time */
        $brando_event_date = ( $brando_event_date ) ? $brando_event_date : '';
        $brando_event_time = ( $brando_event_time ) ? $brando_event_time : '';
        // Column Padding settings
        $padding_setting = ( $padding_setting ) ? $padding_setting : '';
        $desktop_padding = ( $desktop_padding ) ? ' '.$desktop_padding : '';
        $ipad_padding = ( $ipad_padding ) ? ' '.$ipad_padding : '';
        $mobile_padding = ( $mobile_padding ) ? ' '.$mobile_padding : '';
        $custom_desktop_padding = ( $custom_desktop_padding ) ? $custom_desktop_padding : '';
        if($desktop_padding == 'custom-desktop-padding' && $custom_desktop_padding){
            $padding_style .= " padding: ".$custom_desktop_padding.";";
        }else{
            $padding .= $desktop_padding;
        }
        $padding .= $ipad_padding.$mobile_padding;

        // Column Margin settings
        $margin_setting = ( $margin_setting ) ? $margin_setting : '';
        $desktop_margin = ( $desktop_margin ) ? ' '.$desktop_margin : '';
        $ipad_margin = ( $ipad_margin ) ? ' '.$ipad_margin : '';
        $mobile_margin = ( $mobile_margin ) ? ' '.$mobile_margin : '';
        $custom_desktop_margin = ( $custom_desktop_margin ) ? $custom_desktop_margin : '';
        if($desktop_margin == 'custom-desktop-margin' && $custom_desktop_margin){
            $margin_style .= " margin: ".$custom_desktop_margin.";";
        }else{
            $margin .= $desktop_margin;
        }
        $margin .= $ipad_margin.$mobile_margin;

        // Padding and Margin Style Combine
        if($padding_style){
            $style_attr .= $padding_style;
        }
        if($margin_style){
            $style_attr .= $margin_style;
        }
        
        if($style_attr || $brando_title_color){
            $style .= ' style="'.$style_attr.$brando_title_color.'"';
        }
        if($brando_border_transperent == 'custom'){
            $brando_border_color = ( $brando_border_color ) ? ' style ="color: '.$brando_border_color.' !important; border:5px solid"' : '' ;
        }else{
            $brando_border_transperent = ( $brando_border_transperent ) ? ' '.$brando_border_transperent : '';
        }

        switch ($brando_feature_type) {
            case 'featurebox1':
                if($brando_number || $brando_feature_title){
                    $output .='<span class="text-uppercase text-large alt-font font-weight-600 deep-gray-text margin-six-bottom display-inline-block"'.$brando_title_color.'>';
                    if($brando_number){
                        $output .='<span class="crimson-red-text">'.$brando_number.'. &nbsp;</span>';
                    }
                    $output .= $brando_feature_title.'</span>';
                }
                if($thumb[0]){
                   $output .='<img src="'.$thumb[0].'" width="'.$thumb[1].'" height="'.$thumb[2].'" '.$image_alt.$image_title.' class="'.$margin.$padding.'"/>';
                }
                if( $content ){
                    $output .= do_shortcode( brando_remove_wpautop( $content ) );
                }
                if($brando_enable_seperator == 1)
                {       
                   $output .='<div class="separator-line-thick bg-crimson-red margin-ten-all no-margin-lr no-margin-bottom"'.$sep_style.'></div> ';
                }
            break; 

            case 'featurebox2':
                $output .= '<div class="'.$with_gray_border.$margin.$padding.'">';
                    if($brando_et_line_icon_list){
                       $output .= '<i class="margin-four-bottom '.$brando_et_line_icon_list.$icon_size.'"'.$brando_icon_color.'></i>';
                    }
                    if($brando_feature_title){
                       $output .= '<span class="text-medium font-weight-600 text-uppercase margin-two-bottom display-block alt-font"'.$brando_title_color.'>'.$brando_feature_title.'</span>';
                    }
                    if($content){
                       $output .= do_shortcode( brando_remove_wpautop( $content ) );
                    }
                $output .= '</div>';
            break;

            case 'featurebox3':
                $brando_feature = str_replace("||", "<br >", $brando_feature_title);
                $output .='<div class="features-box-style1 center-col">';
                    $output .='<div class="features-box-style1-sub">';
                        if($brando_et_line_icon_list){
                            $output .='<i class="'.$brando_et_line_icon_list.$icon_size.'"'.$brando_icon_color.'></i>';
                        }
                        if($brando_feature_title){
                            $output .='<h5 class="text-large text-uppercase letter-spacing-2 alt-font no-margin"'.$brando_title_color.'>'.$brando_feature.'</h5>';
                        }
                    $output .='</div>';
	            $output .='</div>';
			break;

            case 'featurebox4':
                $output .= '<div class="testimonial-style1">';
    		        if($thumb[0]){
    		           $output .= '<img '.$image_alt.$image_title.' width="'.$thumb[1].'" height="'.$thumb[2].'" src="'.$thumb[0].'">';
                    }
    		        if($content){
    		           $output .= brando_remove_wpautop( $content );
                    }
    		        if($brando_feature_title){
    		           $output .= '<span class="name"'.$brando_title_color.'>'.$brando_feature_title.'</span>';
                    }
                    if($brando_feature_icon == 1 ){
    		          $output .= '<i class="fa fa-quote-left isplay-block margin-eight-top xs-margin-two-top'.$icon_size.'"'.$brando_icon_color.'></i>';
                    }
	            $output .= '</div>';
            break;
            
            case 'featurebox5':
                if( $brando_et_line_icon_list ){
                    $output .= '<i class="'.$brando_et_line_icon_list.$icon_size.' margin-five-bottom xs-margin-two-bottom"'.$brando_icon_color.'></i>';
                }
                if($brando_feature_title){
                    $output .= '<span class="font-weight-600 letter-spacing-1 text-uppercase display-block alt-font margin-three-bottom"'.$brando_title_color.'>'.$brando_feature_title.'</span>';
                }
                if($brando_enable_seperator == 1){
                    $output .= '<div class="separator-line bg-yellow no-margin-lr margin-ten xs-center-col"'.$sep_style.'></div>';
                }
                if($content){
                   $output .= brando_remove_wpautop( $content );
                }
            break;
            
            case 'featurebox6':
                $output .= '<div class="text-center pricing-box">';
                    if( $brando_price ){
                        $output .= '<div class="pricing-price bg-deep-blue"'.$brando_price_bg_color.'>';
                            $output .= '<h3 class="title-extra-large-2 white-text alt-font no-margin"'.$brando_price_color.'>'.$brando_price.'</h3>';
                        $output .= '</div>';
                    }
                    if( $brando_feature_title ){
                        $output .= '<div class="pricing-title bg-deep-blue-dark"'.$brando_title_bg_color.'>';
                            $output .= '<span class="white-text text-large text-uppercase alt-font"'.$brando_title_color.'>'.$brando_feature_title.'</span>';
                        $output .= '</div>';
                    }
                    if( $content ){
                        $output .= '<div class="pricing-features">';
                            $output .= brando_remove_wpautop( $content );
                        $output .= '</div>';
                    }
                    if( !empty($button_title) ){
                        $output .= '<div class="pricing-action">';
                            $output .= '<a href="'.$button_link.'" target="'.$button_target.'" class="highlight-button-dark btn btn-small button no-margin inner-link">'.$button_title.'</a>';
                        $output .= '</div>';
                    }
                $output .= '</div>';
            break;

            case 'featurebox7':
                    $output .= '<div class="col-lg-2 col-md-3 col-sm-2 col-xs-3 no-padding">';
                        if($brando_et_line_icon_list){
                           $output .= '<i class="'.$brando_et_line_icon_list.$icon_size.'"'.$brando_icon_color.'></i>';
                        }
                        $output .= '</div>';
                        $output .='<div class="col-lg-10 col-md-9 col-sm-10 col-xs-9 no-padding">';
                        if($brando_feature_title){
                            $output .= '<span class="display-block alt-font text-uppercase letter-spacing-1 black-text margin-two-bottom"'.$brando_title_color.'>'.$brando_feature_title.'</span>';
                        }
                        if($content){
                            $output .= brando_remove_wpautop( $content );
                        }
                    $output .= '</div>';
            break;

            case 'featurebox8':
                $output .= '<div class="special-dishes">';
                    if($thumb[0]){
                        $output .= '<img src="'.$thumb[0].'" width="'.$thumb[1].'" height="'.$thumb[2].'" '.$image_alt.$image_title.'/>';
                    }
                    if($brando_feature_title){
                       $output .= '<div class="text-uppercase alt-font text-extra-large letter-spacing-2 sm-text-large margin-eight-top xs-margin-four-top"'.$brando_title_color.'>'.$brando_feature_title.'</div>';
                    }
                    if($brando_feature_subtitle){
                       $output .= '<div class="text-uppercase text-small light-gray-text alt-font margin-one-tb sm-padding-two-all">'.$brando_feature_subtitle.'</div>';
                    }
                    if($brando_price){
                       $output .= '<div class="bg-deep-red round-border special-dishes-price text-center text-uppercase alt-font white-text position-absolute"><span class="text-small">'.__('Only','brando-addons').'</span><br><span class="text-extra-large line-height-unset">'.$brando_price.'</span></div>';
                    }
                $output .= '</div>';
            break;

            case 'featurebox9':
               $output .= '<div class="wedding-event-box padding-fifteen-all sm-padding-eight-all">';
                if( $brando_et_line_icon_list ){
                    $output .= '<i class="'.$brando_et_line_icon_list.$icon_size.' turquoise-blue-text margin-five-bottom xs-margin-six-bottom"'.$brando_icon_color.'></i>';
                }
                if( $brando_feature_title ){
                    $output .= '<span class="text-uppercase alt-font text-large display-block font-weight-600 margin-nine-bottom"'.$brando_title_color.'> '.$brando_feature_title.'</span>';
                }
                if( $brando_enable_seperator == 1 ){
                    $output .= '<div class="divider-line margin-nine-bottom"'.$sep_style.'></div>';
                }
                if( $content ){
                    $output .= do_shortcode( brando_remove_wpautop($content) );
                }
            $output .= '</div>';
            break;

            case 'featurebox10':
                $args = array('post_type' => 'post',
                            'name' => $brando_posts_list,
                        );
                $query = new WP_Query( $args );
                $output .= '<div class="blog-post-style7">';
                    while ( $query->have_posts() ) : $query->the_post();
                    /* Image Alt, Title, Caption */
                    $img_alt = brando_option_image_alt(get_post_thumbnail_id());
                    $img_title = brando_option_image_title(get_post_thumbnail_id());
                    $image_alt = ( isset($img_alt['alt']) ) ? $img_alt['alt'] : '' ; 
                    $image_title = ( isset($img_title['title']) ) ? $img_title['title'] : '';

                    $img_attr = array(
                        'title' => $image_title,
                        'alt' => $image_alt,
                    );
                        $post_cat = array();
                        $categories = get_the_category();
                        foreach ($categories as $k => $cat) {
                            $cat_link = get_category_link($cat->cat_ID);
                            $post_cat[]='<span class="text-extra-small post-categories text-uppercase letter-spacing-1 alt-font bg-black display-inline-block margin-four-bottom"><a href="'.$cat_link.'" class="white-text">'.$cat->name.'</a></span>';
                        }
                        $post_category=implode(" ",$post_cat);
                        $post_format = get_post_format( get_the_ID() );
                        $show_excerpt = ( $brando_excerpt_length ) ? brando_get_the_excerpt_theme($brando_excerpt_length) : brando_get_the_excerpt_theme(55);
                            $output .='<div class="post-thumbnail overflow-hidden">';
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
                            $output .='</div>';
                            $output .='<div class="post-details margin-eight-top">';
                                $output .= $post_category;
                                $output .='<span class="text-large text-uppercase display-block alt-font margin-four-bottom sm-text-medium xs-text-medium alt-font font-weight-300">';
                                    $output .='<a href="'.get_permalink().'" class="dark-gray-text"'.$brando_title_color.'>'.get_the_title().'</a>';
                                    $output .='</span>';
                                $output .= '<p class="margin-seven-bottom xs-margin-five-bottom">'.$show_excerpt.'</p>';
                                if( $brando_enable_seperator == 1 ){
                                    $output .='<div class="separator-line-full bg-mid-gray3 margin-seven-bottom xs-margin-five-bottom"'.$sep_style.'></div>';
                                }
                                $output .='<span class="text-small text-uppercase alt-font light-gray-text">';
                                    $output .='<a href="'.get_permalink().'" class="light-gray-text">'.get_the_date('d F Y').'</a>'.esc_html__(' / Posted by','brando-addons').' <a href="'.get_author_posts_url( get_the_author_meta( 'ID' ) ).'" class="light-gray-text">'.get_the_author().'</a>';
                                $output .='</span>';
                            $output .='</div>';
                    endwhile;
                    wp_reset_postdata();
                $output .= '</div>';
            break;

            case 'featurebox11':
                $args = array('post_type' => 'post',
                            'name' => $brando_posts_list,
                        );
                $query = new WP_Query( $args );
                while ( $query->have_posts() ) : $query->the_post();
                $post_author = get_post_field( 'post_author', get_the_ID() );
                $author = __('Posted by ','brando-addons').'<a href="'.esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ).'" class="black-text"'.$brando_author_color.'>'.get_the_author_meta( 'user_nicename', $post_author).'</a>';

                    $output .='<div class="blog-post-style5">';
                        $output .='<div class="post-details alt-font">';
                            if(get_the_title()){
                                $output .='<span class="text-extra-large font-weight-600 z-index-1 position-relative text-uppercase post-title display-block width-90"><a href="'.get_permalink().'"'.$brando_title_color.'>'.get_the_title().'</a></span>';
                            }
                            $output .=' <span class="post-date display-block text-uppercase z-index-1 position-relative font-weight-600"'.$brando_post_date_color.'>'.get_the_date('d F Y', get_the_ID()).'</span>';
                            $output .=' <span class="post-name text-small text-uppercase z-index-1 position-relative">'.$author.'</span>';
                                if($brando_show_border == 1 ){
                                    $output .= '<div class="img-border-medium '.$brando_transperent.' z-index-0"'.$brando_border_color.'></div>';
                                }
                        $output .=' </div>';
                    $output .=' </div>';

                endwhile;
                wp_reset_postdata();
            break;

            case 'featurebox12':
                $args = array('post_type' => 'post',
                            'name' => $brando_posts_list,
                        );
                $query = new WP_Query( $args );
                while ( $query->have_posts() ) : $query->the_post();
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
                    $output .= '<div class="blog-post-style6">';
                        $output .='<article class="col-md-12 col-sm-12 col-xs-12 no-padding">';                                
                            $output .='<div class="col-md-6 col-sm-6 col-xs-6 no-padding post-thumbnail overflow-hidden '.$brando_image_position.'">';
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
                            $output .='</div>';
                            $output .='<div class="col-md-6 col-sm-6 col-xs-6 no-padding post-details-arrow '.$content_pos.'">';
                                $output .='<div class="post-details">';
                                    $output .='<span class="text-small text-uppercase letter-spacing-2 alt-font light-gray-text">'.get_the_date('d M Y').'</span>';
                                    $output .='<span class="text-large text-uppercase display-block alt-font margin-seven-tb sm-text-medium xs-text-medium">';
                                        $output .='<a href="'.get_permalink().'" class="xs-display-inline-block xs-text-small"'.$brando_title_color.'>'.get_the_title().'</a>';
                                    $output .='</span>';
                                    $output .='<div class="separator-line-thick bg-crimson-red margin-twelve-top no-margin-bottom no-margin-lr"></div>';
                                $output .='</div>';
                            $output .='</div>';
                        $output .='</article>';                        
                    $output .='</div>';
                endwhile;
                wp_reset_postdata();
            break;
        }
        return $output;        
    }
}
add_shortcode( 'brando_feature_box', 'brando_feature_box_shortcode' );