<?php
/**
 * This file use for define custom search form.
 *
 * @package Brando
 */
?>
<?php // Start search form. ?>
<form method="get" action="<?php echo esc_url( home_url( '/' ) );?>" name="search" class="main-search">
    <button type="submit" class="fa fa-search close-search search-button"></button>
    <input class="alt-font blog-search-btn" type="text" name="s" value="<?php echo get_search_query();?>" placeholder="<?php echo esc_html__('TYPE KEYWORD HERE...', 'brando');?>">
</form>
<?php // End search form. ?>