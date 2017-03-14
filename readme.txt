=== WP CLI SEO Export metadata ===
Contributors: tmeister

WP_CLI command to export post/pages SEO Metadata

== Description ==
Generate a CSV file with the follow rows, this is handy when the site has

ID
URL
Title
Post Status
Yoast SEO Title
Yoast SEO meta description

This is handy when the site has thousands of posts and the Web UI based plugins can't handle the requests.

Usage:
`wp seo:export fetch --posts_per_page=-1`


