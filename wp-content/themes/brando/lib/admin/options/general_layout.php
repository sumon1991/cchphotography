<?php
/**
 * General Layout Tab For Theme Option.
 *
 * @package Brando
 */
?>
<?php
$brando_search_content = '';

$brando_search_content = array(
    'page' => esc_html__('Page', 'brando'),
    'post' => esc_html__('Post', 'brando'),
    'portfolio' => esc_html__('Portfolio', 'brando'),
);


$this->sections[] = array(
    'icon' => 'el-icon-cogs',
    'title' => esc_html__('Layout Settings', 'brando'),
    'fields' => array(
        array(
            'id'       => 'brando_layout_settings',
            'type'     => 'image_select',
            'title'    => esc_html__( 'Sidebar Settings', 'brando' ),
            'options'  => array(
                'brando_layout_full_screen' => array(
                    'alt' => esc_html__('One Column','brando'),
                    'img' => ReduxFramework::$_url . 'assets/img/1col.png'
                ),
                'brando_layout_left_sidebar' => array(
                    'alt' => esc_html__('Two Columns Left','brando'),
                    'img' => ReduxFramework::$_url . 'assets/img/2cl.png'
                ),
                'brando_layout_right_sidebar' => array(
                    'alt' =>esc_html__('Two Columns Right','brando'),
                    'img' => ReduxFramework::$_url . 'assets/img/2cr.png'
                ),
                'brando_layout_both_sidebar' => array(
                    'alt' => esc_html__('Three Columns','brando'),
                    'img' => ReduxFramework::$_url . 'assets/img/3cm.png'
                ),
            ),
            'default'  => 'brando_layout_full_screen'
        ),
        array(
            'id'       => 'brando_enable_container_fluid',
            'type'     => 'switch',
            'title'    => esc_html__('Enable Container Fluid', 'brando'),
            'default'  => false,
            'required'  => array('brando_layout_settings', 'equals', 'brando_layout_full_screen'),
        ),
        array(
            'id'        => 'brando_layout_left_sidebar',
            'type'      => 'select',
            'title'     => esc_html__('Left Sidebar', 'brando'),
            'data'      => 'sidebar',
            'default'   => '',
            'subtitle' => esc_html__('Select sidebar to display in left column of page', 'brando'),
            'required'  => array('brando_layout_settings', 'equals', array('brando_layout_left_sidebar', 'brando_layout_both_sidebar') ),
        ),
        array(
            'id'        => 'brando_layout_right_sidebar',
            'type'      => 'select',
            'title'     => esc_html__('Right Sidebar', 'brando'),
            'data'      => 'sidebar',
            'default'   => '',
            'subtitle' => esc_html__('Select sidebar to display in right column of page', 'brando'),
            'required'  => array('brando_layout_settings', 'equals', array('brando_layout_right_sidebar', 'brando_layout_both_sidebar') ),
        ),
        array(
            'id'       => 'brando_enable_breadcrumb',
            'type'     => 'switch',
            'title'    => esc_html__('Enable Breadcrumb', 'brando'),
            'default'  => false,
        ),
        /* Body Background */

        array(
            'id'        => 'opt-accordion-begin-general',
            'type'      => 'accordion',
            'title'     => esc_html__('Body Background', 'brando'),
            'subtitle'  => esc_html__('Set background in body', 'brando'),
            'position'  => 'start',
        ),
        array(
            'id'       => 'brando_background_image',
            'type'     => 'media',
            'preview'  => true,
            'url'      => true,  
            'title'    => esc_html__( 'Body Background', 'brando' ),
            'subtitle' => esc_html__( 'Upload the image that will be displayed in the body background', 'brando' ),
        ),
        array(
            'id'=>'brando_bg_image_repeat',
            'type' => 'select',
            'title' => esc_html__('Body Background Image repeat', 'brando'),
            'options' => array(
                'repeat' => esc_html__('Repeat', 'brando'),
                'no-repeat' => esc_html__('No Repeat', 'brando'),
            ),
        ),
        array(
          'id' => 'brando_top_color',
          'type' => 'color',
          'title' => esc_html__('Body Background Color', 'brando'),
          'default' => '',
        ),
        array(
            'id'        => 'opt-accordion-end-general',
            'type'      => 'accordion',
            'position'  => 'end'
        ),

        /* Blog Page Layout */

        array(
            'id'        => 'opt-accordion-begin-general',
            'type'      => 'accordion',
            'title'     => esc_html__('Default Posts / Blog Page Layout Settings', 'brando'),
            'subtitle'  => esc_html__('Settings for default posts / blog landing page', 'brando'),
            'position'  => 'start',
        ),
        array(
            'id'       => 'brando_blog_page_settings',
            'type'     => 'image_select',
            'title'    => esc_html__( 'Sidebar Settings', 'brando' ),
            'options'  => array(
                'brando_blog_page_full_screen' => array(
                    'alt' => esc_html__('One Column','brando'),
                    'img' => ReduxFramework::$_url . 'assets/img/1col.png'
                ),
                'brando_blog_page_left_sidebar' => array(
                    'alt' => esc_html__('Two Columns Left','brando'),
                    'img' => ReduxFramework::$_url . 'assets/img/2cl.png'
                ),
                'brando_blog_page_right_sidebar' => array(
                    'alt' => esc_html__('Two Columns Right','brando'),
                    'img' => ReduxFramework::$_url . 'assets/img/2cr.png'
                ),
                'brando_blog_page_both_sidebar' => array(
                    'alt' => esc_html__('Three Columns','brando'),
                    'img' => ReduxFramework::$_url . 'assets/img/3cm.png'
                ),
            ),
            'default'  => 'brando_blog_page_right_sidebar'
        ),
        array(
            'id'       => 'brando_blog_page_enable_container_fluid',
            'type'     => 'switch',
            'title'    => esc_html__('Enable Container Fluid', 'brando'),
            'default'  => false,
            'required'  => array('brando_blog_page_settings', 'equals', 'brando_blog_page_full_screen'),
        ),
        array(
            'id'        => 'brando_blog_page_left_sidebar',
            'type'      => 'select',
            'title'     => esc_html__('Left Sidebar', 'brando'),
            'data'      => 'sidebar',
            'default'   => '',
            'subtitle' => esc_html__('Select sidebar to display in left column of page', 'brando'),
            'required'  => array('brando_blog_page_settings', 'equals', array('brando_blog_page_left_sidebar', 'brando_blog_page_both_sidebar') ),
        ),
        array(
            'id'        => 'brando_blog_page_right_sidebar',
            'type'      => 'select',
            'title'     => esc_html__('Right Sidebar', 'brando'),
            'data'      => 'sidebar',
            'default'   => 'sidebar-1',
            'subtitle' => esc_html__('Select sidebar to display in right column of page', 'brando'),
            'required'  => array('brando_blog_page_settings', 'equals', array('brando_blog_page_right_sidebar', 'brando_blog_page_both_sidebar') ),
        ),
        array(
          'id' => 'brando_blog_page_title',
          'type' => 'text',
          'title' => esc_html__('Blog Page Title', 'brando'),
          'default' => 'Blog',
        ),
        array(
            'id' => 'brando_header_subtitle',
            'type' => 'text',
            'title' => esc_html__('Subtitle', 'brando'),
            'required'  => array('brando_enable_title_wrapper', 'equals', '1'),
        ),
        array(
            'id'       => 'brando_blog_page_background_image',
            'type'     => 'media',
            'preview'  => true,
            'url'      => true,  
            'title'    => esc_html__( 'Background Image', 'brando' ),
            'subtitle' => esc_html__( 'Upload the background image for Blog page', 'brando' ),
        ),
        array(
            'id'=>'brando_blog_page_grid_layout',
            'type' => 'select',
            'title' => esc_html__('Blog Layout', 'brando'),
            'options' => array(
                'grid' => esc_html__('Grid', 'brando'),
                'classic' => esc_html__('Classic', 'brando'),
            ),
            'default'   => 'grid',
        ),
        array(
            'id'=>'brando_blog_page_grid_column',
            'type' => 'select',
            'title' => esc_html__('Blog Column Layout', 'brando'),
            'options' => array(
                '2' => esc_html__('Column 2', 'brando'),
                '3' => esc_html__('Column 3', 'brando'),
                '4' => esc_html__('Column 4', 'brando'),
            ),
            'default' => '2',
            'required'  => array('brando_blog_page_grid_layout', 'equals', array('grid') ),
        ),
        array(
            'id'=>'brando_blog_page_show_thumbnail',
            'type' => 'switch', 
            'title' => esc_html__('Show Post Thumbnail', 'brando'),
            'default' => true,
            'required'  => array('brando_blog_page_grid_layout', 'equals', array('grid','classic') ),
        ),
        array(
            'id'=>'brando_blog_page_show_separator',
            'type' => 'switch', 
            'title' => esc_html__('Show Separator', 'brando'),
            'default' => true,
            'required'  => array('brando_blog_page_grid_layout', 'equals', array('grid','classic') ),
        ),
        array(
            'id'=>'brando_blog_page_show_post_meta',
            'type' => 'switch', 
            'title' => esc_html__('Show Post Meta', 'brando'),
            'default' => true,
            'required'  => array('brando_blog_page_grid_layout', 'equals', array('grid') ),
        ),
         array(
          'id' => 'brando_blog_page_date_format',
          'type' => 'text',
          'title' => esc_html__('Date Format', 'brando'),
          'default' => 'd m Y',
          'required'  => array('brando_blog_page_show_post_meta', 'equals', array('1') ),
        ),
        array(
            'id'=>'brando_blog_page_show_excerpt',
            'type' => 'switch', 
            'title' => esc_html__('Show Post Excerpt', 'brando'),
            'default' => true,
            'required'  => array('brando_blog_page_grid_layout', 'equals', array('grid','classic') ),
        ),
        array(
          'id' => 'brando_blog_page_excerpt_length',
          'type' => 'text',
          'title' => esc_html__('Excerpt', 'brando'),
          'default' => '30',
          'subtitle' => esc_html__('Specify content length in no. of words', 'brando'),
          'required'  => array('brando_blog_page_show_excerpt', 'equals', array('1') ),
        ),
        array(
            'id'=>'brando_blog_page_show_category',
            'type' => 'switch', 
            'title' => esc_html__('Show Post Category', 'brando'),
            'default' => false,
            'required'  => array('brando_blog_page_grid_layout', 'equals', array('classic') ),
        ),
        array(
            'id'=>'brando_blog_page_show_comments',
            'type' => 'switch', 
            'title' => esc_html__('Show Post Comments', 'brando'),
            'default' => false,
            'required'  => array('brando_blog_page_grid_layout', 'equals', array('classic') ),
        ),
        array(
            'id'=>'brando_blog_page_show_social_icon',
            'type' => 'switch', 
            'title' => esc_html__('Show Social Icons', 'brando'),
            'default' => false,
            'required'  => array('brando_blog_page_grid_layout', 'equals', array('classic') ),
        ),
        array(
            'id'=>'brando_blog_page_show_button',
            'type' => 'switch', 
            'title' => esc_html__('Show Button', 'brando'),
            'default' => false,
            'required'  => array('brando_blog_page_grid_layout', 'equals', array('classic') ),
        ),
        array(
          'id' => 'brando_blog_page_button_text',
          'type' => 'text',
          'title' => esc_html__('Button Text', 'brando'),
          'default' => 'Continue Reading',
          'required'  => array('brando_blog_page_show_button', 'equals', array('1') ),
        ),
        array(
          'id' => 'brando_blog_page_item_per_page',
          'type' => 'text',
          'title' => esc_html__('No. of items per Page', 'brando'),
          'default' => '',
        ),
        array(
            'id'        => 'opt-accordion-end-general',
            'type'      => 'accordion',
            'position'  => 'end'
        ),
        
        /* Single Post */

        array(
            'id'        => 'opt-accordion-begin-general',
            'type'      => 'accordion',
            'title'     => esc_html__('Single Post/Custom Post Layout Settings', 'brando'),
            'subtitle'  => esc_html__('Set layout for single post/custom Post', 'brando'),
            'position'  => 'start',
        ),
        array(
            'id'       => 'brando_layout_settings_post',
            'type'     => 'image_select',
            'title'    => esc_html__( 'Sidebar Settings', 'brando' ),
            'options'  => array(
                'brando_layout_full_screen' => array(
                    'alt' => esc_html__('One Column','brando'),
                    'img' => ReduxFramework::$_url . 'assets/img/1col.png'
                ),
                'brando_layout_left_sidebar' => array(
                    'alt' => esc_html__('Two Columns Left','brando'),
                    'img' => ReduxFramework::$_url . 'assets/img/2cl.png'
                ),
                'brando_layout_right_sidebar' => array(
                    'alt' =>esc_html__('Two Columns Right','brando'),
                    'img' => ReduxFramework::$_url . 'assets/img/2cr.png'
                ),
                'brando_layout_both_sidebar' => array(
                    'alt' => esc_html__('Three Columns','brando'),
                    'img' => ReduxFramework::$_url . 'assets/img/3cm.png'
                ),
            ),
            'default'  => 'brando_layout_full_screen'
        ),
        array(
            'id'       => 'brando_enable_container_fluid_post',
            'type'     => 'switch',
            'title'    => esc_html__('Enable Container Fluid', 'brando'),
            'default'  => false,
            'required'  => array('brando_layout_settings_post', 'equals', 'brando_layout_full_screen'),
        ),
        array(
            'id'        => 'brando_layout_left_sidebar_post',
            'type'      => 'select',
            'title'     => esc_html__('Left Sidebar', 'brando'),
            'data'      => 'sidebar',
            'default'   => '',
            'subtitle' => esc_html__('Select sidebar to display in left column of post', 'brando'),
            'required'  => array('brando_layout_settings_post', 'equals', array('brando_layout_left_sidebar', 'brando_layout_both_sidebar') ),
        ),
        array(
            'id'        => 'brando_layout_right_sidebar_post',
            'type'      => 'select',
            'title'     => esc_html__('Right Sidebar', 'brando'),
            'data'      => 'sidebar',
            'default'   => '',
            'subtitle' => esc_html__('Select sidebar to display in right column of post', 'brando'),
            'required'  => array('brando_layout_settings_post', 'equals', array('brando_layout_right_sidebar', 'brando_layout_both_sidebar') ),
        ),
        array(
            'id'       => 'brando_enable_breadcrumb_post',
            'type'     => 'switch',
            'title'    => esc_html__('Enable Breadcrumb', 'brando'),
            'default'  => false,
        ),
        array(
            'id'=>'brando_enable_meta_date',
            'type' => 'switch', 
            'title' => esc_html__('Enable Post Meta Date', 'brando'),
            'default' => true,
        ),
        array(
            'id'=>'brando_enable_meta_author',
            'type' => 'switch', 
            'title' => esc_html__('Enable Post Meta Author', 'brando'),
            'default' => true,
        ),
        array(
            'id'=>'brando_enable_meta_tags',
            'type' => 'switch', 
            'title' => esc_html__('Enable Post Meta Tags', 'brando'),
            'default' => true,
        ),
        array(
            'id'=>'brando_enable_post_author',
            'type' => 'switch', 
            'title' => esc_html__('Enable Post Author Box', 'brando'),
            'default' => true,
        ),
        array(
            'id'=>'brando_social_icons',
            'type' => 'switch', 
            'title' => esc_html__('Enable Social Icons', 'brando'),
            'default' => true,
        ),
        array(
            'id'        => 'opt-accordion-end-general',
            'type'      => 'accordion',
            'position'  => 'end'
        ),

        /* Single Portfolio Page*/

        array(
            'id'        => 'opt-accordion-begin-general',
            'type'      => 'accordion',
            'title'     => esc_html__('Single Portfolio Post Settings', 'brando'),
            'subtitle'  => esc_html__('Single portfolio post configurations', 'brando'),
            'position'  => 'start',
        ),
        array(
            'id'       => 'brando_layout_settings_portfolio',
            'type'     => 'image_select',
            'title'    => esc_html__( 'Sidebar Settings', 'brando' ),
            'options'  => array(
                'brando_layout_full_screen' => array(
                    'alt' => esc_html__('One Column','brando'),
                    'img' => ReduxFramework::$_url . 'assets/img/1col.png'
                ),
                'brando_layout_left_sidebar' => array(
                    'alt' => esc_html__('Two Columns Left','brando'),
                    'img' => ReduxFramework::$_url . 'assets/img/2cl.png'
                ),
                'brando_layout_right_sidebar' => array(
                    'alt' =>esc_html__('Two Columns Right','brando'),
                    'img' => ReduxFramework::$_url . 'assets/img/2cr.png'
                ),
                'brando_layout_both_sidebar' => array(
                    'alt' => esc_html__('Three Columns','brando'),
                    'img' => ReduxFramework::$_url . 'assets/img/3cm.png'
                ),
            ),
            'default'  => 'brando_layout_full_screen'
        ),
        array(
            'id'       => 'brando_enable_container_fluid_portfolio',
            'type'     => 'switch',
            'title'    => esc_html__('Enable Container Fluid', 'brando'),
            'default'  => false,
            'required'  => array('brando_layout_settings_portfolio', 'equals', 'brando_layout_full_screen'),
        ),
        array(
            'id'        => 'brando_layout_left_sidebar_portfolio',
            'type'      => 'select',
            'title'     => esc_html__('Left Sidebar', 'brando'),
            'data'      => 'sidebar',
            'default'   => '',
            'subtitle' => esc_html__('Select sidebar to display in left column of portfolio', 'brando'),
            'required'  => array('brando_layout_settings_portfolio', 'equals', array('brando_layout_left_sidebar', 'brando_layout_both_sidebar') ),
        ),
        array(
            'id'        => 'brando_layout_right_sidebar_portfolio',
            'type'      => 'select',
            'title'     => esc_html__('Right Sidebar', 'brando'),
            'data'      => 'sidebar',
            'default'   => '',
            'subtitle' => esc_html__('Select sidebar to display in right column of portfolio', 'brando'),
            'required'  => array('brando_layout_settings_portfolio', 'equals', array('brando_layout_right_sidebar', 'brando_layout_both_sidebar') ),
        ),
        array(
            'id'       => 'brando_enable_breadcrumb_portfolio',
            'type'     => 'switch',
            'title'    => esc_html__('Enable Breadcrumb', 'brando'),
            'default'  => false,
        ),
        array(
            'id'=>'brando_enable_meta_date_portfolio',
            'type' => 'switch', 
            'title' => esc_html__('Enable Post Meta Date', 'brando'),
            'default' => true,
        ),
        array(
            'id'=>'brando_enable_meta_author_portfolio',
            'type' => 'switch', 
            'title' => esc_html__('Enable Post Meta Author', 'brando'),
            'default' => true,
        ),
        array(
            'id'=>'brando_enable_meta_tags_portfolio',
            'type' => 'switch', 
            'title' => esc_html__('Enable Post Meta Tags', 'brando'),
            'default' => true,
        ),
        array(
            'id'=>'brando_enable_post_author_portfolio',
            'type' => 'switch', 
            'title' => esc_html__('Enable Post Author', 'brando'),
            'default' => true,
        ),
        array(
            'id'=>'brando_social_icons_portfolio',
            'type' => 'switch', 
            'title' => esc_html__('Enable Social Icons', 'brando'),
            'default' => true,
        ),
        array(
            'id'        => 'opt-accordion-end-general',
            'type'      => 'accordion',
            'position'  => 'end'
        ),
        
        /* Archive Pages Layout */

        array(
            'id'        => 'opt-accordion-begin-general',
            'type'      => 'accordion',
            'title'     => esc_html__('Pages Layout Settings', 'brando'),
            'subtitle'  => esc_html__('Page layout settings only for Archive, Category, Search, Tag, Author pages', 'brando'),
            'position'  => 'start',
        ),
        array(
            'id'       => 'brando_general_settings',
            'type'     => 'image_select',
            'title'    => esc_html__( 'Sidebar Settings', 'brando' ),
            'options'  => array(
                'brando_general_full_screen' => array(
                    'alt' => esc_html__('One Column','brando'),
                    'img' => ReduxFramework::$_url . 'assets/img/1col.png'
                ),
                'brando_general_left_sidebar' => array(
                    'alt' => esc_html__('Two Columns Left','brando'),
                    'img' => ReduxFramework::$_url . 'assets/img/2cl.png'
                ),
                'brando_general_right_sidebar' => array(
                    'alt' => esc_html__('Two Columns Right','brando'),
                    'img' => ReduxFramework::$_url . 'assets/img/2cr.png'
                ),
                'brando_general_both_sidebar' => array(
                    'alt' => esc_html__('Three Columns','brando'),
                    'img' => ReduxFramework::$_url . 'assets/img/3cm.png'
                ),
            ),
            'default'  => '1'
        ),
        array(
            'id'       => 'brando_general_enable_container_fluid',
            'type'     => 'switch',
            'title'    => esc_html__('Enable Container Fluid', 'brando'),
            'default'  => false,
            'required'  => array('brando_general_settings', 'equals', 'brando_general_full_screen'),
        ),
        array(
            'id'        => 'brando_general_left_sidebar',
            'type'      => 'select',
            'title'     => esc_html__('Left Sidebar', 'brando'),
            'data'      => 'sidebar',
            'default'   => '',
            'subtitle' => esc_html__('Select sidebar to display in left column of page', 'brando'),
            'required'  => array('brando_general_settings', 'equals', array('brando_general_left_sidebar', 'brando_general_both_sidebar') ),
        ),
        array(
            'id'        => 'brando_general_right_sidebar',
            'type'      => 'select',
            'title'     => esc_html__('Right Sidebar', 'brando'),
            'data'      => 'sidebar',
            'default'   => '',
            'subtitle' => esc_html__('Select sidebar to display in right column of page', 'brando'),
            'required'  => array('brando_general_settings', 'equals', array('brando_general_right_sidebar', 'brando_general_both_sidebar') ),
        ),
        array(
            'id'       => 'brando_general_background_image',
            'type'     => 'media',
            'preview'  => true,
            'url'      => true,  
            'title'    => esc_html__( 'Background Image', 'brando' ),
            'subtitle' => esc_html__( 'Upload the background image for Archive, Search, Author pages', 'brando' ),
        ),
        array(
            'id'=>'brando_general_grid_layout',
            'type' => 'select',
            'title' => esc_html__('Blog Layout', 'brando'),
            'options' => array(
                'grid' => esc_html__('Grid', 'brando'),
                'classic' => esc_html__('Classic', 'brando'),
            ),
            'default' => 'grid',
        ),
        array(
            'id'=>'brando_general_grid_column',
            'type' => 'select',
            'title' => esc_html__('Blog Column Layout', 'brando'),
            'options' => array(
                '2' => esc_html__('Column 2', 'brando'),
                '3' => esc_html__('Column 3', 'brando'),
                '4' => esc_html__('Column 4', 'brando'),
            ),
            'default' => '3',
            'required'  => array('brando_general_grid_layout', 'equals', array('grid') ),
        ),
        array(
            'id'=>'brando_general_show_thumbnail',
            'type' => 'switch', 
            'title' => esc_html__('Show Post Thumbnail', 'brando'),
            'default' => true,
            'required'  => array('brando_general_grid_layout', 'equals', array('grid','classic') ),
        ),
        array(
            'id'=>'brando_general_show_separator',
            'type' => 'switch', 
            'title' => esc_html__('Show Separator', 'brando'),
            'default' => true,
            'required'  => array('brando_general_grid_layout', 'equals', array('grid','classic') ),
        ),
        array(
            'id'=>'brando_general_show_post_meta',
            'type' => 'switch', 
            'title' => esc_html__('Show Post Meta', 'brando'),
            'default' => true,
            'required'  => array('brando_general_grid_layout', 'equals', array('grid') ),
        ),
         array(
          'id' => 'brando_general_date_format',
          'type' => 'text',
          'title' => esc_html__('Date Format', 'brando'),
          'default' => 'd m Y',
          'required'  => array('brando_general_show_post_meta', 'equals', array('1') ),
        ),
        array(
            'id'=>'brando_general_show_excerpt',
            'type' => 'switch', 
            'title' => esc_html__('Show Post Excerpt', 'brando'),
            'default' => true,
            'required'  => array('brando_general_grid_layout', 'equals', array('grid','classic') ),
        ),
        array(
          'id' => 'brando_general_excerpt_length',
          'type' => 'text',
          'title' => esc_html__('Excerpt', 'brando'),
          'default' => '30',
          'subtitle' => esc_html__('Specify content length in no. of words', 'brando'),
          'required'  => array('brando_general_show_excerpt', 'equals', array('1') ),
        ),
        array(
            'id'=>'brando_general_show_category',
            'type' => 'switch', 
            'title' => esc_html__('Show Post Category', 'brando'),
            'default' => true,
            'required'  => array('brando_general_grid_layout', 'equals', array('classic') ),
        ),
        array(
            'id'=>'brando_general_show_comments',
            'type' => 'switch', 
            'title' => esc_html__('Show Post Comments', 'brando'),
            'default' => true,
            'required'  => array('brando_general_grid_layout', 'equals', array('classic') ),
        ),
        array(
            'id'=>'brando_general_show_social_icon',
            'type' => 'switch', 
            'title' => esc_html__('Show Social Icons', 'brando'),
            'default' => true,
            'required'  => array('brando_general_grid_layout', 'equals', array('classic') ),
        ),
        array(
            'id'=>'brando_general_show_button',
            'type' => 'switch', 
            'title' => esc_html__('Show Button', 'brando'),
            'default' => true,
            'required'  => array('brando_general_grid_layout', 'equals', array('classic') ),
        ),
        array(
          'id' => 'brando_general_button_text',
          'type' => 'text',
          'title' => esc_html__('Button Text', 'brando'),
          'default' => 'Continue Reading',
          'required'  => array('brando_general_show_button', 'equals', array('1') ),
        ),
        array(
          'id' => 'brando_general_item_per_page',
          'type' => 'text',
          'title' => esc_html__('No. of items per Page', 'brando'),
          'default' => '',
        ),
        array(
            'id'=>'brando_general_search_content_settings',
            'type' => 'select',
            'title' => esc_html__('Search Content', 'brando'),
            'multi' => true,
            'options' => $brando_search_content,
            'default'  => array('page','post'),
        ),
        array(
            'id'        => 'opt-accordion-end-general',
            'type'      => 'accordion',
            'position'  => 'end'
        ),

        /* Portfolio Category Layout */

        array(
            'id'        => 'opt-accordion-begin-general',
            'type'      => 'accordion',
            'title'     => esc_html__('Portfolio Category, Tag Layout Settings', 'brando'),
            'subtitle'  => esc_html__('Portfolio category,tag page configurations', 'brando'),
            'position'  => 'start',
        ),
        array(
            'id'       => 'brando_portfolio_cat_settings',
            'type'     => 'image_select',
            'title'    => esc_html__( 'Sidebar Settings', 'brando' ),
            'options'  => array(
                'brando_portfolio_cat_full_screen' => array(
                    'alt' => esc_html__('One Column','brando'),
                    'img' => ReduxFramework::$_url . 'assets/img/1col.png'
                ),
                'brando_portfolio_cat_left_sidebar' => array(
                    'alt' => esc_html__('Two Columns Left','brando'),
                    'img' => ReduxFramework::$_url . 'assets/img/2cl.png'
                ),
                'brando_portfolio_cat_right_sidebar' => array(
                    'alt' => esc_html__('Two Columns Right','brando'),
                    'img' => ReduxFramework::$_url . 'assets/img/2cr.png'
                ),
                'brando_portfolio_cat_both_sidebar' => array(
                    'alt' => esc_html__('Three Columns','brando'),
                    'img' => ReduxFramework::$_url . 'assets/img/3cm.png'
                ),
            ),
            'default'  => '1'
        ),
        array(
            'id'       => 'brando_portfolio_cat_enable_container_fluid',
            'type'     => 'switch',
            'title'    => esc_html__('Enable Container Fluid', 'brando'),
            'default'  => false,
            'required'  => array('brando_portfolio_cat_settings', 'equals', 'brando_portfolio_cat_full_screen'),
        ),
        array(
            'id' => 'brando_portfolio_cat_left_sidebar',
            'type' => 'select',
            'title' => esc_html__('Left Sidebar', 'brando'),
            'data' => 'sidebar',
            'default' => '',
            'subtitle' => esc_html__('Select sidebar to display in left column of page', 'brando'),
            'required'  => array('brando_portfolio_cat_settings', 'equals', array('brando_portfolio_cat_left_sidebar', 'brando_portfolio_cat_both_sidebar') ),
        ),
        array(
            'id'        => 'brando_portfolio_cat_right_sidebar',
            'type'      => 'select',
            'title'     => esc_html__('Right Sidebar', 'brando'),
            'data'      => 'sidebar',
            'default'   => '',
            'subtitle' => esc_html__('Select sidebar to display in right column of page', 'brando'),
            'required'  => array('brando_portfolio_cat_settings', 'equals', array('brando_portfolio_cat_right_sidebar', 'brando_portfolio_cat_both_sidebar') ),
        ),
        array(
            'id'       => 'brando_portfolio_cat_style',
            'type'     => 'images',
            'title'    => esc_html__('Select a Portfolio Style', 'brando'),
            'options' => array(
                "portfolio1" => get_template_directory_uri()."/assets/images/portfolio-style-1.jpg",
                "portfolio2" => get_template_directory_uri()."/assets/images/portfolio-style-2.jpg",
                "portfolio3" => get_template_directory_uri()."/assets/images/portfolio-style-3.jpg",
                "portfolio4" => get_template_directory_uri()."/assets/images/portfolio-style-4.jpg",
                "portfolio5" => get_template_directory_uri()."/assets/images/portfolio-style-5.jpg",
                "portfolio6" => get_template_directory_uri()."/assets/images/portfolio-style-6.jpg",
                "portfolio7" => get_template_directory_uri()."/assets/images/portfolio-style-7.jpg",
            ),
            'imgtitle' => array(
                "imgtitle1" => esc_html__("Portfolio Style 1",'brando'),
                "imgtitle2" => esc_html__("Portfolio Style 2",'brando'),
                "imgtitle3" => esc_html__("Portfolio Style 3",'brando'),
                "imgtitle4" => esc_html__("Portfolio Style 4",'brando'),
                "imgtitle5" => esc_html__("Portfolio Style 5",'brando'),
                "imgtitle6" => esc_html__("Portfolio Style 6",'brando'),
                "imgtitle7" => esc_html__("Portfolio Style 7",'brando'),
            ),
        ),
        array(
            'id'=>'brando_portfolio_cat_columns_settings',
            'type' => 'select',
            'title' => esc_html__('Select a Portfolio Type', 'brando'),
            'options' => array(
                '2' => esc_html__('column 2', 'brando'),
                '3' => esc_html__('column 3', 'brando'),
                '4' => esc_html__('column 4', 'brando'),
                '5' => esc_html__('column 5', 'brando'),
            ),
            'default' => '2',
        ),
        array(
            'id'=>'brando_portfolio_cat_type',
            'type' => 'select',
            'title' => esc_html__('Layout Columns Settings', 'brando'),
            'options' => array(
                'gutter' => esc_html__('Gutter', 'brando'),
                'gutter-medium' => esc_html__('Gutter Medium', 'brando'),
                'gutter-wide' => esc_html__('Gutter Wide', 'brando'),
            ),
            'default' => '2',
        ),
        array(
          'id' => 'brando_portfolio_cat_item_per_page',
          'type' => 'text',
          'title' => esc_html__('No. of items per Page', 'brando'),
          'default' => '',
        ),
        array(
            'id'        => 'opt-accordion-end-general',
            'type'      => 'accordion',
            'position'  => 'end'
        ),

        /* Archive Pages Header Setting */
        
        array(
            'id'        => 'opt-accordion-begin-general',
            'type'      => 'accordion',
            'title'     => esc_html__('Header Settings', 'brando'),
            'subtitle'  => esc_html__('Header settings only for Archive, Category, Search, Tag, Author Pages', 'brando'),
            'position'  => 'start',
        ),
        array(
            'id'       => 'brando_enable_header_general',
            'type'     => 'switch',
            'title'    => esc_html__('Enable Header', 'brando'),
            'default'  => true,
          ),
          array(
            'id'       => 'brando_header_layout_general',
            'type'     => 'images',
            'title'    => esc_html__('Select a Header Style', 'brando'),
            'options' => array(
                "headertype1" => get_template_directory_uri()."/assets/images/header1.jpg",
                "headertype2" => get_template_directory_uri()."/assets/images/header2.jpg",
                "headertype3" => get_template_directory_uri()."/assets/images/header3.jpg",
                "headertype4" => get_template_directory_uri()."/assets/images/header4.jpg",
                "headertype5" => get_template_directory_uri()."/assets/images/header5.jpg",
                "headertype6" => get_template_directory_uri()."/assets/images/header6.jpg",
                "headertype7" => get_template_directory_uri()."/assets/images/header7.jpg",
            ),
            'imgtitle' => array(
                "imgtitle1" => esc_html__("Header With Call To Action",'brando'),
                "imgtitle2" => esc_html__("Hamburger Menu Header",'brando'),
                "imgtitle3" => esc_html__("Centered Logo Menu Header",'brando'),
                "imgtitle4" => esc_html__("Left Vertical Menu Header",'brando'),
                "imgtitle5" => esc_html__("White Background Header",'brando'),
                "imgtitle6" => esc_html__("Transparent Header",'brando'),
                "imgtitle7" => esc_html__("Without Border Header",'brando'),
            ),
          ),
          array(
            'id'       => 'brando_header_text_color_general',
            'type'     => 'select',
            'title'    => esc_html__('Header Text Color', 'brando'),
            'options' => array(
                'nav-black' => esc_html__('Black', 'brando'),
                'nav-white' => esc_html__('White', 'brando'),
            ),
          ),
          array(
            'id' => 'brando_logo_setting_general',
            'type' => 'info_title',
            'title' => esc_html__('Logo Settings', 'brando'),
          ),
          array(
            'id'       => 'brando_header_logo_general',
            'type'     => 'media',
            'preview'  => true,
            'url'      => true,  
            'title'    => esc_html__( 'Logo', 'brando' ),
            'subtitle' => esc_html__( 'Upload the logo that will be displayed in the header', 'brando' ),
          ),
          array(
            'id'       => 'brando_retina_logo_general',
            'type'     => 'media',
            'preview'  => true,
            'url'      => true,  
            'title'    => esc_html__( 'Logo Retina', 'brando' ),
            'subtitle' => esc_html__( 'Optional retina version displayed in devices with retina display (high resolution display).', 'brando' ),
          ),
          array(
              'id' => 'brando_logo_url_general',
              'type' => 'text',
              'title' => esc_html__('Logo URL', 'brando'),
              'default' => '',
              'subtitle' => esc_html__('Specify logo url like. #home.', 'brando'),
          ),
          array(
              'id' => 'brando_retina_logo_width_general',
              'type' => 'text',
              'title' => esc_html__('Retina Logo Width', 'brando'),
              'default' => '',
              'subtitle' => esc_html__('Specify the width in pixel eg. 15px', 'brando'),
          ),
          array(
              'id' => 'brando_retina_logo_height_general',
              'type' => 'text',
              'title' => esc_html__('Retina Logo Height', 'brando'),
              'default' => '',
              'subtitle' => esc_html__('Specify the height in pixel eg. 15px', 'brando'),
          ),
          array(
            'id'        => 'brando_header_sidebar_general',
            'type'      => 'select',
            'title'     => esc_html__('Header Sidebar', 'brando'),
            'data'      => 'sidebar',
            'default'   => '',
            'subtitle' => esc_html__('Select sidebar to display in header', 'brando'),
        ),
        array(
            'id'        => 'opt-accordion-end-general',
            'type'      => 'accordion',
            'position'  => 'end'
        ),
    )
);
?>