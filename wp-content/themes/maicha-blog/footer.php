<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package maicha_blog
 */

$mb_theme_options = maicha_blog_theme_options();
$prefooter_checkbox = $mb_theme_options['prefooter_checkbox'];

?>

<footer>

<?php if ($prefooter_checkbox== 1){ ?>
    <section class="footer-sec">
        <div class="container">
            <div class="row">
                <?php if (is_active_sidebar('maicha_blog_footer_1')) : ?>
                    <div class="col-md-4 mob-margin-top">
                        <?php dynamic_sidebar('maicha_blog_footer_1') ?>
                    </div>
                    <?php
                else: maicha_blog_blank_widget();
                endif; ?>
                <?php if (is_active_sidebar('maicha_blog_footer_2')) : ?>
                    <div class="col-md-4 mob-margin-top">
                        <?php dynamic_sidebar('maicha_blog_footer_2') ?>
                    </div>
                    <?php
                else: maicha_blog_blank_widget();
                endif; ?>
                <?php if (is_active_sidebar('maicha_blog_footer_3')) : ?>
                    <div class="col-md-4 mob-margin-top">
                        <?php dynamic_sidebar('maicha_blog_footer_3') ?>
                    </div>
                    <?php
                else: maicha_blog_blank_widget();
                endif; ?>
            </div>
        </div>
    </section>
<?php } ?>
    <section class="bot-footer">
        <div class="container">
            <p><?php esc_html_e('Powered By WordPress', 'maicha-blog');
                esc_html_e(' | ', 'maicha-blog') ?>
                <span><a target="_blank" rel="nofollow"
                   href="<?php echo esc_url('https://nomadicguy.com/product/maicha-blog/'); ?>"><?php esc_html_e('Maicha Blog' , 'maicha-blog'); ?></a></span>
            </p>
        </div>
    </section>

</footer>

<a href='#' class='scroll-to-top'></a>
<?php wp_footer(); ?>

</body>
</html>
