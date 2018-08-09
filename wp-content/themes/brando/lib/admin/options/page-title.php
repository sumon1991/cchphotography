<?php
/**
 * Page Title Tab For Theme Option.
 *
 * @package Brando
 */
?>
<?php
$this->sections[] = array(
    'icon' => 'el-icon-website',
    'title' => esc_html__('Page Title', 'brando'),
    'fields' => array(
                  	  array(
                          'id'       => 'brando_enable_title_wrapper',
                          'type'     => 'switch',
                          'title'    => esc_html__('Enable Title', 'brando'),
                          'default'  => true,
                          'subtitle' => esc_html__('If on, a title will display in page', 'brando'),
                      ),
                      array(
                        'id' => 'brando_header_subtitle',
                        'type' => 'text',
                        'title' => esc_html__('Subtitle', 'brando'),
                        'required'  => array('brando_enable_title_wrapper', 'equals', '1'),
                      ),
                      array(
                          'id'       => 'brando_title_background',
                          'type'     => 'media',
                          'preview'  => true,
                          'url'      => true,  
                          'title'    => esc_html__( 'Title Background Image', 'brando' ),
                          'subtitle' => esc_html__('Recommended image size (1920px X 700px) for better result.', 'brando'),
                          'required'  => array('brando_enable_title_wrapper', 'equals', '1'),
                      ),
                      array(
                          'id'       => 'brando_title_parallax_effect',
                          'type'     => 'select',
                          'title'    => esc_html__( 'Parallax effect', 'brando' ),
                          'options'  => array('no-effect' => esc_html__('No Effect', 'brando'),
                                    'parallax1' => esc_html__('Parallax effect 1', 'brando'),
                                    'parallax2' => esc_html__('Parallax effect 2', 'brando'),
                                    'parallax3' => esc_html__('Parallax effect 3', 'brando'),
                                    'parallax4' => esc_html__('Parallax effect 4', 'brando'),
                                    'parallax5' => esc_html__('Parallax effect 5', 'brando'),
                                    'parallax6' => esc_html__('Parallax effect 6', 'brando'),
                                    'parallax7' => esc_html__('Parallax effect 7', 'brando'),
                                    'parallax8' => esc_html__('Parallax effect 8', 'brando'),
                                    'parallax9' => esc_html__('Parallax effect 9', 'brando'),
                                    'parallax10' => esc_html__('Parallax effect 10', 'brando'),
                                    'parallax11' => esc_html__('Parallax effect 11', 'brando'),
                                    'parallax12' => esc_html__('Parallax effect 12', 'brando')
                                   ),
                          'subtitle' => esc_html__( 'Choose parallax effect', 'brando' ),
                          'required'  => array('brando_enable_title_wrapper', 'equals', '1'),
                      ),
                )
);
?>