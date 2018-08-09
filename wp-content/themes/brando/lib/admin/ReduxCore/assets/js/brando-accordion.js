(function( $ ) {
    'use strict';

    /* custom tab jquery*/ 
    $(window).load(function() {
        $('.brando-admin-tab-slidingdiv').css("display","none");
        
        $('.brando-admin-tabs > .brando-admin-title').click(function() {
            $('.brando-admin-tab-slidingdiv').slideUp();
            $('.brando-admin-tabs > .brando-admin-title').find('.el-icon-minus').removeClass('el-icon-minus').addClass('el-icon-plus');          
            $('.brando-admin-title').removeClass("active");

            if($(this).next('.brando-admin-tab-slidingdiv').css("display") == "none")
            {
                $(this).next('.brando-admin-tab-slidingdiv').slideDown('500').css("display","block");
                $(this).addClass('active');
                $(this).find('.el-icon-plus').removeClass('el-icon-plus');
                $(this).find('.brando-icon').addClass('el-icon-minus');
            } 
            else {
                $(this).removeClass("active");         
                $(this).next('.brando-admin-tab-slidingdiv').slideUp('500');         
                $(this).find('.el-icon-minus').removeClass('el-icon-minus');
                $(this).find('.brando-icon').addClass('el-icon-plus');
            }

            $.redux.initFields();

        });
    });
       
})( jQuery );

jQuery.noConflict();