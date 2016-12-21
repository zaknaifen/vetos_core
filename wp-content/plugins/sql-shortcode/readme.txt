=== Plugin Name ===
Contributors: vbarkalov
Tags: sql, shortcode, execute, database, xsl, xslt
Requires at least: 2.7.0
Tested up to: 4.1
License: GPLv2
License URI: http://www.gnu.org/licenses/gpl-2.0.html

This plugin allows you to embed SQL shortcodes on your WordPress posts and pages.

== Description ==

This plugin allows you to embed SQL shortcodes on your WordPress posts and pages. This plugin allows you to embed SQL shortcodes on your WordPress pages. Put your SQL query inside shortcode [sql]...[sql] to print result as an HTML table. Put your SQL query inside shortcode [sqlvar]...[/sqlvar] to print result as a single value (e.g. total number of users).

**STYLING THE OUTPUT**

Style the output by adding any of the following shortcode attributes: cellpadding, cellspacing, border, style, tr_style, th_style, td_style.

**CONNECTING TO A NON-WORDPRESS DATABASE**

By default the query will be run again the WordPress database. If you need to connect to another database, add all of the following shortcode attributes: user, pass, host, db. If any of those attributes are not provided, the plugin will use the WordPress database.

**ADVANCE OUTPUT TRANSFORMATION (XSL)**

The [sql]...[sql] shortcode can have an optional nested shortcode [xsl]...[xsl]. Use the nested shortcode only if you wish to apply an additional XSL transformation to the TABLE output, e.g. if you need to introduce additional formatting not supported by the [sql] shortcode attributes, e.g. convert URLs into hyperlinks, etc.

== Installation ==

Use the standard installation and activation procedure.

1. Unzip the plugin to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Go to "Settings" and then to "Customize Admin Interface" to set up the plugin.

== Screenshots ==

1. Using the [sql] shortcode you can display the list of users of your website.
1. You can execute any SQL query by putting it inside [sql] shortcode.
1. You can make things more complex by specifying a nested shortcode [xsl]...[xsl] to apply any custom formatting or add any custom logic. The possibilities are endless.

== Changelog ==

= 1.0 =
* First stable version of the plugin.
