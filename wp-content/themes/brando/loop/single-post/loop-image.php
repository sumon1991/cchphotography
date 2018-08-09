<?php
/**
 * displaying single posts featured image for blog
 *
 * @package Brando
 */
?>
<?php
$brando_blog_image = brando_post_meta("brando_image");

if($brando_blog_image == 1){
	echo '<div class="blog-image bg-transparent">';
	    if ( has_post_thumbnail() ) {
	        the_post_thumbnail( 'full' );
	    }
	echo '</div>';
}
?>