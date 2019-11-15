<?php
global $post;
$breadcrumb_option = get_post_meta($post->ID, 'maicha_blog_pro_breadcrumb_options', true);
$mb_theme_options = maicha_blog_theme_options();
$slider_checkbox = $mb_theme_options['slider_checkbox'];


if (is_page_template('page-templates/homepage.php') && $slider_checkbox== 1){
    $animated_slider_category = $mb_theme_options['animated_slider_category'];
    if($animated_slider_category && 'none' != $animated_slider_category){
        $args = array(
            'post_type' => 'post',
            'posts_per_page' => 3,
            'post_status' => 'publish',
            'order' => 'desc',
            'orderby' => 'menu_order date',
            'tax_query' => array(
                'relation' => 'AND',
                array(
                    'taxonomy' => 'category',
                    'field'    => 'slug',
                    'terms'    => array( $animated_slider_category ),
                ),
            ),
        );
    }
    else{
        $args = array(
            'post_type' => 'post',
            'posts_per_page' => 3,
            'post_status' => 'publish',
            'order' => 'desc',
            'orderby' => 'menu_order date',
        );
    }

    $featured = new WP_Query($args);
    $loop = 0;
?>
<div id="content" class="demo-2 large-animated-slider">
    <div class="slideshow">
        <div class="slides">
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

            <div class="slide">
                <div class="container">
                    <div class="animated-slider-wrap">
                    <div class="slide__img" <?php echo wp_kses_post($image_style); ?>></div>
                   <h2 class="slide__title"><a href="<?php echo esc_url(get_the_permalink()); ?>"> <?php the_title(); ?></a></h2>
                    <p class="slide__desc"><?php echo wp_kses_post(maicha_blog_get_excerpt(get_the_ID(), 100)); ?></p>
                    <a class="slide__link btn btn-default" href="<?php echo esc_url(get_the_permalink()); ?>"><?php esc_html_e("Read More", "maicha-blog") ?></a>
                </div>
                </div>
            </div>
            <?php $loop++;
                endwhile;
                wp_reset_postdata();
            }
            ?>
        </div>

        <nav class="slidenav">
            <button class="slidenav__item slidenav__item--prev"><?php esc_html_e('Previous', 'maicha-blog'); ?></button>
            <span>/</span>
            <button class="slidenav__item slidenav__item--next"><?php esc_html_e('Next', 'maicha-blog'); ?></button>
        </nav>
    </div>
</div>
        <?php
}

?>
