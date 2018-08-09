<?php
/**
 * The template for displaying Author bios
 *
 * @package Brando
 */
?>
<?php // Start Author Info. ?>

<div class="text-center bg-gray clear-both margin-six-bottom">
    <div class="blog-comment text-left clearfix no-margin padding-six-all">
        <?php // Start Author Image. ?>
        <a class="comment-avtar no-margin-top" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>">
            <?php echo get_avatar( get_the_author_meta( 'user_email' ), 300 ); ?>
        </a>
        <?php // End Author Image. ?>
        <?php // Start Author Description. ?>
        <div class="comment-text position-relative overflow-hidden">
            <h5 class="alt-font text-large dark-gray-text no-margin"><a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>"><?php esc_html_e( 'About The Author', 'brando' ); ?></a></h5>
            <p class="alt-font text-uppercase text-small"><?php echo get_the_author(); ?></p>
            <p class="no-margin"><?php the_author_meta( 'description' ); ?></p>
        </div>
        <?php // End Author Description. ?>
    </div>
</div>

<?php // End Author Info. ?>