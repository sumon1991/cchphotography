<?php
/**
 * Social Sharing Links Tab For ( post and product both) Theme Option.
 *
 * @package Brando
 */
?>
<?php
$this->sections[] = array(
    'icon' => 'fa fa-share-alt',
    'title' => esc_html__('Social Sharing', 'brando'),
    'desc' => esc_html__('Select on to show that specific social sharing icon on blog posts.', 'brando'),
    'fields' => array(

                     array(
                        'id'       => 'brando_enable_facebook_sharing',
                        'type'     => 'switch',
                        'title'    => esc_html__('Facebook', 'brando'),
                        'default'  => false,
                    ),
                     array(
                        'id'       => 'brando_enable_twitter_sharing',
                        'type'     => 'switch',
                        'title'    => esc_html__('Twitter', 'brando'),
                        'default'  => false,
                    ),
                     array(
                        'id'       => 'brando_enable_google_plus_sharing',
                        'type'     => 'switch',
                        'title'    => esc_html__('Google Plus', 'brando'),
                        'default'  => false,
                    ),
                
                    array(
                        'id'       => 'brando_enable_linkedin_sharing',
                        'type'     => 'switch',
                        'title'    => esc_html__('LinkedIn', 'brando'),
                        'default'  => false,
                    ),
                    array(
                        'id'       => 'brando_enable_pinterest_sharing',
                        'type'     => 'switch',
                        'title'    => esc_html__('Pinterest', 'brando'),
                        'default'  => false,
                    ),
                    array(
                        'id'       => 'brando_enable_delicious_sharing',
                        'type'     => 'switch',
                        'title'    => esc_html__('Delicious', 'brando'),
                        'default'  => false,
                    ),
                    array(
                        'id'       => 'brando_enable_livejournal_sharing',
                        'type'     => 'switch',
                        'title'    => esc_html__('Livejournal', 'brando'),
                        'default'  => false,
                    ),
                    array(
                        'id'       => 'brando_enable_reddit_sharing',
                        'type'     => 'switch',
                        'title'    => esc_html__('Reddit', 'brando'),
                        'default'  => false,
                    ),
                    array(
                        'id'       => 'brando_enable_stumbleupon_sharing',
                        'type'     => 'switch',
                        'title'    => esc_html__('Stumbleupon', 'brando'),
                        'default'  => false,
                    ),
                    array(
                        'id'       => 'brando_enable_digg_sharing',
                        'type'     => 'switch',
                        'title'    => esc_html__('Digg', 'brando'),
                        'default'  => false,
                    ),
                    array(
                        'id'       => 'brando_enable_tumblr_sharing',
                        'type'     => 'switch',
                        'title'    => esc_html__('Tumblr', 'brando'),
                        'default'  => false,
                    ),
                )
);


?>