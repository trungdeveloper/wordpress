<?php
if (!function_exists('maicha_blog_theme_options')) :
    function maicha_blog_theme_options()
    {
        $defaults = array(

            //banner section
            'banner1' => '',
            'banner2' => '',
            'banner3' => '',
            'causes_title' => '',
            'cause1' => '',
            'cause2' => '',
            'cause3' => '',
            'about' => '',
            'add_info' => '',
            'email' => '',
            'phone' => '',
            'cta' => '',
            'ins' => '',
            'yt' => '',
            'gp' => '',
            'fb' => '',
            'tw' => '',
            'blog_section_title' => '',
            'instagram_username' => '',
            'instagram_access' => '',
            'instagram_client' => '',
            'cta_page' => '',
            'mid_post_title' => '',
            'mid_bottom_title' => '',
            'slider_category' => '',
            'thumbnail_post_category' => '',
            'mid_post_category' => '',
            'callout_category' => '',
            'full_width_category' => '',
            'full_width_posts' => 3,
            'featured_post_category' => '',
            'mid_bottom_category' => '',

            'story_layout' => 'layout1',
            'slider_layout' => 'layout1',
            'blog_category' => '',
            'header_padding' => '',
            'header_color_overlay' => '',
            'logo_align' => 'left',
            'slider_num' => 'fourcol',
            'sidebar_option' => 'rightsidebar',
            'quote_subtitle' => '',
            'quote_title' => '',
            'quote_logo' => '',
            'animated_slider_category' => '',
            'slider_checkbox' => 1,
            'blog_checkbox' => 1,
            'banner_checkbox' => 1,
            'quote_checkbox' => 1,
            'mid_checkbox' => 1,
             'prefooter_checkbox' => 1,
            'mid_post_break' => 6,



        );

        $options = get_option('maicha_blog_theme_options', $defaults);

        //Parse defaults again - see comments
        $options = wp_parse_args($options, $defaults);

        return $options;
    }
endif;
