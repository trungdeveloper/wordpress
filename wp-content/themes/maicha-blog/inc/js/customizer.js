jQuery(document).on( 'change' , '[name="header-banner"]' , function(){
    var banner_choice = jQuery("#show_upload_image input[type='checkbox']:checked").val();
        if (banner_choice == 'withbg') {
            jQuery("#customize-control-maicha_blog_theme_options-header_bgimage").removeClass('hide_upload_img');
        }
        else {
            jQuery("#customize-control-maicha_blog_theme_options-header_bgimage").addClass('hide_upload_img');
        }
});
