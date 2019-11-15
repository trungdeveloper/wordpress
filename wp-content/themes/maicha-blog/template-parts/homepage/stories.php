<?php
$mb_theme_options = maicha_blog_theme_options();
$mid_post_category = $mb_theme_options['mid_post_category'];
$story_layout = $mb_theme_options['story_layout'];
$sidebar_position = $mb_theme_options['sidebar_option'];
$mid_post_title = $mb_theme_options['mid_post_title'];
$mid_checkbox = $mb_theme_options['mid_checkbox'];
$mid_post_break = $mb_theme_options['mid_post_break'];

if (is_page_template('page-templates/homepage.php') && $mid_checkbox== '1'){
if($mid_post_category && 'none' != $mid_post_category){
    /**
 * Set the "paged" parameter (use 'page' if the query is on a static front page).
 *
 * @var int $paged
 */
    $paged = get_query_var( 'page' ) ? intval( get_query_var( 'page' ) ) : 1;
    $args = array(
        'post_type' => 'post',
        'posts_per_page' => $mid_post_break,
        'post_status' => 'publish',
        'order' => 'desc',
        'paged' => $paged,
        'orderby' => 'menu_order date',
        'tax_query' => array(
            'relation' => 'AND',
            array(
                'taxonomy' => 'category',
                'field'    => 'slug',
                'terms'    => array( $mid_post_category ),
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


    $loop = 1;
    if (is_active_sidebar('story-sidebar')) {
        $col = 8;
        $row = 6;
    } else {
        $col = 12;
        $row = 4;
    }
    $check = 12/$row;

if('layout1' == $story_layout && 'rightsidebar' == $sidebar_position){
?>
        <?php if (is_active_sidebar('story-sidebar')) { ?>
            <?php
            $no_sidebar = 'yes-sidebar';
            }
            else{
                $no_sidebar = 'no-sidebar';
            }
        ?>
    <div class="section-siderbar-sec <?php echo esc_attr($no_sidebar); ?>">

        <div class="container">
            <div class="row">

                <div class="col-md-<?php echo esc_attr($col); ?>">
                    <div class="section-title">
                        <h2><?php echo esc_html($mid_post_title); ?></h2>
                    </div>

                    <div class="row">

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

                                    <div class="single-post-wrap">
                                        <div class="post-content-wrap">
                                            <div class="post-thumb">
                                                <img src="<?php echo esc_url($image[0]); ?>">
                                            </div>
                                            <div class="post-content">
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
                                                <h3>
                                                    <a href="<?php echo esc_url(get_the_permalink()); ?>"><?php echo esc_html(get_the_title()); ?></a>
                                                </h3>

                                        <p><?php echo wp_kses_post(maicha_blog_get_excerpt(get_the_ID(), 300)); ?></p>
                                        <a class="btn btn-default" href="<?php echo esc_url(get_the_permalink()); ?>"><?php esc_html_e('Read More', 'maicha-blog'); ?></a>
                                            </div>
                                        </div>
                                    </div>

                                <?php
                                if ($loop % $check == 0) {
                                    echo '</div>';
                                    echo '<div class="row">';
                                }

                                $loop++;
                            endwhile;
                            $total_pages = $featured->max_num_pages;
                            if ($total_pages > 1){

                                $current_page = max(1, get_query_var('page'));
                                echo '<div class="navigation">';

                                echo paginate_links(array(
                                    'base' => get_pagenum_link(1) . '%_%',
                                    'format' => '?paged=%#%',
                                    'current' => $current_page,
                                    'total' => $total_pages,
                                    'type'      => 'list',
                                    'prev_text'          => esc_html__('Previous Posts','maicha-blog'),
                                    'next_text'          => esc_html__('More Posts','maicha-blog'),
                                ));
                                echo '</div>';
                            }
                            wp_reset_postdata();

                        }

                        ?>

                    </div>
                </div>

                <?php if (is_active_sidebar('story-sidebar')) : ?>
                    <div class="col-md-4">
                        <aside id="secondary" class="widget-area">
                        <?php dynamic_sidebar('story-sidebar') ?>
                        </aside>
                    </div>
                <?php
                endif; ?>
            </div>
        </div>
    </div>
    <?php
}



else if('layout2' == $story_layout && 'rightsidebar' == $sidebar_position){
    ?>

    <div class="section-siderbar-sec section-siderbar-style">
        <div class="container">
            <div class="row">
                <div class="col-md-<?php echo esc_attr($col); ?>">
                <div class="section-title">
                    <h2><?php echo esc_html($mid_post_title); ?></h2>
                </div>
                    <div class="row">

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
                        <div class="side-bar-list">
                            <div class="col-md-6">
                                <div class="post-thumb">
                                    <img src="<?php echo esc_url($image[0]); ?>">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="post-content">
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
                                    <h3>
                                        <a href="<?php echo esc_url(get_the_permalink()); ?>"><?php echo esc_html(get_the_title()); ?></a>
                                    </h3>

                                    <p><?php echo wp_kses_post(maicha_blog_get_excerpt(get_the_ID(), 150)); ?></p>
                                        <a class="btn btn-default" href="<?php echo esc_url(get_the_permalink()); ?>"><?php esc_html_e('Read More', 'maicha-blog'); ?></a>
                                </div>
                            </div>
                        </div>

                            <?php
                        endwhile;
                            $total_pages = $featured->max_num_pages;
                            if ($total_pages > 1){

                                $current_page = max(1, get_query_var('page'));
                                echo '<div class="navigation">';

                                echo paginate_links(array(
                                    'base' => get_pagenum_link(1) . '%_%',
                                    'format' => '?paged=%#%',
                                    'current' => $current_page,
                                    'total' => $total_pages,
                                    'type'      => 'list',
                                    'prev_text'          => __('Previous Posts','maicha-blog'),
                                    'next_text'          => __('More Posts','maicha-blog'),
                                ));
                                echo '</div>';
                            }
                            wp_reset_postdata();
                        }
                        ?>

                    </div>
                </div>

                <?php if (is_active_sidebar('story-sidebar')) : ?>
                    <aside id="secondary" class="widget-area">
                    <div class="col-md-4">
                        <?php dynamic_sidebar('story-sidebar') ?>
                    </div>
                    </aside>
                    <?php
                endif; ?>

            </div>
        </div>
    </div>
<?php
}



else if('layout2' == $story_layout && 'leftsidebar' == $sidebar_position){
    ?>

    <div class="section-siderbar-sec section-siderbar-style">
        <div class="container">
            <div class="row">
                <?php if (is_active_sidebar('story-sidebar')) : ?>
                    <aside id="secondary" class="widget-area">
                    <div class="col-md-4">
                        <?php dynamic_sidebar('story-sidebar') ?>
                    </div>
                    </aside>
                    <?php
                endif; ?>

                <div class="col-md-<?php echo esc_attr($col); ?>">
                <div class="section-title">
                    <h2><?php echo esc_html($mid_post_title); ?></h2>
                </div>
                    <div class="row">
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
                        <div class="side-bar-list">
                            <div class="col-md-6">
                                <div class="post-thumb">
                                    <img src="<?php echo esc_url($image[0]); ?>">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="post-content">
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
                                    <h3>
                                        <a href="<?php echo esc_url(get_the_permalink()); ?>"><?php echo esc_html(get_the_title()); ?></a>
                                    </h3>

                                    <p><?php echo wp_kses_post(maicha_blog_get_excerpt(get_the_ID(), 150)); ?></p>
                                        <a class="btn btn-default" href="<?php echo esc_url(get_the_permalink()); ?>"><?php esc_html_e('Read More', 'maicha-blog'); ?></a>
                                </div>
                            </div>
                        </div>

                            <?php
                        endwhile;
                            $total_pages = $featured->max_num_pages;
                            if ($total_pages > 1){

                                $current_page = max(1, get_query_var('page'));
                                echo '<div class="navigation">';

                                echo paginate_links(array(
                                    'base' => get_pagenum_link(1) . '%_%',
                                    'format' => '?paged=%#%',
                                    'current' => $current_page,
                                    'total' => $total_pages,
                                    'type'      => 'list',
                                    'prev_text'          => __('Previous Posts','maicha-blog'),
                                    'next_text'          => __('More Posts','maicha-blog'),
                                ));
                                echo '</div>';
                            }
                            wp_reset_postdata();
                        }
                        ?>

                    </div>
                </div>

            </div>
        </div>
    </div>
<?php
}
else if('layout1' == $story_layout && 'leftsidebar' == $sidebar_position){
    ?>

    <div class="section-siderbar-sec section-siderbar-style">
        <div class="container">
            <div class="row">
                <?php if (is_active_sidebar('story-sidebar')) : ?>
                    <aside id="secondary" class="widget-area">
                    <div class="col-md-4">
                        <?php dynamic_sidebar('story-sidebar') ?>
                    </div>
                    </aside>
                    <?php
                endif; ?>

                <div class="col-md-<?php echo esc_attr($col); ?>">
                <div class="section-title">
                    <h2><?php echo esc_html($mid_post_title); ?></h2>
                </div>
                    <div class="row">
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
                                    <div class="single-post-wrap">
                                        <div class="post-content-wrap">
                                            <div class="post-thumb">
                                                <img src="<?php echo esc_url($image[0]); ?>">
                                            </div>
                                            <div class="post-content">
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
                                                <h3>
                                                    <a href="<?php echo esc_url(get_the_permalink()); ?>"><?php echo esc_html(get_the_title()); ?></a>
                                                </h3>

                                        <p><?php echo wp_kses_post(maicha_blog_get_excerpt(get_the_ID(), 300)); ?></p>
                                        <a class="btn btn-default" href="<?php echo esc_url(get_the_permalink()); ?>"><?php esc_html_e('Read More', 'maicha-blog'); ?></a>
                                            </div>
                                        </div>
                                    </div>

                            <?php
                        endwhile;
                            $total_pages = $featured->max_num_pages;
                            if ($total_pages > 1){

                                $current_page = max(1, get_query_var('page'));
                                echo '<div class="navigation">';

                                echo paginate_links(array(
                                    'base' => get_pagenum_link(1) . '%_%',
                                    'format' => '?paged=%#%',
                                    'current' => $current_page,
                                    'total' => $total_pages,
                                    'type'      => 'list',
                                    'prev_text'          => esc_html__('Previous Posts','maicha-blog'),
                                    'next_text'          => esc_html__('More Posts','maicha-blog'),
                                ));
                                echo '</div>';
                            }
                            wp_reset_postdata();
                        }
                        ?>

                    </div>
                </div>

            </div>
        </div>
    </div>
<?php
}
}
