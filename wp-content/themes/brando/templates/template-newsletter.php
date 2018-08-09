<?php 
/**
 * Template Name: Newsletter
 *
 * @package Brando
 */
if ( ! defined( 'ABSPATH' ) ) {
  exit; // Exit if accessed directly
}
get_header();?>
<?php 
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
    $brando_options = get_option( 'brando_theme_setting' );
    
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
        <section class="parent-section <?php echo esc_attr($brando_section_class); ?>">
            <div class="<?php echo esc_attr($brando_class_main_section); ?>">
                <div class="row">
                        <?php get_template_part('templates/sidebar-left'); ?>
                            <?php if( $_GET['result'] && $_GET['result'] == 'success' ){ ?>
                                <section class="no-padding">
                                    <div class="container">
                                        <div class="row">
                                            <section>
                                                <div class="container">
                                                    <div class="row">
                                                        <div class="col-md-7 col-sm-10 center-col email-subscribed">
                                                            <div class="alert-style1">
                                                                <div class="alert alert-success"><i class="icon-trophy"></i><?php the_content(); ?></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </section>
                                        </div>
                                    </div>
                                </section>
                            <?php } elseif( $_GET['result'] && $_GET['result'] == 'failure' ){ ?>
                                <section class="no-padding">
                                    <div class="container">
                                        <div class="row">
                                            <section>
                                                <div class="container">
                                                    <div class="row">
                                                        <div class="col-md-7 col-sm-10 center-col email-subscribed">
                                                            <div class="alert-style1">
                                                                <div class="alert alert-danger" role="alert"><i class="icon-sad"></i><?php the_content(); ?></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </section>
                                        </div>
                                    </div>
                                </section>
                            <?php }?>
                            <?php
                                wp_link_pages( array(
                                        'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'brando' ),
                                        'after'  => '</div>',
                                ) );
                                $brando_enable_comment = brando_option('brando_enable_page_comment');
                                if($brando_enable_comment == 'default'):
                                    $brando_enable_page_comment = (isset($brando_options['brando_enable_page_comment'])) ? $brando_options['brando_enable_page_comment'] : '';
                                else:
                                    $brando_enable_page_comment = $brando_enable_comment;
                                endif;
                                if ( $brando_enable_page_comment == 1 && (comments_open() || get_comments_number()) ) :
                                                comments_template();
                                endif;
                            ?>
                        <?php get_template_part('templates/sidebar-right'); ?>
                </div>
            </div>
    </section>
	
<?php endwhile; // end of the loop ?>
<?php get_footer(); ?>