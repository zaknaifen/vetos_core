<?php
/**
 * Plugin Name: SQL Shortcode
 * Plugin URI: http://barkalov.com/
 * Description: This plugin allows you to embed SQL shortcodes on your WordPress posts and pages. Put your SQL query inside shortcode [sql]...[sql] to print result as an HTML table. Put your SQL query inside shortcode [sqlvar]...[/sqlvar] to print result as a single value (e.g. total number of users). See readme.txt for full details about using this plugin.
 * Version: 1.1
 * Author: Victor Barkalov
 * Author URI: http://barkalov.com/
 * 
 * License: GPL2
 */

/*  Copyright 2014  Victor Barkalov

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

add_shortcode( 'sql', 'sql_short_code_handler' );
add_shortcode( 'sqlvar', 'sqlvar_short_code_handler' );

function sql_short_code_get_subcode($subcode, &$content, &$subcode_content) {
	if (strpos($content, "[$subcode]") !== false && strpos($content, "[/$subcode]") !== false && strpos($content, "[/$subcode]") > strpos($content, "[$subcode]")) {
		$subcode_content = substr($content, strpos($content, "[$subcode]") + strlen("[$subcode]"), strpos($content, "[/$subcode]") - strpos($content, "[$subcode]") - strlen("[$subcode]"));
		$content = substr($content, 0, strpos($content, "[$subcode]")) . substr($content, strpos($content, "[/$subcode]") + strlen("[/$subcode]"));
		
	}
}

function sql_short_code_unautop($content) {
	return str_replace("&#8221;", '"', str_replace("&#8220;", '"', str_replace("&#8217;", "'", str_replace("&#8216;", "'", str_replace("</p>", "", str_replace("<p>", "", str_replace("<br />", "\n", $content)))))));
}

function sql_short_code_complete_xsl($xsl) {
	if ($xsl == "") {
		return $xsl;
	} else {
		if (strpos($xsl, "<xsl:template") === false) $xsl = "<xsl:template match='/'>$xsl</xsl:template>";
		if (strpos($xsl, "<xsl:stylesheet") === false) $xsl = "<xsl:stylesheet version='1.0' xmlns:xsl='http://www.w3.org/1999/XSL/Transform'>$xsl</xsl:stylesheet>";
		return $xsl;
	}
}

function sql_short_code_handler($atts, $content = null) {
	global $wpdb;
	$output = "";
	$xsl = "";
	$content = do_shortcode($content);
	sql_short_code_get_subcode("xsl", $content, $xsl);
	$content = sql_short_code_unautop($content);
	$xsl = sql_short_code_unautop($xsl);
	$lwpdb = $wpdb;
	if (isset($atts["user"]) && isset($atts["pass"]) && isset($atts["db"]) && isset($atts["host"])) {
		$wpdb = new wpdb($atts["user"], $atts["pass"], $atts["db"], $atts["host"]);
	}
	$results = $lwpdb->get_results($content, ARRAY_A);
	$columns = $lwpdb->get_col_info('name');
	if (is_null($columns)) {
		return "ERROR: " . esc_attr($lwpdb->last_error);
	}
	$output .= "<table"
			. (!isset($atts['cellpadding']) ? "" : " cellpadding='" . $atts['cellpadding'] . "'")
			. (!isset($atts['cellpadding']) ? "" : " cellspacing='" . $atts['cellspacing'] . "'")
			//. (!isset($atts['border']) ? "" : " border='" . $atts['border'] . "'")
			. (!isset($atts['class']) ? "" : " class='" . $atts['class'] . "'")
			. (!isset($atts['style']) ? "" : " style='" . $atts['style'] . "'")
			. " border=1 >";
	$output .= "<tr" . (!isset($atts['tr_style']) ? "" : " style='" . $atts['tr_style'] . "'") . ">";
	foreach ($columns as $column) {
		$output .= "<th" . (!isset($atts['th_style']) ? "" : " style='" . $atts['th_style'] . "'") . ">" . esc_attr($column) . "</th>";;
	}
	$output .= "</tr>";
	foreach ($results as $result) {
		$output .= "<tr" . (!isset($atts['tr_style']) ? "" : " style='" . $atts['tr_style'] . "'") . ">";
		$keys = array_keys($result);
		foreach ($keys as $key) {
			$output .= "<td" . (!isset($atts['td_style']) ? "" : " style='" . $atts['td_style'] . "'") . ">" . esc_attr($result[$key]) . "</td>";;
		}
		$output .= "</tr>";
	}
	$output .= "</table>";

	if ($xsl == "") {
		return $output;
	} else {
		$xml = new DOMDocument;
		$xml->loadXml($output);
		$xslXml = new DOMDOcument;
		$xslXml->loadXml(sql_short_code_complete_xsl(trim($xsl)));
		$proc = new XSLTProcessor;
		$proc->importStyleSheet($xslXml);
		return $proc->transformToXml($xml);
	}
}

function sqlvar_short_code_handler($atts, $content = null) {
	global $wpdb;
	$output = "";
	$xsl = "";
	$content = do_shortcode($content);
	sql_short_code_get_subcode("xsl", $content, $xsl);
	$content = sql_short_code_unautop($content);
	$xsl = sql_short_code_unautop($xsl);
	$lwpdb = $wpdb;
	if (isset($atts["user"]) && isset($atts["pass"]) && isset($atts["db"]) && isset($atts["host"])) {
		$wpdb = new wpdb($atts["user"], $atts["pass"], $atts["db"], $atts["host"]);
	}
	return $lwpdb->get_var($content);
}

















