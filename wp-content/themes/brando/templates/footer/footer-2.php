<?php
/**
 * Displaying footer type 2 section
 *
 * @package Brando
 */
?>
<?php
$brando_old_page_header_meta = $brando_classes = $brando_footer_bottom_class = $brando_footer_bg_image = '';
if(!empty($post)):
    $brando_old_page_header_meta = get_post_meta( $post->ID, 'brando_enable_page_footer_single', true);
endif;
if( $brando_old_page_header_meta != '' && strlen($brando_old_page_header_meta) > 0 ){
    $brando_enable_footer = brando_option('brando_enable_page_footer');
}else{
    $brando_enable_footer = 2;  
}
if($brando_enable_footer == 1 || $brando_enable_footer == '2'){
   
    $brando_footer_bg = brando_option('brando_footer_bg_image');
    if( is_array($brando_footer_bg) ){
        $brando_footer_bg_image = $brando_footer_bg['url'];
    }else{
        $brando_footer_bg_image = $brando_footer_bg;
    }

    if($brando_footer_bg_image):
            $brando_footer_bg_image =  'style="background-image:url('.esc_url($brando_footer_bg_image).')"';
            $brando_classes .= 'cover-background';
    endif;

    $brando_footer_text = brando_option('brando_footer_text');
    $brando_enable_footer_logo = brando_option('brando_enable_footer_logo');
    $brando_footer_logo = brando_option('brando_footer_logo');
    if(is_array($brando_footer_logo))
            $brando_footer_logo =  $brando_footer_logo['url'];

    $brando_footer_sidebar = brando_option('brando_footer_sidebar');
    $brando_enable_footer_copyright = brando_option('brando_enable_footer_copyright');
    $brando_footer_copyright = brando_option('brando_footer_copyright');
    $brando_enable_scrolltotop_button = brando_option('brando_enable_scrolltotop_button');
                   
?>
<footer class="<?php echo esc_attr($brando_classes); ?>" <?php echo wp_kses($brando_footer_bg_image, wp_kses_allowed_html( 'post' )); ?>>
    <?php if($brando_footer_bg_image): ?>
        <div class="opacity-light bg-dark-blue"></div>
    <?php endif; ?>
    <div class="footer-top position-relative">
        <div class="container">
            <div class="row">
            <?php if($brando_footer_text): ?>
                <div class="col-lg-3 col-md-4 col-sm-5 col-xs-12 text-center margin-three-bottom xs-margin-ten-bottom center-col">
                    <span class="text-uppercase alt-font text-large display-block medium-gray-text"><?php echo esc_attr($brando_footer_text); ?></span>
                </div>
            <?php endif; ?>
                <!-- social media link -->
                <?php if( !empty($brando_footer_sidebar) ){ ?>
                    <div class="col-md-12 col-sm-12 center-col text-center">
                        <?php dynamic_sidebar($brando_footer_sidebar); ?>
                    </div>
                <?php } ?>
                <!-- end social media link -->
            </div>
        </div>
    </div>
    <!-- footer logo -->
    <div class="footer-bottom no-padding position-relative">
        <div class="container">
            <div class="row border-top border-transperent-white-light padding-three-tb xs-padding-twelve-tb">
                <div class="col-md-12 col-sm-12 text-center margin-one-bottom">
                    <?php if($brando_enable_footer_logo): ?>
                        <a class="inner-link" href="#home">
                            <?php if($brando_footer_logo): ?>
                                <img src="<?php echo esc_url($brando_footer_logo); ?>" alt=""/>
                            <?php endif; ?>
                        </a>
                    <?php endif; ?>
                </div>
                <?php if($brando_enable_footer_copyright == 1): ?>
                    <div class="col-md-12 col-sm-12 text-center">
                        <span class="text-small text-uppercase letter-spacing-1 light-gray-text alt-font"><?php echo wp_kses($brando_footer_copyright, wp_kses_allowed_html( 'post' )); ?></span>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <!-- end footer logo -->
</footer>
<?php } ?>
<?php
    if( get_post_type( get_the_ID() ) == 'portfolio' && is_singular('portfolio') ){
        $brando_enable_ajax = get_post_meta( get_the_ID(),'brando_enable_ajax_popup_single',true);
    } else {
        $brando_enable_ajax = '';
    }
?>
<?php if( $brando_enable_scrolltotop_button == 1 && $brando_enable_ajax == ''){ ?>
<!-- scroll to top -->
    <a class="scrollToTop" href="javascript:void(0);">
        <i class="fa fa-angle-up"></i>
    </a>
<!-- scroll to top End... -->
<?php } ?>