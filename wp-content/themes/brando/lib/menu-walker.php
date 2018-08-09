<?php
/*
 * Brando Menu Admin Options.
 */

// Exit if accessed directly
if( ! defined( 'ABSPATH' ) ) {
	die;
}
// http://wordpress.stackexchange.com/questions/33342/how-to-add-a-custom-field-in-the-advanced-menu-properties Thanks to "djrmom"
/*
 * Saves new field to postmeta for navigation
 */
add_action('wp_update_nav_menu_item', 'brando_nav_option_update',10, 3);
function brando_nav_option_update($menu_id, $menu_item_db_id, $args ) {

    if( !isset( $_REQUEST['menu-item-brando-menu-single-item-status'][$menu_item_db_id] )) { 
        $_REQUEST['menu-item-brando-menu-single-item-status'][$menu_item_db_id] = '';
    }
    $brando_menu_single_item_status = $_REQUEST['menu-item-brando-menu-single-item-status'][$menu_item_db_id];

    update_post_meta( $menu_item_db_id, '_brando_menu_single_item_status', $brando_menu_single_item_status );

    if( !isset( $_REQUEST['menu-item-brando-menu-single-item-number'][$menu_item_db_id] )) { 
        $_REQUEST['menu-item-brando-menu-single-item-number'][$menu_item_db_id] = '';
    }
    $brando_menu_single_item_number = $_REQUEST['menu-item-brando-menu-single-item-number'][$menu_item_db_id];

    update_post_meta( $menu_item_db_id, '_brando_menu_single_item_number', $brando_menu_single_item_number );

    if( !isset( $_REQUEST['menu-item-brando-menu-single-item-image'][$menu_item_db_id] )) { 
        $_REQUEST['menu-item-brando-menu-single-item-image'][$menu_item_db_id] = '';
    }
    $brando_menu_single_item_image = $_REQUEST['menu-item-brando-menu-single-item-image'][$menu_item_db_id];

    update_post_meta( $menu_item_db_id, '_brando_menu_single_item_image', $brando_menu_single_item_image );

    if( !isset( $_REQUEST['menu-item-brando-menu-single-item-thumb-image'][$menu_item_db_id] )) { 
        $_REQUEST['menu-item-brando-menu-single-item-thumb-image'][$menu_item_db_id] = '';
    }
    $brando_menu_single_item_image_thumb = $_REQUEST['menu-item-brando-menu-single-item-thumb-image'][$menu_item_db_id];

    update_post_meta( $menu_item_db_id, '_brando_menu_single_item_thumb_image', $brando_menu_single_item_image_thumb );
    
}

add_filter( 'wp_edit_nav_menu_walker', 'custom_nav_edit_walker',10,2 );
function custom_nav_edit_walker($walker,$menu_id) {
    return 'Walker_Nav_Menu_Edit_Custom';
}

/**
 * Copied from Walker_Nav_Menu_Edit class in core
 * 
 * Create HTML list of nav menu input items.
 *
 * @package WordPress
 * @since 3.0.0
 * @uses Walker_Nav_Menu
 */
class Walker_Nav_Menu_Edit_Custom extends Walker_Nav_Menu  {
/**
 * @see Walker_Nav_Menu::start_lvl()
 * @since 3.0.0
 *
 * @param string $output Passed by reference.
 */
public $menu_icon_number = 1;

public function start_lvl( &$output, $depth = 0, $args = array() ) {}

/**
 * @see Walker_Nav_Menu::end_lvl()
 * @since 3.0.0
 *
 * @param string $output Passed by reference.
 */
public function end_lvl( &$output, $depth = 0, $args = array() ) {
}

/**
 * @see Walker::start_el()
 * @since 3.0.0
 *
 * @param string $output Passed by reference. Used to append additional content.
 * @param object $item Menu item data object.
 * @param int $depth Depth of menu item. Used for padding.
 * @param object $args
 */
public function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {

    global $_wp_nav_menu_max_depth;
    $_wp_nav_menu_max_depth = $depth > $_wp_nav_menu_max_depth ? $depth : $_wp_nav_menu_max_depth;

    $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

    ob_start();
    $item_id = esc_attr( $item->ID );
    $removed_args = array(
        'action',
        'customlink-tab',
        'edit-menu-item',
        'menu-item',
        'page-tab',
        '_wpnonce',
    );

    $original_title = '';
    if ( 'taxonomy' == $item->type ) {
        $original_title = get_term_field( 'name', $item->object_id, $item->object, 'raw' );
        if ( is_wp_error( $original_title ) )
            $original_title = false;
    } elseif ( 'post_type' == $item->type ) {
        $original_object = get_post( $item->object_id );
        $original_title = $original_object->post_title;
    }

    $classes = array(
        'menu-item menu-item-depth-' . $depth,
        'menu-item-' . esc_attr( $item->object ),
        'menu-item-edit-' . ( ( isset( $_GET['edit-menu-item'] ) && $item_id == $_GET['edit-menu-item'] ) ? 'active' : 'inactive'),
    );

    $title = $item->title;

    if ( ! empty( $item->_invalid ) ) {
        $classes[] = 'menu-item-invalid';
        /* translators: %s: title of menu item which is invalid */
        $title = sprintf( __( '%s (Invalid)','brando' ), $item->title );
    } elseif ( isset( $item->post_status ) && 'draft' == $item->post_status ) {
        $classes[] = 'pending';
        /* translators: %s: title of menu item in draft status */
        $title = sprintf( __('%s (Pending)','brando'), $item->title );
    }

    $title = empty( $item->label ) ? $title : $item->label;
    ?>
    <li id="menu-item-<?php echo esc_attr($item_id); ?>" class="<?php echo implode(' ', $classes ); ?>">
        <dl class="menu-item-bar">
            <dt class="menu-item-handle">
                <span class="item-title"><?php echo esc_html( $title ); ?>
                    <span class="brando-sub-menu-text"><?php esc_html_e( 'sub item' , 'brando'); ?></span>
                </span>
                <span class="item-controls">
                    <span class="item-type"><?php echo esc_html( $item->type_label ); ?></span>
                    <span class="item-order hide-if-js">
                        <a href="<?php
                            echo wp_nonce_url(
                                add_query_arg(
                                    array(
                                        'action' => 'move-up-menu-item',
                                        'menu-item' => $item_id,
                                    ),
                                    remove_query_arg($removed_args, admin_url( 'nav-menus.php' ) )
                                ),
                                'move-menu_item'
                            );
                        ?>" class="item-move-up"><abbr title="<?php esc_attr_e('Move up','brando'); ?>">&#8593;</abbr></a>
                        |
                        <a href="<?php
                            echo wp_nonce_url(
                                add_query_arg(
                                    array(
                                        'action' => 'move-down-menu-item',
                                        'menu-item' => $item_id,
                                    ),
                                    remove_query_arg($removed_args, admin_url( 'nav-menus.php' ) )
                                ),
                                'move-menu_item'
                            );
                        ?>" class="item-move-down"><abbr title="<?php esc_attr_e('Move down','brando'); ?>">&#8595;</abbr></a>
                    </span>
                    <a class="item-edit" id="edit-<?php echo esc_attr( $item_id ); ?>" title="<?php esc_attr_e('Edit Menu Item','brando'); ?>" href="<?php
                        echo ( isset( $_GET['edit-menu-item'] ) && $item_id == $_GET['edit-menu-item'] ) ? admin_url( 'nav-menus.php' ) : add_query_arg( 'edit-menu-item', $item_id, remove_query_arg( $removed_args, admin_url( 'nav-menus.php#menu-item-settings-' . $item_id ) ) );
                    ?>"><?php esc_html_e( 'Edit Menu Item','brando' ); ?></a>
                </span>
            </dt>
        </dl>

        <div class="menu-item-settings" id="menu-item-settings-<?php echo esc_attr ( $item_id ); ?>">
            <?php if( 'custom' == $item->type ) : ?>
                <p class="field-url description description-wide">
                    <label for="edit-menu-item-url-<?php echo esc_attr ( $item_id ); ?>">
                        <strong class="mega-menu-title"><?php esc_html_e( 'URL','brando' ); ?></strong>
                        <input type="text" id="edit-menu-item-url-<?php echo esc_attr ( $item_id ); ?>" class="widefat code edit-menu-item-url" name="menu-item-url[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_attr( $item->url ); ?>" />
                    </label>
                </p>
            <?php endif; ?>
            <?php if($depth == 0 ){ 
                $item->brando_menu_single_item_number = get_post_meta( $item_id, '_brando_menu_single_item_number', true );
                 ?>
                <p class="field-brando-menu-single-item-number description description-thin">
                    <label for="edit-menu-item-brando-menu-single-item-number-<?php echo esc_attr( $item_id ); ?>">
                        <strong><?php esc_html_e( 'Prefix', 'brando' ); ?></strong>
                        <input type="text" id="edit-menu-item-brando-menu-single-item-number-<?php echo esc_attr($item_id); ?>" class="widefat code edit-menu-item-brando-menu-single-item-number" name="menu-item-brando-menu-single-item-number[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_attr( $item->brando_menu_single_item_number ); ?>" />
                    </label>
                </p>
                <?php } ?>
            <p class="description description-thin">
                <label for="edit-menu-item-title-<?php echo esc_attr( $item_id ); ?>">
                    <strong class="mega-menu-title"><?php esc_html_e( 'Navigation Label','brando' ); ?></strong>
                    <input type="text" id="edit-menu-item-title-<?php echo esc_attr ( $item_id ); ?>" class="widefat edit-menu-item-title" name="menu-item-title[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_attr( $item->title ); ?>" />
                </label>
            </p>
            <p class="description description-thin">
                <label for="edit-menu-item-attr-title-<?php echo esc_attr( $item_id ); ?>">
                    <strong class="mega-menu-title"><?php esc_html_e( 'Title Attribute','brando' ); ?></strong>
                    <input type="text" id="edit-menu-item-attr-title-<?php echo esc_attr( $item_id ); ?>" class="widefat edit-menu-item-attr-title" name="menu-item-attr-title[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_attr( $item->post_excerpt ); ?>" />
                </label>
            </p>
            <p class="field-link-target description">
                <label for="edit-menu-item-target-<?php echo esc_attr ( $item_id ); ?>">
                    <input type="checkbox" id="edit-menu-item-target-<?php echo esc_attr( $item_id ); ?>" value="_blank" name="menu-item-target[<?php echo esc_attr($item_id); ?>]"<?php checked( $item->target, '_blank' ); ?> />
                    <strong><?php esc_html_e( 'Open link in a new window/tab','brando' ); ?></strong>
                </label>
            </p>
            <p class="field-css-classes description description-thin">
                <label for="edit-menu-item-classes-<?php echo esc_attr( $item_id ); ?>">
                    <strong class="mega-menu-title"><?php esc_html_e( 'CSS Classes (optional)','brando' ); ?></strong>
                    <input type="text" id="edit-menu-item-classes-<?php echo esc_attr( $item_id ); ?>" class="widefat code edit-menu-item-classes" name="menu-item-classes[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_attr( implode(' ', $item->classes ) ); ?>" />
                </label>
            </p>
            <p class="field-xfn description description-thin">
                <label for="edit-menu-item-xfn-<?php echo esc_attr( $item_id ); ?>">
                    <strong class="mega-menu-title"><?php esc_html_e( 'Link Relationship (XFN)','brando' ); ?></strong>
                    <input type="text" id="edit-menu-item-xfn-<?php echo esc_attr( $item_id ); ?>" class="widefat code edit-menu-item-xfn" name="menu-item-xfn[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_attr( $item->xfn ); ?>" />
                </label>
            </p>
            <p class="field-description description description-wide">
                <label for="edit-menu-item-description-<?php echo esc_attr( $item_id ); ?>">
                    <strong class="mega-menu-title"><?php esc_html_e( 'Description','brando' ); ?></strong>
                    <textarea id="edit-menu-item-description-<?php echo esc_attr ( $item_id ); ?>" class="widefat edit-menu-item-description" rows="3" cols="20" name="menu-item-description[<?php echo esc_attr($item_id); ?>]"><?php echo esc_html( $item->description ); // textarea_escaped ?></textarea>
                    <span class="description"><?php esc_html_e('The description will be displayed in the menu if the current theme supports it.','brando'); ?></span>
                </label>
            </p>

            <?php /* Menu Custom Field Start */ 
                $item->brando_menu_single_item_status = get_post_meta( $item_id, '_brando_menu_single_item_status', true );
                $item->brando_menu_single_item_image = get_post_meta( $item_id, '_brando_menu_single_item_image', true );
                $item->brando_menu_single_item_thumb_image = get_post_meta( $item_id, '_brando_menu_single_item_thumb_image', true );
                
            ?>

            <div class="clear"></div>
            <div class="brando-backhand-mega-menu-init" id="brando-backhand-mega-menu-init">
                <?php /* Enable Menu Item Status Start */ ?>
                <?php $title_status_checked = ''; ?>
                <?php
                    $status_checked = $single_status_checked = $image = $thumb_image = $image_value = $thumb_image_value = $single_number_checked = '';
                ?>
                <p class="field-brando-menu-single-item-status description description-wide">
                    <label for="edit-menu-item-brando-menu-single-item-status-<?php echo esc_attr( $item_id ); ?>">
                        <?php if($item->brando_menu_single_item_status == 'enabled') { $single_status_checked = 'checked="checked"'; } ?>
                        <input type="checkbox" id="edit-menu-item-brando-menu-single-item-status-<?php echo esc_attr($item_id); ?>" class="widefat code edit-menu-item-brando-menu-single-item-status" name="menu-item-brando-menu-single-item-status[<?php echo esc_attr($item_id); ?>]" value="enabled" <?php echo esc_attr( $single_status_checked ); ?> />
                        <strong><?php esc_html_e( 'Enable Onepage For This Item', 'brando' ); ?></strong>
                    </label>
                </p>
                <?php if($depth == 0 ){  ?>
                <p class="field-brando-menu-single-item-image description description-wide">
                    <label for="edit-menu-item-brando-menu-single-item-image-<?php echo esc_attr( $item_id ); ?>">
                        <!-- <strong><?php esc_html_e( 'Menu Image', 'brando' ); ?></strong> -->
                        <?php 
                        if( $item->brando_menu_single_item_image != '' ){ 
                            $image = 'src="'.esc_url($item->brando_menu_single_item_image).'"'; 
                            $image_value = 'value="'.esc_attr($item->brando_menu_single_item_image).'"';
                        }
                            
                        if( $item->brando_menu_single_item_thumb_image != '' ){ 
                            $thumb_image = 'src="'.$item->brando_menu_single_item_thumb_image.'"'; 
                            $thumb_image_value = 'value="'.$item->brando_menu_single_item_thumb_image.'"';
                        }
                        ?>
                        <img class="upload_image_screenshort" <?php echo wp_kses($thumb_image, wp_kses_allowed_html( 'post' )); ?> />
                        <input type="hidden" name="menu-item-brando-menu-single-item-image[<?php echo esc_attr($item_id); ?>]" id="image_url" class="regular-text" <?php echo wp_kses($image_value, wp_kses_allowed_html( 'post' )) ?>>
                        <input type="hidden" name="menu-item-brando-menu-single-item-thumb-image[<?php echo esc_attr($item_id); ?>]" id="thumb_image_url" class="regular-text" <?php echo wp_kses($thumb_image_value, wp_kses_allowed_html( 'post' )) ?>>
                        <input type="button" name="upload-btn" id="upload-btn-<?php echo esc_attr($item_id); ?>" class="button-secondary-cat" value="<?php esc_html_e( 'Upload Image', 'brando' ); ?>">
                        <input type="button" name="remove-btn" id="remove-btn-<?php echo esc_attr($item_id); ?>" class="brando_remove_button button-secondary" value="<?php esc_html_e( 'Remove Image', 'brando' ); ?>">
                    </label>
                </p>
                <?php }?>
                <?php /* Enable Menu Item Status End */ ?>
            </div>
            <?php
            /*
             * end added field
             */
            ?>
            <p class="field-move hide-if-no-js description description-wide">
                <label>
                    <span><?php esc_html_e( 'Move','brando' ); ?></span>
                    <a href="#" class="menus-move menus-move-up" data-dir="up"><?php esc_html_e( 'Up one','brando' ); ?></a>
                    <a href="#" class="menus-move menus-move-down" data-dir="down"><?php esc_html_e( 'Down one','brando' ); ?></a>
                    <a href="#" class="menus-move menus-move-left" data-dir="left"></a>
                    <a href="#" class="menus-move menus-move-right" data-dir="right"></a>
                    <a href="#" class="menus-move menus-move-top" data-dir="top"><?php esc_html_e( 'To the top','brando' ); ?></a>
                </label>
            </p>
            <div class="menu-item-actions description-wide submitbox">
                <?php if( 'custom' != $item->type && $original_title !== false ) : ?>
                    <p class="link-to-original">
                        <?php printf( __('Original: %s','brando'), '<a href="' . esc_attr( $item->url ) . '">' . esc_html( $original_title ) . '</a>' ); ?>
                    </p>
                <?php endif; ?>
                <a class="item-delete submitdelete deletion" id="delete-<?php echo esc_attr( $item_id ); ?>" href="<?php
                echo wp_nonce_url(
                    add_query_arg(
                        array(
                            'action' => 'delete-menu-item',
                            'menu-item' => $item_id,
                        ),
                        remove_query_arg($removed_args, admin_url( 'nav-menus.php' ) )
                    ),
                    'delete-menu_item_' . $item_id
                ); ?>"><?php esc_html_e('Remove','brando'); ?></a> <span class="meta-sep"> | </span> <a class="item-cancel submitcancel" id="cancel-<?php echo esc_attr( $item_id ); ?>" href="<?php echo esc_url( add_query_arg( array('edit-menu-item' => $item_id, 'cancel' => time()), remove_query_arg( $removed_args, admin_url( 'nav-menus.php' ) ) ) );
                    ?>#menu-item-settings-<?php echo esc_attr( $item_id ); ?>"><?php esc_html_e('Cancel','brando'); ?></a>
            </div>

            <input class="menu-item-data-db-id" type="hidden" name="menu-item-db-id[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_attr($item_id); ?>" />
            <input class="menu-item-data-object-id" type="hidden" name="menu-item-object-id[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_attr( $item->object_id ); ?>" />
            <input class="menu-item-data-object" type="hidden" name="menu-item-object[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_attr( $item->object ); ?>" />
            <input class="menu-item-data-parent-id" type="hidden" name="menu-item-parent-id[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_attr( $item->menu_item_parent ); ?>" />
            <input class="menu-item-data-position" type="hidden" name="menu-item-position[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_attr( $item->menu_order ); ?>" />
            <input class="menu-item-data-type" type="hidden" name="menu-item-type[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_attr( $item->type ); ?>" />
        </div><!-- .menu-item-settings-->
        <ul class="menu-item-transport"></ul>
    <?php
    $output .= ob_get_clean();
    }
}


/***************************************************************
*********************Brando Menu Front walkar***************
***************************************************************/

class Brando_Nav_Menu extends Walker_Nav_Menu {
  
    public function start_lvl( &$output, $depth = 0, $args = array() ) {
        $indent = str_repeat("\t", $depth);
        $output .= "\n$indent<ul class=\"sub-menu\">\n";
    }

    
    public function end_lvl( &$output, $depth = 0, $args = array() ) {
        $indent = str_repeat("\t", $depth);
        $output .= "$indent</ul>\n";
    }

   
    public function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
        $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

        $classes = empty( $item->classes ) ? array() : (array) $item->classes;
        $classes[] = 'menu-item-' . esc_attr($item->ID);
        $brando_menu_single_item_status = get_post_meta( $item->ID, '_brando_menu_single_item_status', true );
        $brando_menu_single_item_number = get_post_meta( $item->ID, '_brando_menu_single_item_number', true );
        $brando_menu_single_item_image = get_post_meta( $item->ID, '_brando_menu_single_item_image', true );
        
        $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args, $depth ) );
        $class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

       
        $id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args, $depth );
        $id = $id ? ' id="' . esc_attr( $id ) . '"' : '';

        $output .= $indent . '<li' . $id .$class_names.'>';

        $atts = array();
        $atts['title']  = ! empty( $item->attr_title ) ? $item->attr_title : '';
        $atts['target'] = ! empty( $item->target )     ? $item->target     : '';
        $atts['rel']    = ! empty( $item->xfn )        ? $item->xfn        : '';
        $atts['href']   = ! empty( $item->url )        ? $item->url        : '';

        
        $atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args, $depth );

        $attributes = $number = '';
        foreach ( $atts as $attr => $value ) {
            if ( ! empty( $value ) ) {
                $value = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
                $attributes .= ' ' . $attr . '="' . $value . '"';
            }
        }

        /** This filter is documented in wp-includes/post-template.php */
        $title = apply_filters( 'the_title', $item->title, $item->ID );

        $title = apply_filters( 'nav_menu_item_title', $title, $item, $args, $depth );
        if( $brando_menu_single_item_number ){
            $number = '<span>'.$brando_menu_single_item_number.'</span>';
        } 
        $brando_menu_image = '<img src="'.$brando_menu_single_item_image.'" alt="'.esc_attr($title).'">';
        $item_output = $args->before;
        $brando_onepage_menu_class = '';
        $brando_header_layout = brando_option('brando_header_layout');
        if( $brando_header_layout == 'headertype2' || $brando_header_layout == 'headertype4' ){
            $brando_onepage_menu_class = 'section-link';
        }else{
            $brando_onepage_menu_class = 'inner-link';
        }
        // For Onepage Link Added Class
        if($brando_menu_single_item_status == 'enabled' && $brando_menu_single_item_image == ''){
            $item_output .= '<a'. $attributes .' class="'.esc_attr($brando_onepage_menu_class).'">';
        }elseif($brando_menu_single_item_image != ''){
            $item_output .= '<a'. $attributes .' class="navbar-brand '.esc_attr($brando_onepage_menu_class).'">';
        }else{
            $item_output .= '<a'. $attributes .'>';
        }
        if($brando_menu_single_item_image != ''){
            $item_output .= $args->link_before . $brando_menu_image . $args->link_after;
        }else{
            $item_output .= $args->link_before . $number. $title . $args->link_after;
        }
        $item_output .= '</a>';
        $item_output .= (($item -> hasChildren && $depth == 0 ) ? '<i class="fa fa-angle-down mobile-menu-icon"></i>' : '' );
        $item_output .= (($item -> hasChildren && $depth == 1 ) ? '<i class="fa fa-angle-right mobile-menu-icon"></i>' : '' );
        $item_output .= $args->after;

        $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
    }

    public function end_el( &$output, $item, $depth = 0, $args = array() ) {
        $output .= "</li>\n";
    }
    function display_element ($element, &$children_elements, $max_depth, $depth = 0, $args, &$output)
    {
        // check, whether there are children for the given ID and append it to the element with a (new) ID
        $element->hasChildren = isset($children_elements[$element->ID]) && !empty($children_elements[$element->ID]);
        return parent::display_element($element, $children_elements, $max_depth, $depth, $args, $output);
    }
}

?>