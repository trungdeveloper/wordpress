<?php

class td_js_buffer {
    private static $js_header_buffer = '';
    private static $js_wp_admin_buffer = ''; //js buffer that is echoed to wp-admin - it will be outputed after the variables
    private static $js_variables_buffer = '';  // the variable buffer is rendered in header_buffer or wp_admin buffer
    private static $js_footer_buffer = ''; //js buffer for the footer

    private static $js_header_buffer_rendered = false;
    private static $js_footer_buffer_rendered = false;
    private static $js_wp_admin_buffer_rendered = false;


    /**
     * add custom js to the header section of the site
     * @param $js
     * @throws ErrorException
     */
    static function add_to_header($js) {
        if (self::$js_header_buffer_rendered === true) {
            throw new ErrorException("td_js_buffer::add_to_header - the header JS was already rendered when you called td_js_buffer::add_to_header() (ex: was called to late)");
        }
        self::$js_header_buffer .= "\n" . $js;
    }


    /**
     * add custom javascript to wp_admin footer -
     * @NOTICE: the theme ALREADY OUTPUTS ALL THE JS VARIABLES IN THE wp-admin
     * @param $js
     * @throws ErrorException
     */
    static function add_to_wp_admin_footer($js) {
        if (self::$js_wp_admin_buffer_rendered === true) {
            throw new ErrorException("td_js_buffer::add_to_wp_admin_footer - the header JS was already rendered when you called td_js_buffer::add_to_wp_admin_footer() (ex: was called to late)");
        }
        self::$js_wp_admin_buffer .= "\n" . $js;
    }


    /**
     * Add custom javascript to the footer section of the site
     * @param $js
     * @throws ErrorException
     */
    static function add_to_footer($js) {
        if (self::$js_footer_buffer_rendered === true) {
            throw new ErrorException("td_js_buffer::add_to_footer - the header JS was already rendered when you called td_js_buffer::add_to_footer() (ex: was called to late)");
        }
        self::$js_footer_buffer .= "\n" . $js;
    }


    /**
     * add variables to the header of the site + in the wp-admin footer section
     * @param $var string the full javascript name
     * @param $value mixed the value to assign to the javascript variable - the value is json_encode'd
     */
    static function add_variable($var, $value) {
        self::$js_variables_buffer .= "\n" .'var ' . $var . '=' . json_encode($value) . ';';
    }



    /*  ----------------------------------------------------------------------------------------------------
        helper functions to render the buffers in wp hooks + keep the static class
     */
    static function _render_header() {  //renders the variables + custom js
        self::$js_header_buffer_rendered = true;
        return "\n<!-- JS generated by theme -->" . "\n\n<script>\n    " . self::$js_header_buffer . self::$js_variables_buffer . "\n</script>\n\n";
    }

    static function _render_footer() {  //renders the footer js
        self::$js_footer_buffer_rendered = true;
        return "\n<!-- JS generated by theme -->" . "\n\n<script>\n    " . self::$js_footer_buffer . "\n</script>\n\n";
    }

    static function _render_wp_admin_footer() {  //renders only the variables - used in wp-admin
        self::$js_wp_admin_buffer_rendered = true;
        return "\n<!-- JS generated by theme -->" . "\n\n<script>\n    " . self::$js_variables_buffer . "\n" . self::$js_wp_admin_buffer . "\n</script>\n\n";
    }


}


function td_js_buffer_render() {
    echo td_js_buffer::_render_header();
}

function td_js_render_wp_admin_footer() {
    echo td_js_buffer::_render_wp_admin_footer();
}

function td_js_buffer_footer_render() {
    echo td_js_buffer::_render_footer();
}

//load the entire js in front end
add_action('wp_head', 'td_js_buffer_render', 15);

//load only the variables in wp-admin
add_action('admin_footer', 'td_js_render_wp_admin_footer', 15);


//load the footer js
add_action('wp_footer', 'td_js_buffer_footer_render', 100);