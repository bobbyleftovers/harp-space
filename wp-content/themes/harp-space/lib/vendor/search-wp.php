<?php
function searchwp_term_highlight_auto_excerpt( $excerpt ) {
    global $post;
    if ( ! is_search() ) {
        return $excerpt;
    }
    // prevent recursion
    remove_filter( 'get_the_excerpt', 'searchwp_term_highlight_auto_excerpt' );
    $global_excerpt = function_exists('searchwp_term_highlight_get_the_excerpt_global') ? searchwp_term_highlight_get_the_excerpt_global( $post->ID, null, get_search_query() ) : $excerpt;
    add_filter( 'get_the_excerpt', 'searchwp_term_highlight_auto_excerpt' );
    return wp_kses_post( $global_excerpt );
}
add_filter( 'get_the_excerpt', 'searchwp_term_highlight_auto_excerpt' );
