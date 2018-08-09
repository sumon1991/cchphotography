<?php
/**
 * displaying layout for archive, search page
 *
 * @package Brando
 */

get_header(); 
?>
<?php
    $brando_layout_settings = $brando_enable_container_fluid = $brando_class_main_section = $brando_section_class = $brando_title = $output = '';
    $brando_layout_settings_inner = brando_option('brando_general_settings');
    
    $brando_layout_settings = $brando_layout_settings_inner;
    $brando_enable_container_fluid = brando_option('brando_general_enable_container_fluid');
    
    switch ($brando_layout_settings) {
        case 'brando_general_full_screen':
            $brando_section_class .= ' no-padding';
            if(isset($brando_enable_container_fluid) && $brando_enable_container_fluid == '1'){
                $brando_class_main_section .= 'container-fluid';
            }else{
                $brando_class_main_section .= 'container';
            }
        break;

        case 'brando_general_both_sidebar':
            $brando_section_class .= '';
            $brando_class_main_section .= 'container col3-layout';
        break;

        case 'brando_general_left_sidebar':
        case 'brando_general_right_sidebar':
            $brando_section_class .= '';
            $brando_class_main_section .= 'container col2-layout';
        break;

        default:
            $brando_section_class .= '';
            $brando_class_main_section .= 'container';
        break;
    }
if(is_search()):
    $brando_title .= 'Search For';
elseif(is_author()):
    $brando_title .= get_the_author();
else: 
    if ( is_day() ) :
        $brando_title .= get_the_date() ;

    elseif ( is_month() ) :
        $brando_title .=get_the_date( _x( 'F Y', 'monthly archives date format', 'brando' ) ) ;

    elseif ( is_year() ) :
        $brando_title .= get_the_date( _x( 'Y', 'yearly archives date format', 'brando' ) );

    endif;
    $brando_title .= single_cat_title( '', false );
endif;
echo '<section class="parallax-2 parallax-fix no-padding">';
    $brando_image = $brando_desc = '';
    
    if(is_tag()){
        $brando_t_id = $tag_id;
        $brando_term_meta = get_option( "brando_post_tag_$brando_t_id" );
        $brando_desc = tag_description( $tag_id );
        if ( $brando_term_meta['image_url'] ){
            $brando_image = $brando_term_meta['image_url'];
        }
    }
    elseif(is_category()){
        $brando_t_id = $cat;
        $brando_term_meta = get_option( "brando_taxonomy_$brando_t_id" );
        $brando_desc = category_description( $cat );
        if ( $brando_term_meta['image_url'] ){
            $brando_image = $brando_term_meta['image_url'];
        }
    }elseif(is_search()){
        $brando_desc = ( get_search_query() ) ? '"'.get_search_query().'"' : '';
        $brando_back_image = brando_option('brando_general_background_image');
        if( $brando_back_image['url'] ):
            $brando_image = $brando_back_image['url'];
        endif;
    }else{
        $brando_back_image = brando_option('brando_general_background_image');
        if( $brando_back_image['url'] ):
            $brando_image = $brando_back_image['url'];
        endif;
    }
    
    if( $brando_image ): 
        echo '<img class="parallax-background-img" src="'.esc_url($brando_image).'" alt="" />';
    endif;
    echo '<div class="opacity-full-dark bg-deep-blue3"></div>';
    echo '<div class="container position-relative">';
        echo '<div class="row">';
            echo '<div class="page-title">';
                echo '<div class="col-text-middle-main">';
                    echo '<div class="col-text-middle">';
                        echo '<div class="col-md-12 col-sm-12 text-center">';
                            echo '<h2 class="alt-font white-text font-weight-600 xs-title-extra-large no-margin">'.esc_attr($brando_title).'</h2>';
                            echo '<div class="alt-font title-small xs-text-large white-text text-uppercase margin-one-top display-block">'.brando_remove_wpautop($brando_desc).'</div>';
                        echo '</div>';
                    echo '</div>';
                echo '</div>';
            echo '</div>';
        echo '</div>';
    echo '</div>';
echo '</section>';
?>
<?php
$output = '';  
$brando_enable_breadcrumb = brando_option('brando_enable_breadcrumb');
if( $brando_enable_breadcrumb == 1 ){
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
    echo '<div class="breadcrumb alt-font">';
        echo '<div class="container"> '; 
            echo '<ul>';
                echo wp_kses($brando_breadcrumb->display(), wp_kses_allowed_html( 'post' ));
            echo'</ul>'; 
        echo'</div>'; 
    echo'</div>';
}       
?>
<section class="parent-section<?php echo esc_attr($brando_section_class); ?>">
    <div class="<?php echo esc_attr($brando_class_main_section); ?>">
        <div class="row">
            <?php get_template_part('templates/archive-left'); ?>
                <?php 
                    get_template_part('templates/page-content/content');
                ?>
            <?php get_template_part('templates/archive-right'); ?>
        </div>
    </div>
</section>
<?php get_footer(); ?>
