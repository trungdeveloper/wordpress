=== Easy Query - WP Query Builder===
Contributors: dcooney
Donate link: https://connekthq.com/donate/
Tags: query, builder, wp_query, simple, generator, paging, paged, shortcode builder, shortcode, search, tags, category, post types, query builder
Requires at least: 3.6
Tested up to: 5.2.2
Stable tag: 2.0.4
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Create a custom WordPress query in seconds with Easy Query.

== Description ==

Easy Query is the fastest and simplest way to build and display WordPress queries without writing a single line of code.

Visually build a custom `easy_query` shortcode and `WP_Query` code snippet based on the content of your website by adjusting various parameters in the Query Builder. Then simply place the generated shortcode or WP_Query() directly into a template, content editor or widget area of your theme.


###Features

* **Query Builder** - Create your own Easy Query shortcode in seconds by adjusting the various query parameters.
* **Query Generator** - Generate a custom WP_Query by adjusting parameters in the Query Builder.
* **Customizable Template** - The Easy Query customizable template allows you to match the look and feel of your website.
* **Paging** - Easily enable Easy Query paging by setting paging=”true” in your shortcode.
* **Multiple Instances** - Include multiple instances of Easy Query on a page, post or page template.
* **Save Time and Reduce Frustration** - Stop searching the WP Docs and build a query visually using the Query Builder.


> ###Want More?
> Upgrading to **[Easy Query Pro](https://connekthq.com/plugins/easy-query/)** unlocks added features and functionality of the plugin. 

> ####Unlimited Templates
> Create, modify and delete Easy Query templates as you need them with zero restrictions.
> 
> ####Saved Queries
> Save, edit and delete past queries using the custom query editor. 
> 
> ####Responsive Layouts
> A library of fully responsive layout templates ready for use on your website. 
> 
> ####Paging Styles
> Select from additional pagination styles and colors.
> 
> ####Additional Query Arguments
> Unlock additional query parameters such a taxonomy and custom fields. 
> 
> ####Multisite Compatibility
> Install and manage Easy Query templates and queries across multiple sites in your network.
>
> **[Learn more](https://connekthq.com/plugins/easy-query/)**


###Shortcode Parameters

Easy Query accepts a number of parameters that are passed to the WordPress query via shortcode.
 
*   **container** - Select the type of HTML container that will wrap your Easy Query templates. Default = < ul >
*   **classes** - Target your content by adding custom classes to the container. Default = null
*   **template** - Select which template you would like to use. Default = ‘default’
*   **post_type** - Comma separated list of post types. Default = ‘post’
*   **category__in** - A comma separated list of categories to include by ID. Default = null
*   **category__not_in** - A comma separated list of categories to exclude by ID. Default = null
*   **tag__in** - A comma separated list of tags to include by ID. Default = null
*   **tag__not_in** - A comma separated list of tags to exclude by ID. Default = null
*   **day** - Day of the week. Default = null
*   **month** - Month of the year. Default = null
*   **year** - Year of post. Default = null
*   **author** - Query by author id. Default = null
*   **search** - Query search term (‘s’). Default = null
*   **post__in** - Comma separated list of post ID’s to include in query. Default = null 
*   **post__not_in** - Comma separated list of post ID’s to exclude from query. Default = null 
*   **post_status** - Select status of the post. Default = 'publish'
*   **order** - Display posts in ASC(ascending) or DESC(descending) order. Default = ‘DESC’
*   **orderby** - Order posts by date, title, name, menu order, random, author, post ID or comment count.  Default = ‘date’
*   **offset** - Offset the initial query (number). Default = ’0′
*   **posts_per_page** - Number of posts to load with each Ajax request. Default = ’6′
*   **paging** - Enable Easy Query to page the results. Default = ’true′


###Example Shortcode

    [easy_query type="ul" classes="blog-listing entry-list" template="default" posts_per_page="6" post_type="post, portfolio"]


###Demos
* **[Default](https://connekthq.com/plugins/easy-query/examples/default/)** - Out of the box functionality and styling
* **[Multiple Instances](https://connekthq.com/plugins/easy-query/examples/multiple-instances/)** - Include multiple Easy Query instances on a single page
* **[Owl Carousel](https://connekthq.com/plugins/easy-query/examples/owl-carousel/)** - Creating a responsive jQuery carousel with Owl Carousel


###Tested Browsers

* Firefox (Mac, PC)
* Chrome (Mac, PC, iOS, Android)
* Safari (Mac, iOS)
* IE8+
* Android (Native)
* BB10 (Native)


###Official Website
https://connekthq.com/easy-query/


== Frequently Asked Questions ==


= What are the steps to getting Easy Query to display on my website =

1. Create your shortcode
2. Add the shortcode to your page, by adding it through the content editor or placing it directly within one of your template files.
3. Load a page with your shortcode in place and watch Easy Query load your posts. 

= What are my server requirements? =

Your server must be able to read/write/create files. Easy Query creates the default template on plugin activation and in order to modify the output Easy Query is required to write to the file as well. 

= Can I make modifications to the plugin code? =

Sure, but please be aware that if modifications are made it may affect future updates of the plugin.

= Can I modify the repeater template? =

Yes, visit the Repeater Template section in your WordPress admin.

= How are my templates saved? =

Template data is saved into your WordPress database as well as written directly to a template PHP file in the easy-query plugin directory.

= Can I use custom fields in a template? =

Yes, but you will need to define $post at the top of the template before requesting your custom fields. Like so:
global $post;


== Installation ==

How to install Easy Query.

= Using The WordPress Dashboard =

1. Navigate to the 'Add New' in the plugins dashboard
2. Search for 'Easy Query'
3. Click 'Install Now'
4. Activate the plugin on the Plugin dashboard

= Uploading in WordPress Dashboard =

1. Navigate to the 'Add New' in the plugins dashboard
2. Navigate to the 'Upload' area
3. Select `easy-query.zip` from your computer
4. Click 'Install Now'
5. Activate the plugin in the Plugin dashboard

= Using FTP =

1. Download `easy-query.zip`
2. Extract the `easy-query` directory to your computer
3. Upload the `easy-query` directory to the `/wp-content/plugins/` directory
4. Activate the plugin in the Plugin dashboard


== Screenshots ==

1. Easy Query Dashboard
2. Easy Query Template
3. Custom Query Builder
3. WP_Query Generator


== Upgrade Notice ==
None


== Changelog ==

= 2.0.4 = 
* FIX - Fixed issue with Easy Query pagination showing last page link when not required.

= 2.0.3 = 
** FIX - Fixed issue with Easy Query pagination not working on static frontpage.

= 2.0.2 = 
** FIX - Fix for 'ewpq_query_generator' error in Query Generator.
** UPDATE - Updated license txt.

= 2.0.1 = 
** UPDATE - Adding missing WP_Query generator.
** UPDATE - Updated copy on shortcode builder.
 
= 2.0 = 
** NEW - New look and Feel for 2017 :)
** NEW - Updated paging styles and settings.
** UPDATE - Improvements in template loading. 
** UPDATE - Improved WP_Query. 

= 1.1.1 = 
** FIX ** Pagination not working.
** Update ** Various UI Improvements.

= 1.1.0 = 
** NEW ** Updated Saved Queries to allow for title changes.
** FIX ** Issue with saved queries not saving periodically.
** UPDATE ** Various UI Updates and enhancements.
** UPDATE ** Updated License activation form.

= 1.0.5 =
** FIX ** Updated custom classes being applied to multiple elements in the parsed shortcode. custom_classes param should only be applied to the direct parent of easy query items.
** UPDATE ** Updating broken admin layout in WordPress 4.4

= 1.0.4 =
** NEW ** Added new shortcode parameter 'custom_args' which will let users pass custom query params. e.g. custom_args="post_parent:1745;tag_slug__and:array(design,development)"

= 1.0.3 =
Security Update - We have added an extra layer of security verification around the saving of custom templates and queries.

= 1.0.2 =
Fix for date query parameters

= 1.0 =
Initial Release