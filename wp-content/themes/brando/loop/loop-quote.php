<?php
/**
 * displaying quote for blog
 *
 * @package Brando
 */
?>
<?php
$brando_blog_quote = brando_post_meta('brando_quote');
echo '<div class="blog-image">';
    if($brando_blog_quote){
        echo '<blockquote class="bg-gray">';
            echo '<p class="text-large">'.$brando_blog_quote.'</p>';
        echo '</blockquote>';
    }
echo '</div>';	
?>
