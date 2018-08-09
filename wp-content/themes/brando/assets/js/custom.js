"use strict";
jQuery(document).ready(function($){
    jQuery('.brando_upload_image').click(function(e) {
        e.preventDefault();
        var image = wp.media({ 
            title: 'Upload Image',
        }).open()
        .on('select', function(e){
            // This will return the selected image from the Media Uploader, the result is an object
            var uploaded_image = image.state().get('selection').first();

  			var thumburl = uploaded_image.attributes.sizes.thumbnail;
            // We convert uploaded_image to a JSON object to make accessing it easier
            // Output to the console uploaded_image
            var image_url = uploaded_image.toJSON().url;
            // Let's assign the url value to the input field
            $('#image_url').val(image_url);
            $('img').attr("src",thumburl.url);
            $('img').css("display","block");
        });
    });
    jQuery('.brando_remove_button').click(function () {
		var remove_parent = jQuery(this).parent();
		remove_parent.find('input[type="hidden"]').val('');
		remove_parent.find('.upload_image_screenshort').slideUp();
	});

    // Remove ads from themesettings header.
    setTimeout(function(){ 
        if($( '#redux-header' ).find(".rAds")){
            $(".rAds").remove();
        }
    }, 1000);
});
	