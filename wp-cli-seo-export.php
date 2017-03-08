<?php
/*
Plugin Name: WP CLI SEO Export metadata
Plugin URI: https://enriquechavez.co/
Description: WP_CLI command to export post/pages SEO Metadata
Author: Enrique Chavez
Version: 1.0
Author URI: https://enriquechavez.co/
*/

namespace WP_CLI_SEO_EXPORT;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( defined( 'WP_CLI' ) && WP_CLI ) {
    require_once dirname( __FILE__ ) . '/inc/class-wp-seo-fetch.php';
    require_once dirname( __FILE__ ) . '/inc/class-wp-seo-export.php';
}
