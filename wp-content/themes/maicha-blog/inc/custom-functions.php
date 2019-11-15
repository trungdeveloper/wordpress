<?php
if (!function_exists('maicha_blog_get_excerpt')) :
    function maicha_blog_get_excerpt($post_id, $count)
    {
        $content_post = get_post($post_id);
        $excerpt = $content_post->post_content;

        $excerpt = strip_shortcodes($excerpt);
        $excerpt = strip_tags($excerpt);


        $excerpt = preg_replace('/\s\s+/', ' ', $excerpt);
        $excerpt = preg_replace('#\[[^\]]+\]#', ' ', $excerpt);
        $strip = explode(' ', $excerpt);
        foreach ($strip as $key => $single) {
            if (!filter_var($single, FILTER_VALIDATE_URL) === false) {
                unset($strip[$key]);
            }
        }
        $excerpt = implode(' ', $strip);

        $excerpt = substr($excerpt, 0, $count);
        if (strlen($excerpt) >= $count) {
            $excerpt = substr($excerpt, 0, strripos($excerpt, ' '));
            $excerpt = $excerpt . '...';
        }
        return $excerpt;
    }
endif;
if (!function_exists('maicha_blog_blog_post_format')) {
    function maicha_blog_blog_post_format($post_format, $post_id)
    {
        global $post;

        if ($post_format == 'video') {

            $content = trim(get_post_field('post_content', $post->ID));
            $ori_url = explode("\n", esc_html($content));
            $url = $ori_url[0];
            $url_type = explode(" ", $url);
            $url_type = explode("[", $url_type[0]);

            if (isset($url_type[1])) {
                $url_type_shortcode = $url_type[1];
            }
            $new_content = get_shortcode_regex();
            if (isset($url_type[1])) {

            } else {
                if (!is_single())
                    echo wp_kses_post(wp_oembed_get(maicha_blog_the_featured_video($content)));
            }

        } elseif ($post_format == 'gallery') {
            add_filter( 'shortcode_atts_gallery', 'maicha_blog_shortcode_atts_gallery' );
            $image_url = get_post_gallery_images($post_id);
            $post_thumbnail_id = get_post_thumbnail_id($post_id);
            $attachment = get_post($post_thumbnail_id);
            $gallery = get_post_gallery($post, false);
            if ($gallery != '') {
                $image_list = '';
                if (is_array($gallery) && array_key_exists('ids', $gallery)){
                // if (array_key_exists('ids', $gallery)) {
                    $ids = explode(",", $gallery['ids']);
                } else {
                    $ids = $image_url;
                }

            if ( is_archive() ) {
                ?>

                <div class="post-gallery">
                    <div class="post-format-gallery">
                        <?php foreach ($ids as $id) {
                            if (array_key_exists('ids', $gallery)) {

                                $link = wp_get_attachment_url($id);
                            } else {
                                $link = $id;
                            }

                            ?>
                            <div class="slider-item" style="background-image: url('<?php echo esc_url($link); ?>');">
                            </div>
                        <?php } ?>
                    </div>

                </div> <?php
                }
                elseif(is_single()){
                    the_post_thumbnail();
                }
            ?>
            <?php } else {
                if (has_post_thumbnail() && !is_single() && is_page_template('page-templates/template-home.php')) {
                    echo '<div class="featured-image archive-thumb">';
                    echo '<a  href="' . esc_url(get_the_permalink()) . '" class="post-thumbnail">';
                    the_post_thumbnail();
                    echo '<div class="share-mask"><div class="share-wrap"></div></div></a></div>';
                } else {
                    the_post_thumbnail();
                }
            }
        } else {
            if (has_post_thumbnail() && !is_single() && is_page_template('page-templates/template-home.php')) {
                echo '<div class="featured-image archive-thumb">';
                echo '<a  href="' . esc_url(get_the_permalink()) . '" class="post-thumbnail">';

                the_post_thumbnail();
                echo '<div class="share-mask"><div class="share-wrap"></div></div></a></div>';
            } else {
                the_post_thumbnail();
            }
        }
    }
}


if (!function_exists('maicha_blog_the_featured_video')) {
    function maicha_blog_the_featured_video($content)
    {
        $ori_url = explode("\n", $content);
        $url = $ori_url[0];
        $w = get_option('embed_size_w');
        if (is_single() || is_archive() || is_search() || is_home() || is_page_template('page-templates/template-home.php')) {
            $url = str_replace('448', $w, $url);

            return $url;
        }
        if (0 === strpos($url, 'https://') || 0 == strpos($url, 'http://')) {
            echo esc_url(wp_oembed_get($url));
            $content = trim(str_replace($url, '', $content));
        } elseif (preg_match('#^<(script|iframe|embed|object)#i', $url)) {
            $h = get_option('embed_size_h');
            echo esc_url($url);
            if (!empty($h)) {

                if ($w === $h) $h = ceil($w * 0.75);
                $url = preg_replace(
                    array('#height="[0-9]+?"#i', '#height=[0-9]+?#i'),
                    array(sprintf('height="%d"', $h), sprintf('height=%d', $h)),
                    $url
                );
                echo esc_url($url);
            }
            $content = trim(str_replace($url, '', $content));
        }

    }
}


if (!function_exists('maicha_blog_blank_widget')) {

    function maicha_blog_blank_widget()
    {
        echo '<div class="col-md-4">';
        if (is_user_logged_in() && current_user_can('edit_theme_options')) {
            echo '<a href="' . esc_url(admin_url('widgets.php')) . '" target="_blank"><i class="fa fa-plus-circle"></i> ' . esc_html__('Add Footer Widget', 'maicha-blog') . '</a>';
        }
        echo '</div>';
    }
}


if (!function_exists('maicha_blog_shortcode_atts_gallery')) {

    function maicha_blog_shortcode_atts_gallery($out)
    {
        remove_filter(current_filter(), __FUNCTION__);
        $out['size'] = 'full';
        return $out;
    }
}



if (!function_exists('maicha_blog_archive_link')) {
    function maicha_blog_archive_link($post)
    {
        $year = date('Y', strtotime($post->post_date));
        $month = date('m', strtotime($post->post_date));
        $day = date('d', strtotime($post->post_date));
        $link = site_url('') . '/' . $year . '/' . $month . '?day=' . $day;
        return $link;
    }
}

if ( ! function_exists('maicha_blog_logo_align_class') ) {
    function maicha_blog_logo_align_class() {
        $mb_theme_options = maicha_blog_theme_options();
        $logo_align_class = $mb_theme_options['logo_align'];

         if ($logo_align_class == 'left' ) {
                $logo_class = 'text-left';
            }
            else if ($logo_align_class  == 'right' ) {
                $logo_class = 'text-right';
            }
            else if ($logo_align_class  == 'center' ) {
                $logo_class = 'text-center';
            }
            return $logo_class;
    }
}

if ( ! function_exists('maicha_blog_blog_sec_slider_num') ) {
    function maicha_blog_blog_sec_slider_num() {
        $mb_theme_options = maicha_blog_theme_options();
        $slider_num_class = $mb_theme_options['slider_num'];

         if ($slider_num_class == 'fourcol' ) {
                $slider_num = 'fourcolumn';
            }
            else if ($slider_num_class  == 'threecol' ) {
                $slider_num = 'threecolumn';
            }
            else if ($slider_num_class  == 'twocol' ) {
                $slider_num = 'twocolumn';
            }
            return $slider_num;
    }
}

       
if(function_exists('awesome_istragram_feed_scripts') ) {
function maicha_blog_instagram(){
    
        echo do_shortcode('[awesome_instagram_feed]');
    
}
add_action('maicha_blog_header','maicha_blog_instagram');
}