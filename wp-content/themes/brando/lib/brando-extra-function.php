<?php
if ( ! function_exists( 'brando_set_header' ) ) :
    function brando_set_header( $brando_id )
    {
        if(get_post_type( $brando_id ) == 'portfolio' && is_singular('portfolio')){
            $brando_enable_ajax = get_post_meta($brando_id,'brando_enable_ajax_popup_single',true);
        }else{
            $brando_enable_ajax = '';
        }
    
        if($brando_enable_ajax == '1'){
            remove_all_actions('wp_head');
        }
    }
endif;

if ( ! function_exists( 'brando_set_footer' ) ) :
    function brando_set_footer( $brando_id ){
        if(get_post_type( $brando_id ) == 'portfolio' && is_singular('portfolio')){
            $brando_enable_ajax = get_post_meta($brando_id,'brando_enable_ajax_popup_single',true);
        }else{
            $brando_enable_ajax = '';
        }

        if($brando_enable_ajax == '1'){
            remove_all_actions('wp_footer');
            add_action('wp_footer','brando_hook_for_ajax_page');
        }
    }
endif;

if ( ! function_exists( 'brando_add_ajax_page_div_header' ) ) {
    function brando_add_ajax_page_div_header( $brando_id ){
        if( get_post_type( $brando_id ) == 'portfolio' && is_singular('portfolio') ){
            $brando_enable_ajax = get_post_meta($brando_id,'brando_enable_ajax_popup_single',true);
        }else{
            $brando_enable_ajax = '';
        }
        
        if($brando_enable_ajax == '1'){
            echo '<div class="bg-white">';
        }
    }
}

if ( ! function_exists( 'brando_add_ajax_page_div_footer' ) ) {
    function brando_add_ajax_page_div_footer( $brando_id ){
        if(get_post_type( $brando_id ) == 'portfolio' && is_singular('portfolio')){
            $brando_enable_ajax = get_post_meta($brando_id,'brando_enable_ajax_popup_single',true);
        }else{
            $brando_enable_ajax = '';
        }

        if($brando_enable_ajax == '1'){
            echo '</div>';
        }
    }
}

// For Title Tag
if( ! function_exists( 'brando_title_tag' ) ) : 
    function brando_title_tag( $brando_title ) {
        if ( ! defined('WPSEO_VERSION') ) {
            if ( $brando_title ) {
            } else {
                $brando_title = get_bloginfo( 'name' );
            }
        }
        return $brando_title;
    }
    add_filter( 'wp_title', 'brando_title_tag' );
endif;

if ( ! function_exists( 'brando_post_meta' ) ) :
    function brando_post_meta( $brando_option ){
        global $post;
        $brando_value = get_post_meta( $post->ID, $brando_option.'_single', true);
        return $brando_value;
    }
endif;

// Get the Post Tags

if ( ! function_exists( 'brando_single_post_meta_tag' ) ) :
function brando_single_post_meta_tag() 
{
    ?>
        <div class="margin-six-bottom">
          <?php                          
            $brando_tags_list = get_the_tag_list( '', _x( ', ', 'Used between list items, there is a space after the comma.', 'brando' ) );
            if ( $brando_tags_list ) 
            {
                printf( '%1$s %2$s',
                    _x( '<h5 class="alt-font text-extra-large dark-gray-text no-margin">Tags</h5>', 'Used before tag names.', 'brando' ),
                    $brando_tags_list
                );
            }
            ?>
        </div>
        <?php
    }
endif;

if ( ! function_exists( 'brando_single_portfolio_meta_tag' ) ) :

    function brando_single_portfolio_meta_tag() 
    {
        global $post;
        $brando_portfolio_tag_list = get_the_term_list($post->ID, 'portfolio-tags', '<h5 class="alt-font text-extra-large dark-gray-text">Tags</h5>', ', ', '');
        if($brando_portfolio_tag_list):
            $output = '<div class="margin-six-bottom">';
                $output .= get_the_term_list($post->ID, 'portfolio-tags', '<h5 class="alt-font text-extra-large dark-gray-text">Tags</h5>', ', ', '');
            $output .= '</div>';
            return $output;
        endif;
       
    }
endif;

add_filter( "term_links-post_tag", 'brando_add_tag_class');
if ( ! function_exists( 'brando_add_tag_class' ) ) {
    function brando_add_tag_class($brando_links) 
    {
        return str_replace('<a href="', '<a class="text-small text-uppercase alt-font" href="', $brando_links);
    }
}

if ( ! function_exists( 'brando_option_url' ) ) {
    function brando_option_url($brando_option) {
        $brando_image = brando_option($brando_option);
        if (is_array($brando_image) && isset($brando_image['url']) && !empty($brando_image['url'])) {
            return $brando_image['url'];
        }
        return false;
    }
}

if ( ! function_exists( 'brando_option' ) ) :
    function brando_option( $brando_option )
    {
        global $brando_theme_settings, $post;
        $brando_single = false;
        if(is_singular()){
            $brando_value = get_post_meta( $post->ID, $brando_option.'_single', true);
            $brando_single = true;
        }

        if($brando_single == true){
            if (is_string($brando_value) && (strlen($brando_value) > 0 || is_array($brando_value)) && $brando_value != 'default') {
                return $brando_value;
            }
        }
        if(isset($brando_theme_settings[$brando_option]) && $brando_theme_settings[$brando_option] != ''){
            $brando_option_value = $brando_theme_settings[$brando_option];
            return $brando_option_value;
        }
        return false;
    }
endif;


if ( ! function_exists( 'brando_option_post' ) ) {
    function brando_option_post( $brando_option ){
        global $brando_theme_settings, $post;
        $brando_option_post = '';
        $brando_single = false;
        if(is_singular()){
            $brando_value = get_post_meta( $post->ID, $brando_option.'_single', true);
            $brando_single = true;
        }

        if($brando_single == true){
            if (is_string($brando_value) && (strlen($brando_value) > 0 || is_array($brando_value)) && ($brando_value != 'default')  ) {
                return $brando_value;
            }
        }
        $brando_option_post = $brando_option.'_post';
        if(isset($brando_theme_settings[$brando_option_post]) && $brando_theme_settings[$brando_option_post] != ''){
            $brando_option_value = $brando_theme_settings[$brando_option_post];
            return $brando_option_value;
        }
        return false;
    }
}

if ( ! function_exists( 'brando_option_portfolio' ) ) {
    function brando_option_portfolio( $brando_option ){
        global $brando_theme_settings, $post;
        $brando_option_post = '';
        $brando_single = false;

        if(is_singular()){
            $brando_value = get_post_meta( $post->ID, $brando_option.'_single', true);
            $brando_single = true;
        }

        if($brando_single == true){
            if (is_string($brando_value) && (strlen($brando_value) > 0 || is_array($brando_value)) && ($brando_value != 'default')  ) {
                return $brando_value;
            }
        }
        $brando_option_post = $brando_option.'_portfolio';
        if(isset($brando_theme_settings[$brando_option_post]) && $brando_theme_settings[$brando_option_post] != ''){
            $brando_option_value = $brando_theme_settings[$brando_option_post];
            return $brando_option_value;
        }
        return false;
    }
}

if( ! function_exists( 'brando_script_add_data' ) ) :

function brando_script_add_data( $brando_handle, $brando_key, $brando_value ) {
    global $wp_scripts;
    return $wp_scripts->add_data( $brando_handle, $brando_key, $brando_value );
}

endif; // ! function_exists( 'brando_script_add_data' )

/* For Image Alt Text */
if ( ! function_exists( 'brando_option_image_alt' ) ) {
    function brando_option_image_alt( $brando_attachment_id ){
        global $brando_theme_settings;
        $brando_img_info = '';
        $brando_option = 'enable_image_alt';
        if(isset($brando_theme_settings[$brando_option]) && $brando_theme_settings[$brando_option] != ''){
            $brando_option_value = $brando_theme_settings[$brando_option];
            if(wp_attachment_is_image($brando_attachment_id)){
                $brando_img_info = array(
                    'alt' => get_post_meta( $brando_attachment_id, '_wp_attachment_image_alt', true ),
                );
            }
            if($brando_option_value == '1'){
                return $brando_img_info;
            }else{
                return;
            }
        }
        return;
    }
}

/* For Image Title */
if ( ! function_exists( 'brando_option_image_title' ) ) {
    function brando_option_image_title( $brando_attachment_id ){
        global $brando_theme_settings;
        $brando_img_info = '';
        $brando_option = 'enable_image_title';
        if(isset($brando_theme_settings[$brando_option]) && $brando_theme_settings[$brando_option] != ''){
            $brando_option_value = $brando_theme_settings[$brando_option];
            if(wp_attachment_is_image($brando_attachment_id)){
                $brando_attachment = get_post( $brando_attachment_id );
                $brando_img_info = array(
                    'title' => esc_attr($brando_attachment->post_title),
                );
            }
            if($brando_option_value == '1'){
                return $brando_img_info;
            }else{
                return;
            }
        }
        return;
    }
}

/* For Image Caption */
if ( ! function_exists( 'brando_option_image_caption' ) ) {
    function brando_option_image_caption( $brando_attachment_id ){
        global $brando_theme_settings;
        $brando_img_info = '';
        $brando_option = 'enable_lightbox_caption';
        if(isset($brando_theme_settings[$brando_option]) && $brando_theme_settings[$brando_option] != ''){
            $brando_option_value = $brando_theme_settings[$brando_option];
            if(wp_attachment_is_image($brando_attachment_id)){
                $brando_attachment = get_post( $brando_attachment_id );
                $brando_img_info = array(
                    'caption' => esc_attr($brando_attachment->post_excerpt),
                );
            }
            if($brando_option_value == '1'){
                return $brando_img_info;
            }else{
                return;
            }
        }
        return;
    }
}

/* For Lightbox Image Title */
if ( ! function_exists( 'brando_option_lightbox_image_title' ) ) {
    function brando_option_lightbox_image_title( $brando_attachment_id ){
        global $brando_theme_settings, $post;
        $brando_img_info = '';
        $brando_option = 'enable_lightbox_title';
        if(isset($brando_theme_settings[$brando_option]) && $brando_theme_settings[$brando_option] != ''){
            $brando_option_value = $brando_theme_settings[$brando_option];
            if(wp_attachment_is_image($brando_attachment_id)){
                $brando_attachment = get_post( $brando_attachment_id );
                $brando_img_info = array(
                    'title' => esc_attr($brando_attachment->post_title),
                );
            }
            if($brando_option_value == '1'){
                return $brando_img_info;
            }else{
                return;
            }
        }
        return;
    }
}

/* page title option for individual pages*/
if ( ! function_exists( 'brando_get_title_part' ) ) :
    function brando_get_title_part(){
        
        $brando_enable_head =  brando_option('brando_enable_header');
        if($brando_enable_head == '1' || $brando_enable_head == 'defalut'){
            $brando_enable_header =  brando_option('brando_enable_header');
            $brando_header_layout =  brando_option('brando_header_layout');
            
            if($brando_enable_head == 'default'){
                $brando_options = get_option( 'brando_theme_setting' );
                $brando_enable_header = (isset($brando_options['brando_enable_header'])) ? $brando_options['brando_enable_header'] : '';
            }
            
        }

        $brando_enable_title = brando_option('brando_enable_title_wrapper');
        if($brando_enable_title == 'default'){
            $brando_options = get_option( 'brando_theme_setting' );
            $brando_enable_title = (isset($brando_options['brando_enable_title_wrapper'])) ? $brando_options['brando_enable_title_wrapper'] : '';
        }
        if($brando_enable_title == 0 || is_404())
            return;
        
        $brando_page_title = get_the_title();

        $output = '';
        $brando_page_title_image = brando_option('brando_title_background');
        if(is_array($brando_page_title_image))
                $brando_page_title_image =  $brando_page_title_image['url'];
        

        $brando_title_parallax_effect = brando_option('brando_title_parallax_effect');
        $brando_page_subtitle = brando_option('brando_header_subtitle');

        echo '<section class="'.esc_attr($brando_title_parallax_effect).' parallax-fix no-padding">';
        if( $brando_page_title_image ): 
            echo '<img class="parallax-background-img" src="'.esc_url($brando_page_title_image).'" alt="" />';
        endif;
            echo '<div class="opacity-full-dark bg-deep-blue3"></div>';
            echo '<div class="container position-relative">';
                echo '<div class="row">';
                    echo '<div class="page-title">';
                        echo '<div class="col-text-middle-main">';
                            echo '<div class="col-text-middle">';
                                echo '<div class="col-md-12 col-sm-12 text-center">';
                                    echo '<h2 class="alt-font white-text font-weight-600 xs-title-extra-large no-margin">'.esc_attr($brando_page_title).'</h2>';
                                    echo '<div class="alt-font title-small xs-text-large white-text text-uppercase margin-one-top display-block">'.esc_attr($brando_page_subtitle).'</div>';
                                echo '</div>';
                            echo '</div>';
                        echo '</div>';
                    echo '</div>';
                echo '</div>';
            echo '</div>';
        echo '</section>';
    }
endif;

/* Hook For ajax page */
if ( ! function_exists( 'brando_hook_for_ajax_page' ) ) :
    function brando_hook_for_ajax_page() {
        
        echo "<script>
        'use strict';
        $(document).ready(function () {
                $('.owl-pagination > .owl-page').click(function (e) {
                    if ($(e.target).is('.mfp-close'))
                        return;
                    return false;
                });
                $('.owl-buttons > .owl-prev').click(function (e) {
                    if ($(e.target).is('.mfp-close'))
                        return;
                    return false;
                });
                $('.owl-buttons > .owl-next').click(function (e) {
                    if ($(e.target).is('.mfp-close'))
                        return;
                    return false;
                });

            SetResizeContent();
            });

            function SetResizeContent() {
                var minheight = $(window).height();
                $('.full-screen').css('min-height', minheight);
            }
            </script>";
    }
endif;

if ( ! function_exists( 'brando_owl_pagination_slider_classes' ) ) :
    function brando_owl_pagination_slider_classes( $brando_pagination_color ){
        $brando_class_list = '';

        switch($brando_pagination_color)
        {
            case 0:
                $brando_class_list .= ' dot-pagination';
            break;

            case 1:
                $brando_class_list .= ' square-pagination';
            break;

            case 2:
                $brando_class_list .= ' round-pagination';
            break;

            default:
                $brando_class_list .= ' dot-pagination';
                break;
        }

        return $brando_class_list;
    }
endif;

if ( ! function_exists( 'brando_owl_pagination_color_classes' ) ) :
    function brando_owl_pagination_color_classes( $brando_pagination ){
        $brando_class_list = '';

        switch($brando_pagination)
        {
            case 0:
                $brando_class_list .= ' dark-pagination';
                break;

            case 1:
                $brando_class_list .= ' light-pagination';
                break;

            default:
                $brando_class_list .= ' dark-pagination';
                break;
        }
        return $brando_class_list;
    }
endif;

if ( ! function_exists( 'brando_owl_navigation_slider_classes' ) ) :
    function brando_owl_navigation_slider_classes ($brando_navigation){
        $brando_class_list = '';

        switch($brando_navigation)
        {
            case 0:
                $brando_class_list .= ' dark-navigation';
                break;

            case 1:
                $brando_class_list .= ' light-navigation';
                break;

            default:
                $brando_class_list .= ' dark-navigation';
                break;
        }

        return $brando_class_list;
    }
endif;

add_action( 'wp_before_admin_bar_render', 'brando_remove_customizer_adminbar' ); 

if ( ! function_exists( 'brando_remove_customizer_adminbar' ) ) {
    function brando_remove_customizer_adminbar()
    {
        global $wp_admin_bar;
        $wp_admin_bar->remove_menu('customize');
    }
}

if( ! function_exists( 'brando_remove_wpautop' ) ) :
  function brando_remove_wpautop( $content, $force_br = true ) {
    if ( $force_br ) {
      $content = wpautop( preg_replace( '/<\/?p\>/', "\n", $content ) . "\n" );
    }
    return do_shortcode( shortcode_unautop( $content ) );
  }
endif;

/* For enqueue media for file upload */
if( is_admin() && ! empty ( $_SERVER['PHP_SELF'] ) && 'upload.php' !== basename( $_SERVER['PHP_SELF'] ) ) {
    function brando_load_styles_and_scripts() {
        wp_enqueue_media();
    }
    add_action( 'admin_enqueue_scripts', 'brando_load_styles_and_scripts' );
}

// Check if Brando-addons Plugin active or not.
if(!class_exists('Brando_Addons')){
    if ( ! function_exists( 'brando_get_simple_likes_button' ) ) :
        function brando_get_simple_likes_button( $id ) {
            return;
        }
    endif;
}

if ( ! function_exists( 'brando_get_the_excerpt_theme' ) ) :
    function brando_get_the_excerpt_theme($brando_length)
    {
        return brando_Excerpt::brando_get_by_length($brando_length);
    }
endif;

if ( ! function_exists( 'brando_registered_sidebars_array' ) ) :
function brando_registered_sidebars_array() {
    global $wp_registered_sidebars;
    if( ! empty( $wp_registered_sidebars ) && is_array( $wp_registered_sidebars ) ){ 
        $brando_sidebar_array = array();
        $brando_sidebar_array['default'] = 'Default';
        foreach( $wp_registered_sidebars as $sidebar ){
            $brando_sidebar_array[$sidebar['id']] = $sidebar['name'];
        }
    }
    return $brando_sidebar_array;
}
endif;

add_filter('wp_list_categories', 'brando_add_new_class_list_categories');
if ( ! function_exists( 'brando_add_new_class_list_categories' ) ) :
    function brando_add_new_class_list_categories($brando_list) {
        $brando_list = str_replace('cat-item ', 'cat-item category-list ', $brando_list); 
        return $brando_list;
    }
endif;

if ( ! function_exists( 'brando_tag_cloud_filter' ) ):
    function brando_tag_cloud_filter($return, $args)
    {
      return '<div class="widget-body tags">'.$return.'</div>';
    }
endif;
add_filter('wp_tag_cloud','brando_tag_cloud_filter', 10, 2);


/* Add custom field in tag */

add_action( 'post_tag_add_form_fields', 'brando_post_tag_add_new_meta_field', 10, 2 );

if ( ! function_exists( 'brando_post_tag_add_new_meta_field' ) ) :
    function brando_post_tag_add_new_meta_field() {
        // this will add the custom meta field to the add new term page
        ?>
        <div class="form-field">
            <label for="term_meta[image_url]"><?php esc_html_e( 'Add Category Image', 'brando' ); ?></label>
            <img class="upload_image_screenshort"/>
            <input type="hidden" name="term_meta[image_url]" id="image_url" class="regular-text">
            <input type="button" name="upload-btn-cat" id="upload-btn-cat" class="button-secondary-cat brando_upload_image" value="Upload Image">
            <input type="button" name="remove-btn-cat" id="remove-btn-cat" class="brando_remove_button button-secondary-cat" value="Remove Image">
        </div>
    <?php
    }
endif;

if ( ! function_exists( 'brando_post_tag_edit_meta_field' ) ) :
    function brando_post_tag_edit_meta_field($term) {
     
        // put the term ID into a variable
        $brando_t_id = $term->term_id;
     
        // retrieve the existing value(s) for this meta field. This returns an array
        $brando_term_meta = get_option( "brando_post_tag_$brando_t_id" ); ?>
        <?php
        $brando_img_url = esc_attr( $brando_term_meta['image_url'] ) ? 'src = "'.esc_attr( $brando_term_meta['image_url'] ).'"' : '';
        ?>
        <tr class="form-field">
            <th scope="row" valign="top"><label for="term_meta[custom_term_meta]"><?php esc_html_e( 'Add Category Image', 'brando' ); ?></label></th>
            <td>
                <img class="upload_image_screenshort" <?php echo wp_kses($brando_img_url, wp_kses_allowed_html( 'post' )); ?> width="200" />
                <input type="hidden" name="term_meta[image_url]" value="<?php echo esc_attr( $brando_term_meta['image_url'] ) ? esc_attr( $brando_term_meta['image_url'] ) : ''; ?>" id="image_url" class="regular-text" >
                <input type="button" name="upload-btn-cat" id="upload-btn-cat" class="button-secondary brando_upload_image" value="Upload Image">
                <input type="button" name="remove-btn-cat" id="remove-btn-cat" class="brando_remove_button button-secondary" value="Remove Image">
            </td>
        </tr>
    <?php
    }
endif;
add_action( 'post_tag_edit_form_fields', 'brando_post_tag_edit_meta_field', 10, 2 );

if ( ! function_exists( 'brando_save_post_tag_custom_meta' ) ) :
    function brando_save_post_tag_custom_meta( $brando_term_id ) {
        if ( isset( $_POST['term_meta'] ) ) {
            $brando_t_id = $brando_term_id;
            $brando_term_meta = get_option( "brando_post_tag_$brando_t_id" );
            $brando_cat_keys = array_keys( $_POST['term_meta'] );
            foreach ( $brando_cat_keys as $key ) {
                if ( isset ( $_POST['term_meta'][$key] ) ) {
                    $brando_term_meta[$key] = $_POST['term_meta'][$key];
                }
            }
            // Save the option array.
            update_option( "brando_post_tag_$brando_t_id", $brando_term_meta );
        }
    }  
endif;
add_action( 'edited_post_tag', 'brando_save_post_tag_custom_meta', 10, 2 );  
add_action( 'create_post_tag', 'brando_save_post_tag_custom_meta', 10, 2 );

/* Add custom field in category */

add_action( 'category_add_form_fields', 'brando_taxonomy_add_new_meta_field', 10, 2 );
if ( ! function_exists( 'brando_taxonomy_add_new_meta_field' ) ) :
    function brando_taxonomy_add_new_meta_field() {
        // this will add the custom meta field to the add new term page
        ?>
        <div class="form-field">
            <label for="term_meta[image_url]"><?php esc_html_e( 'Add Category Image', 'brando' ); ?></label>
            <img class="upload_image_screenshort"/>
            <input type="hidden" name="term_meta[image_url]" id="image_url" class="regular-text">
            <input type="button" name="upload-btn-cat" id="upload-btn-cat" class="button-secondary-cat brando_upload_image" value="Upload Image">
            <input type="button" name="remove-btn-cat" id="remove-btn-cat" class="brando_remove_button button-secondary-cat" value="Remove Image">
        </div>
    <?php
    }
endif;

if ( ! function_exists( 'brando_taxonomy_edit_meta_field' ) ) :
    function brando_taxonomy_edit_meta_field($term) {
     
        // put the term ID into a variable
        $brando_t_id = $term->term_id;
     
        // retrieve the existing value(s) for this meta field. This returns an array
        $brando_term_meta = get_option( "brando_taxonomy_$brando_t_id" ); ?>
        <?php
        $brando_img_url = esc_attr( $brando_term_meta['image_url'] ) ? 'src = "'.esc_attr( $brando_term_meta['image_url'] ).'"' : '';
        ?>
        <tr class="form-field">
            <th scope="row" valign="top"><label for="term_meta[custom_term_meta]"><?php esc_html_e( 'Add Category Image', 'brando' ); ?></label></th>
            <td>
                <img class="upload_image_screenshort" <?php echo wp_kses($brando_img_url, wp_kses_allowed_html( 'post' )); ?> width="200" />
                <input type="hidden" name="term_meta[image_url]" value="<?php echo esc_attr( $brando_term_meta['image_url'] ) ? esc_attr( $brando_term_meta['image_url'] ) : ''; ?>" id="image_url" class="regular-text" >
                <input type="button" name="upload-btn-cat" id="upload-btn-cat" class="button-secondary-cat brando_upload_image" value="Upload Image">
                <input type="button" name="remove-btn-cat" id="remove-btn-cat" class="brando_remove_button button-secondary-cat" value="Remove Image">
            </td>
        </tr>
            
    <?php
    }
endif;

add_action( 'category_edit_form_fields', 'brando_taxonomy_edit_meta_field', 10, 2 );

if ( ! function_exists( 'brando_save_taxonomy_custom_meta' ) ) :
    function brando_save_taxonomy_custom_meta( $brando_term_id ) {
        if ( isset( $_POST['term_meta'] ) ) {
            $brando_t_id = $brando_term_id;
            $brando_term_meta = get_option( "brando_taxonomy_$brando_t_id" );
            $brando_cat_keys = array_keys( $_POST['term_meta'] );
            foreach ( $brando_cat_keys as $key ) {
                if ( isset ( $_POST['term_meta'][$key] ) ) {
                    $brando_term_meta[$key] = $_POST['term_meta'][$key];
                }
            }
            // Save the option array.
            update_option( "brando_taxonomy_$brando_t_id", $brando_term_meta );
        }
    }  
endif;
add_action( 'edited_category', 'brando_save_taxonomy_custom_meta', 10, 2 );  
add_action( 'create_category', 'brando_save_taxonomy_custom_meta', 10, 2 );


/* Add custom field in portfolio tag */

add_action( 'portfolio-tags_add_form_fields', 'brando_portfolio_tag_add_new_meta_field', 10, 2 );

if ( ! function_exists( 'brando_portfolio_tag_add_new_meta_field' ) ) :
    function brando_portfolio_tag_add_new_meta_field() {
        // this will add the custom meta field to the add new term page
        ?>
        <div class="form-field">
            <label for="term_meta[image_url]"><?php esc_html_e( 'Add Category Image', 'brando' ); ?></label>
            <img class="upload_image_screenshort"/>
            <input type="hidden" name="term_meta[image_url]" id="image_url" class="regular-text">
            <input type="button" name="upload-btn-cat" id="upload-btn-cat" class="button-secondary-cat brando_upload_image" value="Upload Image">
            <input type="button" name="remove-btn-cat" id="remove-btn-cat" class="brando_remove_button button-secondary-cat" value="Remove Image">
        </div>
    <?php
    }
endif;

if ( ! function_exists( 'brando_portfolio_tag_edit_meta_field' ) ) :
    function brando_portfolio_tag_edit_meta_field($term) {
     
        // put the term ID into a variable
        $brando_t_id = $term->term_id;
     
        // retrieve the existing value(s) for this meta field. This returns an array
        $brando_term_meta = get_option( "brando_portfolio_tag_$brando_t_id" ); ?>
        <?php
        $brando_img_url = esc_attr( $brando_term_meta['image_url'] ) ? 'src = "'.esc_attr( $brando_term_meta['image_url'] ).'"' : '';
        ?>
        <tr class="form-field">
            <th scope="row" valign="top"><label for="term_meta[custom_term_meta]"><?php esc_html_e( 'Add Category Image', 'brando' ); ?></label></th>
            <td>
                <img class="upload_image_screenshort" <?php echo wp_kses($brando_img_url, wp_kses_allowed_html( 'post' )); ?> width="200" />
                <input type="hidden" name="term_meta[image_url]" value="<?php echo esc_attr( $brando_term_meta['image_url'] ) ? esc_attr( $brando_term_meta['image_url'] ) : ''; ?>" id="image_url" class="regular-text" >
                <input type="button" name="upload-btn-cat" id="upload-btn-cat" class="button-secondary brando_upload_image" value="Upload Image">
                <input type="button" name="remove-btn-cat" id="remove-btn-cat" class="brando_remove_button button-secondary" value="Remove Image">
            </td>
        </tr>
    <?php
    }
endif;
add_action( 'portfolio-tags_edit_form_fields', 'brando_portfolio_tag_edit_meta_field', 10, 2 );

if ( ! function_exists( 'brando_save_portfolio_tag_custom_meta' ) ) :
    function brando_save_portfolio_tag_custom_meta( $brando_term_id ) {
        if ( isset( $_POST['term_meta'] ) ) {
            $brando_t_id = $brando_term_id;
            $brando_term_meta = get_option( "brando_portfolio_tag_$brando_t_id" );
            $brando_cat_keys = array_keys( $_POST['term_meta'] );
            foreach ( $brando_cat_keys as $key ) {
                if ( isset ( $_POST['term_meta'][$key] ) ) {
                    $brando_term_meta[$key] = $_POST['term_meta'][$key];
                }
            }
            // Save the option array.
            update_option( "brando_portfolio_tag_$brando_t_id", $brando_term_meta );
        }
    }  
endif;
add_action( 'edited_portfolio-tags', 'brando_save_portfolio_tag_custom_meta', 10, 2 );  
add_action( 'create_portfolio-tags', 'brando_save_portfolio_tag_custom_meta', 10, 2 );


/* Add custom field in portfolio category */

add_action( 'portfolio-category_add_form_fields', 'brando_portfolio_taxonomy_add_new_meta_field', 10, 2 );
if ( ! function_exists( 'brando_portfolio_taxonomy_add_new_meta_field' ) ) :
    function brando_portfolio_taxonomy_add_new_meta_field() {
        // this will add the custom meta field to the add new term page
        ?>
        <div class="form-field">
            <label for="term_meta[image_url]"><?php esc_html_e( 'Add Category Image', 'brando' ); ?></label>
            <img class="upload_image_screenshort"/>
            <input type="hidden" name="term_meta[image_url]" id="image_url" class="regular-text">
            <input type="button" name="upload-btn-cat" id="upload-btn-cat" class="button-secondary-cat brando_upload_image" value="Upload Image">
            <input type="button" name="remove-btn-cat" id="remove-btn-cat" class="brando_remove_button button-secondary-cat" value="Remove Image">
        </div>
    <?php
    }
endif;

if ( ! function_exists( 'brando_portfolio_taxonomy_edit_meta_field' ) ) :
    function brando_portfolio_taxonomy_edit_meta_field($term) {
     
        // put the term ID into a variable
        $brando_t_id = $term->term_id;
     
        // retrieve the existing value(s) for this meta field. This returns an array
        $brando_term_meta = get_option( "brando_portfolio_taxonomy_$brando_t_id" ); ?>
        <?php
        $brando_img_url = esc_attr( $brando_term_meta['image_url'] ) ? 'src = "'.esc_attr( $brando_term_meta['image_url'] ).'"' : '';
        ?>
        <tr class="form-field">
            <th scope="row" valign="top"><label for="term_meta[custom_term_meta]"><?php esc_html_e( 'Add Category Image', 'brando' ); ?></label></th>
            <td>
                <img class="upload_image_screenshort" <?php echo wp_kses($brando_img_url, wp_kses_allowed_html( 'post' )); ?> width="200" />
                <input type="hidden" name="term_meta[image_url]" value="<?php echo esc_attr( $brando_term_meta['image_url'] ) ? esc_attr( $brando_term_meta['image_url'] ) : ''; ?>" id="image_url" class="regular-text" >
                <input type="button" name="upload-btn-cat" id="upload-btn-cat" class="button-secondary-cat brando_upload_image" value="Upload Image">
                <input type="button" name="remove-btn-cat" id="remove-btn-cat" class="brando_remove_button button-secondary-cat" value="Remove Image">
            </td>
        </tr>
            
    <?php
    }
endif;

add_action( 'portfolio-category_edit_form_fields', 'brando_portfolio_taxonomy_edit_meta_field', 10, 2 );

if ( ! function_exists( 'brando_save_portfolio_taxonomy_custom_meta' ) ) :
    function brando_save_portfolio_taxonomy_custom_meta( $brando_term_id ) {
        if ( isset( $_POST['term_meta'] ) ) {
            $brando_t_id = $brando_term_id;
            $brando_term_meta = get_option( "brando_portfolio_taxonomy_$brando_t_id" );
            $brando_cat_keys = array_keys( $_POST['term_meta'] );
            foreach ( $brando_cat_keys as $key ) {
                if ( isset ( $_POST['term_meta'][$key] ) ) {
                    $brando_term_meta[$key] = $_POST['term_meta'][$key];
                }
            }
            // Save the option array.
            update_option( "brando_portfolio_taxonomy_$brando_t_id", $brando_term_meta );
        }
    }  
endif;
add_action( 'edited_portfolio-category', 'brando_save_portfolio_taxonomy_custom_meta', 10, 2 );  
add_action( 'create_portfolio-category', 'brando_save_portfolio_taxonomy_custom_meta', 10, 2 );

add_action('admin_enqueue_scripts', 'brando_admin_script_loader');
if ( ! function_exists( 'brando_admin_script_loader' ) ) :
    function brando_admin_script_loader() {
        if (is_admin()) {
            wp_register_script('brando-admin-custom-js', get_template_directory_uri().'/assets/js/custom.js', array('jquery'));
            wp_enqueue_script('brando-admin-custom-js');

            // Enqueue ET-Line Style For WP Admin.
            wp_enqueue_style( 'brando-line-icons-style', BRANDO_THEME_CSS_URI . '/et-line-icons.css',null, BRANDO_THEME_VERSION);
            // Enqueue elusive webfont Style For WP Admin.
            wp_enqueue_style( 'redux-elusive-icon', ReduxFramework::$_url . 'assets/css/vendor/elusive-icons/elusive-webfont.css');
            // Register Style For WP Admin.
            wp_register_style( 'custom_wp_admin_css', BRANDO_THEME_CSS_URI . '/custom-admin-style.css', false, BRANDO_THEME_VERSION );
            // Enqueue Style For WP Admin.
            wp_enqueue_style( 'custom_wp_admin_css' );
            wp_register_style( 'brando-font-awesome-style', BRANDO_THEME_CSS_URI . '/font-awesome.min.css',null, '4.7.0');
            wp_enqueue_style( 'brando-font-awesome-style' );
            
        }
    }
endif;

/* Dequeue VC font awesome style */
if ( ! function_exists( 'brando_dequeue_vc_style' ) ) :
    function brando_dequeue_vc_style() {
       wp_dequeue_style( 'font-awesome' );
    }
endif;
add_action( 'wp_print_scripts', 'brando_dequeue_vc_style', 100 );


/* For Wordpress4.4 move comment textarea bottom */
if ( ! function_exists( 'brando_move_comment_field_to_bottom' ) ) {
    function brando_move_comment_field_to_bottom( $brando_fields ) {
        $brando_comment_field = $brando_fields['comment'];
        unset( $brando_fields['comment'] );
        $brando_fields['comment'] = $brando_comment_field;
        return $brando_fields;
    }
}
add_filter( 'comment_form_fields', 'brando_move_comment_field_to_bottom' );

if ( ! function_exists( 'brando_theme_comment' ) ) {
    function brando_theme_comment($comment, $args, $depth) {
        
        $GLOBALS['comment'] = $comment;
        extract($args, EXTR_SKIP);

        if ( 'div' == $args['style'] ) {
            $tag = 'div';
            $add_below = 'comment';
        } else {
            $tag = 'li';
            $add_below = 'div-comment';
        }
        

    ?>

     <<?php echo esc_attr($tag) ?> <?php comment_class( empty( $args['has_children'] ) ? 'blog-comment' : 'blog-comment parent' ) ?> id="comment-<?php comment_ID() ?>">
        <?php if ( 'div' != $args['style'] ) : ?>
    <div id="div-comment-<?php comment_ID() ?>" class="comment-body">
        <?php endif; ?>
        <div class="blog-comment-main xs-no-padding-top">
          <div class="blog-comment">
            <div class="comment-avtar">
            <?php if ( $args['avatar_size'] != 0 ) echo get_avatar( $comment, $args['avatar_size'] );   ?>
            </div>
            <?php if ( $comment->comment_approved == '0' ) : ?>
                <em class="comment-awaiting-moderation"><?php esc_html_e( 'Your comment is awaiting moderation.', 'brando' ); ?></em>
                <br />
            <?php endif; ?>
            <div class="comment-text overflow-hidden position-relative">
              <div class="comment-meta commentmetadata">  
                    <a class="blog-comment-name alt-font text-uppercase text-medium dark-gray-text" href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ); ?>">
                    <?php printf( esc_html__( '%s ', 'brando' ), get_comment_author_link() ); ?>
                    </a> 
                    <span class="alt-font text-medium dark-gray-text">
                    <?php
                    /* translators: 1: date, 2: time */
                    printf( esc_html__('%1$s','brando'), get_comment_date(),  get_comment_time() ); 
                    ?>
                    </span>
              </div>
               
                <div class="margin-three-tb"><?php comment_text(); ?></div>
             <?php comment_reply_link( array_merge( $args, array( 'add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) );  ?>
            </div>
        </div>
    </div>

        <?php if ( 'div' != $args['style'] ) : ?>
        </div>
        <?php endif; ?>
        
    <?php
    }
}


// filter to replace class on reply link
add_filter('comment_reply_link', 'brando_replace_reply_link_class');
if ( ! function_exists( 'brando_replace_reply_link_class' ) ) {
    function brando_replace_reply_link_class($brando_class){
        $brando_class = str_replace("class='comment-reply-link", "class='btn-black btn btn-very-small no-margin inner-link", $brando_class);
        return $brando_class;
    }
}
// filter to replace class on reply text
if ( ! function_exists( 'brando_reply_to_comment_link' ) ):
    function brando_reply_to_comment_link( $link, $args, $comment ) {
        if ( !empty( $comment->comment_type ) )
            return '<div class="btn-black btn btn-very-small no-margin inner-link">' . $link . '</div>';
        $link = str_replace( '>' . $args['reply_text']  . '<', '>' . esc_html( 'Post Reply'  ) . '<', $link );
        return $link;
    }
endif;
add_filter( 'comment_reply_link', 'brando_reply_to_comment_link', 10, 3 );
/* For Customize archive post settings */

if ( ! function_exists( 'brando_posts_customize' ) ):
    function brando_posts_customize($query) {
        $brando_options = get_option( 'brando_theme_setting' );
        if( !is_admin() && $query->is_main_query()):
            if ((is_category() || is_archive() || is_author() || is_tag())) {
                if ( get_query_var('paged') ) { $paged = get_query_var('paged'); } else if ( get_query_var('page') ) {$paged = get_query_var('page'); } else {$paged = 1; }
                $brando_item_per_page = (isset($brando_options['brando_general_item_per_page'])) ? $brando_options['brando_general_item_per_page'] : '';
                $query->set('posts_per_page', $brando_item_per_page);
                $query->set('paged', $paged);
            }
            if( is_home() ){
                if ( get_query_var('paged') ) { $paged = get_query_var('paged'); } else if ( get_query_var('page') ) {$paged = get_query_var('page'); } else {$paged = 1; }
                $brando_item_per_page = (isset($brando_options['brando_blog_page_item_per_page'])) ? $brando_options['brando_blog_page_item_per_page'] : '';
                $query->set('posts_per_page', $brando_item_per_page);
                $query->set('paged', $paged);
            }
            
            if(is_search()):
                if ( get_query_var('paged') ) { $paged = get_query_var('paged'); } else if ( get_query_var('page') ) {$paged = get_query_var('page'); } else {$paged = 1; }
                $brando_item_per_page = (isset($brando_options['brando_general_item_per_page'])) ? $brando_options['brando_general_item_per_page'] : '';
                $query->set('posts_per_page', $brando_item_per_page);
                $query->set('paged', $paged);
                $brando_search_content = (isset($brando_options['brando_general_search_content_settings'])) ? $brando_options['brando_general_search_content_settings'] : '';

                if( !empty($brando_search_content)){
                    $query->set('post_type', $brando_search_content);
                }
                
            endif;
            if(is_tax('portfolio-category') || is_tax('portfolio-tags')):
                $brando_item_per_page = (isset($brando_options['brando_portfolio_cat_item_per_page'])) ? $brando_options['brando_portfolio_cat_item_per_page'] : '';
                $query->set('posts_per_page', $brando_item_per_page);
            endif;
        endif;
    } 
endif;
add_action('pre_get_posts', 'brando_posts_customize');


// Post excerpt
add_filter('the_content', 'brando_trim_excerpts');
if ( ! function_exists( 'brando_trim_excerpts' ) ) {
    function brando_trim_excerpts($content = false) {
            global $post;
            if(!is_singular()){
                $content = $post->post_excerpt;
                // If an excerpt is set in the Optional Excerpt box
                if($content) :
                    $content = apply_filters('the_excerpt', $content);

                // If no excerpt is set
                else :
                    $content = $post->post_content;
                endif;
            }
        // Make sure to return the content
        return $content;
    }
}


if ( ! function_exists( 'brando_widgets' ) ) {
    function brando_widgets() {
        $brando_custom_sidebars = brando_option('sidebar_creation');
        if (is_array($brando_custom_sidebars)) {
            foreach ($brando_custom_sidebars as $sidebar) {

                if (empty($sidebar)) {
                    continue;
                }

                register_sidebar ( array (
                    'name' => $sidebar,
                    'id' => sanitize_title ( $sidebar ),
                    'before_widget' => '<div id="%1$s" class="custom-widget %2$s">',
                    'after_widget' => '</div>',
                    'before_title'  => '<h5 class="sidebar-title">',
                    'after_title'   => '</h5>',
                ) );
            }
        }
    }
}
add_action( 'widgets_init', 'brando_widgets' );


if ( ! function_exists( 'brando_get_sidebar' ) ) {
    function brando_get_sidebar($brando_sidebar_name="0"){
        if($brando_sidebar_name != "0"){
            dynamic_sidebar($brando_sidebar_name);
        }else{
            dynamic_sidebar('sidebar-1');
        }
    }
}

if ( ! function_exists( 'brando_login_logo' ) ) :
// To Change Admin Panel Logo.
    function brando_login_logo() { 
        $brando_admin_logo = brando_option('brando_header_logo');
        if( $brando_admin_logo['url'] ):
        ?>
        <style type="text/css">
            .login h1 a {
                background-image: url(<?php echo esc_url($brando_admin_logo['url']);?>  ) !important;
                background-size: contain !important;
                height: 48px !important;
                width: 100% !important;
            }
        </style>
        <?php 
        endif;
    }
endif;
add_action( 'login_enqueue_scripts', 'brando_login_logo' );

// To Change Admin Panel Logo Url.
if ( ! function_exists( 'brando_login_logo_url' ) ) :
    function brando_login_logo_url() {
        return home_url('/');
    }
endif;
add_filter( 'login_headerurl', 'brando_login_logo_url' );

// To Change Admin Panel Logo Title.
if ( ! function_exists( 'brando_login_logo_url_title' ) ) :
    function brando_login_logo_url_title() {
        $brando_text = get_bloginfo('name').' | '.get_bloginfo('description');
        return $brando_text;
    }
endif;
add_filter( 'login_headertitle', 'brando_login_logo_url_title' );

// To remove deprecated notice for old functions
add_filter('deprecated_constructor_trigger_error', '__return_false');

// Remove VC redirection
if(class_exists('Vc_Manager')){
    remove_action( 'vc_activation_hook', 'vc_page_welcome_set_redirect');
    remove_action( 'admin_init', 'vc_page_welcome_redirect');
}

// Body background
if ( ! function_exists( 'brando_body_background' ) ) {
    function brando_body_background(){
        $brando_body_background = '';
        $brando_body_image = brando_option('brando_background_image');
        $brando_body_color = brando_option('brando_top_color');
        $brando_body_image_repeat = ( brando_option('brando_bg_image_repeat')) ? ' '.brando_option('brando_bg_image_repeat') : '';

        $brando_body_top_color = ( $brando_body_color ) ? ' top '.esc_attr($brando_body_color) : '';
        if( !is_array( $brando_body_image ) ):
            $brando_body_background = ' style="background:url('.esc_url($brando_body_image).')'.esc_attr($brando_body_top_color).esc_attr($brando_body_image_repeat).'"';
        elseif( !empty($brando_body_image['url']) ):
            $brando_body_background = ' style="background:url('.esc_url($brando_body_image['url']).')'.esc_attr($brando_body_top_color).esc_attr($brando_body_image_repeat).'"';
        elseif( !empty($brando_body_color) ):
            $brando_body_background = ' style="background:'.esc_attr($brando_body_color).esc_attr($brando_body_image_repeat).'"';
        endif;
        
        echo wp_kses($brando_body_background, wp_kses_allowed_html( 'post' ));
    }
}

if( !function_exists( 'brando_admin_footer' ) ) {
    function brando_admin_footer() {

        if(!empty( $_REQUEST['page'] ) && $_REQUEST['page'] == 'brando_theme_settings') {

            $brando_theme_import_option = get_option('brando_theme_import_option');
            $brando_default_checked = empty($brando_theme_import_option) ? ' checked="checked "' : '';

            // Popup code for Import options
            echo '<div class="brando-popup hidden brando-import-data-popup" data-popup="brando-popup">
                <div class="brando-popup-inner">
                    <form id="export-filters" method="get">
                        <fieldset>
                            <legend class="screen-reader-text">' . esc_html__( 'Content to export', 'brando' ) . '</legend>
                            <h3>Import <span class="brando-demo-option-name"></span>Demo Content</h3>
                            <ul class="brando-import-choice-all">
                                <li>
                                    <label><input type="checkbox" '. $brando_default_checked .' class="brando-checkbox-all" value="all" >' . esc_html__( 'All Content', 'brando' ) . '</label>
                                    <span class="description">' . esc_html__( 'This will contain all of your posts, pages, portfolio & media.', 'brando' ) . '</span>
                                </li>
                            </ul>
                            <ul class="brando-import-choice">
                                <li>
                                    <label><input type="checkbox" '. $brando_default_checked .' class="brando-checkbox" value="posts" >' . esc_html__( 'Posts', 'brando' ) . '</label>
                                </li>
                                <li>
                                    <label><input type="checkbox" '. $brando_default_checked .' class="brando-checkbox" value="pages" >' . esc_html__( 'Pages', 'brando' ) . '</label>
                                </li>
                                <li>
                                    <label><input type="checkbox" '. $brando_default_checked .' class="brando-checkbox" value="portfolio" >' . esc_html__( 'Portfolio', 'brando' ) . '</label>
                                </li>
                                <li>
                                    <label><input type="checkbox" '. $brando_default_checked .' class="brando-checkbox" value="nav_menu_item" >' . esc_html__( 'Navigation Menu', 'brando' ) . '</label>
                                </li>
                                <li>
                                    <label><input type="checkbox" '. $brando_default_checked .' class="brando-checkbox" value="attachment" >' . esc_html__( 'Media', 'brando' ) . '</label>
                                </li>
                                <li>
                                    <label><input type="checkbox" '. $brando_default_checked .' class="brando-checkbox" value="contact_form" >' . esc_html__( 'Contact Form', 'brando' ) . '</label>
                                </li>
                                <li>
                                    <label><input type="checkbox" '. $brando_default_checked .' class="brando-checkbox" value="options" >' . esc_html__( 'Options', 'brando' ) . '</label>
                                </li>
                                <li>
                                    <label><input type="checkbox" '. $brando_default_checked .' class="brando-checkbox" value="widgets" >' . esc_html__( 'Widgets', 'brando' ) . '</label>
                                </li>
                            </ul>
                            <p class="submit">
                                <input type="hidden" name="brando_demo_setup_key" id="brando_demo_setup_key" />
                                <input type="button" value="' . esc_html__( 'Import', 'brando' ) . '" class="button button-primary" id="brando_demo_setup_submit" name="submit">
                            </p>
                        </fieldset>
                    </form>
                    <a class="brando-popup-close" data-popup-close="brando-popup" href="#">x</a>
                </div>
            </div>';

        }
    }
    add_action('admin_footer', 'brando_admin_footer');
}

if ( ! function_exists( 'brando_enqueue_fonts_url' ) ) :

function brando_enqueue_fonts_url() {
    $brando_fonts_url = '';
    $brando_fonts     = array();
    $brando_subsets   = '';
    global $brando_theme_settings;
    
    if( $brando_theme_settings['main_font']['font-family']){
        $brando_fonts[] = $brando_theme_settings['main_font']['font-family'].':400,100,300,500,700,900';
    }else{
        $brando_fonts[] = 'Roboto:400,100,300,500,700,900';
    }

    if( $brando_theme_settings['alt_font']['font-family']){
        $brando_fonts[] = $brando_theme_settings['alt_font']['font-family'].':400,100,300,500,700,900';
    }else{
        $brando_fonts[] = 'Montserrat:400,700';
    }

    if ( $brando_fonts ) {
        $brando_fonts_url = add_query_arg( array(
            'family' => urlencode( implode( '|', $brando_fonts ) ),
            'subset' => urlencode( $brando_subsets ),
        ), '//fonts.googleapis.com/css' );
    }
    return $brando_fonts_url;
}
endif;

if ( ! function_exists( 'brando_font_scripts' ) ) :
    function brando_font_scripts() {
        wp_enqueue_style( 'brando-fonts', brando_enqueue_fonts_url(), array(), null );
    }
endif;
add_action( 'wp_enqueue_scripts', 'brando_font_scripts' );


if ( ! function_exists( 'brando_add_site_favicon' ) ) :
    function brando_add_site_favicon() {
        if ( ! function_exists( 'has_site_icon' ) || ! has_site_icon() ) {
            ?>
            <?php // Start favicon.
            $brando_default_favicon = brando_option( 'default_favicon' );
            $brando_apple_iPhone_retina_favicon = brando_option('apple_iPhone_retina_favicon');
            $brando_apple_iPad_favicon = brando_option('apple_iPad_favicon');
            $brando_apple_iPhone_retina_favicon = brando_option('apple_iPhone_retina_favicon');
            $brando_apple_iPad_retina_favicon = brando_option('apple_iPad_retina_favicon');

            ?>
<link rel="shortcut icon" href="<?php if( $brando_default_favicon && $brando_default_favicon['url'] ) { echo esc_url( brando_option_url('default_favicon') ); } else { echo BRANDO_THEME_IMAGES_URI.'/favicon.png'; }?>">
<link rel="apple-touch-icon" href="<?php if( $brando_apple_iPhone_retina_favicon && $brando_apple_iPhone_retina_favicon['url'] ) { echo esc_url( brando_option_url('apple_iPhone_favicon') ); } else { echo esc_url( BRANDO_THEME_IMAGES_URI.'/apple-touch-icon-57x57.png' ); }?>">
<link rel="apple-touch-icon" sizes="72x72" href="<?php if( $brando_apple_iPad_favicon && $brando_apple_iPad_favicon['url']) { echo esc_url( brando_option_url('apple_iPad_favicon') ); } else { echo esc_url( BRANDO_THEME_IMAGES_URI.'/apple-touch-icon-72x72.png' ); }?>">

<link rel="apple-touch-icon" sizes="114x114" href="<?php if( $brando_apple_iPhone_retina_favicon && $brando_apple_iPhone_retina_favicon['url'] ) { echo esc_url( brando_option_url('apple_iPhone_retina_favicon') ); } else { echo esc_url( BRANDO_THEME_IMAGES_URI.'/apple-touch-icon-114x114.png' ); }?>">
<link rel="apple-touch-icon" sizes="149x149" href="<?php if( $brando_apple_iPad_retina_favicon && $brando_apple_iPad_retina_favicon['url'] ) { echo esc_url( brando_option_url('apple_iPad_retina_favicon') ); } else { echo esc_url( BRANDO_THEME_IMAGES_URI.'/apple-touch-icon-114x114.png' ); }?>">
            <?php // End favicon.
        }
    }
endif;
add_action( 'wp_head', 'brando_add_site_favicon' ); //front end
add_action( 'admin_head', 'brando_add_site_favicon' ); //admin end

if ( ! function_exists( 'brando_add_default_cursor' ) ) :
    function brando_add_default_cursor() {
        
        $brando_custom_css = '';
        $brando_options = get_option( 'brando_theme_setting' );

        $brando_show_default_cursor_image =  (isset($brando_options['brando_show_default_cursor_image']) && !empty($brando_options['brando_show_default_cursor_image'])) ? $brando_options['brando_show_default_cursor_image'] : '';

        if( $brando_show_default_cursor_image != 1 ) {
            $brando_custom_css .= ".grid figure:hover img { cursor: pointer !important }";
            $brando_custom_css .= ".mfp-zoom-out-cur, .mfp-zoom-out-cur .mfp-image-holder .mfp-close, .mfp-image-holder, .mfp-iframe-holder, .mfp-close-btn-in, .mfp-content, .mfp-container, .mfp-auto-cursor .mfp-content { cursor: pointer !important }";
        } else {
            /* For Open Cursor */
            $brando_default_open_cursor_image = (isset($brando_options['brando_default_open_cursor_image']) && !empty($brando_options['brando_default_open_cursor_image'])) ? $brando_options['brando_default_open_cursor_image'] : '';
            if( isset( $brando_default_open_cursor_image['url'] ) && !empty( $brando_default_open_cursor_image['url'] ) ){
                $brando_custom_css .= ".grid figure:hover img { cursor: url('".$brando_default_open_cursor_image['url']."'), pointer !important }";
            }

            /* For Close Cursor */
            $brando_default_close_cursor_image = (isset($brando_options['brando_default_close_cursor_image']) && !empty($brando_options['brando_default_close_cursor_image'])) ? $brando_options['brando_default_close_cursor_image'] : '';
            if( isset( $brando_default_close_cursor_image['url'] ) && !empty( $brando_default_close_cursor_image['url'] ) ){
                $brando_custom_css .= ".mfp-zoom-out-cur, .mfp-zoom-out-cur .mfp-image-holder .mfp-close, .mfp-image-holder, .mfp-iframe-holder, .mfp-close-btn-in, .mfp-content, .mfp-container { cursor: url('".$brando_default_close_cursor_image['url']."'), pointer !important }";
            }
        }

        wp_add_inline_style( 'magnific-popup', $brando_custom_css );
    }
endif;
add_action( 'wp_enqueue_scripts', 'brando_add_default_cursor' );

add_filter( 'body_class', 'brando_add_body_class' );
if ( ! function_exists( 'brando_add_body_class' ) ) :
    function brando_add_body_class( $classes ) {

        $brando_options = get_option( 'brando_theme_setting' );

        $brando_popup_on_click_close =  (isset($brando_options['brando_popup_on_click_close']) && !empty($brando_options['brando_popup_on_click_close'])) ? $brando_options['brando_popup_on_click_close'] : '';
        if( $brando_popup_on_click_close != 1 ) {
            $classes[] = 'brando-custom-popup-close';
        }           

        return $classes;
    }
endif;