<?php
/**
 * The template for displaying the footer
 *
 * @package Brando
 */
?>
<?php 
	get_template_part('templates/footer');

	$brando_header_layout = brando_option('brando_header_layout');
	$brando_enable_header =  brando_option('brando_enable_header');
	if( $brando_header_layout == 'headertype4' && $brando_enable_header != 0){
	    echo '</div>';
	}

	// Close Div For Ajax Popup
	brando_add_ajax_page_div_footer( get_the_ID() );

	brando_set_footer(get_the_ID());

	wp_footer();
?>
</body>
</html>
