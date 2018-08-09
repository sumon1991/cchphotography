<?php
/**
 * The template for displaying Portfolio tags
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Brando
 */

get_header(); 
?>
<?php
    $brando_layout_settings = $brando_enable_container_fluid = $brando_class_main_section = $brando_section_class = $output = '';
    $brando_layout_settings_inner = brando_option('brando_portfolio_cat_settings');
    
    $brando_layout_settings = $brando_layout_settings_inner;
    $brando_enable_container_fluid = brando_option('brando_portfolio_cat_enable_container_fluid');
    
    switch ($brando_layout_settings) {
        case 'brando_portfolio_cat_full_screen':
            $brando_section_class .= ' no-padding';
            if(isset($brando_enable_container_fluid) && $brando_enable_container_fluid == '1'){
                $brando_class_main_section .= 'container-fluid';
            }else{
                $brando_class_main_section .= 'container';
            }
        break;

        case 'brando_portfolio_cat_both_sidebar':
            $brando_section_class .= '';
            $brando_class_main_section .= 'container col3-layout';
        break;

        case 'brando_portfolio_cat_left_sidebar':
        case 'brando_portfolio_cat_right_sidebar':
            $brando_section_class .= '';
            $brando_class_main_section .= 'container col2-layout';
        break;

        default:
            $brando_section_class .= '';
            $brando_class_main_section .= 'container';
        break;
    }

$brando_title = single_cat_title( '', false );
echo '<section class="parallax-2 parallax-fix no-padding">';
    $brando_image = $brando_desc = '';
    
    $brando_t_id = get_queried_object()->term_id;
    $brando_term_meta = get_option( "brando_portfolio_tag_$brando_t_id" );
    $brando_desc = term_description( $brando_t_id, 'portfolio-tags' );
    if ( $brando_term_meta['image_url'] ){
        $brando_image = $brando_term_meta['image_url'];
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
                            echo '<div class="alt-font title-small xs-text-large white-text text-uppercase margin-one-top display-block">'.$brando_desc.'</div>';
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
            <?php get_template_part('templates/portfolio-cat-left'); ?>
                <?php 
                    get_template_part('templates/portfolio-content/content');
                ?>
            <?php get_template_part('templates/portfolio-cat-right'); ?>
        </div>
    </div>
</section>
<?php get_footer(); ?>
