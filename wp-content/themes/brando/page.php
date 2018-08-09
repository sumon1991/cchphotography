<?php
/**
 * The template for displaying pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that
 * other "pages" on your WordPress site will use a different template.
 *
 * @package Brando
 */

get_header(); 
brando_get_title_part();
$brando_enable_breadcrumb = brando_option('brando_enable_breadcrumb');
$brando_enable_title = brando_option('brando_enable_title_wrapper');
$brando_top_breadcrumb = ( $brando_enable_title != 1 && $brando_enable_title != 'default' ) ? ' page-top-breadcrumb': '';

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
    ?>
    <div class="breadcrumb alt-font<?php echo esc_attr($brando_top_breadcrumb); ?>">
        <div class="container">
            <ul>
                <?php echo wp_kses($brando_breadcrumb->display(), wp_kses_allowed_html( 'post' )); ?>
            </ul>
        </div>
    </div>
<?php
}
		// Start the loop.
while ( have_posts() ) : the_post();

    $brando_layout_settings = $brando_enable_container_fluid = $brando_class_main_section = $brando_section_class = '';
    $brando_layout_settings_inner = brando_option('brando_layout_settings');
    $brando_brando_options = get_option( 'brando_theme_setting' );
    
    $brando_layout_settings = $brando_layout_settings_inner;
    $brando_enable_container_fluid = brando_option('brando_enable_container_fluid');
    
    switch ($brando_layout_settings) {
        case 'brando_layout_full_screen':
            $brando_section_class .= ' no-padding';
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
?>
<section class="parent-section<?php echo esc_attr($brando_section_class); ?>">
    <div class="<?php echo esc_attr($brando_class_main_section); ?>">
        <div class="row">
            <?php get_template_part('templates/sidebar-left'); ?>
                <?php the_content(); ?>
                <?php
                    wp_link_pages( array(
                        'before'      => '<div class="page-links default-link-pages"><span class="page-links-title">' . esc_html__( 'Pages:', 'brando' ) . '</span>',
                        'after'       => '</div>',
                        'pagelink'    => '<span class="page-numbers">%</span>',
                    ) );
                    $brando_enable_comment = brando_option('brando_enable_page_comment');

                    if ( $brando_enable_comment == 1 && (comments_open() || get_comments_number()) ) :
                        ?>
                        <section class="border-top">
                            <div class="container">
                                <div class="row">
                                    <?php
                                        comments_template();
                                    ?>
                                </div>
                            </div>
                        </section>
                        <?php
                    endif;
                ?>
            <?php get_template_part('templates/sidebar-right'); ?>
        </div>
    </div>
</section>
<?php 
endwhile;
wp_reset_postdata();
// End the loop.
?>
<?php get_footer(); ?>
