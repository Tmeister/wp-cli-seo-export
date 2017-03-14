<?php

namespace WP_CLI_SEO_EXPORT;

use WP_CLI;

class WP_CLI_SEO extends \WP_CLI_Command {
    public function fetch( $args, $assoc_args ) {
        new WP_CLI_SEO_FETCH( $args, $assoc_args );
    }

    public function categories($args, $assoc_args){
        new WP_CLI_SEO_FETCH_CATEGORIES( $args, $assoc_args );
    }
}

WP_CLI::add_command( 'seo:export', __NAMESPACE__ . '\WP_CLI_SEO' );