<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package maicha_blog
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open();  ?>
<a class="skip-link screen-reader-text" href="#content"><?php _e( 'Skip to content', 'maicha-blog' ); ?></a>
<?php
global $post;
$mb_theme_options = maicha_blog_theme_options();
$email = $mb_theme_options['email'];
$phone = $mb_theme_options['phone'];
$twitter = $mb_theme_options['tw'];
$facebook = $mb_theme_options['fb'];
$google = $mb_theme_options['gp'];
$youtube = $mb_theme_options['yt'];
$instagram = $mb_theme_options['ins'];
$header_padding = $mb_theme_options['header_padding'];

// print_r($logo_class);
$slider_image_url = get_header_image();

if (!empty($slider_image_url)) {
    $image_style = "background-image:url(" . esc_url($slider_image_url) . ");"; ?>
    <?php
} else {
    $image_style = "";
}
?>

<header class="site-header headers-extended" role="banner">
    <!-- Start of Naviation -->
    <div class="nav-wrapper">
            <nav id="primary-nav" class="navbar navbar-default">
                    <!-- Brand and toggle get grouped for better mobile display -->
                <div class="mobile-top-header" style="<?php echo wp_kses_post($image_style); ?> padding-top: <?php echo esc_html($header_padding) ?>;padding-bottom: <?php echo esc_html($header_padding) ?>" >
                <div class="container">
                    <div class="row">
                        <div class="header-logo">
                            <?php
                            $description = get_bloginfo('description', 'display');
                            if ((function_exists('the_custom_logo') && has_custom_logo())) {
                                the_custom_logo();
                            } else {
                                ?>
                                <h3 class="site-title"><a class="navbar-brand"
                                                          href="<?php echo esc_url(home_url('/')); ?>"><?php bloginfo('name'); ?></a>
                                </h3>
                                <p class="site-description"><?php echo esc_html($description) ?></p>
                                <?php
                            }
                            ?>
                        </div>
                        <div class="navbar-col header-icon">
                            <ul class="nav navbar-nav navbar-left">
                            <div class="top-social-icons">

                                    <ul class="social-icons">
                                        <?php if ($twitter || $facebook || $google || $youtube || $instagram):
                                        if ($twitter)
                                            echo '<li><a href="' . esc_url($twitter) . '" class="social-icon"> <i class="fa fa-twitter"></i></a></li>';
                                        if ($facebook)
                                            echo '<li><a href="' . esc_url($facebook) . '" class="social-icon"> <i class="fa fa-facebook"></i></a></li>';
                                        if ($google)
                                            echo '<li><a href="' . esc_url($google) . '" class="social-icon"> <i class="fa fa-google-plus"></i></a></li>';
                                        if ($youtube)
                                            echo '<li><a href="' . esc_url($youtube) . '" class="social-icon"> <i class="fa fa-youtube"></i></a></li>';
                                        if ($instagram)
                                            echo '<li><a href="' . esc_url($instagram) . '" class="social-icon"> <i class="fa fa-instagram"></i></a></li>';
                                         endif; ?>
                                        <li>
                                            <div class="navbar-header">
                                                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                                                        data-target="#navbar-collapse" aria-expanded="false">
                                                    <span class="sr-only"><?php echo esc_html__('Toggle navigation','maicha-blog'); ?></span>
                                                    <span class="icon-bar"></span>
                                                    <span class="icon-bar"></span>
                                                    <span class="icon-bar"></span>
                                                </button>
                                            </div>
                                        </li>
                                    </ul>



                            </div>
                            </ul>
                        </div>
                        </div>
                    </div>
                </div>


                <div class="top-header mobile-hide" style="<?php echo wp_kses_post($image_style); ?> padding-top: <?php echo esc_html($header_padding) ?>;padding-bottom: <?php echo esc_html($header_padding) ?>" >
                    <div class="container">
                        <div class="row">

                            <div class="navbar-col header-icon mobile-hide">
                                <ul class="nav navbar-nav navbar-left">
                                <div class="top-social-icons">

                                    <?php if ($twitter || $facebook || $google || $youtube || $instagram): ?>
                                        <ul class="social-icons">
                                            <?php
                                            if ($twitter)
                                                echo '<li><a href="' . esc_url($twitter) . '" class="social-icon"> <i class="fa fa-twitter"></i></a></li>';
                                            if ($facebook)
                                                echo '<li><a href="' . esc_url($facebook) . '" class="social-icon"> <i class="fa fa-facebook"></i></a></li>';
                                            if ($google)
                                                echo '<li><a href="' . esc_url($google) . '" class="social-icon"> <i class="fa fa-google-plus"></i></a></li>';
                                            if ($youtube)
                                                echo '<li><a href="' . esc_url($youtube) . '" class="social-icon"> <i class="fa fa-youtube"></i></a></li>';
                                            if ($instagram)
                                                echo '<li><a href="' . esc_url($instagram) . '" class="social-icon"> <i class="fa fa-instagram"></i></a></li>';
                                            ?>

                                        </ul>
                                    <?php endif; ?>


                                </div>
                                </ul>
                            </div>

                            <div class="header-logo">
                                <?php
                                $description = get_bloginfo('description', 'display');
                                if ((function_exists('the_custom_logo') && has_custom_logo())) {
                                    the_custom_logo();
                                } else {
                                    ?>
                                    <h3 class="site-title"><a class="navbar-brand"
                                                              href="<?php echo esc_url(home_url('/')); ?>"><?php bloginfo('name'); ?></a>
                                    </h3>
                                    <p class="site-description"><?php echo esc_html($description) ?></p>
                                    <?php
                                }
                                ?>
                            </div>

                            <div class="header-search-bar mobile-hide">
                            <?php get_search_form(); ?>
                            </div>

                        </div>
                    </div>
                </div>


                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="container">
                    <div class="row">
                        <div class="collapse navbar-collapse" id="navbar-collapse">

                         <?php
                            if (has_nav_menu('primary')) { ?>
                            <?php
                                wp_nav_menu(array(
                                    'theme_location' => 'primary',
                                    'container' => '',
                                    'menu_class' => 'nav navbar-nav navbar-center',
                                    'walker' => new maicha_blog_nav_walker(),
                                    'fallback_cb' => 'maicha_blog_nav_walker::fallback',
                                ));
                            ?>
                            <?php } else { ?>
                                <nav id="site-navigation" class="main-navigation clearfix">
                                    <?php   wp_page_menu(array('menu_class' => 'menu')); ?>
                                </nav>
                            <?php } ?>
                        </div><!-- End navbar-collapse -->
                    </div>
                </div>
            </nav>
            </div>

    <!-- End of Navigation -->
</header>
<!-- End of site header -->

