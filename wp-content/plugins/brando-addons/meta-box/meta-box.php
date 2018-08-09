<?php
/**
 * Metabox Class Fill.
 *
 * @package Brando
 */
?>
<?php
/**
 * Calls the class on the post edit screen.
 */
function Brando_Meta_Boxes() 
{
    new brandoMetaboxes();
}

	if ( is_admin() ) {
	    add_action( 'load-post.php', 'Brando_Meta_Boxes' );
	    add_action( 'load-post-new.php', 'Brando_Meta_Boxes' );
	}


/** 
 * The brandoMetaboxes Class.
 */
class brandoMetaboxes {

	/**
	 * Hook into the appropriate actions when the class is constructed.
	 */
	public function __construct() {
		$this->brando_metabox_addons();
		add_action( 'add_meta_boxes', array( $this, 'brando_add_meta_boxs' ) );
		add_action( 'save_post', array( $this, 'brando_save_meta_box' ) );
		add_action('admin_enqueue_scripts', array($this, 'admin_script_loader'));

		/* Portfolio */
		add_action( 'add_meta_boxes', array( $this, 'brando_add_meta_boxs_portfolios' ) );
	}

	/**
	 * Adds the meta box functions container.
	 */
	public function brando_metabox_addons(){
		require_once( BRANDO_ADDONS_ROOT .'/meta-box/meta-box-maps.php' );
	}

	/**
	 * Adds the meta box container.
	 */
	public function brando_add_meta_boxs( $brando_post_type ) {
		$brando_post_types = array('post', 'page', 'portfolio');     //limit meta box to certain post types
		$flag = false;
        if ( in_array( $brando_post_type, $brando_post_types )){
           	$flag = true;
        }
        if($flag == true){
	        $this->brando_add_meta_box('brando_admin_options', 'Brando '.ucfirst($brando_post_type).' Settings', $brando_post_type);
	    }

	}

	public function brando_add_meta_box($brando_id, $brando_label_name, $brando_post_type)
	{
		add_meta_box(
			$brando_id
			,$brando_label_name
			,array( $this, $brando_id )
			,$brando_post_type
			
		);
	}

	public function brando_admin_options()
	{
		global $post;
		if($post->post_type == 'post' || $post->post_type == 'portfolio'){
			$brando_tabs_title = array('Layout Settings', 'Header', 'Page Title', 'Comments Settings', 'Footer', 'Single '.$post->post_type.' Settings');
			$brando_tabs_sub_title = array('', 'Header section configuration settings', '', 'Enable/Disable comments in '.$post->post_type, 'Footer section configuration settings', '');
			$brando_page_tabs = array('Layout Settings', 'Header', 'Page Title', 'Comments Settings', 'Footer', 'Single '.$post->post_type.' Layout');
			$brando_page_tab_content = array('layout_settings', 'header', 'title_wrapper', 'content', 'footer', 'single_post_layout');
		}else{
			$brando_tabs_title = array('Layout Settings', 'Header', 'Page Title', 'Comments Settings', 'Footer');
			$brando_tabs_sub_title = array('', 'Header section configuration settings', '', 'Enable/Disable comments in page', 'Footer section configuration settings');
			$brando_page_tabs = array('Layout Settings', 'Header', 'Page Title', 'Comments Settings', 'Footer');
			$brando_page_tab_content = array('layout_settings', 'header', 'title_wrapper', 'content', 'footer');
		}

		$brando_icon_class = array('icon-gears','fa fa-header', 'el-icon-website', 'fa fa-align-left', 'fa fa-server', 'el-icon-website icon-rotate', 'fa fa-list-alt');
		echo '<ul class="brando_meta_box_tabs">';
		$brando_icon = 0;
		$brando_showicon = '';
			foreach( $brando_page_tabs as $tab_key => $tab_name ) {
				if($brando_icon_class){
					$brando_showicon = '<i class="'.esc_attr($brando_icon_class[$brando_icon]).'"></i>';
				}
				echo '<li class="brando_tab_'.$brando_page_tab_content[$tab_key].'"><a href="'.esc_url($tab_name).'">'.$brando_showicon.'<span class="group_title">'.esc_attr($tab_name).'</span></a></li>';
				$brando_icon++;
			}
		echo '</ul>';

		echo '<div class="brando_meta_box_tab_content">';
		foreach( $brando_page_tab_content as $tab_content_key => $tab_content_name ) {
			echo '<div class="brando_meta_box_tab" id="brando_tab_'.esc_attr($tab_content_name).'">';
				echo "<div class='main_tab_title'>";
					echo "<h3>".$brando_tabs_title[$tab_content_key]."</h3>";
					echo "<span class='description'>".$brando_tabs_sub_title[$tab_content_key]."</span>";
				echo "</div>";
				require_once( BRANDO_ADDONS_ROOT .'/meta-box/metabox-tabs/metabox_'.$tab_content_name.'.php' );
			echo '</div>';
		}
		echo '</div>';
		echo '<div class="clear"></div>';
	}


	/**
	 * Adds the meta box for Portfolio.
	 */
	public function brando_add_meta_boxs_portfolios( $brando_post_type ) 
	{
		$brando_post_types = array('portfolio','post');     //limit meta box to certain post types
		$flag = false;
        if ( in_array( $brando_post_type, $brando_post_types )){
           	$flag = true;
        }
        if($flag == true){
	        $this->brando_add_meta_box('brando_admin_options_single', 'Brando '.ucfirst($brando_post_type).' Format Settings', $brando_post_type);
	    }

	}

	public function brando_add_meta_boxs_portfolio($brando_id, $brando_label_name, $brando_post_type)
	{
		add_meta_box(
			$brando_id
			,$brando_label_name
			,array( $this, $brando_id )
			,$brando_post_type
			,'advanced'
			,'high'
		);
	}

	public function brando_admin_options_single()
	{
        global $post;
		echo '<div class="brando_meta_box_tab_content_single">';
			echo '<div class="brando_meta_box_tab" id="brando_tab_single">';
		
		echo '</div>';
                if($post->post_type == 'post'):
                	//get_template_part( 'lib/meta-box/metabox-tabs/metabox_post_setting' );
                	require_once( BRANDO_ADDONS_ROOT .'/meta-box/metabox-tabs/metabox_post_setting.php' );
                else:
                	//get_template_part( 'lib/meta-box/metabox-tabs/metabox_portfolio_setting' );
                require_once( BRANDO_ADDONS_ROOT .'/meta-box/metabox-tabs/metabox_portfolio_setting.php' );
                endif;
		echo '</div>';
		echo '<div class="clear"></div>';
	}
	/**
	 * Save the meta when the post is saved.
	 *
	 * @param int $post_id The ID of the post being saved.
	 */
	public function brando_save_meta_box( $brando_post_id ) {
	
		// If this is an autosave, our form has not been submitted,
        // so we don't want to do anything.
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) 
			return $brando_post_id;

		/* OK, its safe for us to save the data now. */
		$brando_data = array();
		foreach ( $_POST as $key => $value ) {
			if ( strstr( $key, 'brando_') ) {
				// Sanitize the user input.
				$brando_data = sanitize_text_field( $_POST[$key] );
				// Update the meta field.
				update_post_meta( $brando_post_id, $key, $brando_data );
			}
		}
	}

	function admin_script_loader() {
		
		global $pagenow;
		if( is_admin() && ( $pagenow=='post-new.php' || $pagenow=='post.php' ) ) {
			wp_enqueue_script('media-upload');
			wp_enqueue_script('thickbox');
	   		wp_enqueue_style('thickbox');
	   		wp_register_script('brando-admin-metabox-cookie-js', BRANDO_ADDONS_ROOT_DIR.'/meta-box/js/metabox-cookie.js', array('jquery'), '1.0' );
	   		wp_enqueue_script('brando-admin-metabox-cookie-js');
	   		wp_register_script('brando-admin-metabox-js', BRANDO_ADDONS_ROOT_DIR.'/meta-box/js/meta-box.js', array('jquery'), '1.0' );
			wp_enqueue_script('brando-admin-metabox-js');
	   		wp_register_style('brando-admin-metabox-css', BRANDO_ADDONS_ROOT_DIR.'/meta-box/css/meta-box.css',null, '1.0' );
	   		wp_enqueue_style('brando-admin-metabox-css');
		}
	}
}