<?php
/**
 * Header Tab For Theme Option.
 *
 * @package Brando
 */
?>
<?php
$this->sections[] = array(
    'icon' => 'fa fa-header',
    'title' => esc_html__('Header', 'brando'),
    'desc' => esc_html__('Header section configuration settings', 'brando'),
    'fields' => array(
          array(
            'id'       => 'brando_enable_header',
            'type'     => 'switch',
            'title'    => esc_html__('Enable Header', 'brando'),
            'default'  => true,
          ),
          array(
            'id'       => 'brando_header_layout',
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
            'default' => 'headertype5',
          ),
          array(
            'id'       => 'brando_header_text_color',
            'type'     => 'select',
            'title'    => esc_html__('Header Text Color', 'brando'),
            'options' => array(
                'nav-black' => esc_html__('Black', 'brando'),
                'nav-white' => esc_html__('White', 'brando'),
            ),
            'default' => 'nav-black',
          ),
          array(
            'id' => 'brando_logo_setting',
            'type' => 'info_title',
            'title' => esc_html__('Logo Settings', 'brando'),
          ),
          array(
            'id'       => 'brando_header_logo',
            'type'     => 'media',
            'preview'  => true,
            'url'      => true,  
            'title'    => esc_html__( 'Logo', 'brando' ),
            'subtitle' => esc_html__( 'Upload the logo that will be displayed in the header', 'brando' ),
          ),
          array(
            'id'       => 'brando_retina_logo',
            'type'     => 'media',
            'preview'  => true,
            'url'      => true,  
            'title'    => esc_html__( 'Logo Retina', 'brando' ),
            'subtitle' => esc_html__( 'Optional retina version displayed in devices with retina display (high resolution display).', 'brando' ),
          ),
          array(
              'id' => 'brando_logo_url',
              'type' => 'text',
              'title' => esc_html__('Logo URL', 'brando'),
              'default' => '',
              'subtitle' => esc_html__('Specify logo url like. http://www.domain.com', 'brando'),
          ),
          array(
              'id' => 'brando_retina_logo_width',
              'type' => 'text',
              'title' => esc_html__('Retina Logo Width', 'brando'),
              'default' => '',
              'subtitle' => esc_html__('Specify the width in pixel eg. 15px', 'brando'),
          ),
          array(
              'id' => 'brando_retina_logo_height',
              'type' => 'text',
              'title' => esc_html__('Retina Logo Height', 'brando'),
              'default' => '',
              'subtitle' => esc_html__('Specify the height in pixel eg. 15px', 'brando'),
          ),
          array(
            'id'        => 'brando_header_sidebar',
            'type'      => 'select',
            'title'     => esc_html__('Header Sidebar', 'brando'),
            'data'      => 'sidebar',
            'default'   => '',
            'subtitle' => esc_html__('Select sidebar to display in header', 'brando'),
        ),
    )
);
?>