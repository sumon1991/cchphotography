<?php
/**
 *
 * [Parent Theme] child theme functions and definitions
 * 
 * @package [Parent Theme]
 * @author  Themezaa <info@themezaa.com>
 * 
 */

function brando_child_style() {
    wp_enqueue_style( 'brando-parent-style', get_template_directory_uri(). '/style.css', array( 'bootstrap' ) );
}
add_action( 'wp_enqueue_scripts', 'brando_child_style' );