<?php

namespace WP_CLI_SEO_EXPORT;

use WP_CLI;

class WP_CLI_SEO_FETCH_CATEGORIES {

    public function __construct( $args, $assoc_args ) {
        global $post;

        $filename   = isset( $args[0] ) ? $args[0] : 'output.csv';
        $headers    = [ 'ID', 'Parent Category', 'All Categories', 'URL', 'Title', 'Post Status', 'Yoast SEO Title', 'Yoast SEO meta description' ];
        $fp         = fopen( dirname( __FILE__ ) . '/../output/' . $filename, 'w' );
        $categories = get_terms( [
            'taxonomy' => 'category',
            'parent'   => 0
        ] );
        fputcsv( $fp, $headers );

        foreach ( $categories as $category ) {
//            WP_CLI::log( 'Querying ' . $category->name );
            $query = new \WP_Query( [
                'posts_per_page' => - 1,
                'tax_query'      => [
                    [
                        'taxonomy' => 'category',
                        'field'    => 'term_id',
                        'terms'    => $category->term_id
                    ],
                ],
            ] );

            while ( $query->have_posts() ) {
                $query->the_post();
                $out = [];
                foreach ( get_the_category( $post->ID ) as $k ) {
                    $out[] = htmlspecialchars_decode( $k->name );
                }
//                WP_CLI::log( print_r( $out, true ) );
                $row   = [];
                $row[] = $post->ID;
                $row[] = htmlspecialchars_decode( $category->name );
                $row[] = implode( ' - ', $out );
                $row[] = get_permalink( $post->ID );
                $row[] = htmlspecialchars_decode( $post->post_title );
                $row[] = $post->post_status;
                $row[] = htmlspecialchars_decode( get_post_meta( $post->ID, '_yoast_wpseo_title', true ) );
                $row[] = htmlspecialchars_decode( get_post_meta( $post->ID, '_yoast_wpseo_metadesc', true ) );
//                WP_CLI::log( print_r( $row, true ) );

                fputcsv( $fp, $row );
            }

        }

        fclose( $fp );
    }

}