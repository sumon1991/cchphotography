<?php
/**
 * displaying featured image for blog
 *
 * @package Brando
 */
?>
<?php
/* Image Alt, Title, Caption */
$brando_img_alt = brando_option_image_alt(get_post_thumbnail_id());
$brando_img_title = brando_option_image_title(get_post_thumbnail_id());
$brando_image_alt = ( isset($brando_img_alt['alt']) && !empty($brando_img_alt['alt']) ) ? $brando_img_alt['alt'] : '' ; 
$brando_image_title = ( isset($brando_img_title['title']) && !empty($brando_img_title['title']) ) ? $brando_img_title['title'] : '';

$brando_img_attr = array(
    'title' => $brando_image_title,
    'alt' => $brando_image_alt,
);
echo '<div class="blog-image"><a href="'.get_permalink().'">';
    if ( has_post_thumbnail() ) {
        echo get_the_post_thumbnail( get_the_ID(), 'full',$brando_img_attr );
    }
echo '</a></div>';

?>