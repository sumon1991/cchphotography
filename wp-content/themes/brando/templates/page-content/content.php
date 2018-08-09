<?php
/**
 * displaying content for archive pages layout
 *
 * @package Brando
 */
?>
<?php
$output = $brando_class_column = '';
$brando_options = get_option( 'brando_theme_setting' );
$brando_excerpt_length = (isset($brando_options['brando_general_excerpt_length'])) ? $brando_options['brando_general_excerpt_length'] : '';
$brando_general_layout = (isset($brando_options['brando_general_grid_layout'])) ? $brando_options['brando_general_grid_layout'] : '';
$brando_general_column = (isset($brando_options['brando_general_grid_column'])) ? $brando_options['brando_general_grid_column'] : '';
$brando_show_thumbnail = (isset($brando_options['brando_general_show_thumbnail'])) ? $brando_options['brando_general_show_thumbnail'] : '';
$brando_show_separator = (isset($brando_options['brando_general_show_separator'])) ? $brando_options['brando_general_show_separator'] : '';
$brando_show_post_meta = (isset($brando_options['brando_general_show_post_meta'])) ? $brando_options['brando_general_show_post_meta'] : '';
$brando_show_excerpt = (isset($brando_options['brando_general_show_excerpt'])) ? $brando_options['brando_general_show_excerpt'] : '';
$brando_show_category = (isset($brando_options['brando_general_show_category'])) ? $brando_options['brando_general_show_category'] : '';
$brando_show_comments = (isset($brando_options['brando_general_show_comments'])) ? $brando_options['brando_general_show_comments'] : '';
$brando_show_social_icon = (isset($brando_options['brando_general_show_social_icon'])) ? $brando_options['brando_general_show_social_icon'] : '';
$brando_show_button = (isset($brando_options['brando_general_show_button'])) ? $brando_options['brando_general_show_button'] : '';
$brando_button_text = (isset($brando_options['brando_general_button_text'])) ? $brando_options['brando_general_button_text'] : 'Continue';
$brando_date_format = (isset($brando_options['brando_general_date_format'])) ? $brando_options['brando_general_date_format'] : '';

switch ($brando_general_column) {
	case '2':
		$brando_class_column .= ' col-md-6 col-sm-6 col-xs-12';
	break;
	case '3':
		$brando_class_column .= ' col-md-4 col-sm-6 col-xs-12 margin-four-bottom xs-margin-seven-bottom';
	break;
	case '4':
		$brando_class_column .= ' col-md-3 col-sm-6 col-xs-12';
	break;
}
$brando_blog_layout = ' class="blog-'.esc_attr($brando_general_column).'-column"';
if( have_posts() ){

	if( $brando_general_layout == 'grid'){
		echo '<div'.$brando_blog_layout.'>';
	}
    while ( have_posts() ) : the_post();
		$brando_post_cat = array();
		$brando_popup_id = 'blog-'.get_the_ID();
        $brando_categories = get_the_category();
        foreach ($brando_categories as $k => $cat) {
            $brando_cat_link = get_category_link($cat->cat_ID);
            $brando_post_cat[]='<a href="'.esc_url($brando_cat_link).'" class="text-small dark-gray-text text-uppercase alt-font">'.esc_attr($cat->name).'</a>';
        }
        $brando_post_category=implode(" ",$brando_post_cat);
        /* Image Alt, Title, Caption */
        $brando_img_alt = brando_option_image_alt(get_post_thumbnail_id());
        $brando_img_title = brando_option_image_title(get_post_thumbnail_id());
        $brando_image_alt = ( isset($brando_img_alt['alt']) && !empty($brando_img_alt['alt']) ) ? $brando_img_alt['alt'] : '' ; 
        $brando_image_title = ( isset($brando_img_title['title']) && !empty($brando_img_title['title']) ) ? $brando_img_title['title'] : '';

        $brando_img_attr = array(
            'title' => $brando_image_title,
            'alt' => $brando_image_alt,
        );
        $brando_post_format = get_post_format( get_the_ID() );
        $brando_show_excerpts = ( !empty($brando_excerpt_length) ) ? wpautop(brando_get_the_excerpt_theme($brando_excerpt_length)) : wpautop(brando_get_the_excerpt_theme(55));
        switch ( $brando_general_layout ) {
        	case 'grid':
        		$brando_show_excerpt_grid = ( !empty($brando_excerpt_length) ) ? brando_get_the_excerpt_theme($brando_excerpt_length) : brando_get_the_excerpt_theme(55);
        		echo '<div class="blog-post-style7'.esc_attr($brando_class_column).' margin-seven-bottom">';
        			if( $brando_show_thumbnail == 1 ){
		                echo'<div class="post-thumbnail overflow-hidden">';
		                    if($brando_post_format == 'image'){
		                        get_template_part('loop/loop','image');
		                    }elseif($brando_post_format == 'gallery'){
		                        get_template_part('loop/loop','gallery');
		                    }elseif($brando_post_format == 'video'){
		                        get_template_part('loop/loop','video');
		                    }elseif($brando_post_format == 'quote'){
		                        get_template_part('loop/loop','quote');
		                    }else{
		                        echo  '<div class="blog-image"><a href="'.get_permalink().'">';
		                            if ( has_post_thumbnail() ) {
		                                echo get_the_post_thumbnail( get_the_ID(), 'full',$brando_img_attr );
		                            }
		                        echo  '</a></div>';
		                    }
		                echo'</div>';
		            }
	                echo'<div class="post-details margin-eight-top">';
	                    echo'<span class="text-large text-uppercase display-block alt-font margin-four-bottom sm-text-medium xs-text-medium alt-font font-weight-600">';
	                        echo'<a href="'.get_permalink().'" class="dark-gray-text">'.get_the_title().'</a>';
	                        echo'</span>';
	                    if( $brando_show_excerpt == 1 ){
	                    	echo '<p class="margin-seven-bottom xs-margin-five-bottom">'.$brando_show_excerpt_grid.'</p>';
	                	}
	                    if( $brando_show_separator == 1 ){
	                        echo'<div class="separator-line-full bg-mid-gray3 margin-seven-bottom xs-margin-five-bottom"></div>';
	                    }
	                    if( $brando_show_post_meta == 1 ){
		                    echo'<span class="text-small text-uppercase alt-font light-gray-text">';
		                        echo'<a href="'.get_permalink().'" class="light-gray-text">'.get_the_date($brando_date_format).'</a>'.esc_html__(' / Posted by','brando').' <a href="'.get_author_posts_url( get_the_author_meta( 'ID' ) ).'" class="light-gray-text">'.get_the_author().'</a>';
		                    echo'</span>';
	                	}
	                echo'</div>';
	            echo'</div>';
        	break;

        	case 'classic':
        		$brando_post_title = get_the_title();
				echo '<article class="blog-listing">';
			        echo '<div class="col-md-2 col-sm-2 col-xs-12 text-center alt-font overflow-hidden no-padding-left sm-no-padding md-no-padding">';
			            echo '<div class="post-date xs-margin-lr-auto xs-no-margin-top fast-yellow-text"><span>'.get_the_date("d").'</span>'.get_the_date('M Y').'</div>';
			        echo '</div>';
				    echo '<div class="col-md-10 col-sm-10 col-xs-12 post-details no-padding-right xs-no-padding-left margin-twelve-bottom xs-margin-eighteen-bottom">';
				    
				    echo '<span class="alt-font display-block title-small xs-text-extra-large sm-text-medium xs-text-center margin-four-bottom"><a href="'.get_permalink().'">'.get_the_title().'</a></span>';
				    	if( $brando_show_thumbnail == 1 ){
					    	if($brando_post_format == 'image'){
			                    get_template_part('loop/loop','image');
			                }elseif($brando_post_format == 'gallery'){
			                    get_template_part('loop/loop','gallery');
			                }elseif($brando_post_format == 'video'){
			                    get_template_part('loop/loop','video');
			                }elseif($brando_post_format == 'quote'){
			                    get_template_part('loop/loop','quote');
			                }else{
			                    echo  '<div class="blog-image"><a href="'.get_permalink().'">';
			                        if ( has_post_thumbnail() ) {
			                            echo get_the_post_thumbnail( get_the_ID(), 'full',$brando_img_attr );
			                        }
			                    echo  '</a></div>';
			                }
			        	}
			        	if( $brando_show_excerpt == 1 ){
							echo '<div class="margin-five-tb xs-margin-three-tb">'.$brando_show_excerpts.'</div>';
						}
						if( $brando_show_category == 1 || $brando_show_comments == 1 ){
							echo '<div class="col-md-8 col-sm-12 col-xs-12 no-padding blog-listing-link xs-text-center sm-margin-three-bottom">';
							if( $brando_show_category == 1 ){
						        echo wp_kses($brando_post_category, wp_kses_allowed_html( 'post' ));
						    }
						    if( $brando_show_comments == 1 && (comments_open() || get_comments_number())){
						                comments_popup_link( esc_html__( 'Leave a comment', 'brando' ), esc_html__( '1 Comment', 'brando' ), esc_html__( '% Comments', 'brando' ), 'comment' );
							}					       
						    echo '</div>';
						}
						if( $brando_show_social_icon == 1 ){
						    echo '<div class="col-md-4 col-sm-12 col-xs-12 no-padding text-right sm-text-left xs-text-center">';
						        echo '<div class="blog-sharing sm-no-margin-tb">';
						        	echo '<a href="http://www.facebook.com/sharer.php?u='.esc_url(get_permalink()).'" onclick="window.open(this.href,this.title,width=500,height=500,top=300px,left=300px);  return false;"  rel="nofollow" target="_blank" title="'.esc_attr($brando_post_title).'"><i class="fa fa-facebook"></i></a>';
	                            	
	                            	echo '<a href="https://twitter.com/share?url='.esc_url(get_permalink()).'" onclick="window.open(this.href,this.title,width=500,height=500,top=300px,left=300px);  return false;"  rel="nofollow" target="_blank" title="'.esc_attr($brando_post_title).'"><i class="fa fa-twitter"></i></a>';
	                            	
	                            	echo '<a href="//plus.google.com/share?url='.esc_url(get_permalink()).'" target="_blank" onclick="window.open(this.href,this.title,width=500,height=500,top=300px,left=300px);  return false;"  rel="nofollow" title="'.esc_attr($brando_post_title).'"><i class="fa fa-google-plus"></i></a>';
	                            	
	                            	echo '<a href="http://linkedin.com/shareArticle?mini=true&amp;url='.esc_url(get_permalink()).'&amp;title='.esc_attr($brando_post_title).'" target="_blank" onclick="window.open(this.href,this.title,width=500,height=500,top=300px,left=300px);  return false;"  rel="nofollow" title="'.esc_attr($brando_post_title).'"><i class="fa fa-linkedin"></i></a>';
						        echo '</div>';
						    echo '</div>';
						}
						if( $brando_show_button == 1 ){
						    echo '<div class="col-md-12 col-sm-12 col-xs-12 no-padding sm-text-left xs-text-center margin-four-tb">';
						        echo '<a href="'.get_permalink().'" class="btn-black btn btn-very-small no-margin">'.esc_attr($brando_button_text).'</a>';
						    echo '</div>';
						}
					    if( $brando_show_separator == 1 ){
						    echo '<div class="col-md-12 col-sm-12 no-padding xs-display-none">';
						        echo '<div class="bg-fast-yellow separator-line-thick no-margin-lr margin-three-all no-margin-bottom"></div>';
						    echo '</div>';
						}
					echo '</div>';
				echo '</article>';
        break;
    }
    endwhile;
    if( $brando_general_layout == 'grid'){
		echo '</div>';
	}
   	wp_reset_postdata();
    if( $wp_query->max_num_pages > 1 ){
        echo '<div class="col-md-12 col-sm-12 col-xs-12 pagination text-center">';
            echo paginate_links( array(
                'base'         => esc_url_raw( str_replace( 999999999, '%#%', remove_query_arg( 'add-to-cart', get_pagenum_link( 999999999, false ) ) ) ),
                'format'       => '',
                'add_args'     => '',
                'current'      => max( 1, get_query_var( 'paged' ) ),
                'total'        => $wp_query->max_num_pages,
                'prev_text'    => '<i class="fa fa-angle-left title-medium font-weight-600 no-border"></i>',
                'next_text'    => '<i class="fa fa-angle-right title-medium font-weight-600"></i>',
                'type'         => 'plain',
                'end_size'     => 1,
                'mid_size'     => 4
            ) );
        echo '</div>';
    }
}else{
    get_template_part('templates/content','none');
}
?>