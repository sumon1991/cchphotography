<?php
/**
 * The template for displaying single portfolio posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Brando
 */
get_header(); 
// Start the loop.
while ( have_posts() ) : the_post();

    $brando_layout_settings = $brando_enable_container_fluid = $brando_class_main_section = $brando_section_class = $output= '';
    $brando_layout_settings_inner = brando_option_portfolio('brando_layout_settings');
    $brando_options = get_option('brando_theme_setting');
    $brando_layout_settings = $brando_layout_settings_inner;
    $brando_enable_container_fluid = brando_option_portfolio('brando_enable_container_fluid');
    switch ($brando_layout_settings) 
    {
        case 'brando_layout_full_screen':
            $brando_section_class .= 'no-padding';
            if(isset($brando_enable_container_fluid) && $brando_enable_container_fluid == '1'){
                $brando_class_main_section .= 'container-fluid';
            }else{
                $brando_class_main_section .= 'container';
            }
        break;

        case 'brando_layout_both_sidebar':
            $brando_section_class .= '';
            $brando_class_main_section .= 'container col3-layout';
        break;

        case 'brando_layout_left_sidebar':
        case 'brando_layout_right_sidebar':
            $brando_section_class .= '';
            $brando_class_main_section .= 'container col2-layout';
        break;

        default:
            $brando_section_class .= '';
            $brando_class_main_section .= 'container';
        break;
    }

/* Portfolio title */
$brando_enable_title = brando_option('brando_enable_title_wrapper');
if($brando_enable_title != 0){
    $brando_title_parallax_effect = brando_option('brando_title_parallax_effect');
    $brando_image = brando_option('brando_title_background');
    
    $brando_enable_date = ($brando_options['brando_enable_meta_date_portfolio'] == 1 ) ? esc_attr(get_the_date('d F Y')) : '';
    $brando_enable_author = ($brando_options['brando_enable_meta_author_portfolio'] == 1 ) ? esc_html__('By ','brando').'<a class="white-text" href='.esc_url(get_author_posts_url( get_the_author_meta( 'ID' ) )).'>'.get_the_author().'</a>' : '';
    $brando_meta_sep = ($brando_options['brando_enable_meta_date_portfolio'] == 1 && $brando_options['brando_enable_meta_author_portfolio'] == 1) ? ' / ' : '';

    echo '<section class="'.esc_attr($brando_title_parallax_effect).' parallax-fix no-padding">';
        if(is_array($brando_image))
                $brando_image =  $brando_image['url'];

        if( $brando_image ){
            echo '<img class="parallax-background-img" src="'.esc_url($brando_image).'" alt="" />';
        }
        echo '<div class="opacity-full-dark bg-deep-blue3"></div>';
        echo '<div class="container position-relative">';
            echo '<div class="row">';
                echo '<div class="page-title">';
                    echo '<div class="col-text-middle-main">';
                        echo '<div class="col-text-middle">';
                            echo '<div class="col-md-12 col-sm-12 text-center">';
                                echo '<h2 class="alt-font white-text font-weight-600 xs-title-extra-large no-margin">'.get_the_title().'</h2>';
                                if( $brando_options['brando_enable_meta_date_portfolio'] == 1 || $brando_options['brando_enable_meta_author_portfolio'] == 1 ){
                                    echo '<span class="alt-font title-small xs-text-large white-text text-uppercase margin-one-top display-block">'.$brando_enable_date.$brando_meta_sep.$brando_enable_author.'</span>';
                                }
                            echo '</div>';
                        echo '</div>';
                    echo '</div>';
                echo '</div>';
            echo '</div>';
        echo '</div>';
    echo '</section>';
}

if (class_exists('brando_breadcrumb_navigation_xt')) 
{
    $brando_breadcrumb = new brando_breadcrumb_navigation_xt;
    $brando_breadcrumb->opt['static_frontpage'] = false;
    $brando_breadcrumb->opt['url_blog'] = '';
    $brando_breadcrumb->opt['title_blog'] = esc_html__('Home','brando');
    $brando_breadcrumb->opt['title_home'] = esc_html__('Home','brando');
    $brando_breadcrumb->opt['separator'] = '';
    $brando_breadcrumb->opt['tag_page_prefix'] = '';
    $brando_breadcrumb->opt['singleblogpost_category_display'] = false;
} 
?>
<?php
    $brando_enable_breadcrumb = brando_option_portfolio('brando_enable_breadcrumb');
    $brando_enable_title = (!empty($brando_options['brando_enable_title_wrapper'])) ? $brando_options['brando_enable_title_wrapper'] : '';
    $brando_top_breadcrumb = ( $brando_enable_title != 1 && empty($brando_enable_title)) ? ' page-top-breadcrumb': '';
    if( $brando_enable_breadcrumb == 1 ){
        echo'<div class="breadcrumb alt-font'.esc_attr($brando_top_breadcrumb).'">';
            echo'<div class="container"> '; 
                echo'<ul>';
                    echo wp_kses($brando_breadcrumb->display(), wp_kses_allowed_html( 'post' ));
                echo'</ul>'; 
            echo'</div>'; 
        echo'</div>';
    }
    echo '<section class="'.esc_attr($brando_section_class).'">';
        echo '<div class="'.esc_attr($brando_class_main_section).'">';
            echo '<div class="row">';
               echo '<div class="blog-listing">';
                        get_template_part('templates/portfolio-sidebar-left');
                    echo '<article>';
                        $brando_thumb = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'full');
                        $brando_enable_feature_image = brando_post_meta("brando_featured_image");
                        $brando_url = $brando_thumb['0'];
                        if( $brando_enable_feature_image == 1 ){
                            echo '<div class="post-details no-padding margin-four-bottom">';
                                echo'<div class="blog-image bg-transparent">';
                                    if( $url ){
                                        /* Image Alt, Title, Caption */
                                        $brando_img_alt = brando_option_image_alt(get_post_thumbnail_id());
                                        $brando_img_title = brando_option_image_title(get_post_thumbnail_id());
                                        $brando_image_alt = ( isset($brando_img_alt['alt']) && !empty($brando_img_alt['alt']) ) ? 'alt="'.esc_attr($brando_img_alt['alt']).'"' : 'alt=""' ; 
                                        $brando_image_title = ( isset($brando_img_title['title']) && !empty($brando_img_title['title']) ) ? 'title="'.esc_attr($brando_img_title['title']).'"' : '';

                                        echo '<img src="' . esc_url($brando_url) . '" width="'.$brando_thumb[1].'" height="'.$brando_thumb[2].'" '.$brando_image_alt.$brando_image_title.'>';
                                    }
                                echo'</div>';
                            echo '</div>';
                        }
                    echo '<div class="blog-description">';
                            echo do_shortcode( get_the_content());
                            wp_link_pages( array(
                                'before'      => '<div class="page-links default-link-pages"><span class="page-links-title">' . esc_html__( 'Pages:', 'brando' ) . '</span>',
                                'after'       => '</div>',
                                'pagelink'    => '<span class="page-numbers">%</span>',
                            ) );
                    echo '</div>';

                    $brando_enable_tags = brando_option('brando_enable_meta_tags_portfolio');
                    if($brando_enable_tags == 1){
                        echo brando_single_portfolio_meta_tag();
                    }
                    
                    $brando_enable_author = brando_option('brando_enable_post_author_portfolio');
                    if($brando_enable_author == 1):
                        // Author bio.
                        if ( is_single() && get_the_author_meta('description')) :
                            get_template_part( 'author-bio' );
                        endif;

                    endif;
                    
                    $brando_enable_social = brando_option('brando_social_icons_portfolio');
                    if($brando_enable_social == 1 && class_exists('Brando_Addons')):
                        echo do_shortcode('[brando_single_post_share]'); 
                    endif;
                 
                echo '</article>';   
                    $brando_enable_comment = brando_option('brando_enable_portfolio_comment');
                    if( $brando_enable_comment == 1 ):
                        // If comments are open or we have at least one comment, load up the comment template
                        if ( comments_open() || get_comments_number() ) :
                            echo comments_template();
                        endif;

                    endif;
                    get_template_part('templates/portfolio-sidebar-right');
                echo '</div>'; 
            echo '</div>';
        echo '</div>';
    echo '</section>';
endwhile;
wp_reset_postdata();
// End the loop.
get_footer(); ?>
