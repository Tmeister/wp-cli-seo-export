<?php

namespace WP_CLI_SEO_EXPORT;

use WP_CLI;

class WP_CLI_SEO_FETCH {

    public function __construct( $args, $assoc_args ) {
        global $post;

        $filename = isset( $args[0] ) ? $args[0] : 'output.csv';
        $headers  = [ 'ID', 'URL', 'Title', 'Post Status', 'Yoast SEO Title', 'Yoast SEO meta description' ];
        $fp       = fopen( dirname( __FILE__ ) . '/../output/' . $filename, 'w' );
        $query    = new \WP_Query( $assoc_args );

        fputcsv( $fp, $headers );
        while ( $query->have_posts() ) {
            $row = [];
            $query->the_post();
            $row[] = $post->ID;
            $row[] = get_permalink( $post->ID );
            $row[] = $post->post_title;
            $row[] = $post->post_status;
            $row[] = get_post_meta( $post->ID, '_yoast_wpseo_title', true );
            $row[] = get_post_meta( $post->ID, '_yoast_wpseo_metadesc', true );

            fputcsv( $fp, $row );
        }

        fclose( $fp );
    }

}