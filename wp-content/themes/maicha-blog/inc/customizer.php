<?php
/**
 * Maicha Blog Theme Customizer
 *
 * @package maicha_blog
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function maicha_blog_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
    $mb_theme_options = maicha_blog_theme_options();
	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial( 'blogname', array(
			'selector'        => '.site-title a',
			'render_callback' => 'maicha_blog_customize_partial_blogname',
		) );
		$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
			'selector'        => '.site-description',
			'render_callback' => 'maicha_blog_customize_partial_blogdescription',
		) );
	}

    $wp_customize->add_panel(
        'theme_options',
        array(
            'title' => esc_html__('Theme Options', 'maicha-blog'),
            'priority' => 2,
        )
    );



    /* Header Section */

    $wp_customize->add_section(
        'top_header_section',
        array(
            'title' => esc_html__( 'Top Header Section','maicha-blog' ),
            'panel'=>'theme_options',
            'capability'=>'edit_theme_options',
        )
    );




        $wp_customize->add_setting('maicha_blog_theme_options[header_padding]',
        array(
            'default' => $mb_theme_options['header_padding'],
            'type' => 'option',
            'sanitize_callback' => 'sanitize_text_field',
        ));
        $wp_customize->add_control('maicha_blog_theme_options[header_padding]',
        array(
            'label' => esc_html__('Add Padding in Header', 'maicha-blog'),
            'section' => 'top_header_section',
            'type' => 'text',
        ));




        $wp_customize->add_setting('maicha_blog_theme_options[tw]',
        array(
            'default' => $mb_theme_options['tw'],
            'type' => 'option',
            'sanitize_callback' => 'esc_url_raw',
        ));
    $wp_customize->add_control('maicha_blog_theme_options[tw]',
        array(
            'label' => esc_html__('Twitter Link', 'maicha-blog'),
            'section' => 'top_header_section',
            'type' => 'text',
        ));
    $wp_customize->add_setting('maicha_blog_theme_options[fb]',
        array(
            'default' => $mb_theme_options['fb'],
            'type' => 'option',
            'sanitize_callback' => 'esc_url_raw',
        ));
    $wp_customize->add_control('maicha_blog_theme_options[fb]',
        array(
            'label' => esc_html__('Facebook Link', 'maicha-blog'),
            'section' => 'top_header_section',
            'type' => 'text',
        ));
    $wp_customize->add_setting('maicha_blog_theme_options[gp]',
        array(
            'default' => $mb_theme_options['gp'],
            'type' => 'option',
            'sanitize_callback' => 'esc_url_raw',
        ));
    $wp_customize->add_control('maicha_blog_theme_options[gp]',
        array(
            'label' => esc_html__('Google Plus Link', 'maicha-blog'),
            'section' => 'top_header_section',
            'type' => 'text',
        ));
    $wp_customize->add_setting('maicha_blog_theme_options[yt]',
        array(
            'default' => $mb_theme_options['yt'],
            'type' => 'option',
            'sanitize_callback' => 'esc_url_raw',
        ));
    $wp_customize->add_control('maicha_blog_theme_options[yt]',
        array(
            'label' => esc_html__('Youtube Link', 'maicha-blog'),
            'section' => 'top_header_section',
            'type' => 'text',
        ));
    $wp_customize->add_setting('maicha_blog_theme_options[ins]',
        array(
            'default' => $mb_theme_options['ins'],
            'type' => 'option',
            'sanitize_callback' => 'esc_url_raw',
        ));
    $wp_customize->add_control('maicha_blog_theme_options[ins]',
        array(
            'label' => esc_html__('Instagram Link', 'maicha-blog'),
            'section' => 'top_header_section',
            'type' => 'text',
        ));

   /* Banner Section */


    $wp_customize->add_section(
        'am_slider_banner_section',
        array(
            'title' => esc_html__( 'Main Animated Slider','maicha-blog' ),
            'panel'=>'theme_options',
            'capability'=>'edit_theme_options',
        )
    );
 //checkbox sanitization function
     function maicha_blog_sanitize_checkbox( $input ) {
        if ( true === $input ) {
            return 1;
         } else {
            return 0;
         }
    }
    $wp_customize->add_setting('maicha_blog_theme_options[slider_checkbox]',
        array(
            'type' => 'option',
            'default'        => true,
            'default' => $mb_theme_options['slider_checkbox'],
            'sanitize_callback' => 'maicha_blog_sanitize_checkbox',
        )
    );

    $wp_customize->add_control('maicha_blog_theme_options[slider_checkbox]',
        array(
            'label' => esc_html__('Show Slider Section', 'maicha-blog'),
            'type' => 'Checkbox',
            'priority' => 1,
            'section' => 'am_slider_banner_section',

        )
    );

//select sanitization function
    function maicha_blog_sanitize_select( $input, $setting ){

        //input must be a slug: lowercase alphanumeric characters, dashes and underscores are allowed only
        $input = sanitize_key($input);

        //get the list of possible select options
        $choices = $setting->manager->get_control( $setting->id )->choices;

        //return input if valid or return default option
        return ( array_key_exists( $input, $choices ) ? $input : $setting->default );

    }
    $wp_customize->add_setting('maicha_blog_theme_options[animated_slider_category]',
        array(
            'type'    => 'option',
            'sanitize_callback' => 'maicha_blog_sanitize_select',
            'default' => $mb_theme_options['animated_slider_category'],
        ));

    $wp_customize->add_control( 'maicha_blog_theme_options[animated_slider_category]',
        array(
            'section' => 'am_slider_banner_section',
            'type' => 'select',
            'choices' => maicha_blog_get_categories_select(),
            'label'   => esc_html__('Select Category For Banner Section?', 'maicha-blog'),
            'settings' => 'maicha_blog_theme_options[animated_slider_category]',
            'priority' => 1,
        )
    );

    //blog section

    $wp_customize->add_section(
        'nct_blog_section',
        array(
            'title' => esc_html__( 'Blog Section','maicha-blog' ),
            'panel'=>'theme_options',
            'capability'=>'edit_theme_options',
        )
    );
    $wp_customize->add_setting('maicha_blog_theme_options[blog_checkbox]',
        array(
            'type' => 'option',
            'default'        => 1,
            'default' => $mb_theme_options['blog_checkbox'],
            'sanitize_callback' => 'maicha_blog_sanitize_checkbox',
        )
    );

    $wp_customize->add_control('maicha_blog_theme_options[blog_checkbox]',
        array(
            'label' => esc_html__('Show Blog Section', 'maicha-blog'),
            'type' => 'Checkbox',
            'priority' => 1,
            'section' => 'nct_blog_section',

        )
    );
        $wp_customize->add_setting('maicha_blog_theme_options[blog_section_title]',
        array(
            'default' => $mb_theme_options['blog_section_title'],
            'type' => 'option',
            'sanitize_callback' => 'sanitize_text_field',
        ));
        $wp_customize->add_control('maicha_blog_theme_options[blog_section_title]',
        array(
            'label' => esc_html__('Add Section Title', 'maicha-blog'),
            'section' => 'nct_blog_section',
            'type' => 'text',
        ));
    $wp_customize->add_setting('maicha_blog_theme_options[blog_category]',
        array(
            'type'    => 'option',
            'sanitize_callback' => 'maicha_blog_sanitize_select',
            'default' => $mb_theme_options['mid_bottom_category'],
        ));

    $wp_customize->add_control('maicha_blog_theme_options[blog_category]',
        array(
            'section' => 'nct_blog_section',
            'type' => 'select',
            'choices' => maicha_blog_get_categories_select(),
            'label'   => esc_html__('Select Category For Blog Section.', 'maicha-blog'),
            'settings' => 'maicha_blog_theme_options[blog_category]',
            'priority' => 1,
        )
    );

//radio box sanitization function
        function maicha_blog_sanitize_radio( $input, $setting ){

            //input must be a slug: lowercase alphanumeric characters, dashes and underscores are allowed only
            $input = sanitize_key($input);

            //get the list of possible radio box options
            $choices = $setting->manager->get_control( $setting->id )->choices;

            //return input if valid or return default option
            return ( array_key_exists( $input, $choices ) ? $input : $setting->default );

        }
        $wp_customize->add_setting( 'maicha_blog_theme_options[slider_num]', array(
          'capability' => 'edit_theme_options',
          'default' => 'fourcol',
          'sanitize_callback' => 'maicha_blog_sanitize_radio',
          'type' => 'option',
        ) );

        $wp_customize->add_control( 'maicha_blog_theme_options[slider_num]', array(
          'type' => 'radio',
          'section' => 'nct_blog_section', // Add a default or your own section
          'label' =>esc_attr( __('Slides to show', 'maicha-blog') ),
          'description' => esc_attr( __('Choose No of Item in Slider', 'maicha-blog') ),
          'choices' => array(
            'fourcol' => esc_attr( __('Four Column', 'maicha-blog') ),
            'threecol' => esc_attr( __('Three Column', 'maicha-blog') ),
            'twocol' => esc_attr( __('Two Column', 'maicha-blog') ),
          ),
        ) );

    /* Banner Section */

    $wp_customize->add_section(
        'nct_banner_section',
        array(
            'title' => esc_html__( 'Slider & Thumbnail Section','maicha-blog' ),
            'panel'=>'theme_options',
            'capability'=>'edit_theme_options',
        )
    );

    $wp_customize->add_setting('maicha_blog_theme_options[banner_checkbox]',
        array(
            'type' => 'option',
            'default'        => 1,
            'default' => $mb_theme_options['banner_checkbox'],
            'sanitize_callback' => 'maicha_blog_sanitize_checkbox',
        )
    );

    $wp_customize->add_control('maicha_blog_theme_options[banner_checkbox]',
        array(
            'label' => esc_html__('Show Banner Section', 'maicha-blog'),
            'type' => 'Checkbox',
            'priority' => 1,
            'section' => 'nct_banner_section',

        )
    );

    $wp_customize->add_setting('maicha_blog_theme_options[slider_category]',
        array(
            'type'    => 'option',
            'sanitize_callback' => 'maicha_blog_sanitize_select',
            'default' => $mb_theme_options['slider_category'],
        ));

    $wp_customize->add_control('maicha_blog_theme_options[slider_category]',
        array(
            'section' => 'nct_banner_section',
            'type' => 'select',
            'choices' => maicha_blog_get_categories_select(),
            'label'   => esc_html__('Select Category For Left Slider', 'maicha-blog'),
            'settings' => 'maicha_blog_theme_options[slider_category]',
            'priority' => 1,
        )
    );

    $wp_customize->add_setting('maicha_blog_theme_options[thumbnail_post_category]',
        array(
            'type'    => 'option',
            'sanitize_callback' => 'maicha_blog_sanitize_select',
            'default' => $mb_theme_options['thumbnail_post_category'],
        ));

    $wp_customize->add_control('maicha_blog_theme_options[thumbnail_post_category]',
        array(
            'section' => 'nct_banner_section',
            'type' => 'select',
            'choices' => maicha_blog_get_categories_select(),
            'label'   => esc_html__('Select Category For Thumbnail', 'maicha-blog'),
            'settings' => 'maicha_blog_theme_options[thumbnail_post_category]',
            'priority' => 1,
        )
    );




    //mid section with sidebar
    $wp_customize->add_section(
        'nct_mid_section',
        array(
            'title' => esc_html__( 'Mid Section With Sidebar','maicha-blog' ),
            'panel'=>'theme_options',
            'capability'=>'edit_theme_options',
        )
    );
    $wp_customize->add_setting('maicha_blog_theme_options[mid_checkbox]',
        array(
            'type' => 'option',
            'default'        => 1,
            'default' => $mb_theme_options['mid_checkbox'],
            'sanitize_callback' => 'maicha_blog_sanitize_checkbox',
        )
    );

    $wp_customize->add_control('maicha_blog_theme_options[mid_checkbox]',
        array(
            'label' => esc_html__('Show Mid Sidebar Section', 'maicha-blog'),
            'type' => 'Checkbox',
            'priority' => 1,
            'section' => 'nct_mid_section',

        )
    );

        $wp_customize->add_setting('maicha_blog_theme_options[mid_post_title]',
        array(
            'default' => $mb_theme_options['mid_post_title'],
            'type' => 'option',
            'sanitize_callback' => 'sanitize_text_field',
        ));
        $wp_customize->add_control('maicha_blog_theme_options[mid_post_title]',
        array(
            'label' => esc_html__('Add Section Title', 'maicha-blog'),
            'section' => 'nct_mid_section',
            'type' => 'text',
        ));

    $wp_customize->add_setting('maicha_blog_theme_options[mid_post_category]',
        array(
            'type'    => 'option',
            'sanitize_callback' => 'maicha_blog_sanitize_select',
            'default' => $mb_theme_options['mid_post_category'],
        ));

    $wp_customize->add_control('maicha_blog_theme_options[mid_post_category]',
        array(
            'section' => 'nct_mid_section',
            'type' => 'select',
            'choices' => maicha_blog_get_categories_select(),
            'label'   => esc_html__('Select Category For Mid Section With Sidebar?', 'maicha-blog'),
            'settings' => 'maicha_blog_theme_options[mid_post_category]',
            'priority' => 1,
        )
    );
    $wp_customize->add_setting('maicha_blog_theme_options[story_layout]',
        array(
            'default' => $mb_theme_options['story_layout'],
            'type' => 'option',
            'sanitize_callback' => 'maicha_blog_sanitize_select',
        ));
    $wp_customize->add_control('maicha_blog_theme_options[story_layout]',
        array(
            'label' => esc_html__('Choose Layout', 'maicha-blog'),
            'section' => 'nct_mid_section',
            'type' => 'select',
            'choices'  => array(
                'layout1'  => 'Layout 1',
                'layout2' => 'Layout 2',
            ),

        )
    );

    $wp_customize->add_setting('maicha_blog_theme_options[sidebar_option]',
        array(
            'default' => $mb_theme_options['sidebar_option'],
            'type' => 'option',
            'sanitize_callback' => 'maicha_blog_sanitize_select',
        ));
    $wp_customize->add_control('maicha_blog_theme_options[sidebar_option]',
        array(
            'label' => esc_html__('Sidebar Position', 'maicha-blog'),
            'description' => esc_attr( __('Choose Where to place Sidebar?', 'maicha-blog') ),
            'section' => 'nct_mid_section',
            'type' => 'select',
            'choices'  => array(
                'leftsidebar'  => 'Left Sidebar',
                'rightsidebar' => 'Right Sidebar',
            ),

        )
    );
        $wp_customize->add_setting('maicha_blog_theme_options[mid_post_break]',
        array(
            'default' => $mb_theme_options['mid_post_break'],
            'type' => 'option',
            'sanitize_callback' => 'sanitize_text_field',
        ));
        $wp_customize->add_control('maicha_blog_theme_options[mid_post_break]',
        array(
            'label' => esc_html__('No of Posts to show before Breakdown using Navigation', 'maicha-blog'),
            'section' => 'nct_mid_section',
            'type' => 'text',
        ));



    $wp_customize->add_section(
        'nct_quote_section',
        array(
            'title' => esc_html__( 'Quote Section','maicha-blog' ),
            'panel'=>'theme_options',
            'capability'=>'edit_theme_options',
        )
    );
    $wp_customize->add_setting('maicha_blog_theme_options[quote_checkbox]',
        array(
            'type' => 'option',
            'default'        => 1,
            'default' => $mb_theme_options['quote_checkbox'],
            'sanitize_callback' => 'maicha_blog_sanitize_checkbox',
        )
    );

    $wp_customize->add_control('maicha_blog_theme_options[quote_checkbox]',
        array(
            'label' => esc_html__('Show Quote Section', 'maicha-blog'),
            'type' => 'Checkbox',
            'priority' => 1,
            'section' => 'nct_quote_section',

        )
    );
    $wp_customize->add_setting('maicha_blog_theme_options[quote_subtitle]',
        array(
            'default' => $mb_theme_options['quote_subtitle'],
            'type' => 'option',
            'sanitize_callback' => 'sanitize_text_field',
        ));
    $wp_customize->add_control('maicha_blog_theme_options[quote_subtitle]',
        array(
            'label' => esc_html__('Enter Subtitle', 'maicha-blog'),
            'section' => 'nct_quote_section',
            'type' => 'text',
            ));

    $wp_customize->add_setting('maicha_blog_theme_options[quote_title]',
        array(
            'default' => $mb_theme_options['quote_title'],
            'type' => 'option',
            'sanitize_callback' => 'sanitize_text_field',
        ));
    $wp_customize->add_control('maicha_blog_theme_options[quote_title]',
        array(
            'label' => esc_html__('Enter Description', 'maicha-blog'),
            'section' => 'nct_quote_section',
            'type' => 'text',
            ));

    $wp_customize->add_setting('maicha_blog_theme_options[quote_logo]',
    array(
        'default' => $mb_theme_options['quote_logo'],
        'type' => 'option',
        'sanitize_callback' => 'maicha_blog_sanitize_image',
    ));
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'maicha_blog_theme_options[quote_logo]',
        array(
            'label' => __( 'Upload Quote Logo', 'maicha-blog' ),
            'section' => 'nct_quote_section',
            'settings' => 'maicha_blog_theme_options[quote_logo]',

        ) )
    );



    $wp_customize->add_section(
        'nct_prefooter_section',
        array(
            'title' => esc_html__( 'Prefooter Section','maicha-blog' ),
            'panel'=>'theme_options',
            'capability'=>'edit_theme_options',
        )
    );
    $wp_customize->add_setting('maicha_blog_theme_options[prefooter_checkbox]',
        array(
            'type' => 'option',
            'default'        => 1,
            'default' => $mb_theme_options['prefooter_checkbox'],
            'sanitize_callback' => 'maicha_blog_sanitize_checkbox',
        )
    );

    $wp_customize->add_control('maicha_blog_theme_options[prefooter_checkbox]',
        array(
            'label' => esc_html__('Show Prefooter Section', 'maicha-blog'),
            'type' => 'Checkbox',
            'priority' => 1,
            'section' => 'nct_prefooter_section',

        )
    );


}
add_action( 'customize_register', 'maicha_blog_customize_register' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function maicha_blog_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function maicha_blog_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function maicha_blog_customize_preview_js() {
	wp_enqueue_script( 'maicha-blog-customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'maicha_blog_customize_preview_js' );
