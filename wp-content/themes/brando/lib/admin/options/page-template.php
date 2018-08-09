<?php
/**
 * Page or Template Tab For Theme Option.
 *
 * @package Brando
 */
?>
<?php

$brando_first_under_construction = $brando_second_under_construction = $brando_third_under_construction = '';
if( class_exists('Brando_Addons') ) {
    if ( function_exists( 'brando_under_construction_template_start_theme_option' ) ) {
        $brando_first_under_construction = brando_under_construction_template_start_theme_option();
    }
    if ( function_exists( 'brando_under_construction_template_page_theme_option' ) ) {
        $brando_second_under_construction = brando_under_construction_template_page_theme_option();
    }
    if ( function_exists( 'brando_under_construction_template_end_theme_option' ) ) {
        $brando_third_under_construction = brando_under_construction_template_end_theme_option();
    }
}

$this->sections[] = array(
    'icon' => 'fa fa-file-text-o',
    'title' => esc_html__('Page/Template', 'brando'),
    'fields' => array(
        $brando_first_under_construction,
        $brando_second_under_construction,
        $brando_third_under_construction,
     /*  Comment */
        array(
            'id'        => 'opt-accordion-begin-general',
            'type'      => 'accordion',
            'title'     => esc_html__('Comments Settings', 'brando'),
            'subtitle'  => esc_html__('Enable/Disable comments in post or portfolio or page', 'brando'),
            'position'  => 'start',
        ),
        array(
            'id'=>'brando_enable_page_comment',
            'type' => 'switch', 
            'title' => esc_html__('Enable Comments in Page', 'brando'),
            'default'  => true,
        ),
        array(
            'id'=>'brando_enable_post_comment',
            'type' => 'switch', 
            'title' => esc_html__('Enable Comments in Post', 'brando'),
            'default' => true,
        ),
        array(
            'id'=>'brando_enable_portfolio_comment',
            'type' => 'switch', 
            'title' => esc_html__('Enable Comments in Portfolio', 'brando'),
            'default' => false,
        ),
        array(
            'id'        => 'opt-accordion-end-general',
            'type'      => 'accordion',
            'position'  => 'end'
        ),

        /*  404 Page */
        array(
            'id'        => 'opt-accordion-begin-general',
            'type'      => 'accordion',
            'title'     => esc_html__('404 Page Settings', 'brando'),
            'subtitle'  => esc_html__('Set title, content, image, button text and button URL for 404 / page not found page', 'brando'),
            'position'  => 'start',
        ),
        array(
            'id'       => '404_title_text',
            'type'     => 'text',
            'title'    => esc_html__( 'Title Text', 'brando' ),
            'default'  => '404!'
        ),
        array(
            'id'       => '404_content_text',
            'type'     => 'textarea',
            'title'    => esc_html__( '404 Content Text', 'brando' ),
            'default'  => 'The page you were looking<br/>for could not be found.'
        ),
        array(
            'id'       => '404_image',
            'type'     => 'media',
            'preview'  => true,
            'url'      => true,  
            'title'    => esc_html__( '404 Background Image', 'brando' ),
            'subtitle' => esc_html__( 'Upload image', 'brando' ),
        ),
        array(
            'id'=>'404_enable_text_button',
            'type' => 'switch', 
            'title' => esc_html__('Enable Button', 'brando'),
            'default' => true,
            '1'       => 'On',
            '0'      => 'Off',
        ),
        array(
            'id'       => '404_button',
            'type'     => 'text',
            'title'    => esc_html__( 'Button Text', 'brando' ),
            'required' => array('404_enable_text_button', 'equals', '1'),
            'default'  => 'Go to home page'
        ),
        array(
            'id'=>'404_button_url',
            'type' => 'select',
            'title' => esc_html__('Button Url', 'brando'),
            'data' => 'pages',
            'required'  => array('404_enable_text_button', 'equals', '1'),
        ),
        array(
            'id'=>'404_enable_search',
            'type' => 'switch', 
            'title' => esc_html__('Enable Search', 'brando'),
            'default' => true,
        ),
        array(
            'id'        => 'opt-accordion-end-general',
            'type'      => 'accordion',
            'position'  => 'end'
        ),
    )
);
?>