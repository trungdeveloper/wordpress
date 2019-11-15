<?php
$mb_theme_options = maicha_blog_theme_options();
$quote_subtitle = $mb_theme_options['quote_subtitle'];
$quote_title = $mb_theme_options['quote_title'];
$quote_logo = (($mb_theme_options['quote_logo']) ? $mb_theme_options['quote_logo'] : '');
$quote_checkbox = $mb_theme_options['quote_checkbox'];

if (is_page_template('page-templates/homepage.php') && $quote_checkbox== '1'){
?>
<div class="quote-sec section">
    <div class="container">
        <div class="row">
            <div class="quote-wrap text-center">
                <div class="quote-inner">
                    <span><?php echo esc_html($quote_subtitle); ?></span>
                    <h2><?php echo esc_html($quote_title); ?></h2>
                    <?php if ($quote_logo) : ?>
                    <img src="<?php echo esc_url($quote_logo); ?> " alt="">
                <?php endif ?>
                </div>
            </div>
        </div>
    </div>
</div>
        <?php
}

?>
