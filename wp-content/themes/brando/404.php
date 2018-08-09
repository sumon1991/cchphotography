<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @package Brando
 */

get_header(); ?>
<?php
$brando_title_text = ( brando_option('404_title_text') ) ? '<p class="not-found-title white-text">'.brando_option('404_title_text').'</p>' : '';
$brando_content_text = ( brando_option('404_content_text') ) ? '<p class="title-small xs-title-small xs-display-none text-uppercase letter-spacing-2 white-text">'.brando_option('404_content_text').'</p>' : '';
$brando_img = brando_option('404_image');
$brando_image = ( $brando_img['url'] ) ? ' style="background-image: url('.esc_url($brando_img['url']).')"' : '';
$brando_bg_color = ( $brando_img['url'] ) ? '' : ' bg-dark-sky';
$brando_button = ( brando_option('404_button') ) ? brando_option('404_button') : esc_html__( 'Go to home page', 'brando' );
$brando_button_url = ( brando_option('404_button_url') ) ? get_permalink(get_page_by_path( brando_option('404_button_url') )) : home_url('/');
$brando_enable_text_button = brando_option('404_enable_text_button');
$brando_enable_search = brando_option('404_enable_search');


$brando_top_header_class = '';
$brando_options = get_option( 'brando_theme_setting' );
$brando_enable_header = (isset($brando_options['brando_enable_header'])) ? $brando_options['brando_enable_header'] : '';
$brando_header_layout = (isset($brando_options['brando_header_layout'])) ? $brando_options['brando_header_layout'] : '';
   
if($brando_enable_header == 1 && $brando_header_layout != 'headertype8')
{
    $brando_top_header_class .= 'content-top-margin';
}

?>
<?php // Start 404 Page Content ?>
<section class="no-padding cover-background full-screen page-not-found<?php echo wp_kses($brando_bg_color, wp_kses_allowed_html( 'post' )) ?>"<?php echo wp_kses($brando_image, wp_kses_allowed_html( 'post' )) ?>>
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-sm-12 col-xs-12 text-center center-col full-screen">
                <div class="col-text-center">
                    <div class="col-text-middle-main">
                        <div class="col-text-middle">
                            <?php echo wp_kses($brando_title_text, wp_kses_allowed_html( 'post' )); ?>
                            <?php echo wp_kses($brando_content_text, wp_kses_allowed_html( 'post' )); ?>
                            <div class="not-found-search-box">
                                <?php if( $brando_enable_text_button == 1 ): ?>
                                    <a class="btn-small-white btn btn-small no-margin-right" href="<?php echo esc_url( $brando_button_url );?>"><?php echo esc_attr( $brando_button ); ?></a>
                                <?php endif; ?>
                                <?php if( $brando_enable_text_button == 1 && $brando_enable_search == 1 ): ?>
                                    <div class="not-found-or-text"><?php echo esc_html__('or', 'brando'); ?></div>
                                <?php endif; ?>
                                <?php if( $brando_enable_search == 1 ): ?>
                                    <?php echo get_search_form( ); ?>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php // End 404 Page Content ?>
<?php get_footer(); ?>