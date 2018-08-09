<?php
/**
 * General Tab For Theme Option.
 *
 * @package Brando
 */
?>
<?php
$brando_enable_under_construction = '';
if( class_exists('Brando_Addons') ) {
    if ( function_exists( 'brando_under_construction_theme_option' ) ) {
        $brando_enable_under_construction = brando_under_construction_theme_option();
    }
}
$this->sections[] = array(
    'icon' => 'el-icon-adjust-alt',
    'title' => esc_html__('General', 'brando' ),
    'fields' => array(
        $brando_enable_under_construction,
        array(
            'id'       => 'sidebar_creation',
            'type'     => 'multi_text',
            'title'    => esc_html__( 'Custom Sidebars', 'brando' ),
            'subtitle' => esc_html__( 'Custom sidebars can be assigned to any post or pages ', 'brando' ),
            'desc' => esc_html__('You can add multiple custom sidebars', 'brando' ),
        ),
        array(
            'id'       => 'general_css_code',
            'type'     => 'ace_editor',
            'title'    => esc_html__('CSS Code', 'brando' ),
            'subtitle' => esc_html__('Add your custom CSS code here', 'brando' ),
            'mode'     => 'css',
            'desc'     => '',
            'default'  => ""
        ),
        array(
            'id'        => 'opt-accordion-begin-general',
            'type'      => 'accordion',
            'title'     => esc_html__('Favicon Settings', 'brando' ),
            'subtitle'  => esc_html__('Set favicon for general desktop, Apple iPhone, Apple iPhone Retina, Apple iPad, Apple iPad Retina ', 'brando' ),
            'position'  => 'start',
        ),
        array(
            'id'       => 'default_favicon',
            'type'     => 'media',
            'preview'  => true,
            'url'      => true,  
            'title'    => esc_html__( 'Favicon', 'brando' ),
            'subtitle' => esc_html__( 'Favicon for your website (32px x 32px)', 'brando' ),
        ),
        array(
            'id'       => 'apple_iPhone_favicon',
            'type'     => 'media',
            'preview'  => true,
            'url'      => true,  
            'title'    => esc_html__( 'Apple iPhone Icon', 'brando' ),
            'subtitle' => esc_html__( 'Favicon for apple iPhone (57px x 57px)', 'brando' ),
        ),
        array(
            'id'       => 'apple_iPhone_retina_favicon',
            'type'     => 'media',
            'preview'  => true,
            'url'      => true,  
            'title'    => esc_html__( 'Apple iPhone Retina Icon', 'brando' ),
            'subtitle' => esc_html__( 'Favicon for apple iPhone retina version (114px x 114px)', 'brando' ),
        ),
        array(
            'id'       => 'apple_iPad_favicon',
            'type'     => 'media',
            'preview'  => true,
            'url'      => true,  
            'title'    => esc_html__( 'Apple iPad Icon', 'brando' ),
            'subtitle' => esc_html__( 'Favicon for apple iPad (72px x 72px)', 'brando' ),
        ),
        array(
            'id'       => 'apple_iPad_retina_favicon',
            'type'     => 'media',
            'preview'  => true,
            'url'      => true,  
            'title'    => esc_html__( 'Apple iPad Retina Icon', 'brando' ),
            'subtitle' => esc_html__( 'Favicon for apple iPad retina version (114px x 114px)', 'brando' ),
        ),
        array(
            'id'        => 'opt-accordion-end-general',
            'type'      => 'accordion',
            'position'  => 'end'
        ),
        array(
            'id'        => 'opt-accordion-begin-general',
            'type'      => 'accordion',
            'title'     => esc_html__('Image Meta Data Settings', 'brando' ),
            'subtitle'  => esc_html__('Set visibility for image alt, title and caption ', 'brando' ),
            'position'  => 'start',
        ),
        array(
            'id'       => 'enable_image_alt',
            'type'     => 'switch',
            'title'    => esc_html__('Render Image Alt', 'brando' ),
            'default'  => true,
        ),
        array(
            'id'       => 'enable_image_title',
            'type'     => 'switch',
            'title'    => esc_html__('Render Image Title', 'brando' ),
            'default'  => false,
        ),
        array(
            'id'       => 'enable_lightbox_title',
            'type'     => 'switch',
            'title'    => esc_html__('Show Image Title in Lightbox Popup', 'brando' ),
            'default'  => false,
        ),
        array(
            'id'       => 'enable_lightbox_caption',
            'type'     => 'switch',
            'title'    => esc_html__('Show Image Caption in Lightbox Popup', 'brando' ),
            'default'  => false,
        ),
        array(
            'id'        => 'opt-accordion-end-general',
            'type'      => 'accordion',
            'position'  => 'end'
        ),
        array(
            'id'        => 'opt-accordion-begin-general',
            'type'      => 'accordion',
            'title'     => esc_html__('Post Default Image Settings', 'brando' ),
            'subtitle'  => esc_html__('Upload your default image which will be displayed in portfolio grid / list if there is no featured image assigned to post.', 'brando' ),
            'position'  => 'start',
        ),
        array(
            'id'       => 'brando_no_image',
            'type'     => 'media',
            'preview'  => true,
            'url'      => true,
            'title'    => esc_html__('Upload Image', 'brando' ),
        ),
        array(
            'id'        => 'opt-accordion-end-general',
            'type'      => 'accordion',
            'position'  => 'end'
        ),
        array(
            'id'        => 'opt-accordion-begin-general',
            'type'      => 'accordion',
            'title'     => esc_html__( 'Popup Cursor Settings', 'brando' ),
            'subtitle'  => esc_html__( 'Enable / Disable + / - cursor or upload your custom cursor image (32px X 32px size)', 'brando' ),
            'position'  => 'start',
        ),
        array(
            'id'       => 'brando_show_default_cursor_image',
            'type'     => 'switch',
            'title'    => esc_html__( 'Show Cursor', 'brando' ),
            'default'  => true,
        ),
        array(
            'id'       => 'brando_default_open_cursor_image',
            'type'     => 'media',
            'preview'  => true,
            'url'      => true,
            'title'    => esc_html__( 'Cursor Image for Open Popup', 'brando' ),
            'required'  => array( 'brando_show_default_cursor_image', 'equals', array( '1' ) ),
        ),
        array(
            'id'       => 'brando_default_close_cursor_image',
            'type'     => 'media',
            'preview'  => true,
            'url'      => true,
            'title'    => esc_html__( 'Cursor Image for Close Popup', 'brando' ),
            'required'  => array( 'brando_show_default_cursor_image', 'equals', array( '1' ) ),
        ),
        array(
            'id'       => 'brando_popup_on_click_close',
            'type'     => 'switch',
            'title'    => esc_html__( 'Close Popup on Click', 'brando' ),
            'default'  => true,
        ),
        array(
            'id'        => 'opt-accordion-end-general',
            'type'      => 'accordion',
            'position'  => 'end'
        ),
    )
);
?>