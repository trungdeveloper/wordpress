<?php
global $post;
$breadcrumb_option = get_post_meta($post->ID, 'maicha_blog_pro_breadcrumb_options', true);
$mb_theme_options = maicha_blog_theme_options();
$banner_checkbox = $mb_theme_options['banner_checkbox'];
if (is_page_template('page-templates/homepage.php') && $banner_checkbox== '1'){
    $slider_category = $mb_theme_options['slider_category'];
    $thumbnail_post_category = $mb_theme_options['thumbnail_post_category'];
    if($slider_category && 'none' != $slider_category){
        $args = array(
            'post_type' => 'post',
            'posts_per_page' => 10,
            'post_status' => 'publish',
            'order' => 'desc',
            'orderby' => 'menu_order date',
            'tax_query' => array(
                'relation' => 'AND',
                array(
                    'taxonomy' => 'category',
                    'field'    => 'slug',
                    'terms'    => array( $slider_category ),
                ),
            ),
        );
    }
    else{
        $args = array(
            'post_type' => 'post',
            'posts_per_page' => 5,
            'post_status' => 'publish',
            'order' => 'desc',
            'orderby' => 'menu_order date',
        );
    }

    $featured = new WP_Query($args);
    $loop = 0;
?>

        <!-- Start of content section -->
        <section class="main-slider-sec">
            <div class="container">
                <div class="col-md-7">
                    <div class="split-slider-wrap">
                        <?php
                        if ($featured->have_posts()) {
                            while ($featured->have_posts()) : $featured->the_post();
                                global $post;
                                $post_format = get_post_format($post->ID);
                                $blog_post_author = get_avatar(get_the_author_meta('ID'), 32);
                                $post_thumbnail_id = get_post_thumbnail_id(get_the_ID());
                                $image = wp_get_attachment_image_src($post_thumbnail_id, 'full');
                                $author_name = get_the_author_meta('display_name');
                                $category = get_the_category();
                                if (!empty($image)) {
                                    $image_style = "style='background-image:url(" . esc_url($image[0]) . ")'";
                                } else {
                                    $image_style = '';
                                }
                                ?>
                                <div class="split-slider">
                                    <div class="slider-img-wrap" <?php echo wp_kses_post($image_style); ?>>
                                    </div>
                                    <div class="slider-post-content">
                                        <h2>
                                            <a href="<?php echo esc_url(get_the_permalink()); ?>"><?php  the_title(); ?></a>
                                        </h2>
                                        <ul class="post-meta">
                                            <li class="meta-date"><a
                                                        href="<?php echo esc_url(maicha_blog_archive_link($post)); ?>">
                                                            <time class="entry-date published"
                                                                  datetime="<?php echo esc_url(maicha_blog_archive_link($post)); ?>"><?php echo esc_html(the_time( get_option( 'date_format' ) )); ?></time>
                                                </a></li>
                                                    <li class="meta-comments"><a
                                                    href="<?php echo esc_url(get_comments_link(get_the_ID()));; ?>"><?php
                            printf(/* translators: 1: number of comments */ _nx('%1$s Comment','%1$s Comments',get_comments_number(),'', 'maicha-blog'), number_format_i18n( get_comments_number() ));?></a></li>
                                            <li class="meta-author"><a
                                                        href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>"><?php esc_html_e('By ', 'maicha-blog'); ?> <?php echo esc_html(get_the_author()); ?></a>
                                            </li>
                                        </ul>

                                        <p><?php echo wp_kses_post(maicha_blog_get_excerpt(get_the_ID(), 270)); ?></p>
                                        <a class="btn btn-default" href="<?php echo esc_url(get_the_permalink()); ?>"><?php esc_html_e('Read More', 'maicha-blog'); ?></a>
                                    </div>
                                </div>
                                <?php $loop++;
                            endwhile;
                            wp_reset_postdata();
                        }
                        ?>
                    </div>
                </div>

                <?php if($thumbnail_post_category && 'none' != $thumbnail_post_category){
                    $args = array(
                        'post_type' => 'post',
                        'posts_per_page' => 10,
                        'post_status' => 'publish',
                        'order' => 'desc',
                        'orderby' => 'menu_order date',
                        'tax_query' => array(
                            'relation' => 'AND',
                            array(
                                'taxonomy' => 'category',
                                'field'    => 'slug',
                                'terms'    => array( $thumbnail_post_category ),
                            ),
                        ),
                    );
                }
                else{
                    $args = array(
                        'post_type' => 'post',
                        'posts_per_page' => 10,
                        'post_status' => 'publish',
                        'order' => 'desc',
                        'orderby' => 'menu_order date',
                    );
                }

                $featured = new WP_Query($args);
                $loop = 0; ?>
                <div class="col-md-5">
                    <div class="thumbnail-right-wrap">
                        <?php
                        if ($featured->have_posts()) {
                            while ($featured->have_posts()) : $featured->the_post();
                                global $post;
                                $post_format = get_post_format($post->ID);
                                $blog_post_author = get_avatar(get_the_author_meta('ID'), 32);
                                $post_thumbnail_id = get_post_thumbnail_id(get_the_ID());
                                $image = wp_get_attachment_image_src($post_thumbnail_id, 'full');
                                $author_name = get_the_author_meta('display_name');
                                $category = get_the_category();
                                if (!empty($image)) {
                                    $image_style = "style='background-image:url(" . esc_url($image[0]) . ")'";
                                } else {
                                    $image_style = '';
                                }
                                ?>
                        <div class="thumbnail-post-item">
                            <div class="thumbnail-post-img">
                                <img src="<?php echo esc_url($image[0]) ?>">
                            </div>

                            <div class="thumbnail-post-content">
                                <h2>
                                    <a href="<?php echo esc_url(get_the_permalink()); ?>"><?php  the_title(); ?></a>
                                </h2>
                                <ul class="post-meta">
                                    <li class="meta-date"><a
                                                href="<?php echo esc_url(maicha_blog_archive_link($post)); ?>">
                                                            <time class="entry-date published"
                                                                  datetime="<?php echo esc_url(maicha_blog_archive_link($post)); ?>"><?php echo esc_html(the_time( get_option( 'date_format' ) )); ?></time>
                                        </a></li>
                                                    <li class="meta-comments"><a
                                                    href="<?php echo esc_url(get_comments_link(get_the_ID()));; ?>"><?php
                            printf(/* translators: 1: number of comments */ _nx('%1$s Comment','%1$s Comments',get_comments_number(),'', 'maicha-blog'), number_format_i18n( get_comments_number() ));?></a></li>
                                </ul>

                            </div>
                        </div>
                                <?php $loop++;
                            endwhile;
                            wp_reset_postdata();
                        }
                        ?>
                    </div>
                </div>
            </div>
        </section>
        <?php
}

?>
