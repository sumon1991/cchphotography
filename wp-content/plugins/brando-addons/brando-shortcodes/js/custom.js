!function($) {
	"use strict";
    /* jQuery Enable Click Event For Switch */
    $('.switch-option-enable').on('click',function(){    
      if (!$(this).hasClass('selected')) {
          var c = $(this).parent().find('select');
          $(this).parent().find('.selected').removeClass('selected');
          $(this).addClass('selected');
          c.val(1).trigger('change');
        }
    });

    /* jQuery Disable Click Event For Switch */
    $('.switch-option-disable').on('click',function(){
      if (!$(this).hasClass("selected")) {
          var c = $(this).parent().find('select');
          $(this).parent().find('.selected').removeClass("selected");
          $(this).addClass("selected");
          c.val(0).trigger('change');
        }
    });    

    /* jQuery For Preview Slider Image */
    $('.preview-image-hide').hide();
    $('.preview-image-show').show();
    $('.brando-preview-image-main').parent().parent().find('.wpb_element_label').hide();

    /* jQuery For add selected class for current type */
    $('.brando_portfolio_style,.slider_premade_style,.brando_portfolio_filter_style,.brando_block_premade_style,.brando_feature_type,.counter_or_chart,.brando_team_member_style,.brando_blog_premade_style,.brando_heading_type,.button_style,.accordian_pre_define_style,.brando_post_slider_style,.tabs_style,.brando_tab_content_premade_style,.brando_image_block_premade_style,.brando_testimonial_premade_style,.image_gallery_type,.popup_type,.brando_alert_massage_premade_style').bind('change keyup', function(e) {
      $(this).parent().parent().parent().find('.brando_preview_image_select option').removeAttr("selected");
      $(this).parent().parent().parent().find('.preview-image-hide').hide();
      var current_selected = $(this).val();
      if(current_selected){
        $(this).parent().parent().parent().find('.brando-preview-image-main .'+current_selected).show();
        $(this).parent().parent().parent().find('.brando_preview_image_select option[class="'+current_selected+'"]').attr('selected', 'selected');
      }
    });

    /* jQuery Click Event For Icon */
    $('.brando_icon_preview').on('click', function() {
        if( $(this).hasClass('active_icon') ){
          $(this).removeClass('active_icon');
          $(this).parent().parent().find('.brando_icon_field').val('');
        }else{
          $('.brando_icon_preview').removeClass('active_icon');
          $(this).addClass('active_icon');
          var selected_icon = $(this).children().attr('data-name');
          $(this).parent().parent().find('.brando_icon_field').val(selected_icon);
        }
    });

}(window.jQuery);


/* File Upload For Menu */
jQuery(document).ready(function($){
    $(document).delegate(this, 'click', function (e) {
        if(e.target.className == 'button-secondary-cat'){
        e.preventDefault();
        var image = wp.media({ 
            title: 'Upload Image',
            // mutiple: true if you want to upload multiple files at once
            //multiple: false
        }).open()
        .on('select', function(e1){
            // This will return the selected image from the Media Uploader, the result is an object
            var uploaded_image = image.state().get('selection').first();
            var thumburl = uploaded_image.attributes.sizes.thumbnail;
            // We convert uploaded_image to a JSON object to make accessing it easier
            // Output to the console uploaded_image
            var image_url = uploaded_image.toJSON().url;
            // Let's assign the url value to the input field
            
            $('#'+e.target.id).parent().find('#thumb_image_url').val(thumburl.url);
            $('#'+e.target.id).parent().find('#image_url').val(image_url);
            $('#'+e.target.id).parent().find('img').attr("src",thumburl.url);
            $('#'+e.target.id).parent().find('img').css("display","block");
        });
      }
    });
    $(document).delegate(this, 'click', function (e) {
      if(e.target.className == 'brando_remove_button button-secondary-cat'){
        var remove_parent = jQuery(e.target).parent();
      remove_parent.find('input[type="hidden"]').val('');
      remove_parent.find('.upload_image_screenshort').slideUp();
      }
  });
});
  