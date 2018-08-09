<?php
/**
 * Footer Tab For Theme Option.
 *
 * @package Brando
 */
?>
<?php
$this->sections[] = array(
    'icon' => 'el-icon-website icon-rotate',
    'title' => esc_html__('Footer', 'brando'),
    'desc' => esc_html__('Footer section configuration settings', 'brando'),
    'fields' => array(
    	array(
            'id'       => 'brando_enable_page_footer',
            'type'     => 'switch',
            'title'    => esc_html__('Enable Footer ¨¨W¨P¨L¨O¨C¨K¨E¨R¨.¨C¨O¨M¨¨', 'brando'),
            'default'  => true,
        ),
        array(
            'id'       => 'brando_footer_bg_image',
            'type'     => 'media',
            'preview'  => true,
            'url'      => true,
            'title'    => esc_html__( 'Footer Background Image', 'brando' ),
        ),
        array(
            'id'       => 'brando_footer_type',
            'type'     => 'images',
            'title'    => esc_html__('Brando Footer Type', 'brando'),
            'options' => array(
                "footer-type-1" => get_template_directory_uri()."/assets/images/footer-type-1.jpg",
                "footer-type-2" => get_template_directory_uri()."/assets/images/footer-type-2.jpg",
                "footer-type-3" => get_template_directory_uri()."/assets/images/footer-type-3.jpg",
                "footer-type-4" => get_template_directory_uri()."/assets/images/footer-type-4.jpg",
                "footer-type-5" => get_template_directory_uri()."/assets/images/footer-type-5.jpg",
            ),
            'imgtitle' => array(
                "imgtitle1" => esc_html__("Footer Style 1",'brando'),
                "imgtitle2" => esc_html__("Footer Style 2",'brando'),
                "imgtitle3" => esc_html__("Footer Style 3",'brando'),
                "imgtitle4" => esc_html__("Footer Style 4",'brando'),
                "imgtitle5" => esc_html__("Footer Style 5",'brando'),
            ),
            'default' => 'footer-type-1',
          ),
        array(
              'id' => 'brando_footer_text',
              'type' => 'text',
              'title' => esc_html__('Footer Text', 'brando'),
              'default' => '',
              'subtitle' => esc_html__('Specify footer text.', 'brando'),
              'required'  => array('brando_footer_type', 'equals', array('footer-type-1','footer-type-2')),
        ),
		array(
            'id'       => 'brando_enable_footer_logo',
            'type'     => 'switch',
            'title'    => esc_html__('Enable Footer Logo', 'brando'),
            'default'  => false,
            'required'  => array('brando_footer_type', 'equals', array('footer-type-1','footer-type-2','footer-type-4')),
        ),
        array(
            'id'       => 'brando_footer_logo',
            'type'     => 'media',
            'required'  => array('brando_enable_footer_logo', 'equals', '1'),
            'preview'  => true,
            'url'      => true,
            'title'    => esc_html__( 'Footer Logo', 'brando' ),
        ),
        array(
            'id'        => 'brando_footer_sidebar',
            'type'      => 'select',
            'title'     => esc_html__('Footer Sidebar', 'brando'),
            'data'      => 'sidebar',
            'default'   => '',
            'subtitle' => esc_html__('Select sidebar to display in footer', 'brando'),
            'required'  => array('brando_footer_type', 'equals', array('footer-type-1','footer-type-2','footer-type-3','footer-type-4','footer-type-5')),
        ),
        array(
            'id'       => 'brando_enable_footer_copyright',
            'type'     => 'switch',
            'title'    => esc_html__('Enable Footer Copyright', 'brando'),
            'default'  => false,
            'required'  => array('brando_footer_type', 'equals', array('footer-type-1','footer-type-2','footer-type-3','footer-type-4','footer-type-5')),
        ),
        array(
            'id'       => 'brando_footer_copyright',
            'type'     => 'textarea',
            'title'    => esc_html__( 'Copyright', 'brando' ),
            'required'  => array('brando_enable_footer_copyright', 'equals', '1'),
            'subtitle' => esc_html__( 'Add copyright content here', 'brando' ),
        ),
        array(
            'id'       => 'brando_enable_scrolltotop_button',
            'type'     => 'switch',
            'title'    => esc_html__('Enable ScrollToTop Button', 'brando'),
            'default'  => false,
        ),
    )
);
?>