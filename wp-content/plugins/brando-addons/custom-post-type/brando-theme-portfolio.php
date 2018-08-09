<?php
/**
 * Register Custom Post Type Portfolio.
 *
 * @package Brando
 */
?>
<?php
/**
 * Portfolio custom post type
 */
$labels = array(
	'name'               => _x( 'Portfolio', 'Projects','brando-addons' ),
	'singular_name'      => _x( 'Portfolio', 'Project','brando-addons' ),
	'add_new'            => _x( 'Add New', 'Project','brando-addons' ),
	'add_new_item'       => __( 'Add New Project','brando-addons' ),
	'edit_item'          => __( 'Edit Project','brando-addons' ),
	'new_item'           => __( 'New Project','brando-addons' ),
	'all_items'          => __( 'All Projects','brando-addons' ),
	'view_item'          => __( 'View Project','brando-addons' ),
	'search_items'       => __( 'Search Projects','brando-addons' ),
	'not_found'          => __( 'No Projects found','brando-addons' ),
	'not_found_in_trash' => __( 'No Projects found in the Trash','brando-addons' ),
	'parent_item_colon'  => '',
	'menu_name'          => __('Portfolio', 'brando-addons' )
);
$args = array(
	'labels'        => $labels,
	'description'   => __('Holds our products and product specific data', 'brando-addons' ),
	'public'        => true,
	'menu_icon'     => 'dashicons-portfolio',
	'menu_position' => 21,
	'supports'      => array( 'title', 'thumbnail','editor', 'comments','revisions','page-attributes' ),
	'has_archive'   => true,
	'hierarchical' => true,
);
register_post_type( 'portfolio', $args );

/**
 * Portflio Category
 */
$labels = array(
	'name'              => _x( 'Categories', 'taxonomy general name', 'brando-addons' ),
	'singular_name'     => _x( 'Category', 'taxonomy singular name', 'brando-addons' ),
	'search_items'      => __( 'Search categories', 'brando-addons' ),
	'all_items'         => __( 'All Categories', 'brando-addons' ),
	'parent_item'       => __( 'Parent Category', 'brando-addons' ),
	'parent_item_colon' => __( 'Parent Category:', 'brando-addons' ),
	'edit_item'         => __( 'Edit Category', 'brando-addons' ),
	'update_item'       => __( 'Update Category', 'brando-addons' ),
	'add_new_item'      => __( 'Add New Category', 'brando-addons' ),
	'new_item_name'     => __( 'New Category Name', 'brando-addons' ),
	'menu_name'         => __( 'Categories' ),
);
$args = array( 'labels' => $labels, 'hierarchical' => true);

register_taxonomy( 'portfolio-category', 'portfolio', $args );

/**
 * Portflio Tag
 */

$args = array('hierarchical' => false, 'label' => 'Tags', 'query_var' => true, 'rewrite' => true);

register_taxonomy( 'portfolio-tags', 'portfolio', $args );
?>