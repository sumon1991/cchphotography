<?php
/**
 * Shortcode For Portfolio
 *
 * @package Brando
 */
?>
<?php
/*-----------------------------------------------------------------------------------*/
/* Portfolio */
/*-----------------------------------------------------------------------------------*/

if ( ! function_exists( 'brando_portfolio_filter_shortcode' ) ) {
    function brando_portfolio_filter_shortcode( $atts, $content = null ) {
        extract( shortcode_atts( array(
            'id' => '',
            'class' => '',
            'brando_portfolio_filter_style' => '',
            'brando_categories_list' => '',
            'brando_filter_custom_color' => '',
        ), $atts ) );
        $output = $classes = $filter_style = '';
        $classes = $style_array = array();
        $id = ( $id ) ? ' id="'.$id.'"' : '';
        $class = ( $class ) ? $classes[] = $class : '';

        $brando_filter_custom_color = ( $brando_filter_custom_color ) ? ' style="color:'.$brando_filter_custom_color.' !important;"' : '';
      
        // Class List
        $class_list = implode(" ", $classes);
        $column_class = ( $class_list ) ? ' '.$class_list : '';
        
        $categories_to_display_ids = explode(",",$brando_categories_list);
        if ( is_array( $categories_to_display_ids ) && $categories_to_display_ids[0] == '0' ) {
            unset( $categories_to_display_ids[0] );
            $categories_to_display_ids = array_values( $categories_to_display_ids );
        }
        // If no categories are chosen or "All categories", we need to load all available categories
        if ( ! is_array( $categories_to_display_ids ) || count( $categories_to_display_ids ) == 0 ) {
            $terms = get_terms( 'portfolio-category' );
            
            if ( ! is_array( $categories_to_display_ids ) ) {
                $categories_to_display_ids = array();
            }
            foreach ( $terms as $term ) {
                $categories_to_display_ids[] = $term->slug;
            }
        }
        
        $taxonomy = 'portfolio-category';
        $args = array(
            'orderby' => 'id',
            'order' => 'ASC',
            'hide_empty'        => 0, 
            'slug'           => $categories_to_display_ids,
        );
        $tax_terms = get_terms($taxonomy, $args);
        switch ($brando_portfolio_filter_style) {
            case 'filter-style-1':
                $output .='<ul'.$id.' class="portfolio-filter nav nav-tabs no-border portfolio-filter-tab alt-font text-uppercase letter-spacing-1'.$column_class.'">';
                    $output .='<li class="nav active xs-display-inline "><a href="#" data-filter="*" class="xs-display-inline"'.$brando_filter_custom_color.'>All</a></li>';
                    foreach ($tax_terms as $tax_term) {
                        $output .='<li class="nav xs-display-inline "><a href="#" data-filter=".portfolio-filter-'.$tax_term->term_id.'" class="xs-display-inline"'.$brando_filter_custom_color.'>'.$tax_term->name.'</a></li>';
                    }
                $output .='</ul>';
            break;
            
            case 'filter-style-2':
                $output .='<ul'.$id.' class="portfolio-filter nav nav-tabs portfolio-filter-tab-style-2 alt-font text-uppercase letter-spacing-1 xs-width-100'.$column_class.'">';
                    $output .='<li class="nav active xs-display-inline"><a href="#" data-filter="*"'.$brando_filter_custom_color.'>All</a></li>';
                    foreach ($tax_terms as $tax_term) {
                        $output .='<li class="nav xs-display-inline"><a href="#" data-filter=".portfolio-filter-'.$tax_term->term_id.'"'.$brando_filter_custom_color.'>'.$tax_term->name.'</a></li>';
                    }
                $output .='</ul>';
            break;

            case 'filter-style-3':
                $output .='<ul'.$id.' class="portfolio-filter nav nav-tabs no-border portfolio-filter-tab-style-4 alt-font text-large text-uppercase letter-spacing-1'.$column_class.'">';
                    $output .='<li class="nav active xs-display-inline"><a href="#" data-filter="*" class="position-relative xs-display-inline"'.$brando_filter_custom_color.'>All</a></li>';
                    foreach ($tax_terms as $tax_term) {
                        $output .='<li class="nav xs-display-inline"><a href="#" data-filter=".portfolio-filter-'.$tax_term->term_id.'" class="position-relative xs-display-inline"'.$brando_filter_custom_color.'>'.$tax_term->name.'</a></li>';
                    }
                $output .='</ul>';
            break;

            case 'filter-style-4':
                $output .='<ul'.$id.' class="portfolio-filter sm-text-small nav nav-tabs no-border portfolio-filter-tab-style-5 alt-font text-uppercase letter-spacing-1 text-large'.$column_class.'">';
                    $output .='<li class="nav active xs-display-inline xs-width-100 xs-text-center"><a href="#" data-filter="*" class="position-relative xs-display-inline"'.$brando_filter_custom_color.'>All</a></li>';
                    foreach ($tax_terms as $tax_term) {
                        $output .='<li class="nav xs-display-inline xs-width-100 xs-text-center"><a href="#" data-filter=".portfolio-filter-'.$tax_term->term_id.'" class="position-relative xs-display-inline"'.$brando_filter_custom_color.'>'.$tax_term->name.'</a></li>';
                    }
                $output .='</ul>';
            break;

            case 'filter-style-5':
                $output .='<div class="col-lg-6 col-md-8 col-sm-10 col-xs-10 text-right pull-right margin-six-bottom sm-margin-ten-bottom">';
                    $output .='<ul'.$id.' class="portfolio-filter nav nav-tabs no-border portfolio-filter-tab-style-6 alt-font text-large text-uppercase letter-spacing-1'.$column_class.'">';
                       $output .='<li class="nav active xs-display-inline xs-width-100 xs-padding-four-tb"><a href="#" data-filter="*" class="position-relative xs-display-inline"'.$brando_filter_custom_color.'>All</a></li>';
                        foreach ($tax_terms as $tax_term) {
                            $output .='<li class="nav xs-display-inline xs-width-100 xs-padding-four-tb"><a href="#" data-filter=".portfolio-filter-'.$tax_term->term_id.'" class="position-relative xs-display-inline"'.$brando_filter_custom_color.'>'.$tax_term->name.'</a></li>';
                        }
                    $output .='</ul>';
                $output .='</div>';
            break;

            case 'filter-style-6':
                $output .='<ul'.$id.' class="portfolio-filter nav nav-tabs no-border portfolio-filter-tab-style-3 alt-font text-uppercase letter-spacing-1'.$column_class.'">';
                    $output .='<li class="nav active xs-display-inline "><a href="#" data-filter="*" class="xs-display-inline"'.$brando_filter_custom_color.'>All</a></li>';
                    foreach ($tax_terms as $tax_term) {
                        $output .='<li class="nav xs-display-inline "><a href="#" data-filter=".portfolio-filter-'.$tax_term->term_id.'" class="xs-display-inline"'.$brando_filter_custom_color.'>'.$tax_term->name.'</a></li>';
                    }
                $output .='</ul>';
            break;
        }

        return $output;
    }
}
add_shortcode( 'brando_portfolio_filter', 'brando_portfolio_filter_shortcode' );
?>