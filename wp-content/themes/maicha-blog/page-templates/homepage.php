<?php
/**
 *
 * Template Name: Frontpage

 *
 */

get_header();
get_template_part('template-parts/homepage/animated-slider','null');
get_template_part('template-parts/homepage/blog','null');
get_template_part('template-parts/homepage/split-slider','null');
get_template_part('template-parts/homepage/stories','null');
get_template_part('template-parts/homepage/quote','null');
do_action('maicha_blog_header');
get_footer();
