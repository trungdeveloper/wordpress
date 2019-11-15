<?php
$mb_theme_options = maicha_blog_theme_options();
$slider_num = maicha_blog_blog_sec_slider_num();
$blog_category = $mb_theme_options['blog_category'];
$blog_section_title = $mb_theme_options['blog_section_title'];
$blog_checkbox = $mb_theme_options['blog_checkbox'];

if (is_page_template('page-templates/homepage.php') && $blog_checkbox== '1'){
if($blog_category && 'none' != $blog_category){
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
                'terms'    => array( $blog_category ),
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
$blog_result = new WP_Query($args);
$loop = 0;
?>
<div class="small-slider-sec">
    <div class="container">
        <div class="row">
            <?php
            if($blog_section_title){ ?>
                <div class="section-title text-center txt-center">
                    <h2><?php echo esc_html($blog_section_title); ?></h2>
                </div>
            <?php } ?>
            <div class="small-banner-wrap <?php echo esc_attr($slider_num); ?>">
                <?php
                if ($blog_result->have_posts()) {
                    while ($blog_result->have_posts()) : $blog_result->the_post();
                        global $post;
                        $post_format = get_post_format($post->ID);
                        $blog_post_author = get_avatar(get_the_author_meta('ID'), 32);
                        $post_thumbnail_id = get_post_thumbnail_id(get_the_ID());
                        $image = wp_get_attachment_image_src($post_thumbnail_id, 'blog-thumbnail');
                        $author_name = get_the_author_meta('display_name');
                        $category = get_the_category();
                        if (!empty($image)) {
                            $image_style = "style='background-image:url(" . esc_url($image[0]) . ")'";
                        } else {
                            $image_style = '';
                        }
                        ?>
                        <div class="banner-wrap-element">
                            <div class="post-content-wrap">
                                <div class="post-thumb">
                                    <img src="<?php echo esc_url($image[0]) ?>">
                                </div>
                                <div class="post-content">
                                    <h2>
                                        <a href="<?php echo esc_url(get_the_permalink()); ?>"><?php the_title(); ?></a>
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
                        </div>
                        <?php $loop++;
                    endwhile;
                    wp_reset_postdata();
                }
                ?>
            </div>
        </div>
    </div>
</div>
<?php }
