<?php
/**
 * displaying single posts quote for blog
 *
 * @package Brando
 */
?>
<?php
$brando_blog_quote = brando_post_meta('brando_quote');
echo '<div class="blog-image margin-bottom-30px">';
    if($brando_blog_quote):
        echo '<blockquote class="bg-gray alt-font">';
            echo '<p class="text-large margin-ten no-margin-lr no-margin-top">'.$brando_blog_quote.'</p>';
        echo '</blockquote>';
    endif;
echo '</div>';

$brando_blog_image = brando_post_meta("brando_featured_image");
if($brando_blog_image == 1)
{
    echo '<div class="blog-image bg-transparent margin-five no-margin-lr">';
        if ( has_post_thumbnail() ) 
        {
            the_post_thumbnail( 'full' );
        }
    echo '</div>';
}	
?>
