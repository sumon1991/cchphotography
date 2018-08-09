(function( $ ) {
    'use strict';

    brando_save_option_button();
    
    /* Hide Success Message After 15sec */
    if(jQuery("#run-regenerate-thumbnails").css('display') == 'block'){
        $('#run-regenerate-thumbnails').delay(15000).fadeOut('slow');
    }

    function brando_save_option_button() {

        var $btns = $( 'input[name="redux_save"]' ),
            $form = $('.redux-container'),
            $savedMessage = $form.find('#redux-sticky');
        
        $btns.click(function (e) {
            $('.redux-save-warn').slideUp();
            var $btn = $(this);
            if ($btn.hasClass('loading')) {
                e.preventDefault();
                return;
            }

            var data = $form.find('input,textarea,select').serialize();
            //$form.find('.redux-ajax-loading').show();

            $.ajax({
                url: brando_ajax_button_save['adminajaxurl'],
                type: 'post',
                data: data,
                success: function (data) {
                    //TODO: Show proper saved message
                    OnSaveComplete();
                    //console.log('Ajax Done');
                },
                error: function (data) {
                    alert('Error occured in saving data');
                }
            });

            function OnSaveComplete() {
                //$form.find('.redux-ajax-loading').hide();
                /*$('.saved_notice').slideDown();
                $('.saved_notice').delay( 4000 ).slideUp();*/
            }
            e.preventDefault();
        });
    }

    var stop_ajax_request = false;
    var ajax_call_count = 0;
    var import_completed = false;
    var ajax_import_error = false;

    // Ajax brando log function to show messages
    var brando_log = function(msg) {
        $('.import-ajax-message').append(msg);
        $('.import-ajax-message').animate({"scrollTop": $('.import-ajax-message')[0].scrollHeight}, "fast");
    }

    var refresh_ajax_call_to_import_log = function() {
        
        ajax_call_count++;
        
        if (stop_ajax_request) {
            return;
        }
        
        // Stop Ajax clall After 700Sec.
        if (ajax_call_count > 700) {
            brando_log('Import doesn\'t respond.');
            return;
        }
        
        // Ajax For Refresh Log
        $.ajax({
            url: ajaxurl,
            data: {
                action : 'brando_refresh_import_log'
            },
            success:function(data) {
                
                if (data.search("ERROR") != -1) {
                    ajax_import_error = true;
                }
                
                $('.import-ajax-message').html(data);
                $('.import-ajax-message').animate({"scrollTop": $('.import-ajax-message')[0].scrollHeight}, "fast");
                
                // Add Error Message In Log
                if (ajax_import_error) {
                    stop_ajax_request = true;
                    brando_log('Import error!');
                    return;
                }
                
                // Add Completed Message In Log
                if (import_completed) {
                    stop_ajax_request = true;
                    brando_log('<p>Import Done.</p>');
                    window.location.href = window.location.href + "&show-message=true";
                    return;
                }
            },
            error: function(errorThrown) {
                console.log(errorThrown);
            }
        }).done( function() { 
            
            setTimeout( refresh_ajax_call_to_import_log , 1000) 
        } );
    }

    
    //Brando import data choice script
    jQuery('.brando-import').on('click', function(e) {
        e.preventDefault();

        jQuery(this).parent().find('.import-loader-img').addClass("active");
        var import_messages = jQuery('.import-ajax-message');
        var setup_key = jQuery(this).attr('data-setup-key');
        jQuery('#brando_demo_setup_key').val(setup_key);

        var default_checked = jQuery(this).attr('data-default-checked');
        if(default_checked == 1) {
            jQuery(".brando-checkbox-all").prop("checked", true);
            jQuery(".brando-checkbox").prop("checked", true);
        } else {
            jQuery(".brando-checkbox-all").prop("checked", false);
            jQuery(".brando-checkbox").prop("checked", false);
        }

        jQuery('.brando-import-data-popup').show();
    });

    //Brando check all posts while checked all content
    jQuery('.brando-checkbox-all').on('change', function() {
        jQuery(".brando-checkbox").prop('checked', jQuery(this).prop("checked"));
    });

    //Brando change all content based on checked individual checkbox
    jQuery('.brando-checkbox').on('click', function() {

        if(jQuery(".brando-checkbox").length == jQuery(".brando-checkbox:checked").length) {
            jQuery(".brando-checkbox-all").prop("checked", true);
        } else {
            jQuery(".brando-checkbox-all").prop("checked", false);
        }

    });

    jQuery('#brando_demo_setup_submit').on('click', function(e) {
        e.preventDefault();

        var loading_img = jQuery('.import-loader-img.active');

        var import_messages = jQuery('.import-ajax-message');

        import_messages.empty();

        var message = confirm('Are you sure you want to proceed? Please note that your existing data will be replaced.');

        if( message == true && jQuery(".brando-checkbox:checked").length > 0 && jQuery('#brando_demo_setup_key').val() != '' ) {

            jQuery('.demo-show-message').hide();
            jQuery('.brando-import-data-popup').hide();
            jQuery('.brando-import').attr('disabled', true);
            loading_img.show();
            import_messages.show();
            
            var importOptions = [];
            var setupKey = jQuery('#brando_demo_setup_key').val();
            jQuery(".brando-checkbox:checked").each(function(key, option) {
                importOptions.push(jQuery( option ).val());
            });

            var data = {
                action: 'brando_import_sample_data',
                setup_key: setupKey,
                import_options: importOptions
            };

            jQuery('.importer-notice').hide();

            var request = $.ajax({
              url: ajaxurl,
              type: "POST",
              data: data
            });

            request.success(function(msg) {
                //ajaxmessageend();
                import_completed = true
                loading_img.hide();
                jQuery('.brando-import').attr('disabled', false);
                jQuery('.brando-import-data-popup').hide();
                //console.log( msg );
            });

            request.fail(function(jqXHR, textStatus) {
                alert( "Request failed: " + textStatus );
                jQuery('.brando-import').attr('disabled', false);
            });
            setTimeout(function(){  
                $('html, body').animate({
                    scrollTop: $('.import-ajax-message').offset().top - 50
                }, 2000);
            }, 5000);
            setTimeout( refresh_ajax_call_to_import_log , 1000);
        }
    });

    //----- OPEN
    $('[data-popup-open]').on('click', function(e)  {
        var targeted_setup_key = jQuery(this).attr('data-setup-key');
        $('.brando-demo-option-name').text(targeted_setup_key + ' ');
        var targeted_popup_class = jQuery(this).attr('data-popup-open');
        $('[data-popup="' + targeted_popup_class + '"]').fadeIn(350);

        e.preventDefault();
    });

    //----- CLOSE
    $('[data-popup-close]').on('click', function(e)  {
        var targeted_popup_class = jQuery(this).attr('data-popup-close');
        $('[data-popup="' + targeted_popup_class + '"]').fadeOut(350);
        jQuery('.import-loader-img.active').removeClass("active");
        e.preventDefault();
    });

})( jQuery );

jQuery.noConflict();