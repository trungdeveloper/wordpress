<?php
/**
 * Created by PhpStorm.
 * User: ramnepal
 * Date: 1/14/19
 * Time: 4:56 PM
 */

if( ! class_exists('WP_Customize_Control') ){
    return NULL;
}

class maicha_blog_Top_Dropdown_Customize_Control extends WP_Customize_Control
{
    public $type = 'select';

    public function render_content()
    {
        $terms = get_terms('category');
        ?>
        <label>
            <span class="customize-control-title"><?php echo esc_html($this->label); ?></span>
            <p class="customize-control-description"><?php esc_html_e('Posts assigned to the respective category will be displayed)','maicha-blog') ?></p>
                <select <?php $this->link(); ?>>
                    <option value="none">None</option>
                    <?php
                    foreach ($terms as $t)
                        echo '<option value="' . esc_attr($t->slug) . '"' . selected($this->value(), esc_attr($t->name), false) . '>' . esc_attr($t->name) . '</option>';
                    ?>
                </select>

        </label>

        <?php
    }
}


if (!function_exists('maicha_blog_get_categories_select')) :
   function maicha_blog_get_categories_select()
   {
       $maicha_blog_cat = get_categories();
       $results = array();

       if (!empty($maicha_blog_cat)) :
           $results[''] = __('Select Category', 'maicha-blog');
           foreach ($maicha_blog_cat as $result) {
               $results[$result->slug] = $result->name;
           }
       endif;
       return $results;
   }
endif;

function maicha_blog_sanitize_image( $image, $setting ) {
  $type = array(
    'jpg|jpeg|jpe' => 'image/jpeg',
    'gif'          => 'image/gif',
    'png'          => 'image/png',
    'bmp'          => 'image/bmp',
    'tif|tiff'     => 'image/tiff',
    'ico'          => 'image/x-icon',
  );
  $file = wp_check_filetype( $image, $type );
  return ( $file['ext'] ? $image : $setting->default );
}

