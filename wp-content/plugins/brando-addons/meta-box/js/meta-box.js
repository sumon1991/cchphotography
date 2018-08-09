jQuery(document).ready(function($){
	// Check on load for selected tab when user come before if not it show first one active
	if($.cookie('brando_metabox_active_id_' + $('#post_ID').val())) {
		var active_class = $.cookie('brando_metabox_active_id_' + $('#post_ID').val());

		$('#brando_admin_options').find('.brando_meta_box_tabs li').removeClass('active');
		$('#brando_admin_options').find('.brando_meta_box_tab').removeClass('active').hide();

		$('.'+active_class).addClass('active').fadeIn();
		$('#brando_admin_options').find('#'+active_class).addClass('active').fadeIn();

	} else {
		$('.brando_meta_box_tabs li:first-child').addClass('active');
		$('.brando_meta_box_tab_content .brando_meta_box_tab:first-child').addClass('active').fadeIn();
	}
	$('.brando_meta_box_tabs li a').click(function(e) {
		e.preventDefault();

		var tab_click_id = $(this).parent().attr('class').split(' ')[0];
		var tab_main_div = $(this).parents('#brando_admin_options');

		$.cookie('brando_metabox_active_id_' + $('#post_ID').val(), tab_click_id, { expires: 7 });
		
		tab_main_div.find('.brando_meta_box_tabs li').removeClass('active');
		tab_main_div.find('.brando_meta_box_tab').removeClass('active').hide();

		$(this).parent().addClass('active').fadeIn();
		tab_main_div.find('#'+tab_click_id).addClass('active').fadeIn();

	});

  /* Metabox dependance of fields */
	
    $(".brando_select_parent").change(function () {
	    var str_selected = $(this).find("option:selected").val();
	    var tab_active_status_main = $(this).parents('#brando_admin_options');
	    $('.hide_dependent').find('input[type="hidden"]').val('0');
		tab_active_status_main.find('.hide_dependent').addClass('hide_dependency');

		if (tab_active_status_main.find('.hide_dependency').hasClass(str_selected+'_single')){
			tab_active_status_main.find('.'+str_selected+'_single').removeClass('hide_dependency');
			tab_active_status_main.find('.'+str_selected+'_single').find('input[type="hidden"]').val('1');
		}
		
		/* Special case for Both sidebar*/ 
		if(str_selected == 'brando_layout_both_sidebar'){
			$('.brando_layout_left_sidebar_single').removeClass('hide_dependency');
			$('.brando_layout_left_sidebar_single').find('input[type="hidden"]').val('1');
			$('.brando_layout_right_sidebar_single').removeClass('hide_dependency');
			$('.brando_layout_right_sidebar_single').find('input[type="hidden"]').val('1');
		}
		
	});

    // Remaining BY Mukesh
    $('#brando_layout_settings_single').change(function () {
    	var str_selected = $(this).find("option:selected").val();
    	var str_selected_parent = $(this).parents('#brando_tab_layout_settings');
    	str_selected_parent.find('.hide-child').addClass('hide-children');
    	str_selected_parent.find('.' +str_selected+ '_single_box').removeClass('hide-children');
    	str_selected_parent.find('.' +str_selected+ '_single_box').addClass('show-children');

    	
    });
	/* Metabox Image Upload Button Click*/

	jQuery('.brando_upload_button').click(function (event) {
        var file_frame;
	  	var button = $(this);

	    var button_parent = $(this).parent();
		var id = button.attr('id').replace('_button', '');
	    event.preventDefault();
	    

	    // If the media frame already exists, reopen it.
	    if ( file_frame ) {
	      file_frame.open();
	      return;
	    }

	    // Create the media frame.
	    file_frame = wp.media.frames.file_frame = wp.media({
	      title: jQuery( this ).data( 'uploader_title' ),
	      button: {
	        text: jQuery( this ).data( 'uploader_button_text' ),
	      },
	      multiple: false  // Set to true to allow multiple files to be selected
	    });

	    // When an image is selected, run a callback.
	    file_frame.on( 'select', function() {
	      // We set multiple to false so only get one image from the uploader
	      var full_attachment = file_frame.state().get('selection').first().toJSON();

	      var attachment = file_frame.state().get('selection').first();

	      var thumburl = attachment.attributes.sizes.thumbnail;
	      var thumb_hidden = button_parent.find('.upload_field').attr('name');

	      if ( thumburl || full_attachment ) {
				button_parent.find("#"+id).val(full_attachment.url);
				button_parent.find("."+thumb_hidden+"_thumb").val(full_attachment.url);
				
				button_parent.find(".upload_image_screenshort").attr("src", full_attachment.url);
				//button_parent.find(".upload_image_screenshort").show();
				button_parent.find(".upload_image_screenshort").slideDown();
			}
	    });

	    // Finally, open the modal
	    file_frame.open();
	});
	
	// Remove button function to remove attach image and hide screenshort Div.
	jQuery('.brando_remove_button').click(function () {
		var remove_parent = $(this).parent();
		remove_parent.find('.upload_field').val('');
		remove_parent.find('input[type="hidden"]').val('');
		remove_parent.find('.upload_image_screenshort').slideUp();
	});

	// On page load add all image url to show in screenshort.
	$('.upload_field').each(function(){
		if($(this).val()){
			$(this).parent().find('.upload_image_screenshort').attr("src", $(this).parent().find('input[type="hidden"]').val());
		}else{
			$(this).parent().find('.upload_image_screenshort').hide();
		}
	});


	/* multiple image upload */

	jQuery('.brando_upload_button_multiple').click(function (event) {
        var file_frame;
	  	var button = $(this);

	    var button_parent = $(this).parent();
		var id = button.attr('id').replace('_button', '');
		var app=aa=[];
	    event.preventDefault();
	    

	    // If the media frame already exists, reopen it.
	    if ( file_frame ) {
	      file_frame.open();
	      return;
	    }

	    // Create the media frame.
	    file_frame = wp.media.frames.file_frame = wp.media({
	      title: jQuery( this ).data( 'uploader_title' ),
	      button: {
	        text: jQuery( this ).data( 'uploader_button_text' ),
	      },
	      multiple: true  // Set to true to allow multiple files to be selected
	    });

	    // When an image is selected, run a callback.
	    file_frame.on( 'select', function() {

	      var thumb_hidden = button_parent.find('.upload_field').attr('name');
	     
			var selection = file_frame.state().get('selection');
			var app=aa=[];
				selection.map( function( attachment ) {
				var attachment = attachment.toJSON();
				button_parent.find('.multiple_images').append( '<div id="'+attachment.id+'"><img src="'+attachment.url+'" class="upload_image_screenshort_multiple" alt="" style="width:100px;"/><a href="javascript:void(0)" class="remove">remove</a></div>' );
			});
	    });
	    // Finally, open the modal
	    file_frame.open();
	});

	jQuery(".button-primary").on('click',function(){
		var pr_div;
		jQuery('.multiple_images').each(function(){
			if(jQuery(this).children().length > 0){
				var attach_id = [];
				var pr_div = jQuery(this).parent();
				jQuery(this).children('div').each(function(){
						attach_id.push(jQuery(this).attr('id'));						
				});
				
				pr_div.find('.upload_field').val(attach_id);
			}else{
				jQuery(this).parent().find('.upload_field').val('');
			}
		});		
	});

	jQuery(".multiple_images").on('click','.remove', function() {
		jQuery(this).parent().slideUp();
		jQuery(this).parent().remove();
	});

	/* multiple image upload End */


	/*==============================================================*/
	// Post Format Meta Start
	/*==============================================================*/
	function post_format_selection_options() {
			
			//Hide Link Format in Post type
			jQuery('body.post-type-post #post-format-link, body.post-type-post .post-format-link').hide();
			jQuery('body.post-type-portfolio #post-format-gallery, body.post-type-portfolio .post-format-gallery').hide();
			jQuery('body.post-type-portfolio #post-format-video, body.post-type-portfolio .post-format-video').hide();
			jQuery('body.post-type-portfolio #post-format-image, body.post-type-portfolio .post-format-image').hide();
			jQuery('body.post-type-portfolio #post-format-quote, body.post-type-portfolio .post-format-quote').hide();
			jQuery('body.post-type-portfolio .post-format-quote').next('br').hide();
			jQuery('body.post-type-portfolio .post-format-gallery').next('br').hide();
			jQuery('body.post-type-portfolio .post-format-image').next('br').hide();
			jQuery('body.post-type-portfolio .post-format-video').next('br').hide();
			
			jQuery('body.post-type-post #brando_admin_options_single').hide();

	       if (jQuery('#post-format-gallery').is(':checked')) {
	        	jQuery('body.post-type-post #brando_admin_options_single').show();
	            jQuery('.brando_gallery_single_box').fadeIn();
	            jQuery('.brando_lightbox_image_single_box').fadeIn();
	            jQuery('.brando_quote_single_box').hide();
	            jQuery('.brando_link_type_single_box').hide();
	            jQuery('.brando_link_single_box').hide();
	            jQuery('.brando_video_mp4_single_box').hide();
	            jQuery('.brando_video_ogg_single_box').hide();
	            jQuery('.brando_video_webm_single_box').hide();
	            jQuery('.brando_video_single_box').hide();
	            jQuery('.brando_video_type_single_box').hide();
	            jQuery('.brando_enable_mute_single_box').hide();
	            jQuery('.brando_image_single_box').hide();
	            jQuery('.brando_featured_image_single_box').fadeIn();
	            jQuery('.brando_subtitle_single_box').fadeIn();

	        } else if (jQuery('#post-format-video').is(':checked')) {
	        	jQuery('body.post-type-post #brando_admin_options_single').show();
	            jQuery('.brando_gallery_single_box').hide();
	            jQuery('.brando_lightbox_image_single_box').hide();
	            jQuery('.brando_quote_single_box').hide();
	            jQuery('.brando_link_type_single_box').hide();
	            jQuery('.brando_link_single_box').hide();
	            jQuery('.brando_video_mp4_single_box').fadeIn();
	            jQuery('.brando_video_ogg_single_box').fadeIn();
	            jQuery('.brando_video_webm_single_box').fadeIn();
	            jQuery('.brando_video_single_box').fadeIn();
	            jQuery('.brando_video_type_single_box').fadeIn();
	            jQuery('.brando_enable_mute_single_box').fadeIn();
	            jQuery('.brando_image_single_box').hide();
	            jQuery('.brando_featured_image_single_box').fadeIn();
	            jQuery('.brando_subtitle_single_box').fadeIn();


	        }else if (jQuery('#post-format-quote').is(':checked')) {
	        	jQuery('body.post-type-post #brando_admin_options_single').show();
	            jQuery('.brando_gallery_single_box').hide();
	            jQuery('.brando_lightbox_image_single_box').hide();
	            jQuery('.brando_quote_single_box').fadeIn();
	            jQuery('.brando_link_type_single_box').hide();
	            jQuery('.brando_link_single_box').hide();
	            jQuery('.brando_video_mp4_single_box').hide();
	            jQuery('.brando_video_ogg_single_box').hide();
	            jQuery('.brando_video_webm_single_box').hide();
	            jQuery('.brando_video_single_box').hide();
	            jQuery('.brando_video_type_single_box').hide();
	            jQuery('.brando_enable_mute_single_box').hide();
	            jQuery('.brando_image_single_box').hide();
	            jQuery('.brando_featured_image_single_box').fadeIn();
	            jQuery('.brando_subtitle_single_box').fadeIn();
	            
	        } else if (jQuery('#post-format-link').is(':checked')) {
	        	jQuery('body.post-type-post #brando_admin_options_single').show();
	            jQuery('.brando_gallery_single_box').hide();
	            jQuery('.brando_lightbox_image_single_box').hide();
	            jQuery('.brando_quote_single_box').hide();
	            jQuery('.brando_link_type_single_box').fadeIn();
	            jQuery('.brando_link_single_box').fadeIn();
	            jQuery('.brando_video_mp4_single_box').hide();
	            jQuery('.brando_video_ogg_single_box').hide();
	            jQuery('.brando_video_webm_single_box').hide();
	            jQuery('.brando_video_single_box').hide();
	            jQuery('.brando_video_type_single_box').hide();
	            jQuery('.brando_enable_mute_single_box').hide();
	            jQuery('.brando_image_single_box').hide();
	            jQuery('.brando_featured_image_single_box').fadeIn();
	            jQuery('.brando_subtitle_single_box').fadeIn();
	            
	        }else if (jQuery('#post-format-image').is(':checked')) {
	        	jQuery('body.post-type-post #brando_admin_options_single').show();
	            jQuery('.brando_gallery_single_box').hide();
	            jQuery('.brando_lightbox_image_single_box').hide();
	            jQuery('.brando_quote_single_box').hide();
	            jQuery('.brando_image_single_box').fadeIn();
	            jQuery('.brando_link_type_single_box').hide();
	            jQuery('.brando_link_single_box').hide();
	            jQuery('.brando_video_mp4_single_box').hide();
	            jQuery('.brando_video_ogg_single_box').hide();
	            jQuery('.brando_video_webm_single_box').hide();
	            jQuery('.brando_video_single_box').hide();
	            jQuery('.brando_video_type_single_box').hide();
	            jQuery('.brando_enable_mute_single_box').hide();
	            jQuery('.brando_featured_image_single_box').hide();
	            jQuery('.brando_subtitle_single_box').fadeIn();
	            
	        }else {
	        	jQuery('body.post-type-post #brando_admin_options_single').hide();
	            jQuery('.brando_gallery_single_box').hide();
	            jQuery('.brando_lightbox_image_single_box').hide();
	            jQuery('.brando_quote_single_box').hide();
	            jQuery('.brando_link_type_single_box').hide();
	            jQuery('.brando_link_single_box').hide();
	            jQuery('.brando_video_mp4_single_box').hide();
	            jQuery('.brando_video_ogg_single_box').hide();
	            jQuery('.brando_video_webm_single_box').hide();
	            jQuery('.brando_video_single_box').hide();
	            jQuery('.brando_video_type_single_box').hide();
	            jQuery('.brando_enable_mute_single_box').hide();
	            jQuery('.brando_image_single_box').hide();
	            jQuery('.brando_featured_image_single_box').fadeIn();
	            jQuery('.brando_subtitle_single_box').fadeIn();

	        }
	    }
	    post_format_selection_options();

	    var select_type = jQuery('#post-formats-select input');
	    

	    jQuery(this).change(function() {
	        post_format_selection_options();
	    });

	    // Remove unselected type meta data for post.
	    post_submit();
	    function post_submit(){
	        jQuery('#publish').click(function(){
	        	if (jQuery('#post-format-gallery').is(':checked')) {
		            jQuery('.brando_meta_box_tab_content_single .brando_quote_single_box').find("textarea").val('');
		            jQuery('.brando_meta_box_tab_content_single .brando_link_type_single_box').find("select option").val('');
		            jQuery('.brando_meta_box_tab_content_single .brando_link_single_box').find("input:first-child").val('');
		            jQuery('.brando_meta_box_tab_content_single .brando_video_mp4_single_box').find("input:first-child").val('');
		            jQuery('.brando_meta_box_tab_content_single .brando_video_ogg_single_box').find("input:first-child").val('');
		            jQuery('.brando_meta_box_tab_content_single .brando_video_webm_single_box').find("input:first-child").val('');
		            jQuery('.brando_meta_box_tab_content_single .brando_video_single_box').find("input:first-child").val('');
		            jQuery('.brando_meta_box_tab_content_single .brando_video_type_single_box').find("select option").val('');
		            jQuery('.brando_meta_box_tab_content_single .brando_enable_mute_single_box').find("select option").val('');
		            jQuery('.brando_meta_box_tab_content_single .brando_image_single_box').find("select option").val('');

	        	}if (jQuery('#post-format-video').is(':checked')) {
		            jQuery('.brando_meta_box_tab_content_single .upload_field').val('');
		            jQuery('.brando_meta_box_tab_content_single .brando_quote_single_box').find("textarea").val('');
		            jQuery('.brando_meta_box_tab_content_single .brando_link_type_single_box').find("select option").val('');
		            jQuery('.brando_meta_box_tab_content_single .brando_link_single_box').find("input:first-child").val('');
		            jQuery('.brando_meta_box_tab_content_single .brando_image_single_box').find("select option").val('');
		            jQuery('.brando_meta_box_tab_content_single .brando_lightbox_image_single_box').find("select option").val('');

	        	}if (jQuery('#post-format-quote').is(':checked')) {
		            jQuery('.brando_meta_box_tab_content_single .upload_field').val('');
		            jQuery('.brando_meta_box_tab_content_single .brando_link_type_single_box').find("select option").val('');
		            jQuery('.brando_meta_box_tab_content_single .brando_link_single_box').find("input:first-child").val('');
		            jQuery('.brando_meta_box_tab_content_single .brando_video_mp4_single_box').find("input:first-child").val('');
		            jQuery('.brando_meta_box_tab_content_single .brando_video_ogg_single_box').find("input:first-child").val('');
		            jQuery('.brando_meta_box_tab_content_single .brando_video_webm_single_box').find("input:first-child").val('');
		            jQuery('.brando_meta_box_tab_content_single .brando_video_single_box').find("input:first-child").val('');
		            jQuery('.brando_meta_box_tab_content_single .brando_video_type_single_box').find("select option").val('');
		            jQuery('.brando_meta_box_tab_content_single .brando_enable_mute_single_box').find("select option").val('');
		            jQuery('.brando_meta_box_tab_content_single .brando_image_single_box').find("select option").val('');
		            jQuery('.brando_meta_box_tab_content_single .brando_lightbox_image_single_box').find("select option").val('');
		            
	            
	        	}if (jQuery('#post-format-link').is(':checked')) {
		            jQuery('.brando_meta_box_tab_content_single .upload_field').val('');
		            jQuery('.brando_meta_box_tab_content_single .brando_quote_single_box').find("textarea").val('');
		            jQuery('.brando_meta_box_tab_content_single .brando_video_mp4_single_box').find("input:first-child").val('');
		            jQuery('.brando_meta_box_tab_content_single .brando_video_ogg_single_box').find("input:first-child").val('');
		            jQuery('.brando_meta_box_tab_content_single .brando_video_webm_single_box').find("input:first-child").val('');
		            jQuery('.brando_meta_box_tab_content_single .brando_video_single_box').find("input:first-child").val('');
		            jQuery('.brando_meta_box_tab_content_single .brando_video_type_single_box').find("select option").val('');
		            jQuery('.brando_meta_box_tab_content_single .brando_enable_mute_single_box').find("select option").val('');
		            jQuery('.brando_meta_box_tab_content_single .brando_image_single_box').find("select option").val('');
		            jQuery('.brando_meta_box_tab_content_single .brando_lightbox_image_single_box').find("select option").val('');
	            
	        	}if (jQuery('#post-format-image').is(':checked')) {
		            jQuery('.brando_meta_box_tab_content_single .upload_field').val('');
		            jQuery('.brando_meta_box_tab_content_single .brando_quote_single_box').find("textarea").val('');
		            jQuery('.brando_meta_box_tab_content_single .brando_link_type_single_box').find("select option").val('');
		            jQuery('.brando_meta_box_tab_content_single .brando_link_single_box').find("input:first-child").val('');
		            jQuery('.brando_meta_box_tab_content_single .brando_video_mp4_single_box').find("input:first-child").val('');
		            jQuery('.brando_meta_box_tab_content_single .brando_video_ogg_single_box').find("input:first-child").val('');
		            jQuery('.brando_meta_box_tab_content_single .brando_video_webm_single_box').find("input:first-child").val('');
		            jQuery('.brando_meta_box_tab_content_single .brando_video_single_box').find("input:first-child").val('');
		            jQuery('.brando_meta_box_tab_content_single .brando_video_type_single_box').find("select option").val('');
		            jQuery('.brando_meta_box_tab_content_single .brando_enable_mute_single_box').find("select option").val('');
		            jQuery('.brando_meta_box_tab_content_single .brando_lightbox_image_single_box').find("select option").val('');
		            jQuery('.brando_meta_box_tab_content_single .brando_featured_image_single_box').find("select option").val('');
	            
	        	}if (jQuery('#post-format-0').is(':checked')) {
		            jQuery('.brando_meta_box_tab_content_single .upload_field').val('');
		            jQuery('.brando_meta_box_tab_content_single .brando_quote_single_box').find("textarea").val('');
		            jQuery('.brando_meta_box_tab_content_single .brando_link_type_single_box').find("select option").val('');
		            jQuery('.brando_meta_box_tab_content_single .brando_link_single_box').find("input:first-child").val('');
		            jQuery('.brando_meta_box_tab_content_single .brando_video_mp4_single_box').find("input:first-child").val('');
		            jQuery('.brando_meta_box_tab_content_single .brando_video_ogg_single_box').find("input:first-child").val('');
		            jQuery('.brando_meta_box_tab_content_single .brando_video_webm_single_box').find("input:first-child").val('');
		            jQuery('.brando_meta_box_tab_content_single .brando_video_single_box').find("input:first-child").val('');
		            jQuery('.brando_meta_box_tab_content_single .brando_video_type_single_box').find("select option").val('');
		            jQuery('.brando_meta_box_tab_content_single .brando_enable_mute_single_box').find("select option").val('');
		            jQuery('.brando_meta_box_tab_content_single .brando_image_single_box').find("select option").val('');
		            jQuery('.brando_meta_box_tab_content_single .brando_lightbox_image_single_box').find("select option").val('');
		            //jQuery('.brando_meta_box_tab_content_single .brando_featured_image_single_box').find("select option").val('');
	        	}
	        });
	    }
	/*==============================================================*/
	// Post Format Meta End
	/*==============================================================*/
});
